@extends('layouts.app')
@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>नमुना संकलन</h2>
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
                                नमुना संकलन
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
                    <h6 class="mb-10">नमुना संकलन</h6>
                </div>
                <div class="text-start mt-3">

                    <p class="text-muted mb-2 font-15"><strong>नाम :</strong> <span
                            class="ms-2">{{$sampleCollection->full_name}}</span>
                    </p>

                    <p class="text-muted mb-2 font-15"><strong>फोन :</strong> <span
                            class="ms-2">{{$sampleCollection->phone}}</span></p>

                    <p class="text-muted mb-2 font-15"><strong>ठेगाना :</strong><span
                                class="ms-2">{{$sampleCollection->address}}</span></p>



                    <p class="text-muted mb-2 font-15"><strong>समस्या विवरण :</strong><span
                                        class="ms-2">{{$sampleCollection->remarks}}</span></p>
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-style mb-30">
                <div style="display: flex;justify-content: space-between">
                    <h6 class="mb-10">फाइल</h6>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-style mb-30">
                            <div class="card-body">
                                <div class="row">
                                    @forelse ($sampleCollection->files as $file)
                                        <div class="col-md-4 mb-3">
                                            <div class="card">
                                                <div class="card-header">
                                                    <form action="{{route('admin.file.destroy',$file)}}" method="post" >
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger show_confirm"  type="submit"> <i class="mdi mdi-close"></i> </button>
                                                    </form>
                                                </div>
                                                <div class="card-body">
                                                    <img src="{{ asset('storage/'.$file->url) }}" alt="Image"
                                                         style="height: 200px;width:100%">
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <h2 style="text-align: center;">No Result Found</h2>
                                    @endforelse


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>

    <div class="form-elements-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <!-- input style start -->
                <div class="card-style mb-30">
                    <h6 class="mb-25">समस्याको सामधान</h6>
                    <form action="{{route('admin.sampleCollection.update', $sampleCollection)}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12 mt-1">
                            <div class="form-group">
                                <label for="comment">सुझाव</label>
                                <textarea class="form-control textarea @error('comment') is-invalid @enderror" placeholder="सुझाव " name="comment"
                                    id="comment">{{ old('comment',$sampleCollection->comment) }}</textarea>
                                @error('comment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
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
