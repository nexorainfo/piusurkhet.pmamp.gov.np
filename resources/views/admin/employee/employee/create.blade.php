@extends('layouts.app')
@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Employee</h2>
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
                            <li class="breadcrumb-item"><a href="#0">Employee</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Employee
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
                    <form action="{{route('admin.employee.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-style-1">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="@error('name') is-invalid @enderror"
                                   placeholder="Name" value="{{old('name')}}">
                            @error('name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        @if(config('default.dual_language'))
                            <div class="input-style-1">
                                <label for="name_en">Name English</label>
                                <input type="text" id="name_en" name="name_en" class="@error('name_en') is-invalid @enderror"
                                       placeholder="Name English" value="{{old('name_en')}}">
                                @error('name_en')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        @endif

                        <div class="input-style-1">
                            <label for="photo">Photo</label>
                            <input type="file" id="photo" name="photo" class="@error('photo') is-invalid @enderror"
                                   value="{{old('photo')}}">
                            @error('photo')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="select-style-2">
                            <div class="select-position">
                                <label for="designation_id">Designation</label>
                                <select id="designation_id" name="designation_id"
                                        class="@error('designation_id') is-invalid @enderror">
                                    <option value="">-- Select Designation --</option>
                                    @foreach($designations as $designation)
                                        <option
                                            value="{{$designation->id}}" {{old('designation_id')==$designation->id ? 'selected':''}}>{{$designation->title}}</option>
                                    @endforeach
                                </select>
                                @error('designation_id')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>


                        <div class="select-style-2">
                            <div class="select-position">
                                <label for="department_id">Department</label>
                                <select id="department_id" name="department_id"
                                        class="@error('department_id') is-invalid @enderror">
                                    <option value="">-- Select Department --</option>
                                    @foreach($departments as $department)
                                        <option
                                            value="{{$department->id}}" {{old('department_id')==$department->id ? 'selected':''}}>{{$department->title}}</option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>


                        <div class="input-style-1">
                            <label for="level">Level</label>
                            <input type="text" id="level" name="level" class="@error('level') is-invalid @enderror"
                                   value="{{old('level')}}">
                            @error('level')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        @if(config('default.dual_language'))
                        <div class="input-style-1">
                            <label for="level_en">Level English</label>
                            <input type="text" id="level_en" name="level_en" class="@error('level_en') is-invalid @enderror"
                                   value="{{old('level_en')}}">
                            @error('level_en')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        @endif

                        <div class="input-style-1">
                            <label for="phone">Phone</label>
                            <input type="text" id="phone" name="phone" class="@error('phone') is-invalid @enderror"
                                   value="{{old('phone')}}">
                            @error('phone')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="input-style-1">
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address"
                                   class="@error('address') is-invalid @enderror"
                                   value="{{old('address')}}">
                            @error('address')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        @if(config('default.dual_language'))
                            <div class="input-style-1">
                            <label for="address_en">Address English</label>
                            <input type="text" id="address_en" name="address_en"
                                   class="@error('address_en') is-invalid @enderror"
                                   value="{{old('address_en')}}" >
                            @error('address_en')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                            </div>

                        @endif

                        <div class="input-style-1">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" class="@error('email') is-invalid @enderror"
                                   placeholder="Email" value="{{old('email')}}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="input-style-1">
                            <label for="position">Position</label>
                            <input type="number" id="position" name="position"
                                   class="@error('position') is-invalid @enderror" min="1" value="{{old('position')}}">
                            @error('position')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
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

@endsection
