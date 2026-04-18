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
                            <li class="breadcrumb-item"><a href="#0">Employee</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Ex Employee Edit
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
                    <form action="{{route('admin.exEmployee.update', $exEmployee)}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="input-style-1">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name"
                                   class="@error('name') is-invalid @enderror"
                                   placeholder="Name" value="{{old('name', $exEmployee->name)}}">
                            @error('name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        @if(config('default.dual_language'))
                            <div class="input-style-1">
                                <label for="name_en">Name (English)</label>
                                <input type="text" id="name_en" name="name_en"
                                       class="@error('name_en') is-invalid @enderror"
                                       placeholder="Name English" value="{{old('name_en', $exEmployee->name_en)}}">
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

                        <div class="input-style-1">
                            <label for="designation">Designation</label>
                            <input type="text" id="designation" name="designation"
                                   class="@error('designation') is-invalid @enderror"
                                   placeholder="Designation (Nepali)"
                                   value="{{old('designation', $exEmployee->designation)}}">
                            @error('designation')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        @if(config('default.dual_language'))
                            <div class="input-style-1">
                                <label for="designation_en">Designation (English)</label>
                                <input type="text" id="designation_en" name="designation_en"
                                       class="@error('designation_en') is-invalid @enderror"
                                       placeholder="Designation (English)"
                                       value="{{old('designation_en', $exEmployee->designation_en)}}">
                                @error('designation_en')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        @endif

                        <div class="input-style-1">
                            <label for="department">Department</label>
                            <input type="text" id="department" name="department"
                                   class="@error('department') is-invalid @enderror"
                                   placeholder="Department (English)"
                                   value="{{old('department', $exEmployee->department)}}">
                            @error('department')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        @if(config('default.dual_language'))
                            <div class="input-style-1">
                                <label for="department_en">Department (English)</label>
                                <input type="text" id="department_en" name="department_en"
                                       class="@error('department_en') is-invalid @enderror"
                                       placeholder="Department (English)"
                                       value="{{old('department_en', $exEmployee->department_en)}}">
                                @error('department_en')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        @endif
                        <div class="input-style-1">
                            <label for="level">Level</label>
                            <input type="text" id="level" name="level" class="@error('level') is-invalid @enderror"
                                   value="{{old('level', $exEmployee->level)}}">
                            @error('level')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        @if(config('default.dual_language'))
                            <div class="input-style-1">
                                <label for="level_en">Level English</label>
                                <input type="text" id="level_en" name="level_en"
                                       class="@error('level_en') is-invalid @enderror"
                                       value="{{old('level_en', $exEmployee->level_en)}}">
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
                                   value="{{old('phone', $exEmployee->phone)}}">
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
                                   value="{{old('address', $exEmployee->address)}}">
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
                                       value="{{old('address_en', $exEmployee->address_en)}}">
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
                                   placeholder="Email" value="{{old('email', $exEmployee->email)}}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="input-style-1">
                            <label for="joining_date">Joining Date</label>
                            <input type="text" id="joining_date" name="joining_date"
                                   class="@error('joining_date') is-invalid @enderror" min="1"
                                   value="{{old('joining_date', $exEmployee->joining_date)}}" placeholder="YYYY-MM-DD">
                            @error('joining_date')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="input-style-1">
                            <label for="leaving_date">Leaving Date</label>
                            <input type="text" id="leaving_date" name="leaving_date"
                                   class="@error('leaving_date') is-invalid @enderror" min="1"
                                   value="{{old('leaving_date', $exEmployee->leaving_date)}}" placeholder="YYYY-MM-DD">
                            @error('leaving_date')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="radio-style-1">
                            <label for="is_chief">Chief/Employee</label> <br>
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            <input type="radio" id="chief" name="is_chief"
                                   class="@error('is_chief') is-invalid @enderror"
                                   value="1"@checked(old('is_chief', $exEmployee->is_chief) == 1) >
                            <label for="chief">Chief</label>
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            <input type="radio" id="chief" name="is_chief"
                                   class="@error('is_chief') is-invalid @enderror"
                                   value="0" @checked(old('is_chief', $exEmployee->is_chief) == 0) >
                            <label for="chief">Employee</label>
                            @error('is_chief')
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
