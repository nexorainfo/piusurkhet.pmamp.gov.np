<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use function abort_if;
use function redirect;
use function view;

class RoleController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        abort_if(
            Gate::denies('role_access'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $permissions = Permission::all();
        $roles = Role::with('permissions')->latest()->get();
        return view('admin.role.index', compact('permissions', 'roles'));
    }

    public function store(StoreRoleRequest $request)
    {
        abort_if(
            Gate::denies('role_create'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $role = Role::create($request->validated());

        $role->permissions()->sync($request->input('permissions'));

        return redirect(route('admin.role.index'))->with('success', 'Role Added');
    }


    public function edit(Role $role)
    {
        abort_if(
            Gate::denies('role_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $permissions = Permission::all();
        return view('admin.role.edit', compact('permissions', 'role'));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        abort_if(
            Gate::denies('role_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $role->update($request->validated());

        $role->permissions()->sync($request->input('permissions'));

        return redirect(route('admin.role.index'))->with('success', 'Role Updated');
    }

    public function destroy(Role $role)
    {
        abort_if(
            Gate::denies('role_delete'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $role->permissions()->detach();
        $role->delete();
        return redirect(route('admin.role.index'))->with('success', 'Role Deleted');
    }
}
