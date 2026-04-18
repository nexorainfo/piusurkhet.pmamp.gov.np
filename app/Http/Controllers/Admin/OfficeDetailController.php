<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OfficeDetail\StoreOfficeDetailRequest;
use App\Http\Requests\OfficeDetail\UpdateOfficeDetailRequest;
use App\Models\OfficeDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class OfficeDetailController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        abort_if(
            Gate::denies('office_detail_access'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $officeDetails = OfficeDetail::orderBy('position')->get();

        return view('admin.office_detail.index', compact('officeDetails'));
    }

    public function create()
    {
        abort_if(
            Gate::denies('office_detail_create'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        return view('admin.office_detail.create');
    }

    public function store(StoreOfficeDetailRequest $request)
    {
        abort_if(
            Gate::denies('office_detail_create'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        OfficeDetail::create($request->validated());

        toast('Office Detail Created Successfully', 'success');

        return back();
    }

    public function edit(OfficeDetail $officeDetail)
    {
        abort_if(
            Gate::denies('office_detail_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        return view('admin.office_detail.edit', compact('officeDetail'));
    }

    public function update(UpdateOfficeDetailRequest $request, OfficeDetail $officeDetail)
    {
        abort_if(
            Gate::denies('office_detail_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $officeDetail->update($request->validated());

        toast('Office Detail Updated Successfully', 'success');

        return redirect(route('admin.officeDetail.index'));
    }

    public function destroy(OfficeDetail $officeDetail)
    {
        abort_if(
            Gate::denies('office_detail_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $officeDetail->delete();

        toast('Office Detail Deleted Successfully', 'success');

        return back();
    }

    public function showOnIndex(OfficeDetail $officeDetail): RedirectResponse
    {
        abort_if(
            Gate::denies('office_detail_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $officeDetail->update([
            'show_on_index' => !$officeDetail->show_on_index
        ]);

        toast('Status Updated Successfully', 'success');
        return back();
    }
}
