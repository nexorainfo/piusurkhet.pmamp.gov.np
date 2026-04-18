<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class EmployeeController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        abort_if(
            Gate::denies('employee_access'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $employees = Employee::with('designation', 'department')->orderBy('position')->get();

        return view('admin.employee.employee.index', compact('employees'));
    }

    public function create()
    {
        abort_if(
            Gate::denies('employee_create'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $designations = Designation::latest()->get();
        $departments = Department::latest()->get();

        return view('admin.employee.employee.create', compact('designations', 'departments'));
    }

    public function store(StoreEmployeeRequest $request)
    {
        abort_if(
            Gate::denies('employee_create'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        Employee::create($request->validated());

        toast('Employee Added Successfully', 'success');

        return redirect(route('admin.employee.index'));
    }

    public function edit(Employee $employee)
    {
        abort_if(
            Gate::denies('employee_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $designations = Designation::latest()->get();
        $departments = Department::latest()->get();

        return view('admin.employee.employee.edit', compact('designations', 'departments', 'employee'));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        abort_if(
            Gate::denies('employee_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        if ($request->hasFile('photo')) {
            if ($employee->getRawOriginal('photo')) {
                $this->deleteFile($employee->getRawOriginal('photo'));
            }
        }

        $employee->update($request->validated());

        toast('Employee Updated Successfully', 'success');

        return redirect(route('admin.employee.index'));
    }

    public function destroy(Employee $employee)
    {
        abort_if(
            Gate::denies('employee_delete'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        if ($employee->getRawOriginal('photo')) {
            $this->deleteFile($employee->getRawOriginal('photo'));
        }

        $employee->delete();

        toast('Employee Deleted Successfully', 'success');

        return back();
    }
}
