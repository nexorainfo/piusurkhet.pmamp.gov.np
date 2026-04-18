<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpermDistribution extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'tag',
        'address',
        'duration',
        'pedigree_caste_id',

    ];

    public function pedigreeCaste(): BelongsTo
    {
        return $this->belongsTo(PedigreeCaste::class);
    }

}
