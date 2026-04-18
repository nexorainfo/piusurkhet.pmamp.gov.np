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
                            <li class="breadcrumb-item active" aria-current="page">
                                {{$documentCategory->title}} List
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
                    <h6 class="mb-25">Document list</h6>
                    <form action="{{route('admin.documentCategory.document.update',[$documentCategory,$document])}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="input-style-1">
                            <label for="title">Title</label>
                            <input type="text" id="title" name="title" class="@error('title') is-invalid @enderror"
                                   placeholder="Title" value="{{old('title',$document->title)}}">
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
                                       placeholder="Title" value="{{old('title_en',$document->title_en)}}">
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
                                   placeholder="Slug" value="{{old('slug',$document->slug)}}">
                            @error('slug')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="input-style-1">
                            <label for="document_category_id">Category</label>
                            <select name="document_category_id" id="document_category_id" class="form-control">
                                <option value="">Select</option>
                                @foreach($documentCategory->documentCategories as $category)
                                    <option value="{{$category->id}}" {{old('document_category_id',$category->id)==$document->document_category_id ? 'selected':''}}>{{$category->title}}</option>
                                @endforeach
                            </select>
                            @error('document_category_id')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="input-style-1">
                            <label for="files">File</label>
                            <input type="file" id="url" name="files[]" class="@error('files') is-invalid @enderror"
                                   multiple>
                            @error('files.*')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                            @error('files')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="input-style-1">
                            <label for="publisher">Publisher</label>
                            <input type="text" id="publisher" name="publisher" class="@error('publisher') is-invalid @enderror"
                                   placeholder="Publisher" value="{{old('publisher',$document->publisher)}}">
                            @error('publisher')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        @if(config('default.dual_language'))
                            <div class="input-style-1">
                                <label for="publisher_en">Publisher English</label>
                                <input type="text" id="publisher_en" name="publisher_en" class="@error('publisher_en') is-invalid @enderror"
                                       placeholder="Publisher English" value="{{old('publisher_en',$document->publisher_en)}}">
                                @error('publisher_en')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        @endif
                        <div class="input-style-1">
                            <label for="published_date">Date</label>
                            <input type="text" id="published_date" name="published_date" class="@error('published_date') is-invalid @enderror nepali-date"
                                   placeholder="Published Date" value="{{old('published_date',$document->published_date)}}">
                            @error('published_date')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="input-style-1">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" cols="30" rows="10" class="ckEditor">{{old('description',$document->description)}}</textarea>
                            @error('description')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        @if(config('default.dual_language'))
                            <div class="input-style-1">
                                <label for="description_en">Description English</label>
                                <textarea name="description_en" id="description_en" cols="30" rows="10" class="ckEditor">{{old('description_en',$document->description_en)}}</textarea>
                                @error('description_en')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        @endif
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
  @push('script')
        <script src="{{ asset('assets/backend/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ asset('assets/backend/ckeditor/editor.js') }}"></script>
    @endpush

    @push('script')
        <!-- Nepali Date Picker Js -->
        <script src="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v3.7.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(".nepali-date").nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10
            })
        </script>
    @endpush
@endsection
