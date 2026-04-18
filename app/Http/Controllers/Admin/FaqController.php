<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Faq\StoreFaqRequest;
use App\Http\Requests\Faq\UpdateFaqRequest;
use App\Models\Faq;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class FaqController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        abort_if(
            Gate::denies('faq_access'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $faqs = Faq::all();

        return view('admin.faq.index', compact('faqs'));
    }

    public function create()
    {
        abort_if(
            Gate::denies('faq_create'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        return view('admin.faq.create');
    }

    public function store(StoreFaqRequest $request)
    {
        abort_if(
            Gate::denies('faq_create'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        Faq::create($request->validated());

        toast('Faq Created Successfully', 'success');

        return back();
    }

    public function edit(Faq $faq)
    {
        abort_if(
            Gate::denies('faq_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        return view('admin.faq.edit', compact('faq'));
    }

    public function update(UpdateFaqRequest $request, Faq $faq)
    {
        abort_if(
            Gate::denies('faq_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $faq->update($request->validated());

        toast('Faq Updated Successfully', 'success');

        return redirect(route('admin.faq.index'));
    }

    public function destroy(Faq $faq)
    {
        abort_if(
            Gate::denies('faq_delete'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $faq->delete();

        toast('Faq Deleted Successfully', 'success');

        return back();
    }
}
