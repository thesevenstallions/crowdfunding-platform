<?php

namespace App\Models;

use App\Enums\Status;
use App\Models\Scopes\SystemVisibility;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectType extends Model
{
    use HasTimestamps;
    use SoftDeletes;

    protected $casts = [
        'status' => Status::class
    ];
    protected $fillable = [
        'name',
        'status',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', Status::Active->value);
    }
}
