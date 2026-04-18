<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Department extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'title',
        'title_en',
    ];

    public function employee(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    public function getPhotoAttribute($value): string
    {
        if (!empty($value)) {
            return Storage::disk('public')->url($value);
        }
        return '-';
    }

    public function setPhotoAttribute($value)
    {
        $this->attributes['photo'] = $value->store('slider', 'public');
    }
}
