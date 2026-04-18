<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id ?? '',
            'name' => app()->getLocale() == 'ne' ? $this->name : $this->name_en,
            'image' => $this->photo ?? '',
            'level' => app()->getLocale() == 'ne' ? $this->level : $this->level_en,
            'phone' => $this->phone ?? '',
            'email' => $this->email ?? '',
            'address' => app()->getLocale() == 'ne' ? $this->address : $this->address_en,
            'position' => $this->position ?? '',
            'department' => app()->getLocale() == 'ne' ? $this->department->title : $this->department->title_en,
            'designation' => app()->getLocale() == 'ne' ? $this->designation->title : $this->designation->title_en,
            'office' => config('app.name')
        ];
    }
}
