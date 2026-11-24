<?php

use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ResizedImageController;
use Illuminate\Support\Facades\Route;
use League\CommonMark\Extension\FrontMatter\FrontMatterParser;

// Resized WebP copies of uploaded images, made the first time each size is asked for.
Route::get('storage/resized/{width}/{path}', ResizedImageController::class)
    ->where(['width' => '[0-9]+', 'path' => '.+\.webp'])
    ->name('image.resized');

Route::get('/', function (\Illuminate\Http\Request $request) {
    if (config('default.dual_language')) {
        return redirect(route('welcome', ['language' => \App\Support\SiteLanguage::fromRequest($request)]));
    } else {
        return redirect(route('welcome'));
    }
});

Route::middleware('ipMiddleware')->group(function () {

    if (config('default.dual_language')) {
        Route::middleware('setLanguage')->group(function () {
            (new listing)->routes();
        });
    } else {
        (new listing)->routes();
    }
});

class listing
{
    public function routes(): void
    {
        Route::get('/', [FrontendController::class, 'index'])->name('welcome');
        Route::get('languageChange/{languageChange}',[FrontendController::class,'languageChange'])->name('language');
        Route::get('officeDetail/{officeDetail:slug}', [FrontendController::class, 'officeDetails'])->name('officeDetail');
        Route::get('documentCategory/{documentCategory:slug}', [FrontendController::class, 'documentCategory'])->name('documentCategory');
        Route::get('document/{document:slug}', [FrontendController::class, 'documentDetail'])->name('documentDetail');

        Route::get('detail/{slug}', [FrontendController::class, 'staticMenus'])->name('static');

        Route::get('detail/photoGallery/{photoGallery:slug}', [FrontendController::class, 'photoGalleryDetails'])->name('photoGalleryDetails');

        Route::get('detail/smuggling/{smuggling}', [FrontendController::class, 'smugglingDetail'])->name('smugglingDetail');

        Route::get('subDivision/{subDivision:slug}', [FrontendController::class, 'subDivisionDetail'])->name('subDivisionDetail');
        Route::get('subDivision/{subDivision:slug}/staffs', [FrontendController::class, 'subDivisionStaffs'])->name('subDivision.subDivisionStaffs');
        Route::get('subDivision/{subDivision:slug}/documents', [FrontendController::class, 'subDivisionDocuments'])->name('subDivision.subDivisionDocuments');
        Route::get('subDivision/{subDivision:slug}/document/{subDivisionDocument}', [FrontendController::class, 'subDivisionDocumentDetail'])->name('subDivision.documentDetail');
        Route::get('subDivision/{subDivision:slug}/smuggling', [FrontendController::class, 'subDivisionSmuggling'])->name('subDivision.subDivisionSmuggling');
        Route::get('subDivision/{subDivision:slug}/smuggling/{smuggling}', [FrontendController::class, 'subDivisionSmugglingDetail'])->name('subDivision.smugglingDetail');

        Route::get('search', [FrontendController::class, 'search'])->name('frontend.search');

        Route::post('sendMessage', [FrontendController::class, 'sendMessage'])->name('sendMessage');
        Route::get('faq', [FrontendController::class, 'faq'])->name('faq');
        Route::post('image',[ImageController::class,'imageUpload'])->name('imageUpload');

    }
}
