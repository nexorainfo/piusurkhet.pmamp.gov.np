@extends('layouts.app')
@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>फोटो ग्यालरी</h2>
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
                            <li class="breadcrumb-item"><a href="">फोटो ग्यालरी</a></li>

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
                    <h6 class="mb-25">फोटो ग्यालरी अपडेट</h6>
                    <form action="{{route('admin.photoGallery.update',$photoGallery)}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('put')
                        <div class="input-style-1">
                            <label for="title">Title</label>
                            <input type="text" id="title" name="title" class="@error('title') is-invalid @enderror"
                                   placeholder="Title" value="{{old('title',$photoGallery->title)}}">
                            @error('title')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        @if(config('default.dual_language'))
                            <div class="col-md-4">
                                <div class="input-style-1">
                                    <label for="title_en">शीर्षक (English)</label>
                                    <input type="text" id="title_en" name="title_en"
                                           placeholder="शीर्षक English" value="{{old('title_en',$photoGallery->title_en)}}">
                                    @error('title_en')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                        @endif
                        <div class="input-style-1">
                            <label for="slug">Slug</label>
                            <input type="text" id="slug" name="slug" class="@error('slug') is-invalid @enderror"
                                   placeholder="Slug" value="{{old('slug',$photoGallery->slug)}}">
                            @error('slug')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="input-style-1">
                            <label for="images">Images(Insert Multiple Image)</label>
                            <input type="file" id="images" name="images[]" class="@error('images') is-invalid @enderror"
                                   multiple>
                            @error('images')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                            @error('images.*')
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
