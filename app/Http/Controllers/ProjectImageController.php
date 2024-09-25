<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectImageRequest;
use App\Http\Requests\UpdateProjectImageRequest;
use App\Http\Resources\ProjectImageResource;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Services\ProjectImageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class ProjectImageController extends Controller
{
    protected ProjectImageService $projectImageService;

    public function __construct(ProjectImageService $projectImageService)
    {
        $this->projectImageService = $projectImageService;
    }

    /**
     * @return ResourceCollection
     */
    public function index(): ResourceCollection
    {
        return ProjectImageResource::collection(
            $this
                ->projectImageService
                ->all(
                    paginate: true,
                )
        );
    }

    public function store(StoreProjectImageRequest $request, Project $project): JsonResponse
    {
        $projectImage = $this->projectImageService->create($request->validated(), $project);

        return response()->json([
            'message' => 'Created successfully',
            'model' => ProjectImageResource::make($projectImage),
        ], Response::HTTP_CREATED);
    }

    public function show(Project $project, ProjectImage $projectImage): JsonResponse
    {
        return response()->json(
            ProjectImageResource::make($projectImage),
            Response::HTTP_OK
        );
    }

    public function update(UpdateProjectImageRequest $request, Project $project, ProjectImage $projectImage): JsonResponse
    {
        $projectImage = $this->projectImageService->update($request->validated(), $projectImage);

        return response()->json([
            'message' => 'Updated successfully',
            'model' => ProjectImageResource::make($projectImage),
        ], Response::HTTP_OK);
    }

    public function destroy(Project $project, ProjectImage $projectImage): JsonResponse
    {
        $this->projectImageService->delete($projectImage);

        return response()->json([
            'message' => 'Deleted successfully',
        ], Response::HTTP_OK);
    }
}
