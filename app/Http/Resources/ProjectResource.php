<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Number;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status->name,
            'description' => $this->description,
            'is_special' => $this->is_special,
            'is_urgent' => $this->is_urgent,
            'budget' => Number::currency($this->budget, 'EUR','de'),
            'organizer_name' => $this->organizer_name,
            'organizer_position' => $this->organizer_position,
            'organizer_company_name' => $this->organizer_company_name,
            'project_type' => ProjectTypeResource::make($this->projectType),
            'project_donations' => ProjectDonationResource::collection($this->projectDonations),
            'project_updates' => ProjectUpdateResource::collection($this->projectUpdates),
            'project_images' => ProjectImageResource::collection($this->projectImages),
        ];
    }
}
