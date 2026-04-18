@extends('layouts.app')
@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>VideoGallery</h2>
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
                            <li class="breadcrumb-item"><a href="">VideoGallery</a></li>

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
                    <h6 class="mb-25">Update Video Gallery</h6>
                    <form action="{{route('admin.videoGallery.update',$videoGallery)}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('put')
                        <div class="input-style-1">
                            <label for="title">Title</label>
                            <input type="text" id="title" name="title" class="@error('title') is-invalid @enderror"
                                   placeholder="Title" value="{{old('title',$videoGallery->title)}}">
                            @error('title')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        @if(config('default.dual_language'))
                            <div class="col-md-6">
                                <div class="input-style-1">
                                    <label for="title_en">शीर्षक (English)</label>
                                    <input type="text" id="title_en" name="title_en"
                                           placeholder="शीर्षक English" value="{{old('title_en',$videoGallery->title_en)}}">
                                    @error('title_en')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                        @endif
                        <div class="input-style-1">
                            <label for="url">Url</label>
                            <input type="text" id="url" name="url" class="@error('url') is-invalid @enderror"
                                   placeholder="Url" value="{{old('slug',$videoGallery->url)}}">
                            @error('url')
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
