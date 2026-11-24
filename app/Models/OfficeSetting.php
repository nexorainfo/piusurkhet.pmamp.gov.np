<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfficeSetting extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'office_name',
        'background_img',
        'office_name_en',
        'office_phone',
        'office_email',
        'cover_photo',
        'office_address',
        'office_address_en',
        'en_header',
        'ne_header',
        'chief_id',
        'information_officer_id',
        'grivance_officer_id',
        'map_iframe',
        'facebook_iframe',
        'twitter_iframe',
        'document_list_type',
        'office_hours_winter',
        'office_hours_summer',
        'youtube_url',
        'instagram_url',
        'tiktok_url',
    ];

    public function setCoverPhotoAttribute($value)
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['cover_photo'] = $value->store('office_setting', 'public');
        }
    }

    public function setEnHeaderAttribute($value)
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['en_header'] = $value->store('office_setting', 'public');
        }
    }

    public function setNeHeaderAttribute($value)
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['ne_header'] = $value->store('office_setting', 'public');
        }
    }

    public function setBackgroundImgAttribute($value)
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['background_img'] = $value->store('office_setting', 'public');
        }
    }
    /**
     * Social profile links for the footer, keyed by network.
     * The Facebook and Twitter fields hold embed (plugin) URLs; the page address is read from their href parameter.
     */
    public function getSocialLinksAttribute(): array
    {
        $links = [
            'facebook' => self::pageUrlFromEmbed($this->facebook_iframe),
            'x' => self::pageUrlFromEmbed($this->twitter_iframe),
            'youtube' => $this->youtube_url,
            'instagram' => $this->instagram_url,
            'tiktok' => $this->tiktok_url,
        ];

        return array_filter($links, fn ($url) => is_string($url) && preg_match('#^https?://#i', $url));
    }

    private static function pageUrlFromEmbed(?string $url): ?string
    {
        if (!$url) {
            return null;
        }

        parse_str((string) parse_url($url, PHP_URL_QUERY), $query);

        return isset($query['href']) && is_string($query['href']) ? $query['href'] : $url;
    }

    public function chief(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'chief_id');
    }

    public function informationOfficer(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'information_officer_id');
    }
    public function grivanceOfficer(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'grivance_officer_id');
    }



    public function officeSettingHeaders(): HasMany
    {
        return $this->hasMany(OfficeSettingHeader::class);
    }

}
