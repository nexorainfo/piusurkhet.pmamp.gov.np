<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\Setting\UpdateOfficeSettingRequest;
use App\Models\Employee;
use App\Models\OfficeSetting;
use App\Http\Controllers\Controller;
use App\Models\OfficeSettingHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class OfficeSettingController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        abort_if(
            Gate::denies('office_setting_access'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $employees=Employee::orderBy('position')->get();

        $officeSetting = OfficeSetting::latest()->first();
        $officeSettingHeaders = OfficeSettingHeader::orderBy('position')->get();
        return view('admin.setting.office_setting.index', compact('officeSetting','employees','officeSettingHeaders'));
    }


    public function update(UpdateOfficeSettingRequest $request, OfficeSetting $officeSetting)
    {
        abort_if(
            Gate::denies('office_setting_access'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $this->removeSettingFiles($request, $officeSetting);

        $officeSetting->update($request->validated());

        toast('Office Setting Updated Successfully', 'success');

        return back();
    }

    public function removeSettingFiles($request, $officeSetting)
    {
        if ($request->hasFile('cover_photo')) {
            if ($officeSetting->cover_photo) {
                $this->deleteFile($officeSetting->cover_photo);
            }
        }

        if ($request->hasFile('en_header')) {
            if ($officeSetting->en_header) {
                $this->deleteFile($officeSetting->en_header);
            }
        }

        if ($request->hasFile('ne_header')) {
            if ($officeSetting->ne_header) {
                $this->deleteFile($officeSetting->ne_header);
            }
        }
    }

}
