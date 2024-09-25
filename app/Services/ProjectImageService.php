<?php

namespace App\Services;

use App\Models\Project;
use App\Models\ProjectImage;
use App\Repositories\ProjectImageRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProjectImageService extends BaseService
{
    protected string $repositoryName = ProjectImageRepository::class;

    public function create(array $payload, Project $project): bool|ProjectImage
    {
        $payload['project_id'] = $project->getKey();
        if (isset($payload['file_name'])) {
            $payload['file_name'] = $this->uploadFile($payload['file_name'], $project->getKey());
        }
        return $this->repository->create($payload);
    }

    public function update(array $payload, ProjectImage $projectImage): ProjectImage
    {
        $oldImage = $this->getFilePath($projectImage);
        if (isset($payload['file_name'])) {
            $payload['file_name'] = $this->uploadFile($payload['file_name'], $projectImage->project_id);
        }
        $projectImage->update($payload);
        Storage::disk()->delete('public', $oldImage);

        return $projectImage->fresh();
    }

    public function delete(ProjectImage $projectImage): void
    {
        $oldImage = $this->getFilePath($projectImage);
        Storage::disk()->delete('public', $oldImage);
        $projectImage->delete();
    }

    public function uploadFile(UploadedFile $file, $projectId): string
    {
        $path = Storage::disk()->putFile("public/projects/$projectId/", $file);
        return basename(Storage::disk()->path($path));
    }

    public function getFilePath(ProjectImage $projectImage): string
    {
        return Storage::path("projects/{$projectImage->project_id}/".$projectImage->file_name);
    }
    public function getFileUrl(ProjectImage $projectImage): string
    {
        return Storage::url("projects/{$projectImage->project_id}/".$projectImage->file_name);
    }
}
