<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory, SoftDeletes;


    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'model_type',
        'model_id',
        'url',
        'extension',
        'original_name',
    ];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function getPublicUrlAttribute(): string
    {
        return asset('storage/' . $this->url);
    }

    public function getDisplayNameAttribute(): string
    {
        return $this->original_name ?: basename($this->url);
    }

    public function isImage(): bool
    {
        return in_array(strtolower($this->extension), ['jpg', 'jpeg', 'png', 'webp', 'gif'], true);
    }

    public function isPdf(): bool
    {
        return strtolower($this->extension) === 'pdf';
    }

    /** Size in bytes, or null if the file is missing from the disk. */
    public function getSizeAttribute(): ?int
    {
        $disk = Storage::disk('public');

        return $disk->exists($this->url) ? $disk->size($this->url) : null;
    }

    /** Font Awesome 4 icon for the file type. */
    public function getIconAttribute(): string
    {
        return match (strtolower($this->extension)) {
            'pdf' => 'fa-file-pdf-o',
            'jpg', 'jpeg', 'png', 'webp', 'gif' => 'fa-file-image-o',
            'doc', 'docx' => 'fa-file-word-o',
            'xls', 'xlsx', 'csv' => 'fa-file-excel-o',
            'ppt', 'pptx' => 'fa-file-powerpoint-o',
            'zip', 'rar' => 'fa-file-archive-o',
            default => 'fa-file-o',
        };
    }
}
