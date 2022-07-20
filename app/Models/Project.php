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

    /**
     * @param  Builder  $query
     * @param  string  $project_type_id
     * @param  string  $branch_id
     * @param  string  $name
     * @param  string  $description
     * @param  string|null  $id
     * @return Builder
     */
    public function scopeDuplicate(Builder $query, string $project_type_id, string $branch_id, string $name, string $description, string $id = null): Builder
    {
        if ($id) {
            $query->where('id', '<>', $id);
        }

        return $query
            ->where('name', $name)
            ->where('description', $description)
            ->where('project_type_id', $project_type_id)
            ->where('branch_id', $branch_id);
    }
}
