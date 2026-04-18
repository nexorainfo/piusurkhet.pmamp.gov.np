@extends('layouts.app')
@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Role</h2>
                </div>
            </div>
            <!-- end col -->
            <div class="col-md-6">
                <div class="breadcrumb-wrapper mb-30">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#0">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#0">User Management</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Role
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>

    <div class="form-elements-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <!-- input style start -->
                <div class="card-style mb-30">
                    <h6 class="mb-25">Input Fields</h6>
                    <form action="{{route('admin.role.store')}}" method="POST">
                        @csrf
                        <div class="input-style-1">
                            <label for="title">Title</label>
                            <input type="text" id="title" name="title" class="@error('title') is-invalid @enderror"
                                   placeholder="Title" value="{{old('title')}}">
                            @error('title')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="select-style-2">
                            <div class="select-position">
                                <label for="permissions">Permissions</label>
                                <select id="permissions" name="permissions[]"
                                        class="@error('permissions') is-invalid @enderror"
                                        multiple>
                                    @foreach($permissions as $permission)
                                        <option
                                            value="{{$permission->id}}" @selected(old('permissions'))>{{$permission->title}}</option>
                                    @endforeach
                                </select>
                                @error('permissions')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="
                          button-group
                          d-flex
                          justify-content-center
                          flex-wrap
                        ">
                                <button type="submit" class="main-btn w-100 primary-btn btn-hover m-2">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>


                </div>
                <!-- end card -->

            </div>

        </div>
        <!-- end row -->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-style mb-30">
                <h6 class="mb-10">Role List</h6>

                <div class="table-wrapper table-responsive table-hover">
                    <table class="table">
                        <thead>
                        <tr>
                            <th><h6>#</h6></th>
                            <th><h6>Role</h6></th>
                            <th><h6>Permission</h6></th>
                            <th><h6>Action</h6></th>
                        </tr>
                        <!-- end table row-->
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td class="min-width">
                                    <p>{{$role->title}}</p>
                                </td>
                                <td class="min-width">
                                    @foreach($role->permissions as $permission)
                                        {{$permission->title}} {{!$loop->last ? ',' : ''}}
                                    @endforeach
                                </td>

                                <td>
                                    <div class="action">
                                        <a href="{{route('admin.role.edit', $role)}}" class="text-info">
                                            <i class="lni lni-pencil"></i>
                                        </a>
                                        <form action="{{route('admin.role.destroy',$role)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete '+{{$role->title}} +'?') ">
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
