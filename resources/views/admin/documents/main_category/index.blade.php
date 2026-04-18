@extends('layouts.app')
@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Document Category</h2>
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
                                Document Category
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>

    <div class="card-style mb-30">
        <form action="{{route('admin.documentCategory.store')}}" method="POST"
              enctype="multipart/form-data">
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
                            <label for="title_en">शीर्षक English</label>
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
                        <label for="position">Position</label>
                        <input type="number" id="position" name="position" value="{{old('position')}}"
                               placeholder="Position">
                        @error('position')
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
                <h6 class="mb-10">Category List</h6>

                <div class="table-wrapper table-responsive table-hover">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Title</th>
                            <th>Position</th>
                            <th>Show On Index</th>
                            <th>Action</th>
                        </tr>
                        <!-- end table row-->
                        </thead>
                        <tbody>
                        @foreach($documentCategories as $documentCategory)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td class="min-width">
                                    <p>{{$documentCategory->title}}</p>
                                </td>
                                <td class="min-width">
                                    <p>{{$documentCategory->position}}</p>
                                </td>
                                <td>
                                    <a href="{{route('admin.documentCategory.showOnIndex',$documentCategory)}}">
                                        @if($documentCategory->show_on_index==1)
                                            <i class="mdi mdi-check mdi-24px text-success"></i>
                                        @else
                                            <i class="mdi mdi-window-close mdi-24px text-danger"></i>
                                        @endif

                                    </a>
                                </td>

                                <td>
                                    <div class="action">
                                        @can('document_category_edit')
                                        <a href="{{route('admin.documentCategory.edit', $documentCategory)}}"
                                           class="text-info">
                                            <i class="lni lni-pencil"></i>
                                        </a>
                                        @endcan
                                        <form action="{{route('admin.documentCategory.destroy',$documentCategory)}}"
                                              method="POST"
                                              >
                                            @csrf
                                            @method('DELETE')
                                            @can('document_category_delete')
                                            <button class="text-danger show_confirm" type="submit">
                                                <i class="lni lni-trash-can"></i>
                                            </button>
                                            @endcan
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                    <!-- end table -->
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
@endsection
