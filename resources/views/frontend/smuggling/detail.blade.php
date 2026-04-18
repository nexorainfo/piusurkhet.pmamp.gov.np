@extends('layouts.master')
@section('content')

    <div class="container-fluid mt-2">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('welcome')}}"><i class="fa fa-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page"> {{$smuggling->title}} Photos</li>
            </ol>
        </nav>
    </div>
    <section class="single-category-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="textbox">
                        <h4 class="title-dark">{{$smuggling->title}}</h4>
                        <div class="mt-2 text">{{$smuggling->title}} Photos</div>
                    </div>
                    <div class="news-iframe">
                        @foreach($smuggling->files as $file)
                            <img src="{{ asset('storage/'.$file->url) }}" alt="{{$file->original_name}}"
                                 style="width: 100%;height: auto">
                        @endforeach
                    </div>
                    <div class="p-1">
                        <p> {!! $smuggling->description !!}</p>
                    </div>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="box">
                        <h4 class="title mb-3">{{__('Related')}} Smuggling</h4>
                        <div class="tab-pane fade show">
                            @forelse($relatedSmugglings as $relatedSmuggling)
                                <a  href="{{route('smugglingDetail',$relatedSmuggling)}}"
                                    class="card-01 mb-2">
                                    <h6 class="heading des">{{$relatedSmuggling->title}}</h6>
                                </a>
                            @empty
                                <h6>No Data !!</h6>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

