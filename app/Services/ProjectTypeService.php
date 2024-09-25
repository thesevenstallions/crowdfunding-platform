<?php

namespace App\Services;


use App\Models\ProjectType;
use App\Repositories\ProjectTypeRepository;

class ProjectTypeService extends BaseService
{
    protected string $repositoryName = ProjectTypeRepository::class;

    public function create(array $payload): bool|ProjectType
    {
        return $this->repository->create($payload);
    }

    public function update(array $payload, ProjectType $projectType): ProjectType
    {
        $projectType->update($payload);
        return $projectType->fresh();
    }

    public function delete(ProjectType $projectType): void
    {
        $projectType->delete();
    }
}
