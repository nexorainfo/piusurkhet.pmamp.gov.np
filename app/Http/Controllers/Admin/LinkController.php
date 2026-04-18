<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Link\StoreLinkRequest;
use App\Models\Link;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class LinkController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        abort_if(
            Gate::denies('link_access'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );
        $links = Link::get();
       return view('admin.link.index',compact('links'));
    }

    public function store(StoreLinkRequest $request)
    {
        abort_if(
            Gate::denies('link_create'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );
        Link::create($request->validated());

        toast('Link Added Successfully', 'success');

        return back();
    }

    public function edit(Link $link)
    {
        abort_if(
            Gate::denies('link_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );
        return view('admin.link.edit',compact('link'));
    }

    public function update(StoreLinkRequest $request, Link $link)
    {
        abort_if(
            Gate::denies('link_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );
        $link->update($request->validated());

        toast('Link Updated Successfully', 'success');

        return redirect(route('admin.link.index'));
    }

    public function destroy(Link $link)
    {
        abort_if(
            Gate::denies('link_delete'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );
        $link->delete();

        toast('Link Deleted Successfully', 'success');

        return back();
    }
}
