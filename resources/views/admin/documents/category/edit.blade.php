@extends('layouts.app')
@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>{{$documentCategory->title}}</h2>
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
                            <li class="breadcrumb-item"><a href="#0">{{$documentCategory->title}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Category
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
                    <h6 class="mb-25">{{$documentCategory->title}}</h6>
                    <form action="{{route('admin.documentCategory.category.update',[$documentCategory,$category])}}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="input-style-1">
                            <label for="title">Title</label>
                            <input type="text" id="title" name="title" class="@error('title') is-invalid @enderror"
                                   placeholder="Title" value="{{old('title',$category->title)}}">
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
                                       placeholder="Title English" value="{{old('title_en',$category->title_en)}}">
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
                                   placeholder="Slug" value="{{old('slug',$category->slug)}}">
                            @error('slug')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="input-style-1">
                            <label for="position">Position</label>
                            <input type="number" id="position" name="position"
                                   value="{{old('position',$category->position)}}"
                                   placeholder="Position">
                            @error('position')
                            <p class="text-danger">{{$message}}</p>
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
