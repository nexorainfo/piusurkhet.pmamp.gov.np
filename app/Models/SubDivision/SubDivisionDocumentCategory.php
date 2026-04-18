<?php

namespace App\Models\SubDivision;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubDivisionDocumentCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'title',
        'title_en',
        'sub_division_id',
    ];


    public function subDivision(): BelongsTo
    {
        return $this->belongsTo(SubDivision::class);
    }
}
