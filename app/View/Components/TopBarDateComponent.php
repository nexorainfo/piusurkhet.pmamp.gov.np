<?php

namespace App\View\Components;

use App\Traits\NepaliDateConverter;
use Illuminate\View\Component;

class TopBarDateComponent extends Component
{
    use NepaliDateConverter;

    /**
     * Create a new component instance.
     *
     * @return void
     */

    public string $todayDate;

    public function __construct()
    {
        $this->todayDate = $this->get_nepali_number($this->get_today_nepali_date());
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.top-bar-date-component');
    }
    protected function get_nepali_number($data): string|array
    {
        return str_replace(['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'], ['१', '२', '३', '४', '५', '६', '७', '८', '९', '०'], $data);
    }
}
