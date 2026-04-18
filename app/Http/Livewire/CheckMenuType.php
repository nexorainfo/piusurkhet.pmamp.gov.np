<?php

namespace App\Http\Livewire;

use App\Models\DocumentCategory;
use App\Models\OfficeDetail;
use App\Models\PedigreeCaste;
use App\Models\PedigreeCategory;
use App\Models\SubDivision\SubDivision;
use App\Models\Subordinate;
use Livewire\Component;

class CheckMenuType extends Component
{
    public $menu_type = null;
    public $model_id = null;
    public $menuTypes = [];

    public $menu = null;

    public function mount($menu = null)
    {
        if (!empty($menu)) {
            $this->menu_type = $menu->type;
            $this->model_id = $menu->model_id;
        }
    }

    public function render()
    {
        if (!empty($this->menu_type)) {
            if ($this->menu_type == "category") {
                $this->menuTypes = DocumentCategory::with('documentCategories')->whereNull('document_category_id')->get();
            } elseif ($this->menu_type == "subDivision") {
                $this->menuTypes = SubDivision::latest()->get();
            } elseif ($this->menu_type == "subordinate") {
                $this->menuTypes = Subordinate::latest()->get();
                // dd($this->menuTypes);
            }  else {
                $this->menuTypes = OfficeDetail::all();
            }
        }

        return view('livewire.check-menu-type');
    }
}
