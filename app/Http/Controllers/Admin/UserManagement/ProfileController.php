<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdatePasswordRequest;
use App\Http\Requests\Profile\UpdateProfileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('backend.profile');
    }

    public function updateProfile(UpdateProfileRequest $request): RedirectResponse
    {
        if ($request->hasFile('profile_photo_path')) {
            $originalPhoto = auth()->user()->getRawOriginal('profile_photo_path');
            if ($originalPhoto) {
                $this->deleteFile($originalPhoto);
            }
        }

        auth()->user()->update($request->validated());

        toast('Profile Updated Successfully', 'success');

        return back();
    }

    public function updatePassword(UpdatePasswordRequest $request): RedirectResponse
    {
        auth()->user()->update($request->validated());

        toast('Password Changed Successfully','success');

        return back();
    }
}
