<?php

namespace App\Models\SubDivision;

use App\Models\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubDivisionDocument extends Model
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
        'sub_division_document_category_id',
        'publisher',
        'publisher_en',
        'date',
        'description',
        'description_en',
        'status',
        'mark_as_new',
        'sub_division_id',
    ];


    public function subDivisionDocumentCategory(): BelongsTo
    {
        return $this->belongsTo(SubDivisionDocumentCategory::class);
    }

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'model');
    }

    public function subDivision(): BelongsTo
    {
        return $this->belongsTo(SubDivision::class);
    }
}
