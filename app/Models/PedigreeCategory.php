<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PedigreeCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'title',
    ];


    public function pedigreeCaste(): HasMany
    {
        return $this->hasMany(PedigreeCaste::class);
    }
    public function spermDistributions(): HasMany
    {
        return $this->hasMany(SpermDistribution::class);
    }

}
