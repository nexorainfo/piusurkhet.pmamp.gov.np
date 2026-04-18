<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subordinate extends Model
{
    use HasFactory,SoftDeletes;

    protected $dates=[
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $fillable=[
        'title',
        'title_en',
        'logo',
        'url',
        'phone',
        'email',

    ];


    public function getPhotoAttribute($value): string
    {
        return $this->attributes['logo'] ? asset('storage/' . $this->attributes['logo']) : " ";
    }

    public function setPhotoAttribute($value)
    {
        $this->attributes['logo'] = $value->store('subordinate', 'public');
    }
}
