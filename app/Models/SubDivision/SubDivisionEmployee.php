<?php

namespace App\Models\SubDivision;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class SubDivisionEmployee extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'name',
        'name_en',
        'photo',
        'department',
        'department_en',
        'designation',
        'designation_en',
        'level',
        'level_en',
        'phone',
        'email',
        'address',
        'address_en',
        'position',
        'status',
        'is_chief',
        'sub_division_id',
    ];

    protected $casts = [
        'status' => 'boolean',
        'is_chief' => 'boolean',
    ];

    public function subDivision(): BelongsTo
    {
        return $this->belongsTo(SubDivision::class);
    }

    public function getPhotoAttribute($value): string
    {
        return $this->attributes['photo'] ? asset('storage/' . $this->attributes['photo']) : asset('assets/backend/images/user_icon.jpg');
    }

    public function setPhotoAttribute($value)
    {
        $this->attributes['photo'] = $value->store('employee', 'public');
    }
}
