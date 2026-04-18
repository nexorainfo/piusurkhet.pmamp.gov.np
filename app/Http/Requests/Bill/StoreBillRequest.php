<?php

namespace App\Http\Requests\Bill;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreBillRequest extends FormRequest
{

    public function authorize(): bool
    {
        return Gate::allows('bill_create');
    }

    public function rules(): array
    {
        if(config('default.dual_language'))
        {
            return [
                'budget_no' => ['required', 'string', 'max:255'],
                'expense_head' => ['required', 'string', 'max:255'],
                'expense_head_en' => ['required', 'string', 'max:255'],
                'buying_process' => ['required', 'string', 'max:255'],
                'buying_process_en' => ['required', 'string', 'max:255'],
                'pan_no' => ['required', 'string', 'max:255'],
                'bill_photo' => ['nullable', 'mimes:jpg,jpeg,png,pdf'],
                'bill_date' => ['required', 'date'],
                'amount' => ['required', 'numeric'],
                'receipt_date' => ['required', 'date'],
                'description' => ['nullable'],
                'description_en' => ['nullable'],
                'remarks' => ['nullable', 'string', 'max:255'],
                'remarks_en' => ['nullable', 'string', 'max:255']
            ];
        }else
        {
        return [
            'budget_no' => ['required', 'string', 'max:255'],
            'expense_head' => ['required', 'string', 'max:255'],
            'buying_process' => ['required', 'string', 'max:255'],
            'pan_no' => ['required', 'string', 'max:255'],
            'bill_photo' => ['nullable', 'mimes:jpg,jpeg,png,pdf'],
            'bill_date' => ['required', 'date'],
            'amount' => ['required', 'numeric'],
            'receipt_date' => ['required', 'date'],
            'description' => ['nullable'],
            'remarks' => ['nullable', 'string', 'max:255']
        ];
    }

    }
}
