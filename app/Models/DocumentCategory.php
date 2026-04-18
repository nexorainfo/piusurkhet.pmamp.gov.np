<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'document_category_id',
        'title',
        'title_en',
        'show_on_index',
        'position',
        'slug',
    ];

    public function documentCategories(): HasMany
    {
        return $this->hasMany(DocumentCategory::class);
    }

    public function documentCategory(): BelongsTo
    {
        return $this->belongsTo(DocumentCategory::class);
    }

    public function parentCategory(): BelongsTo
    {
        return $this->belongsTo(DocumentCategory::class, 'document_category_id');
    }

    public function mainDocuments(): HasMany
    {
        return $this->hasMany(Document::class, 'main_document_category_id');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}
