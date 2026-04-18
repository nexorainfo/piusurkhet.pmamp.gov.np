<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subordinate\StoreSubordinateRequest;
use App\Http\Requests\Subordinate\UpdateSubordinateRequest;
use App\Models\Subordinate;
use Illuminate\Http\Request;

class SubordinateContoller extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subordinates=Subordinate::latest()->get();
        return view('admin.subordinate.index',compact('subordinates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subordinate.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubordinateRequest $request)
    {

        Subordinate::create($request->validated());
        toast('subordinate Added Successfully', 'success');
        return to_route('admin.subordinate.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Subordinate $subordinate)
    {
        return view('admin.subordinate.edit',compact('subordinate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubordinateRequest $request, Subordinate $subordinate)
    {
        $subordinate->update($request->validated());
        toast('suboerdinate updated Successfully', 'success');
        return to_route('admin.subordinate.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subordinate $subordinate)
    {
        $subordinate->delete();
        toast('subordinate deleted Successfully', 'success');
        return back();
    }
}
