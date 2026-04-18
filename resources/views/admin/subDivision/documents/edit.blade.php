@extends('layouts.app')
@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Sub Division Document</h2>
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
                            <li class="breadcrumb-item"><a href="#0">Sub Division</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Sub Division Document
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
                    <h6 class="mb-25">Update Sub Division Document</h6>
                    <form action="{{route('admin.subDivisionDocument.update',$subDivisionDocument)}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="input-style-1">
                            <label for="title">Title</label>
                            <input type="text" id="title" name="title" class="@error('title') is-invalid @enderror"
                                   placeholder="Title" value="{{old('title',$subDivisionDocument->title)}}">
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
                                       placeholder="Title" value="{{old('title_en',$subDivisionDocument->title_en)}}">
                                @error('title_en')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        @endif
                        <div class="input-style-1">
                            <label for="sub_division_document_category_id">Category</label>
                            <select name="sub_division_document_category_id" id="sub_division_document_category_id" class="form-control">
                                <option value="">Select</option>
                                @foreach($subDivisionDocumentCategories as $subDivisionDocumentCategory)
                                    <option value="{{$subDivisionDocumentCategory->id}}" {{old('sub_division_document_category_id',$subDivisionDocumentCategory->id) == $subDivisionDocument->sub_division_document_category_id ? 'selected':''}}>{{$subDivisionDocumentCategory->title}}</option>
                                @endforeach
                            </select>
                            @error('sub_division_document_category_id')

                            <p style="color:red"> {{$message}}</p>

                            @enderror

                        </div>
                        <div class="input-style-1">
                            <label for="files">Files</label>
                            <input type="file" class="@error('files') is-invalid @enderror" name="files[]" id="files" multiple>
                            @error('files.*')
                            <p style="color: red"> {{$message}}</p>
                            @enderror

                            @error('files')
                            <p style="color: red"> {{$message}}</p>
                            @enderror

                        </div>
                        <div class="input-style-1">
                            <label for="publisher">Publisher</label>
                            <input type="text" id="publisher" name="publisher" class="@error('publisher') is-invalid @enderror"
                                   placeholder="Publisher" value="{{old('publisher',$subDivisionDocument->publisher)}}">
                            @error('publisher')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        @if(config('default.dual_language'))
                            <div class="input-style-1">
                                <label for="publisher_en">Publisher English</label>
                                <input type="text" id="publisher_en" name="publisher_en" class="@error('publisher_en',$subDivisionDocument->publisher_en) is-invalid @enderror"
                                       placeholder="Publisher English" value="{{old('publisher_en')}}">
                                @error('publisher_en')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        @endif
                        <div class="input-style-1">
                            <label for="date">Date</label>
                            <input type="text" id="date" name="date" class="@error('date') is-invalid @enderror"
                                   placeholder="Date" value="{{old('date',$subDivisionDocument->date)}}">
                            @error('date')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="input-style-1">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{old('description',$subDivisionDocument->description)}}</textarea>
                            @error('description')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        @if(config('default.dual_language'))
                            <div class="input-style-1">
                                <label for="description_en">Description English</label>
                                <textarea name="description_en" id="description_en" cols="30" rows="10" class="form-control">{{old('description_en',$subDivisionDocument->description_en)}}</textarea>
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

@endsection
