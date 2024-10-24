<?php

namespace App\Repositories;

use App\Models\Project;

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
}
