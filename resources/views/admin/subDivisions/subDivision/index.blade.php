@extends('layouts.app')
@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>सब डिभिजन कार्यालयहरु</h2>
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
                            <li class="breadcrumb-item active" aria-current="page">
                                सब डिभिजन कार्यालयहरु
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
                    <h6 class="mb-10">सब डिभिजन कार्यालयहरु</h6>
                    <a href="{{route('admin.subDivision.create')}}" class="btn btn-sm btn-primary">Add New</a>
                </div>
                <div class="table-wrapper table-responsive table-hover">
                    <table class="table">
                        <thead>
                        <tr>
                            <th><h6>#</h6></th>
                            <th><h6>Title</h6></th>
                            <th><h6>Email</h6></th>
                            <th><h6>Phone</h6></th>
                            <th><h6>Action</h6></th>
                        </tr>
                        <!-- end table row-->
                        </thead>
                        <tbody>
                        @foreach($subDivisions as $subDivision)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td class="min-width">
                                    <p>{{$subDivision->title}}</p>
                                </td>
                                <td class="min-width">
                                    <p>{{$subDivision->email}}</p>
                                </td>
                                <td class="min-width">
                                    <p>{{$subDivision->phone}}</p>
                                </td>

                                <td>
                                    <div class="action">
                                        <a href="{{route('admin.subDivision.edit', $subDivision)}}" class="text-info">
                                            <i class="lni lni-pencil"></i>
                                        </a>
                                        <form action="{{route('admin.subDivision.destroy',$subDivision)}}" method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete '+{{$subDivision->name}} +'?') ">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-danger" type="submit">
                                                <i class="lni lni-trash-can"></i>
                                            </button>
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
