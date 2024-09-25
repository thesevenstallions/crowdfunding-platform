<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectUpdate extends Model
{
    use HasTimestamps;
    use SoftDeletes;

    protected $casts = [
        'update_date' => 'date',
    ];
    protected $fillable = [
        'update_date',
        'description',
        'project_id',
    ];

    public function project(): BelongsTo{
        return $this->belongsTo(Project::class);
    }
}
