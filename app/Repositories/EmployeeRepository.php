<?php

namespace App\Repositories;

use App\Models\Employee;

class EmployeeRepository
{
    public function all()
    {
        return Employee::paginate(10);
    }

    public function create(array $data)
    {
        return Employee::create($data);
    }

    public function update($id, array $data)
    {
        $employee = Employee::find($id);
        $employee->update($data);
        return $employee;
    }

    public function delete($id)
    {
        return Employee::destroy($id);
    }

    public function find($id)
    {
        return Employee::find($id);
    }
}
