@extends('layouts.app')
@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Sub Division Office</h2>
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
                            <li class="breadcrumb-item"><a href="#">Sub Division</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Sub Division Office
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
                    <form action="{{route('admin.subDivision.store')}}" method="POST">
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
                        @if(config('default.dual_language'))
                            <div class="input-style-1">
                                <label for="title_en">Title English</label>
                                <input type="text" id="title_en" name="title_en" class="@error('title_en') is-invalid @enderror"
                                       placeholder="Title English" value="{{old('title_en')}}">
                                @error('title_en')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        @endif
                        <div class="input-style-1">
                            <label for="slug">Slug</label>
                            <input type="text" id="slug" name="slug" class="@error('slug') is-invalid @enderror"
                                   placeholder="Slug" value="{{old('slug')}}">
                            @error('slug')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
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
                            <label for="phone">Phone</label>
                            <input type="number" id="phone" name="phone" class="@error('phone') is-invalid @enderror"
                                   value="{{old('phone')}}">
                            @error('phone')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="input-style-1">
                            <label for="introduction">Introduction</label>
                            <textarea name="introduction" id="introduction" cols="30" rows="10"
                                      class="@error('introduction') is-invalid @enderror">{{old('introduction')}}</textarea>
                            @error('introduction')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        @if(config('default.dual_language'))
                            <div class="input-style-1">
                                <label for="introduction_en">Introduction English</label>
                                <textarea name="introduction_en" id="introduction_en" cols="30" rows="10"
                                          class="@error('introduction_en') is-invalid @enderror">{{old('introduction_en')}}</textarea>
                                @error('introduction_en')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        @endif
                        <div class="input-style-1">
                            <label for="map">Map</label>
                            <textarea name="map" id="map" cols="30" rows="4"
                                      class="@error('map') is-invalid @enderror" placeholder="Map Url">{{old('map')}}</textarea>
                            @error('map')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="input-style-1">
                            <label for="facebook">Facebook Page Url</label>
                            <textarea name="facebook" id="facebook" cols="30" rows="4"
                                      class="@error('facebook') is-invalid @enderror"
                                      placeholder="Facebook Page Url">{{old('facebook')}}</textarea>
                            @error('facebook')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-sm btn-primary">
                                Submit
                            </button>
                        </div>
                    </form>


                </div>
                <!-- end card -->

            </div>

        </div>
        <!-- end row -->
    </div>

@endsection
