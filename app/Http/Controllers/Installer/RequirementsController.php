<?php

namespace App\Http\Controllers\Installer;

use App\Helpers\RequirementsChecker;
use Illuminate\Routing\Controller;

class RequirementsController extends Controller
{

    protected RequirementsChecker $requirements;


    public function __construct(RequirementsChecker $checker)
    {
        $this->requirements = $checker;
    }


    public function requirements()
    {

        $phpSupportInfo = $this->requirements->checkPHPversion(
            config('installer.core.minPhpVersion')
        );
        // dd('here');
        $requirements = $this->requirements->check(
            config('installer.requirements')
        );

        return view('installer.requirements', compact('requirements', 'phpSupportInfo'));
    }
}
