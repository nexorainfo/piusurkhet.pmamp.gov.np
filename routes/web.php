<?php

use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;
use League\CommonMark\Extension\FrontMatter\FrontMatterParser;

Route::get('/', function () {
    if (config('default.dual_language')) {
        $locale = app()->getLocale();
        return redirect(route('welcome', ['language'=>$locale]));
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
