<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SlaInfo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sla_id',
        'severity_id',
        'time_response',
        'time_response_unit_id',
        'time_recovery',
        'time_recovery_unit_id',
    ];

    /**
     * @return BelongsTo
     */
    public function sla(): BelongsTo
    {
        return $this->belongsTo(Sla::class);
    }

    /**
     * @return BelongsTo
     */
    public function severity(): BelongsTo
    {
        return $this->belongsTo(Severity::class);
    }

    public function timeResponseUnit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'time_response_unit_id');
    }

    public function timeRecoveryUnit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'time_recovery_unit_id');
    }

    public function resolutions(): HasMany
    {
        return $this->hasMany(Resolution::class);
    }

    public function availabilities(): HasMany
    {
        return $this->hasMany(Availability::class);
    }
}
