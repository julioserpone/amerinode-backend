<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'capital',
        'code_iso',
        'code_iso3',
        'currency',
        'calling_code',
        'flag_url',
    ];

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'branches');
    }

    /**
     * Scope a query to countries actives.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeIsActive(Builder $query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to countries without timestamps.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeWithoutTimestamp(Builder $query)
    {
        return $query->select([
            'name',
            'capital',
            'code_iso',
            'code_iso3',
            'currency',
            'calling_code',
            'flag_url',
        ]);
    }

    /**
     * Scope a query to active companies of a country
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeWithCompaniesActives(Builder $query)
    {
        $query->with(['companies' => function ($q){
            $q->where('branches.status', 'active');
        }]);
    }
}
