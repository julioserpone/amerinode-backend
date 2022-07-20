<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Severity extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'name',
        'description',
        'color',
        'status',
    ];

    /**
     * @param  Builder  $query
     * @param  array  $model
     * @param  string|null  $id
     * @return Builder
     */
    public function scopeDuplicate(Builder $query, array $model, string $id = null): Builder
    {
        if ($id) {
            $query->where('id', '<>', $id);
        }

        return $query->where('code', $model['code'])
            ->where('name', $model['name'])
            ->where('description', $model['description']);
    }
}
