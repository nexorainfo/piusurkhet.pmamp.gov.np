<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\Department\StoreDepartmentRequest;
use App\Http\Requests\Department\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DepartmentController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        abort_if(
            Gate::denies('department_access'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $departments = Department::latest()->get();

        return view('admin.employee.department.index', compact('departments'));
    }


    public function store(StoreDepartmentRequest $request)
    {
        abort_if(
            Gate::denies('menu_create'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        Department::create($request->validated());

        return redirect(route('admin.department.index'))->with('success', 'Department Added');
    }

    public function edit(Department $department)
    {
        abort_if(
            Gate::denies('menu_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        return view('admin.employee.department.edit', compact('department'));
    }

    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        abort_if(
            Gate::denies('menu_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $department->update($request->validated());
        return redirect(route('admin.department.index'))->with('success', 'Department Updated');
    }

    public function destroy(Department $department)
    {
        abort_if(
            Gate::denies('menu_delete'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $department->delete();
        return redirect(route('admin.department.index'))->with('success', 'Department Deleted');
    }
}
