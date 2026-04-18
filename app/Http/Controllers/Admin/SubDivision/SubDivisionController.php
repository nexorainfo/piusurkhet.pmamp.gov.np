<?php

namespace App\Http\Controllers\Admin\SubDivision;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\StoreSubDivisionRequest;
use App\Http\Requests\UpdateSubDivisionRequest;
use App\Models\SubDivision\SubDivision;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SubDivisionController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        abort_if(
            Gate::denies('sub_division_access'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );
        $subDivisions = SubDivision::latest()->get();
        return view('admin.subDivisions.subDivision.index', compact('subDivisions'));
    }

    public function create()
    {
        abort_if(
            Gate::denies('sub_division_create'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );
        return view('admin.subDivisions.subDivision.create');
    }

    public function store(StoreSubDivisionRequest $request)
    {
        abort_if(
            Gate::denies('sub_division_create'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        \DB::transaction(function () use ($request) {
            $subDivision = SubDivision::create($request->validated());

            $subDivision->user()->create([
                'name' => $request->input('title'),
                'email' => $request->input('email'),
                'password' => 'password',
                'role_id' => 2,
            ]);
        });
        toast('Sub Division Stored Successfully', 'success');
        return redirect(route('admin.subDivision.index'));
    }

    public function edit(SubDivision $subDivision)
    {
        if (empty(auth()->user()->sub_division_id)) {
            abort_if(
                Gate::denies('sub_division_edit'),
                ResponseAlias::HTTP_FORBIDDEN,
                '403 Forbidden | you are not allowed to access this resource'
            );
        }
        return view('admin.subDivisions.subDivision.edit', compact('subDivision'));
    }

    public function update(UpdateSubDivisionRequest $request, SubDivision $subDivision)
    {
        if (empty(auth()->user()->sub_division_id)) {
            abort_if(
                Gate::denies('sub_division_edit'),
                ResponseAlias::HTTP_FORBIDDEN,
                '403 Forbidden | you are not allowed to access this resource'
            );
        }

        if (User::where('id', '!=', $subDivision->user->id)->where('email', $request->input('email'))->count() == 0) {
            $subDivision->update($request->validated());
        } else {
            toast('Sub Division Cannot be updated Email already exists', 'error');
            return back();
        }

        toast('Sub Division Updated Successfully', 'success');

        if (auth()->user()->sub_division_id) {
            return back();
        } else {
            return redirect(route('admin.subDivision.index'));
        }
    }

    public function destroy(SubDivision $subDivision)
    {
        abort_if(
            Gate::denies('sub_division_delete'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $subDivision->user()->forceDelete();
        $subDivision->forceDelete();
        toast('Sub Division Deleted Successfully', 'success');
        return redirect(route('admin.subDivision.index'));
    }


}
