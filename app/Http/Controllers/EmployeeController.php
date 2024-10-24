<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Traits\SoftDeleteTrait;
use App\Mail\WelcomeEmployeeMail;
use Illuminate\Support\Facades\Mail;
use App\Repositories\EmployeeRepository;
use App\Traits\HandlesRepositoryActionsTrait;
use App\Http\Requests\Employee\CreateEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    use HandlesRepositoryActionsTrait, SoftDeleteTrait;

    private $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
        $this->model = Employee::class;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = $this->employeeRepository->all();
        return $this->successResponse($employees, 'Employees retrieved successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateEmployeeRequest $request, $project_id)
    {
        $employeeData = $request->validated();

        $employee = $this->handleCreate(function () use ($request, $project_id) {
            return $this->employeeRepository->create(array_merge(
                $request->validated(),
                ['project_id' => $project_id]
            ));
        }, 'Employee created successfully');

    
        Mail::to($employeeData['email'])->send(new WelcomeEmployeeMail($employeeData));
        return $this->successResponse($employee, 'Employee created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = $this->employeeRepository->find($id);
        if (!$employee) {
            return $this->notFoundResponse('Employee not found');
        }
        return $this->successResponse($employee, 'Employee retrieved successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, $project_id, string $id)
    {
        $employee = $this->employeeRepository->find($id);

        // Check if employee exists and belongs to the correct project
        if (!$employee || $employee->project_id != $project_id) {
            return $this->notFoundResponse('Employee not found or does not belong to this project');
        }

        return $this->handleUpdate(function () use ($id, $request) {
            return $this->employeeRepository->update($id, $request->validated());
        }, 'Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = $this->employeeRepository->find($id);
        if (!$employee) {
            return $this->notFoundResponse('Employee not found');
        }

        return $this->handleDelete(function () use ($id) {
            $this->employeeRepository->delete($id);
        }, 'Employee deleted successfully');
    }

    public function restore($id)
    {
        $employee = $this->restoreModel($id);

        if ($employee) {
            return $this->successResponse($employee, 'Employee restored successfully');
        }

        return $this->errorResponse('Failed to restore employee');
    }
}
