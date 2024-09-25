<?php

namespace App\Repositories;

use App\Models\Project;
use App\Models\ProjectType;
use App\Models\ProjectUpdate;

class ProjectUpdateRepository extends BaseRepository
{
    /**
     * @var string
     */
    public string $modelName = ProjectUpdate::class;
}
