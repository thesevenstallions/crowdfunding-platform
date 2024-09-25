<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectDonation extends Model
{
    use HasTimestamps;
    use SoftDeletes;

    protected $casts = [
        'donation_amount' => 'float',
        'donation_date' => 'date',
    ];
    protected $fillable = [
        'donation_amount',
        'donation_date',
        'donor',
        'project_id',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
