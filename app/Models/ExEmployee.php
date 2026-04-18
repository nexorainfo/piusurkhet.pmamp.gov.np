<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExEmployee extends Model
{
    use HasFactory,SoftDeletes;

    protected $dates=[
        'deleted_at',
        'created_at',
        'updated_at',
        'joining_date',
        'leaving_date',
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
        'joining_date',
        'leaving_date',
        'is_chief',
        'status',
    ];


    public function getPhotoAttribute($value): string
    {
        return $this->attributes['photo'] ? asset('storage/' . $this->attributes['photo']) : asset('assets/backend/images/user_icon.jpg');
    }

    public function setPhotoAttribute($value)
    {
        $this->attributes['photo'] = $value->store('employee', 'public');
    }
}
