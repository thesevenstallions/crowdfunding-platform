<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectUpdateRequest;
use App\Http\Resources\ProjectUpdateResource;
use App\Models\Project;
use App\Models\ProjectUpdate;
use App\Services\ProjectUpdateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class ProjectUpdateController extends Controller
{
    protected ProjectUpdateService $projectUpdateService;

    public function __construct(ProjectUpdateService $projectUpdateService)
    {
        $this->projectUpdateService = $projectUpdateService;
    }

    /**
     * @return ResourceCollection
     */
    public function index(): ResourceCollection
    {
        return ProjectUpdateResource::collection(
            $this
                ->projectUpdateService
                ->all(
                    paginate: true,
                    allowedFilters: [
                        'update_date',
                        'project_id',
                    ],
                    allowedSorts: [
                        'update_date',
                    ]
                )
        );
    }

    public function store(StoreProjectUpdateRequest $request, Project $project): JsonResponse
    {
        $projectUpdate = $this->projectUpdateService->create($request->validated(), $project);

        return response()->json([
            'message' => 'Created successfully',
            'model' => ProjectUpdateResource::make($projectUpdate),
        ], Response::HTTP_CREATED);
    }

    public function show(Project $project, ProjectUpdate $projectUpdate): JsonResponse
    {
        return response()->json(
            ProjectUpdateResource::make($projectUpdate),
            Response::HTTP_OK
        );
    }

    public function update(StoreProjectUpdateRequest $request, Project $project, ProjectUpdate $projectUpdate): JsonResponse
    {
        $projectUpdate = $this->projectUpdateService->update($request->validated(), $projectUpdate);

        return response()->json([
            'message' => 'Updated successfully',
            'model' => ProjectUpdateResource::make($projectUpdate),
        ], Response::HTTP_OK);
    }

    public function destroy(Project $project, ProjectUpdate $projectUpdate): JsonResponse
    {
        $this->projectUpdateService->delete($projectUpdate);

        return response()->json([
            'message' => 'Deleted successfully',
        ], Response::HTTP_OK);
    }
}
