<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    protected ProjectService $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * @return ResourceCollection
     */
    public function index(): ResourceCollection
    {
        return ProjectResource::collection(
            $this
                ->projectService
                ->all(
                    paginate: true,
                    allowedFilters: [
                        'name',
                        'status',
                        'is_special',
                        'is_urgent',
                        'project_type_id',
                    ],
                    allowedSorts: [
                        'name',
                    ],
                    callback: function ($query){
                        return $query->active();
                    }
                )
        );
    }

    public function store(StoreProjectRequest $request): JsonResponse
    {
        $project = $this->projectService->create($request->validated());

        return response()->json([
            'message' => 'Created successfully',
            'model' => ProjectResource::make($project),
        ], Response::HTTP_CREATED);
    }

    public function show(Project $project): JsonResponse
    {
        return response()->json(
            ProjectResource::make($project),
            Response::HTTP_OK
        );
    }

    public function update(UpdateProjectRequest $request, Project $project): JsonResponse
    {
        $project = $this->projectService->update($request->validated(), $project);
        return response()->json([
            'message' => 'Updated successfully',
            'model' => ProjectResource::make($project),
        ], Response::HTTP_OK);
    }

    public function destroy(Project $project): JsonResponse
    {
        $this->projectService->delete($project);
        return response()->json([
            'message' => 'Deleted successfully',
        ], Response::HTTP_OK);
    }
}
