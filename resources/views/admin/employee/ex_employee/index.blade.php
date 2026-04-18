@extends('layouts.app')
@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Ex Employee</h2>
                </div>
            </div>
            <!-- end col -->
            <div class="col-md-6">
                <div class="breadcrumb-wrapper mb-30">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.dashboard')}}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Employees</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Ex Employee
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-style mb-30">
                <div style="display: flex;justify-content: space-between">
                    <h6>Ex Employee List</h6>
                    @can('ex_employee_create')
                    <a href="{{route('admin.exEmployee.create')}}"
                       class="btn btn-sm btn-primary"> Add New
                    </a>
                    @endcan
                </div>
                <div class="table-wrapper table-responsive table-hover">
                    <table class="table">
                        <thead>
                        <tr>
                            <th><h6>Photo</h6></th>
                            <th><h6>Name</h6></th>
                            <th><h6>Department</h6></th>
                            <th><h6>Designation</h6></th>
                            <th><h6>Tenure</h6></th>
                            <th><h6>Contact</h6></th>
                            <th><h6>Chief/Employee</h6></th>
                            <th><h6>Action</h6></th>
                        </tr>
                        <!-- end table row-->
                        </thead>
                        <tbody>
                        @foreach($employees as $employee)
                            <tr>
                                <td class="min-width">
                                    <img src="{{$employee->photo}}" alt="{{$employee->name}}" width="80">
                                </td>
                                <td class="min-width">
                                    <p>{{$employee->name}}</p>
                                </td>
                                <td class="min-width">
                                    <p>{{$employee->department ?? ''}}</p>
                                </td>
                                <td class="min-width">
                                    <p>{{$employee->designation ?? ''}}</p>
                                </td>
                                <td class="min-width">
                                    <p>{{$employee->joining_date->format('Y-m-d')}} - {{$employee->leaving_date->format('Y-m-d')}}</p>
                                </td>
                                <td class="min-width">
                                    <p><i class="fa fa-phone"></i> {{$employee->phone}}</p>
                                    <p><i class="fa fa-envelope"></i> {{$employee->email}}</p>
                                </td>
                                <td class="min-width">
                                    <p>@if($employee->is_chief == 1)
                                           <span class="badge bg-primary rounded-pill">Office Chief</span>
                                        @else
                                            <span class="badge bg-info rounded-pill">Employee</span>
                                        @endif</p>
                                </td>

                                <td>
                                    <div class="action">
                                        @can('ex_employee_edit')
                                        <a href="{{route('admin.exEmployee.edit', $employee)}}" class="text-info">
                                            <i class="lni lni-pencil"></i>
                                        </a>
                                        @endcan
                                        <form action="{{route('admin.exEmployee.destroy',$employee)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            @can('ex_employee_delete')
                                            <button class="text-danger show_confirm" type="submit">
                                                <i class="lni lni-trash-can"></i>
                                            </button>
                                            @endcan
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                    <!-- end table -->
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
@endsection
