<?php

namespace App\Models;

use App\Enums\FamilyMemberEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FamilyMember extends Model
{
    use HasFactory,SoftDeletes;

    protected $dates=[
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $fillable=[
        'pedigree_id',
        'name',
        'tag',
        'photo',
        'milk_production',
        'member'
    ];
    protected $casts = [
        'member' => FamilyMemberEnum::class,
    ];

    public function pedigree(): BelongsTo
    {
        return $this->belongsTo(pedigree::class,);
    }

    public function getPhotoAttribute($value): string
    {
        return $this->attributes['photo'] ? asset('storage/' . $this->attributes['photo']) : asset('assets/backend/images/user_icon.jpg');
    }

    public function setPhotoAttribute($value): void
    {
        $this->attributes['photo'] = $value->store('familyMember', 'public');
    }

}
