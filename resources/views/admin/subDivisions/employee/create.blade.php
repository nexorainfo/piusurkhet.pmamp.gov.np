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
                    <form action="{{route('admin.subDivisionEmployee.store')}}" method="POST"
                          enctype="multipart/form-data">
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

                        <div class="input-style-1">
                            <label for="designation">Designation</label>
                            <input type="text" id="designation" name="designation"
                                   class="@error('designation') is-invalid @enderror"
                                   placeholder="Designation" value="{{old('designation')}}">
                            @error('designation')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        @if(config('default.dual_language'))
                            <div class="input-style-1">
                                <label for="designation_en">Designation English</label>
                                <input type="text" id="designation_en" name="designation_en"
                                       class="@error('designation_en') is-invalid @enderror"
                                       placeholder="Designation English" value="{{old('designation_en')}}">
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
                                   placeholder="Department" value="{{old('department')}}">
                            @error('department')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        @if(config('default.dual_language'))
                            <div class="input-style-1">
                                <label for="department_en">Department English</label>
                                <input type="text" id="department_en" name="department_en"
                                       class="@error('department_en') is-invalid @enderror"
                                       placeholder="Department English" value="{{old('department_en')}}">
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
                                       value="{{old('address_en')}}">
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

                        <div class="radio-style">
                            <label for="is_chief">Is Chief?</label>
                            <br>
                            <input type="radio" id="no" name="is_chief"
                                   class="@error('is_chief') is-invalid @enderror"
                                   value="0" @checked(old('is_chief'))>
                            <label for="no">No</label>
                            <input type="radio" id="yes" name="is_chief"
                                   class="@error('is_chief') is-invalid @enderror"
                                   value="1" @checked(old('is_chief'))>
                            <label for="yes">Yes</label>
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
