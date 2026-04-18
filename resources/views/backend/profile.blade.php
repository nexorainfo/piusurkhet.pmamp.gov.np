@extends('layouts.app')
@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="titlemb-30">
                    <h2>My Profile Information</h2>
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
                                My Profile
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->

    <div class="row">
        <div class="col-lg-6">
            <div class="card-style settings-card-1 mb-30">
                <div
                    class="
                    title
                    mb-30
                    d-flex
                    justify-content-between
                    align-items-center
                  "
                >
                    <h6>My Profile</h6>
                    <button class="border-0 bg-transparent">
                        <i class="lni lni-pencil-alt"></i>
                    </button>
                </div>
                <div class="profile-info">
                    <div class="d-flex align-items-center mb-30">
                        <div class="profile-image">
                            <img src="{{auth()->user()->profile_photo_path}}" alt=""/>
                        </div>
                        <div class="profile-meta">
                            <h5 class="text-bold text-dark mb-10">{{auth()->user()->name}}</h5>
                            <h6 class="text-bold text-dark mb-10">
                                Role : <span class="badge badge-primary">{{auth()->user()->role->title??''}}</span>
                            </h6>
                        </div>
                    </div>
                    <form action="{{route('admin.profile.updateProfile')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">User Name</label>
                                    <input type="text" name="name" id="name" placeholder="User Name" class="form-control" value="{{auth()->user()->name}}"/>
                                    @error('name')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" placeholder="Email" class="form-control" value="{{auth()->user()->email}}"/>
                                    @error('email')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">Photo</label>
                                    <input type="file" name="profile_photo_path" class="form-control" id="email">
                                    @error('profile_photo_path')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        Save Changes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

        <div class="col-lg-6">
            <div class="card-style settings-card-2 mb-30">
                <div class="title mb-30">
                    <h6>Change Password</h6>
                </div>
                <form action="{{route('admin.profile.updatePassword')}}" method="post">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-12">
                            <div class="input-style-1">
                                <label for="current_password">Current Password</label>
                                <input type="password" id="current_password" name="current_password" placeholder="Current Password"/>
                                @error('current_password')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="input-style-1">
                                <label for="password">New Password</label>
                                <input type="password" id="password" name="password" placeholder="New Password"/>
                                @error('password')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="input-style-1">
                                <label for="password_confirmation">Password Confirmation</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password"/>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary">
                                Save Changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection
