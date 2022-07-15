<?php

namespace App\Models;

use Aws\Api\Service;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectType extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'service_type_id',
        'description',
        'status',
    ];

    public function serviceType(): BelongsTo
    {
        return $this->belongsTo(ServiceType::class);
    }

    /**
     * Scope a query to project types with service types.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeAllWithServiceType(Builder $query)
    {
        return $query->withTrashed()->with(['serviceType' => function ($q) {
            $q->withTrashed();
        }]);
    }
}
