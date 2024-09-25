<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasTimestamps;
    use SoftDeletes;

    protected $casts = [
        'is_special' => 'boolean',
        'is_urgent' => 'boolean',
        'status' => Status::class
    ];
    protected $fillable = [
        'name',
        'description',
        'is_special',
        'is_urgent',
        'budget',
        'organizer_name',
        'organizer_position',
        'organizer_company_name',
        'status',
        'project_type_id',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', Status::Active->value);
    }

    public function projectType(): BelongsTo{
        return $this->belongsTo(ProjectType::class);
    }

    public function projectDonations(): HasMany{
        return $this->hasMany(ProjectDonation::class);
    }
    public function projectUpdates(): HasMany{
        return $this->hasMany(ProjectUpdate::class);
    }
    public function projectImages(): HasMany{
        return $this->hasMany(ProjectImage::class);
    }
}
