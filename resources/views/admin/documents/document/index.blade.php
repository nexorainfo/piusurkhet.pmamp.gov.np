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
                                {{$documentCategory->title}}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-style mb-30">
                <div style="display: flex;justify-content: space-between">
                    <h6 class="mb-10">{{$documentCategory->title}}</h6>
                    @can('document_create')
                    <a href="{{route('admin.documentCategory.document.create',$documentCategory)}}" class="btn btn-sm btn-primary">Add New</a>
                        @endcan
                </div>
                <div class=" table-responsive table-hover">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Mark As New</th>
                            <th>popUp</th>
                            <th>Action</th>
                        </tr>
                        <!-- end table row-->
                        </thead>
                        <tbody>
                        @forelse($documentCategory->mainDocuments as $document)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td>{{Str::words($document->title,15,'...')}}</td>
                                <td>
                                    @can('document_edit')
                                    <a href="{{route('admin.documentCategory.document.updateStatus',[$documentCategory,$document])}}">
                                        @if($document->status==1)
                                            <i class="mdi mdi-check mdi-24px text-success"></i>
                                        @else
                                            <i class="mdi mdi-window-close mdi-24px text-danger"></i>
                                        @endif

                                    </a>
                                    @endcan
                                </td>
                                <td>
                                    @can('document_edit')
                                    <a href="{{route('admin.documentCategory.document.markAsNew',[$documentCategory,$document])}}">
                                        @if($document->mark_as_new==1)
                                            <i class="mdi mdi-check mdi-24px text-success"></i>
                                        @else
                                            <i class="mdi mdi-window-close mdi-24px text-danger"></i>
                                        @endif

                                    </a>
                                    @endcan
                                </td>
                                <td>
                                    @can('document_edit')
                                        <a href="{{route('admin.documentCategory.document.popUp',[$documentCategory,$document])}}">
                                            @if($document->popUp==1)
                                                <i class="mdi mdi-check mdi-24px text-success"></i>
                                            @else
                                                <i class="mdi mdi-window-close mdi-24px text-danger"></i>
                                            @endif

                                        </a>
                                    @endcan
                                </td>
                                <td>
                                    <div class="action">
                                        @can('document_edit')
                                        <a href="{{route('admin.documentCategory.document.edit', [$documentCategory,$document])}}" class="text-info">
                                            <i class="lni lni-pencil"></i>
                                        </a>
                                        @endcan
                                        <a href="{{route('admin.documentCategory.document.show', [$documentCategory,$document])}}" class="text-info">
                                            <i class="lni lni-list"></i>
                                        </a>
                                        <form action="{{route('admin.documentCategory.document.destroy',[$documentCategory,$document])}}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                            @can('document_delete')
                                            <button class="text-danger show_confirm">
                                                <i class="lni lni-trash-can"></i>
                                            </button>
                                            @endcan
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="4">No Result Found</td>
                            </tr>
                        @endforelse

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
