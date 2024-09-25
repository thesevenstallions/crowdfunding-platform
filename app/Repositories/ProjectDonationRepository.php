<?php

namespace App\Repositories;

use App\Models\Project;
use App\Models\ProjectDonation;
use App\Models\ProjectType;

class ProjectDonationRepository extends BaseRepository
{
    /**
     * @var string
     */
    public string $modelName = ProjectDonation::class;
}
