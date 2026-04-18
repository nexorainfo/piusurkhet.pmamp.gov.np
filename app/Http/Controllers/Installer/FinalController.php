<?php

namespace App\Http\Controllers\Installer;

use App\Events\LaravelInstallerFinished;
use App\Helpers\EnvironmentManager;
use App\Helpers\FinalInstallManager;
use App\Helpers\InstalledFileManager;
use Illuminate\Routing\Controller;

class FinalController extends Controller
{

    public function finish(InstalledFileManager $fileManager, FinalInstallManager $finalInstall, EnvironmentManager $environment)
    {
        $finalMessages = $finalInstall->runFinal();
        $finalStatusMessage = $fileManager->update();
        $finalEnvFile = $environment->getEnvContent();

        event(new LaravelInstallerFinished);

        return view('installer.finished', compact('finalMessages', 'finalStatusMessage', 'finalEnvFile'));
    }
}
