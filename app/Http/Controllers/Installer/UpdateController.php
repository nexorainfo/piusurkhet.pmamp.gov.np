<?php

namespace App\Http\Controllers\Installer;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use App\Helpers\DatabaseManager;
use App\Helpers\InstalledFileManager;
use App\Helpers\MigrationsHelper;
use Illuminate\View\View;

class UpdateController extends Controller
{
    use MigrationsHelper;

    /**
     * Display the updater welcome page.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function welcome()
    {
        return view('installer.update.welcome');
    }

    /**
     * Display the updater overview page.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function overview()
    {
        $migrations = $this->getMigrations();
        $dbMigrations = $this->getExecutedMigrations();

        return view('installer.update.overview', ['numberOfUpdatesPending' => count($migrations) - count($dbMigrations)]);
    }

    /**
     * Migrate and seed the database.
     *
     * @return RedirectResponse
     */
    public function database()
    {
        $databaseManager = new DatabaseManager;
        $response = $databaseManager->migrateAndSeed();

        return redirect()->route('LaravelUpdater::final')
                         ->with(['message' => $response]);
    }

    /**
     * Update installed file and display finished view.
     *
     * @param InstalledFileManager $fileManager
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function finish(InstalledFileManager $fileManager)
    {
        $fileManager->update();

        return view('installer.update.finished');
    }
}
