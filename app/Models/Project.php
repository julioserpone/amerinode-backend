<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'projectId',
        'project_type_id',
        'branch_id',
        'name',
        'description',
        'status',
    ];

    public function projectType(): BelongsTo
    {
        return $this->belongsTo(ProjectType::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function relationsNested(): array
    {
        return [
            'projectType' => function ($q) {
                $q->with('serviceType');
            },
            'branch' => function ($q) {
                $q->with(['company', 'country']);
            },
        ];
    }

    public function scopeListAllOrdered(Builder $query)
    {
        $query->with($this->relationsNested())->orderBy('name');
    }
}
