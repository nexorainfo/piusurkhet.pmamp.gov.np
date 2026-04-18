<?php

namespace App\Models;

use App\Models\SubDivision\SubDivision;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'phone',
        'profile_photo_path',
        'sub_division_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setProfilePhotoPathAttribute($value)
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['profile_photo_path'] = $value->store('profile_photos/' . Str::slug(auth()->user()->name, "_"), 'public');
        }
    }

    public function getProfilePhotoPathAttribute(): string
    {
        return $this->attributes['profile_photo_path'] ? asset('storage/' . $this->attributes['profile_photo_path']) : asset('assets/backend/images/user_icon.jpg');
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function subDivision(): BelongsTo
    {
        return $this->belongsTo(SubDivision::class);
    }
}
