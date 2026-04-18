<?php

namespace App\Http\Controllers\Admin\SubDivision;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubDivisionEmployeeRequest;
use App\Http\Requests\UpdateSubDivisionEmployeeRequest;
use App\Models\SubDivision\SubDivisionEmployee;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SubDivisionEmployeeController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        abort_if(
            Gate::denies('subDivision_employee_access'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );
        if (empty(auth()->user()->sub_division_id)) {
            abort(401);
        }
        $subDivisionEmployees = SubDivisionEmployee::where('sub_division_id', auth()->user()->sub_division_id)
            ->orderBy('position')
            ->get();

        return view('admin.subDivisions.employee.index', compact('subDivisionEmployees'));
    }

    public function create()
    {
        abort_if(
            Gate::denies('subDivision_employee_create'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );
        if (empty(auth()->user()->sub_division_id)) {
            abort(401);
        }
        return view('admin.subDivisions.employee.create');
    }

    public function store(StoreSubDivisionEmployeeRequest $request)
    {
        abort_if(
            Gate::denies('subDivision_employee_create'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );
        if (empty(auth()->user()->sub_division_id)) {
            abort(401);
        }

        SubDivisionEmployee::create($request->validated() + ['sub_division_id' => auth()->user()->sub_division_id]);
        toast('Sub Division Employee Stored Successfully', 'success');
        return redirect(route('admin.subDivisionEmployee.index'));
    }

    public function show(SubDivisionEmployee $subDivisionEmployee)
    {
        abort_if(
            Gate::denies('subDivision_employee_show'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );
        if (empty(auth()->user()->sub_division_id) && auth()->user()->sub_division_id != $subDivisionEmployee->sub_division_id) {
            abort(401);
        }
    }

    public function edit(SubDivisionEmployee $subDivisionEmployee)
    {
        abort_if(
            Gate::denies('subDivision_employee_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );
        if (empty(auth()->user()->sub_division_id) && auth()->user()->sub_division_id != $subDivisionEmployee->sub_division_id) {
            abort(401);
        }

        return view('admin.subDivisions.employee.edit', compact('subDivisionEmployee'));
    }

    public function update(UpdateSubDivisionEmployeeRequest $request, SubDivisionEmployee $subDivisionEmployee)
    {
        abort_if(
            Gate::denies('subDivision_employee_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );
        if (empty(auth()->user()->sub_division_id) && auth()->user()->sub_division_id != $subDivisionEmployee->sub_division_id) {
            abort(401);
        }

        $subDivisionEmployee->update($request->validated());

        toast('Sub Division Employee Updated Successfully', 'success');
        return redirect(route('admin.subDivisionEmployee.index'));
    }

    public function destroy(SubDivisionEmployee $subDivisionEmployee)
    {
        abort_if(
            Gate::denies('subDivision_employee_delete'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );
        if (empty(auth()->user()->sub_division_id) && auth()->user()->sub_division_id != $subDivisionEmployee->sub_division_id) {
            abort(401);
        }

        $subDivisionEmployee->delete();

        toast('Sub Division Employee deleted Successfully', 'success');
        return redirect(route('admin.subDivisionEmployee.index'));
    }
}
