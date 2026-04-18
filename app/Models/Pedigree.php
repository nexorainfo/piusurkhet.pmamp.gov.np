<?php

namespace App\Models;

use App\Enums\FamilyMemberEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedigree extends Model
{
    use HasFactory,SoftDeletes;

    protected $dates=[
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $fillable=[
        'title',
        'tag',
        'photo',
        'date_of_birth',
        'birth_place',
        'pedigree_caste_id',
    ];

    public function pedigreeCaste(): BelongsTo
    {
        return $this->belongsTo(PedigreeCaste::class);
    }

    public function getPhotoAttribute($value): string
    {
        return $this->attributes['photo'] ? asset('storage/' . $this->attributes['photo']) : asset('assets/backend/images/user_icon.jpg');
    }

    public function setPhotoAttribute($value): void
    {
        $this->attributes['photo'] = $value->store('pedigree', 'public');
    }

    public function distributions(): HasMany
    {
        return $this->hasMany(Distribution::class);
    }
    public function familyMembers(): HasMany
    {
        return $this->hasMany(FamilyMember::class);
    }
    public function fatherDetail(){
        return  $this->familyMembers()->where('member', FamilyMemberEnum::FATHER)->first();
    }
    public function motherDetail(){
        return  $this->familyMembers()->where('member', FamilyMemberEnum::MOTHER)->first();
    }
}
