<?php

namespace App\Services;


use App\Models\Project;
use App\Repositories\ProjectRepository;

class ProjectService extends BaseService
{
    protected string $repositoryName = ProjectRepository::class;

    public function create(array $payload): bool|Project
    {
        return $this->repository->create($payload);
    }

    public function update(array $payload, Project $project): Project
    {
        $project->update($payload);
        return $project->fresh();
    }

    public function delete(Project $project): void
    {
        $project->delete();
    }
}
