<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectImage extends Model
{
    use HasTimestamps;
    protected $fillable = [
        'file_name',
        'title',
        'alt_tag_description',
        'project_id',
    ];

    public function project(): BelongsTo{
        return $this->belongsTo(Project::class);
    }
}
