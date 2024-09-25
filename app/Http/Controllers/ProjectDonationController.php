<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectDonationRequest;
use App\Http\Resources\ProjectDonationResource;
use App\Models\Project;
use App\Models\ProjectDonation;
use App\Services\ProjectDonationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class ProjectDonationController extends Controller
{
    protected ProjectDonationService $projectDonationService;

    public function __construct(ProjectDonationService $projectDonationService)
    {
        $this->projectDonationService = $projectDonationService;
    }

    /**
     * @return ResourceCollection
     */
    public function index(): ResourceCollection
    {
        return ProjectDonationResource::collection(
            $this
                ->projectDonationService
                ->all(
                    paginate: true,
                    allowedFilters: [
                        'donor',
                        'project_id',
                    ],
                    allowedSorts: [
                        'donor',
                    ]
                )
        );
    }

    public function store(StoreProjectDonationRequest $request, Project $project): JsonResponse
    {
        $projectDonation = $this->projectDonationService->create($request->validated(), $project);

        return response()->json([
            'message' => 'Created successfully',
            'model' => ProjectDonationResource::make($projectDonation),
        ], Response::HTTP_CREATED);
    }

    public function show(Project $project, ProjectDonation $projectDonation): JsonResponse
    {
        return response()->json(
            ProjectDonationResource::make($projectDonation),
            Response::HTTP_OK
        );
    }

    public function update(StoreProjectDonationRequest $request, Project $project, ProjectDonation $projectDonation): JsonResponse
    {
        $projectDonation = $this->projectDonationService->update($request->validated(), $projectDonation);

        return response()->json([
            'message' => 'Updated successfully',
            'model' => ProjectDonationResource::make($projectDonation),
        ], Response::HTTP_OK);
    }

    public function destroy(Project $project, ProjectDonation $projectDonation): JsonResponse
    {
        $this->projectDonationService->delete($projectDonation);

        return response()->json([
            'message' => 'Deleted successfully',
        ], Response::HTTP_OK);
    }
}
