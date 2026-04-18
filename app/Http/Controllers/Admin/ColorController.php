<?php

namespace App\Http\Controllers\Admin;

use App\Models\Color;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ColorController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $color = Color::first();
        return view('admin.color.index',compact('color'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Color $color)
    {
        //
    }

    public function edit(Color $color)
    {
        //
    }

    public function update(Request $request, Color $color)
    {
        $request->validate([
            'nav'=>'required',
            'footer'=>'required',
            'scroller'=>'required'
        ]);

        $color->nav=$request->input('nav');
        $color->scroller=$request->input('scroller');
        $color->footer=$request->input('footer');
        $color->save();
        toast('Color Updated Successfully', 'success');
        return redirect(route('admin.color.index'));

    }

    public function destroy(Color $color)
    {
        //
    }
}
