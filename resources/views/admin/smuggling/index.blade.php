@extends('layouts.app')
@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>तस्करी</h2>
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
                                तस्करी
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
                    <h6 class="mb-10">तस्करी लिस्ट</h6>
                    <a href="{{route('admin.smuggling.create')}}" class="btn btn-sm btn-primary">Add New</a>
                </div>
                <div class="table-responsive table-hover">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Title</th>
                            <th>Cover Photo</th>
                            <th>Images</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                        <!-- end table row-->
                        </thead>
                        <tbody>
                        @forelse($smugglings as $smuggling)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$smuggling->title}}</td>
                                <td>
                                    <img src="{{asset('storage/'.$smuggling->files->first()->url)}}" height="75" width="75" alt="Photo">
                                </td>
                                <td>
                                    <a href="{{route('admin.smuggling.show',$smuggling)}}" class="btn btn-sm btn-primary">
                                        <i class="mdi mdi-eye"></i> View
                                    </a>
                                </td>
                                <td>{{\Illuminate\Support\Str::words($smuggling->description,60)}}</td>
                                <td>
                                    <div class="action">
                                        <a href="{{route('admin.smuggling.edit', $smuggling)}}" class="text-info">
                                            <i class="lni lni-pencil"></i>
                                        </a>
                                        <form action="{{route('admin.smuggling.destroy',$smuggling)}}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-danger show_confirm">
                                                <i class="lni lni-trash-can"></i>
                                            </button>
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
