<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use function abort_if;
use function auth;
use function redirect;
use function toast;
use function view;

class UserController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        abort_if(
            Gate::denies('user_access'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $users = User::with('role')->where('id', '!=', auth()->id())->latest()->get();

        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        abort_if(
            Gate::denies('user_create'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $roles = Role::with('permissions')->latest()->get();
        return view('admin.user.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        abort_if(
            Gate::denies('user_create'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        User::create($request->validated());
        toast('Store Successfully', 'success');
        return redirect(route('admin.user.index'))->with('success', 'User Added');
    }


    public function edit(User $user)
    {
        abort_if(
            Gate::denies('user_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $roles = Role::with('permissions')->latest()->get();
        return view('admin.user.edit', compact('roles', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        abort_if(
            Gate::denies('user_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $user->update($request->validated());
        toast($user->name.'Updated Successfully', 'success');
        return redirect(route('admin.user.index'))->with('success', 'User Updated');
    }

    public function destroy(User $user)
    {
        abort_if(
            Gate::denies('user_delete'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $user->delete();
        toast('Deleted Successfully', 'success');
        return redirect(route('admin.user.index'))->with('success', 'User Deleted');
    }
}
