@extends('layouts.app')
@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Dashboard</h2>
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
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->
    <div class="row">
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="icon-card mb-30">
                <div class="icon purple">
                    <i class="lni lni-users"></i>
                </div>
                <div class="content">
                    <h6 class="mb-10">जम्मा कर्मचारीहरु</h6>
                    <h3 class="text-bold text-center mb-10">{{$employeeCount}}</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="icon-card mb-30">
                <div class="icon purple">
                    <i class="lni lni-gallery"></i>
                </div>
                <div class="content">
                    <h6 class="mb-10">जम्मा {{auth()->user()->sub_division_id ? 'तस्करी' : ''}} फोटोहरु</h6>
                    <h3 class="text-bold text-center mb-10">{{$photoGalleryCount}}</h3>
                </div>
            </div>
        </div>
        @if(empty(auth()->user()->sub_division_id))
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon purple">
                        <i class="lni lni-gallery"></i>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">जम्मा स्लाइडर</h6>
                        <h3 class="text-bold text-center mb-10">{{$sliderCount}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon purple">
                        <i class="lni lni-bullhorn"></i>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">जम्मा बिल</h6>
                        <h3 class="text-bold text-center mb-10">{{$billCount}}</h3>
                    </div>
                </div>
            </div>
        @endif
        @foreach($documentCategories as $documentCategory)
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon purple">
                        <i class="lni lni-files"></i>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">{{$documentCategory->title}}</h6>
                        <h3 class="text-bold text-center mb-10">{{$documentCategory->main_documents_count}}</h3>
                    </div>
                </div>
            </div>
        @endforeach
        @if(!empty(auth()->user()->sub_division_id))
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon purple">
                        <i class="lni lni-files"></i>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">जम्मा सूचना / प्रकाशन</h6>
                        <h3 class="text-bold text-center mb-10">{{$subDivisionDocumentCount}}</h3>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <!-- End Row -->
    <!-- end container -->

@endsection
