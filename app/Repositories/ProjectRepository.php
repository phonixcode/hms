<?php

namespace App\Repositories;

use App\Models\Project;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class ProjectRepository
{
    public function all()
    {
        return Project::all();
    }

    public function create(array $data)
    {
        return Project::create($data);
    }

    public function update($id, array $data)
    {
        $project = Project::find($id);
        $project->update($data);
        return $project;
    }

    public function delete($id)
    {
        return Project::destroy($id);
    }

    public function find($id)
    {
        return Project::find($id);
    }

    public function getDashboardSummary(): array
    {
        $totalProjects = Project::count();
        $totalEmployees = Employee::count();

        $projectsGroupedByStatus = Project::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get()
            ->keyBy('status')
            ->map->total;

        return [
            'total_projects' => $totalProjects,
            'total_employees' => $totalEmployees,
            'projects_grouped_by_status' => $projectsGroupedByStatus,
        ];
    }

    public function getProjectsWithEmployees($search = null, $perPage = 15)
    {
        $query = Project::with('employees');

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('status', 'like', '%' . $search . '%');
        }

        return $query->paginate($perPage);
    }
}
