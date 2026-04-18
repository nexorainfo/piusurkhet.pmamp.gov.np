<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PedigreeCaste extends Model
{
    use HasFactory,SoftDeletes;

    protected $dates=[
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $fillable=[
        'title',
        'pedigree_category_id',
    ];

    public function pedigree(): HasMany
    {
        return $this->hasMany(Pedigree::class);
    }
    public function pedigreeCategory(): BelongsTo
    {
        return $this->belongsTo(PedigreeCategory::class);
    }
    public function spermDistributions(): HasMany
    {
        return $this->hasMany(SpermDistribution::class);
    }
}
