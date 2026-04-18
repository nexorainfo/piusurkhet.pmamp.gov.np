<?php

use App\Http\Controllers\Admin\{BillController,
    CategoryController,
    ChatController,
    ColorController,
    ContactMessageController,
    DashboardController,
    DepartmentController,
    DesignationController,
    DocumentCategoryController,
    DocumentController,
    EmployeeController,
    ExEmployeeController,
    FaqController,
    FileController,
    ImageController,
    LinkController,
    MenuController,
    OfficeDetailController,
    OfficeSettingController,
    OfficeSettingHeaderController,
    PhotoGalleryController,
    SliderController,
    SmugglingController,
    SubDivision\SubDivisionController,
    SubDivision\SubDivisionDocumentCategoryController,
    SubDivision\SubDivisionDocumentController,
    SubDivision\SubDivisionEmployeeController,
    SubordinateContoller,
    UserManagement\ProfileController,
    UserManagement\RoleController,
    UserManagement\UserController,
    VideoGalleryController};
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', DashboardController::class)->name('dashboard');

Route::prefix('/setting')->group(function () {
    Route::resource('officeSetting', OfficeSettingController::class)->only('index', 'update');
    Route::resource('officeDetail', OfficeDetailController::class);
});

Route::prefix('profile')->as('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('show');
    Route::put('/updateProfile', [ProfileController::class, 'updateProfile'])->name('updateProfile');
    Route::put('/updatePassword', [ProfileController::class, 'updatePassword'])->name('updatePassword');
});
Route::prefix('userManagement')->group(function () {
    Route::resource('role', RoleController::class);
    Route::resource('user', UserController::class);
});

Route::resource('slider', SliderController::class);

Route::prefix('employees')->group(function () {
    Route::resource('department', DepartmentController::class);
    Route::resource('designation', DesignationController::class);
    Route::resource('employee', EmployeeController::class);
    Route::resource('exEmployee', ExEmployeeController::class);
});


Route::get('documentCategory/{documentCategory}/showOnIndex', [DocumentCategoryController::class, 'showOnIndex'])->name('documentCategory.showOnIndex');
Route::resource('documentCategory', DocumentCategoryController::class);
Route::get('documentCategory/{documentCategory}/document/{document}/updateStatus', [DocumentController::class, 'updateStatus'])->name('documentCategory.document.updateStatus');
Route::get('documentCategory/{documentCategory}/document/{document}/markAsNew', [DocumentController::class, 'markAsNew'])->name('documentCategory.document.markAsNew');
Route::get('documentCategory/{documentCategory}/document/{document}/popUp', [DocumentController::class, 'popUp'])->name('documentCategory.document.popUp');
Route::resource('documentCategory/{documentCategory}/document', DocumentController::class)->names('documentCategory.document');
Route::get('documentCategory/{documentCategory}/category/{category}/showOnIndex', [CategoryController::class, 'showOnIndex'])->name('documentCategory.category.showOnIndex');
Route::resource('documentCategory/{documentCategory}/category', CategoryController::class)->names('documentCategory.category');

Route::prefix('subDivisions')->group(function () {
    Route::resource('subDivision', SubDivisionController::class);
    Route::resource('subDivisionEmployee', SubDivisionEmployeeController::class);
    Route::prefix('documents')->group(function () {
        Route::resource('subDivisionDocumentCategory', SubDivisionDocumentCategoryController::class);
        Route::get('subDivisionDocument/{subDivisionDocument}/updateStatus', [SubDivisionDocumentController::class, 'updateStatus'])->name('subDivisionDocument.status');
        Route::get('subDivisionDocument/{subDivisionDocument}/markAsNew', [SubDivisionDocumentController::class, 'markAsNew'])->name('subDivisionDocument.markAsNew');
        Route::resource('subDivisionDocument', SubDivisionDocumentController::class);

    });
    Route::resource('subordinate',SubordinateContoller::class);
});

Route::put('officeDetail/{officeDetail}/showOnIndex', [OfficeDetailController::class, 'showOnIndex'])->name('officeDetail.showOnIndex');
Route::get('officeDetail/{officeDetail}/showOnIndex', [OfficeDetailController::class, 'showOnIndex'])->name('officeDetail.showOnIndex');
Route::get('menu/{menu}/updateStatus', [MenuController::class, 'updateStatus'])->name('menu.updateStatus');
Route::resource('menu', MenuController::class);
Route::resource('officeSettingHeader', OfficeSettingHeaderController::class);

Route::prefix('gallery')->group(function () {
    Route::delete('photo/{photo}/delete', [PhotoGalleryController::class, 'deletePhoto'])->name('photo.deletePhoto');
    Route::resource('photoGallery', PhotoGalleryController::class);
    Route::resource('videoGallery', VideoGalleryController::class);
});

Route::resource('faq', FaqController::class);
//link
Route::resource('link', LinkController::class);
Route::resource('bill', BillController::class);
//file Deletes
Route::resource('file', FileController::class)->only('destroy');

Route::resource('contactMessage', ContactMessageController::class)->only('index', 'destroy');

Route::resource('smuggling', SmugglingController::class);

Route::resource('color', ColorController::class);

Route::get('chat', ChatController::class)->name('chat');

Route::resource('officeSettingHeader', OfficeSettingHeaderController::class);

