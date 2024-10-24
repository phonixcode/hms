<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\CreateProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Repositories\ProjectRepository;
use App\Traits\HandlesRepositoryActionsTrait;

class ProjectController extends Controller
{
    use HandlesRepositoryActionsTrait;

    private $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = $this->projectRepository->all();
        return $this->successResponse($projects, 'Projects retrieved successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProjectRequest $request)
    {
        return $this->handleCreate(function () use ($request) {
            return $this->projectRepository->create($request->validated());
        }, 'Project created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = $this->projectRepository->find($id);
        if (!$project) {
            return $this->notFoundResponse('Project not found');
        }
        return $this->successResponse($project, 'Project retrieved successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, string $id)
    {
        $project = $this->projectRepository->find($id);
        if (!$project) {
            return $this->notFoundResponse('Project not found');
        }

        return $this->handleUpdate(function () use ($id, $request) {
            return $this->projectRepository->update($id, $request->validated());
        }, 'Project updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = $this->projectRepository->find($id);
        if (!$project) {
            return $this->notFoundResponse('Project not found');
        }

        return $this->handleDelete(function () use ($id) {
            $this->projectRepository->delete($id);
        }, 'Project deleted successfully');
    }
}
