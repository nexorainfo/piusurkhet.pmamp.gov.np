<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Bill\StoreBillRequest;
use App\Http\Requests\Bill\UpdateBillRequest;
use App\Models\Bill;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class BillController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        abort_if(
            Gate::denies('bill_access'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $bills = Bill::orderByDesc('bill_date')->get();

        return view('admin.bill.index', compact('bills'));
    }

    public function create()
    {
        abort_if(
            Gate::denies('bill_create'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        return view('admin.bill.create');
    }

    public function store(StoreBillRequest $request)
    {
        abort_if(
            Gate::denies('bill_create'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        Bill::create($request->validated());

        toast('Bill Created Successfully', 'success');

        return back();
    }

    public function edit(Bill $bill)
    {
        abort_if(
            Gate::denies('bill_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        return view('admin.bill.edit', compact('bill'));
    }

    public function update(UpdateBillRequest $request, Bill $bill)
    {
        abort_if(
            Gate::denies('bill_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        if ($request->hasFile('bill_photo')) {
            if ($bill->bill_photo) {
                $this->deleteFile($bill->bill_photo);
            }
        }

        $bill->update($request->validated());

        toast('Bill Updated Successfully', 'success');

        return redirect(route('admin.bill.index'));
    }

    public function destroy(Bill $bill)
    {
        abort_if(
            Gate::denies('bill_delete'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        if ($bill->bill_photo) {
            $this->deleteFile($bill->bill_photo);
        }

        $bill->delete();

        toast('Bill Deleted Successfully', 'success');

        return back();
    }
}
