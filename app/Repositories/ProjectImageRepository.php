<?php

namespace App\Repositories;

use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\ProjectType;

class ProjectImageRepository extends BaseRepository
{
    /**
     * @var string
     */
    public string $modelName = ProjectImage::class;
}
