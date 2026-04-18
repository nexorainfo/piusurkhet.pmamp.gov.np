<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfficeSettingHeader\UpdateOfficeSettingHeaderRequest;
use App\Models\OfficeSetting;
use App\Models\OfficeSettingHeader;
use Illuminate\Http\Request;

class OfficeSettingHeaderController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(OfficeSettingHeader $officeSettingHeader)
    {

    }

    public function edit(OfficeSettingHeader $officeSettingHeader)
    {
        return view('admin.setting.office_setting.edit',compact('officeSettingHeader'));
    }

    public function update(UpdateOfficeSettingHeaderRequest $request, OfficeSettingHeader $officeSettingHeader)
    {
        $officeSettingHeader->update($request->validated());

        toast('Office Setting Updated Successfully', 'success');
        return redirect(route('admin.officeSetting.index'));


    }

    public function destroy(OfficeSettingHeader $officeSettingHeader)
    {
        $officeSettingHeader->delete();
        toast('Office Setting Deleted Successfully', 'success');
        return back();
    }
}
