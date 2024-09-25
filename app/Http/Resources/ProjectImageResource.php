<?php

namespace App\Http\Resources;

use App\Services\ProjectImageService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectImageResource extends JsonResource
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
            'file_name' => app(ProjectImageService::class)->getFileUrl($this->resource),
            'title' => $this->title,
            'alt_tag_description' => $this->alt_tag_description,
        ];
    }
}
