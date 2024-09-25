<?php

namespace App\Repositories;

use App\Models\Project;
use App\Models\ProjectType;

class ProjectRepository extends BaseRepository
{
    /**
     * @var string
     */
    public string $modelName = Project::class;
}
