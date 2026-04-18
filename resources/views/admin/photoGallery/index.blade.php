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

    <div class="card-style mb-30">
        <form action="{{route('admin.photoGallery.store')}}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="input-style-1">
                        <label for="title">शीर्षक</label>
                        <input type="text" id="title" name="title"
                               placeholder="शीर्षक" value="{{old('title')}}">
                        @error('title')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                @if(config('default.dual_language'))
                <div class="col-md-4">
                    <div class="input-style-1">
                        <label for="title_en">शीर्षक (English)</label>
                        <input type="text" id="title_en" name="title_en"
                               placeholder="शीर्षक English" value="{{old('title_en')}}">
                        @error('title_en')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                @endif
                <div class="col-md-4">
                    <div class="input-style-1">
                        <label for="slug">Slug</label>
                        <input type="text" id="slug" name="slug"
                               placeholder="Slug" value="{{old('slug')}}">
                        @error('slug')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-style-1">
                        <label for="images">Images(Insert Multiple Image)</label>
                        <input class="mt-1" type="file" id="images" name="images[]" multiple>
                        @error('images')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                        @error('images.*')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-sm btn-primary">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-style mb-30">
                <h6 class="mb-10">फोटो ग्यालरी लिस्ट</h6>

                <div class="table-wrapper table-responsive table-hover">
                    <table class="table">
                        <thead>
                        <tr>
                            <th><h6>#</h6></th>
                            <th><h6>Title</h6></th>
                            <th><h6>Images</h6></th>
                            <th><h6>Action</h6></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($photoGalleries as $photoGallery)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td class="min-width">
                                    <p>{{$photoGallery->title}}</p>
                                </td>
                                <td class="min-width">
                                    <a href="{{route('admin.photoGallery.show',$photoGallery)}}" class="btn btn-primary">
                                     <i class="mdi mdi-flash-red-eye"></i>View
                                    </a>
                                </td>

                                <td>
                                    <div class="action">
                                        <a href="{{route('admin.photoGallery.edit', $photoGallery)}}" class="text-info">
                                            <i class="lni lni-pencil"></i>
                                        </a>
                                        <form action="{{route('admin.photoGallery.destroy',$photoGallery)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-danger show_confirm"   type="submit">
                                                <i class="lni lni-trash-can"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
