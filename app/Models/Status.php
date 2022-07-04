<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'statusId',
        'module',
        'description',
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

        return $query->where('module', $model['module'])
            ->where('description', $model['description']);
    }
}
