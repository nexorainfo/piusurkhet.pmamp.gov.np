<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DepartmentResource;
use App\Http\Resources\DesignationResource;
use App\Http\Resources\EmployeeResource;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use Illuminate\Http\Request;

class PublicApiController extends Controller
{
    public function designation()
    {
        return DesignationResource::collection(Designation::all());
    }

    public function department()
    {
        return DepartmentResource::collection(Department::all());
    }

    public function employees(Request $request)
    {
        return [
            'department' => DepartmentResource::collection(Department::all()),
            'designation' => DesignationResource::collection(Designation::all()),
            'employees' => EmployeeResource::collection(
                Employee::with('department', 'designation')
                    ->where(function ($query) use ($request) {
                        if ($request->designation_id) {
                            $query->where('designation_id', $request->designation_id);
                        }
                        if ($request->department_id) {
                            $query->where('department_id', $request->department_id);
                        }
                    })
                    ->get(),
            )];
    }
}
