<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'branchId',
        'company_id',
        'country_id',
        'status',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * @param  Builder  $query
     * @param  array  $country
     * @param  array  $company
     * @param  string|null  $id
     * @return Builder
     */
    public function scopeDuplicate(Builder $query, array $country, array $company, string $id = null): Builder
    {
        if ($id) {
            $query->where('id', '<>', $id);
        }

        return $query->where('country_id', $country['id'])
            ->where('description', $company['id']);
    }
}
