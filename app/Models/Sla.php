<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sla extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'status',
    ];

    /**
     * @return HasMany
     */
    public function details(): HasMany
    {
        return $this->hasMany(SlaInfo::class);
    }

    public function relationsNested(): array
    {
        return [
            'details' => function ($q) {
                $q->with([
                    'severity',
                    'timeResponseUnit',
                    'timeRecoveryUnit',
                    'resolutions' => function ($q) {
                        $q->with('unit');
                    },
                    'availabilities' => function ($q) {
                        $q->with('unit');
                    },
                ]);
            },
        ];
    }

    public function scopeListAllOrdered(Builder $query)
    {
        $query->with($this->relationsNested())->orderBy('name');
    }
}
