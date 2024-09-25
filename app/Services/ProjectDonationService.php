<?php

namespace App\Services;

use App\Models\Project;
use App\Models\ProjectDonation;
use App\Repositories\ProjectDonationRepository;

class ProjectDonationService extends BaseService
{
    protected string $repositoryName = ProjectDonationRepository::class;

    public function create(array $payload, Project $project): bool|ProjectDonation
    {
        $payload['project_id'] = $project->getKey();
        return $this->repository->create($payload);
    }

    public function update(array $payload, ProjectDonation $projectDonation): ProjectDonation
    {
        $projectDonation->update($payload);

        return $projectDonation->fresh();
    }

    public function delete(ProjectDonation $projectDonation): void
    {
        $projectDonation->delete();
    }
}
