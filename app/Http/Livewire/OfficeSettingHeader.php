<?php

namespace App\Http\Livewire;

use App\Models\OfficeSetting;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OfficeSettingHeader extends Component
{

    public $officeSettingHeaders = [];

    public $english;
    public $nepali;
    public $font_color;
    public $font_size;
    public $font_family;
    public $position;
    public  $font;



    public function mount()
    {


    }

    protected $rules = [

        'officeSettingHeaders.*.english' => ['required','string'],
        'officeSettingHeaders.*.nepali' => ['required','string'],
        'officeSettingHeaders.*.font_color' => ['nullable'],
        'officeSettingHeaders.*.font_family' => ['required'],
        'officeSettingHeaders.*.font_size' => ['required'],
        'officeSettingHeaders.*.position' => ['required'],
        'officeSettingHeaders.*.font' => ['required'],


    ];

    public function addOfficeSettingHeader()
    {
        $this->officeSettingHeaders[] = [];
    }

    public function removeOfficeSettingHeader($index)
    {
        if (array_key_exists('id', $this->officeSettingHeaders[$index])) {
            \App\Models\OfficeSettingHeader::find($this->officeSettingHeaders[$index]['id'])->delete();
        }
        unset($this->officeSettingHeaders[$index]);
        $this->officeSettingHeaders = array_values($this->officeSettingHeaders);
    }

    public function save()
    {
        $this->validate();

        DB::transaction(function () {
           $office = OfficeSetting::first();
                foreach ($this->officeSettingHeaders as $officeSettingHeader)
                {
                    $office->officeSettingHeaders()->create($officeSettingHeader);
                }
        });

        toast('Office Setting Updated Successfully', 'success');
       return redirect(route('admin.officeSetting.index'));

    }
    public function render()
    {

        return view('livewire.office-setting-header');
    }
}

