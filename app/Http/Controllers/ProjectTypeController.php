<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Http\Requests\StoreProjectTypeRequest;
use App\Http\Requests\UpdateProjectTypeRequest;
use App\Http\Resources\ProjectTypeResource;
use App\Models\ProjectType;
use App\Services\ProjectTypeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class ProjectTypeController extends Controller
{
    protected ProjectTypeService $projectTypeService;

    public function __construct(ProjectTypeService $projectTypeService)
    {
        $this->projectTypeService = $projectTypeService;
    }

    /**
     * @return ResourceCollection
     */
    public function index(): ResourceCollection
    {
        return ProjectTypeResource::collection(
            $this
                ->projectTypeService
                ->all(
                    paginate: true,
                    allowedFilters: [
                        'name',
                        'status',
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

    public function store(StoreProjectTypeRequest $request): JsonResponse
    {
        $projectType = $this->projectTypeService->create($request->validated());

        return response()->json([
            'message' => 'Created successfully',
            'model' => ProjectTypeResource::make($projectType),
        ], Response::HTTP_CREATED);
    }

    public function show(ProjectType $projectType): JsonResponse
    {
        return response()->json(
            ProjectTypeResource::make($projectType),
            Response::HTTP_OK
        );
    }

    public function update(UpdateProjectTypeRequest $request, ProjectType $projectType): JsonResponse
    {
        $projectType = $this->projectTypeService->update($request->validated(), $projectType);
        return response()->json([
            'message' => 'Updated successfully',
            'model' => ProjectTypeResource::make($projectType),
        ], Response::HTTP_OK);
    }

    public function destroy(ProjectType $projectType): JsonResponse
    {
        $this->projectTypeService->delete($projectType);
        return response()->json([
            'message' => 'Deleted successfully',
        ], Response::HTTP_OK);
    }
}
