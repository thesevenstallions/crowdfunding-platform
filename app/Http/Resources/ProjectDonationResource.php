<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Number;

class ProjectDonationResource extends JsonResource
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
            'donor' => $this->donor,
            'donation_date' => $this->donation_date->format('d.m.Y'),
            'donation_amount' => Number::currency($this->donation_amount, 'EUR','de'),
        ];
    }
}
