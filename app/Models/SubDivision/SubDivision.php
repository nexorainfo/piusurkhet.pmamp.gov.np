<?php

namespace App\Models\SubDivision;

use App\Models\Smuggling;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubDivision extends Model
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
        'email',
        'phone',
        'slug',
        'introduction',
        'introduction_en',
        'map',
        'facebook',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function subDivisionEmployee(): HasMany
    {
        return $this->hasMany(SubDivisionEmployee::class);
    }

    public function subDivisionDocumentCategory(): HasMany
    {
        return $this->hasMany(SubDivisionDocumentCategory::class);
    }

    public function subDivisionDocuments(): HasMany
    {
        return $this->hasMany(SubDivisionDocument::class);
    }

    public function smugglings(): HasMany
    {
        return $this->hasMany(Smuggling::class);
    }
}
