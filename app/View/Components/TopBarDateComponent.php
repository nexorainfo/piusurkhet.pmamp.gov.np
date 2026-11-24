<?php

namespace App\View\Components;

use DateTimeImmutable;
use Illuminate\View\Component;
use NepDate\AdDate;

class TopBarDateComponent extends Component
{
    /**
     * Today's Bikram Sambat date, e.g. "मङ्सिर ८, २०८३" or "Mangsir 8, 2083".
     */
    public string $todayDate;

    public function __construct()
    {
        $locale = app()->getLocale() === 'en' ? 'en' : 'ne';

        $this->todayDate = AdDate::fromDateTime(new DateTimeImmutable())
            ->toBs()
            ->format('F j, Y', $locale);
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
}
