<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ExEmployee\StoreExEmployeeRequest;
use App\Http\Requests\ExEmployee\UpdateExEmployeeRequest;
use App\Models\ExEmployee;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ExEmployeeController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        abort_if(
            Gate::denies('ex_employee_access'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $employees = ExEmployee::orderByDesc('leaving_date')->get();

        return view('admin.employee.ex_employee.index', compact('employees'));
    }

    public function create()
    {
        abort_if(
            Gate::denies('ex_employee_create'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        return view('admin.employee.ex_employee.create');
    }

    public function store(StoreExEmployeeRequest $request)
    {
        abort_if(
            Gate::denies('ex_employee_create'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        ExEmployee::create($request->validated());

        toast('Ex Employee Added Successfully', 'success');

        return redirect(route('admin.exEmployee.index'));
    }

    public function edit(ExEmployee $exEmployee)
    {
        abort_if(
            Gate::denies('ex_employee_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        return view('admin.employee.ex_employee.edit', compact('exEmployee'));
    }

    public function update(UpdateExEmployeeRequest $request, ExEmployee $exEmployee)
    {
        abort_if(
            Gate::denies('ex_employee_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );
        if ($request->hasFile('photo')) {
            if ($exEmployee->getRawOriginal('photo')) {
                $this->deleteFile($exEmployee->getRawOriginal('photo'));
            }
        }

        $exEmployee->update($request->validated());
        toast('Ex Employee Added Successfully', 'success');

        return redirect(route('admin.exEmployee.index'));
    }

    public function destroy(ExEmployee $exEmployee)
    {
        abort_if(
            Gate::denies('ex_employee_delete'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        if ($exEmployee->getRawOriginal('photo')) {
            $this->deleteFile($exEmployee->getRawOriginal('photo'));
        }

        $exEmployee->delete();

        toast('Ex Employee Deleted Successfully', 'success');

        return back();
    }
}
