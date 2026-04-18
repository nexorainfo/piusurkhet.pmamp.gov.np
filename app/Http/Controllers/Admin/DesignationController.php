<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Designation\StoreDesignationRequest;
use App\Http\Requests\Designation\UpdateDesignationRequest;
use App\Models\Designation;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DesignationController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        abort_if(
            Gate::denies('designation_access'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $designations = Designation::latest()->get();
        return view('admin.employee.designation.index', compact('designations'));
    }

    public function store(StoreDesignationRequest $request)
    {
        abort_if(
            Gate::denies('designation_create'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        Designation::create($request->validated());

        toast('Designation Added Successfully', 'success');

        return back();
    }

    public function edit(Designation $designation)
    {
        abort_if(
            Gate::denies('designation_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        return view('admin.employee.designation.edit', compact('designation'));
    }


    public function update(UpdateDesignationRequest $request, Designation $designation)
    {
        abort_if(
            Gate::denies('designation_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $designation->update($request->validated());

        toast('Designation Updated Successfully', 'success');

        return redirect(route('admin.designation.index'));
    }

    public function destroy(Designation $designation)
    {
        abort_if(
            Gate::denies('designation_delete'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $designation->delete();

        toast('Designation Deleted Successfully', 'success');

        return redirect(route('admin.designation.index'));
    }
}
