<?php

namespace App\Models;

use App\Support\BsDateSortKey;
use App\Support\NepaliNumber;
use NepDate\BsDate;
use Throwable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use JetBrains\PhpStorm\ArrayShape;

class Document extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'main_document_category_id',
        'document_category_id',
        'title',
        'title_en',
        'slug',
        'published_date',
        'status',
        'popUp',
        'description',
        'publisher',
        'mark_as_new',
        'title_en',
        'description_en',
        'publisher_en'

    ];

    public function mainDocumentCategory(): BelongsTo
    {
        return $this->belongsTo(DocumentCategory::class, 'main_document_category_id');
    }

    public function documentCategory(): BelongsTo
    {
        return $this->belongsTo(DocumentCategory::class);
    }

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'model');
    }

    protected static function booted(): void
    {
        // Keep the sortable copy of the BS date in step with what staff typed.
        static::saving(function (Document $document) {
            $document->published_date_sort = BsDateSortKey::from($document->published_date);
        });
    }

    /**
     * Published date padded to "२०८३-०५-०५" (or "2083-05-05" on English pages).
     * Falls back to the date as typed if it can't be read.
     */
    public function getPublishedDatePaddedAttribute(): ?string
    {
        $key = $this->published_date_sort ?? BsDateSortKey::from($this->published_date);

        return $key ? NepaliNumber::localize($key) : $this->published_date;
    }

    /** Published date written out, e.g. "५ भदौ २०८३" or "5 Bhadra 2083". */
    public function getPublishedDateLongAttribute(): ?string
    {
        $key = $this->published_date_sort ?? BsDateSortKey::from($this->published_date);
        if (!$key) {
            return $this->published_date;
        }

        [$year, $month, $day] = array_map('intval', explode('-', $key));

        try {
            return BsDate::of($year, $month, $day)->format('long', app()->getLocale() === 'en' ? 'en' : 'ne');
        } catch (Throwable) {
            // A date that doesn't exist in the BS calendar (e.g. a typo): show it padded instead.
            return $this->published_date_padded;
        }
    }

    /**
     * Scope: newest BS published date first. published_date is free text ("२०८३-२-६"),
     * so this sorts on published_date_sort, its zero-padded form ("2083-02-06").
     */
    public function scopeOrderByBsPublishedDateDesc($query)
    {
        return $query->orderByDesc('published_date_sort')->orderByDesc('id');
    }
}
