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
                            <li class="breadcrumb-item active" aria-current="page">
                                Sub Division
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
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

    <div class="row">
        <div class="col-lg-12">
            <div class="card-style mb-30">
                <div style="display: flex;justify-content: space-between">
                    <h6 class="mb-10">Sub Division Document</h6>
                    <a href="{{route('admin.subDivisionDocument.create')}}" class="btn btn-sm btn-primary">Add New</a>
                </div>
                <div class=" table-responsive table-hover">
                    <table class="table">
                        <thead>
                        <tr>
                            <th><h6>SN</h6></th>
                            <th><h6>Sub Division Document Category</h6></th>
                            <th><h6>Publisher</h6></th>
                            <th><h6>Date</h6></th>
                            <th><h6>Status</h6></th>
                            <th><h6>Mark As New</h6></th>
                            <th><h6>Action</h6></th>
                        </tr>
                        <!-- end table row-->
                        </thead>
                        <tbody>
                        @foreach($subDivisionDocuments as $subDivisionDocument)
                            <tr>
                                <td class="min-width">
                                   <p>{{$loop->iteration}}</p>
                                </td>
                                <td class="min-width">
                                   <p>{{$subDivisionDocument->subDivisionDocumentCategory->title}}</p>
                                </td>
                                <td class="min-width">
                                   <p>{{$subDivisionDocument->publisher}}</p>
                                </td>
                                <td class="min-width">
                                  <p>{{$subDivisionDocument->date}}</p>
                                </td>
                                <td class="min-width">
                                    <a href="{{route('admin.subDivisionDocument.status',$subDivisionDocument)}}">
                                        @if($subDivisionDocument->status==1)
                                            <i class="mdi mdi-check mdi-24px text-success"></i>
                                        @else
                                            <i class="mdi mdi-window-close mdi-24px text-danger"></i>
                                        @endif
                                    </a>
                                </td>

                                <td class="min-width">
                                    <a href="{{route('admin.subDivisionDocument.markAsNew',$subDivisionDocument)}}">
                                        @if($subDivisionDocument->mark_as_new==1)
                                            <i class="mdi mdi-check mdi-24px text-success"></i>
                                        @else
                                            <i class="mdi mdi-window-close mdi-24px text-danger"></i>
                                        @endif
                                    </a>
                                </td>
                                <td>
                                    <div class="action">
                                        <a href="{{route('admin.subDivisionDocument.edit', $subDivisionDocument)}}"
                                           class="text-info">
                                            <i class="lni lni-pencil"></i>
                                        </a>
                                        <a href="{{route('admin.subDivisionDocument.show', $subDivisionDocument)}}"
                                           class="text-info">
                                            <i class="lni lni-list"></i>
                                        </a>
                                        <form action="{{route('admin.subDivisionDocument.destroy',$subDivisionDocument)}}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-danger show_confirm" type="submit">
                                                <i class="lni lni-trash-can"></i>
                                            </button>
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
