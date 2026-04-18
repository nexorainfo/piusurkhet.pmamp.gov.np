<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = [
        'bill_date',
        'receipt_date',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'budget_no',
        'expense_head',
        'buying_process',
        'expense_head_en',
        'buying_process_en',
        'pan_no',
        'bill_photo',
        'bill_date',
        'amount',
        'receipt_date',
        'description',
        'remarks',
        'description_en',
        'remarks_en',
    ];

    public function setBillPhotoAttribute($value)
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['bill_photo'] = $value->store('bill', 'public');
        }
    }
}
