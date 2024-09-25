<?php

namespace App\Services;

use App\Models\Project;
use App\Models\ProjectUpdate;
use App\Repositories\ProjectUpdateRepository;

class ProjectUpdateService extends BaseService
{
    protected string $repositoryName = ProjectUpdateRepository::class;

    public function create(array $payload, Project $project): bool|ProjectUpdate
    {
        $payload['project_id'] = $project->getKey();
        return $this->repository->create($payload);
    }

    public function update(array $payload, ProjectUpdate $projectUpdate): ProjectUpdate
    {
        $projectUpdate->update($payload);

        return $projectUpdate->fresh();
    }

    public function delete(ProjectUpdate $projectUpdate): void
    {
        $projectUpdate->delete();
    }
}
