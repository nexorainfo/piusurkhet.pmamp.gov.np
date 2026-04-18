@extends('frontend.sub-division.index')
@section('subDivisionContent')
    <div class="container-fluid mt-2">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('welcome')}}"><i class="fa fa-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page"> @if(request()->language=='en') {{$subDivision->title_en}} @else  {{$subDivision->title}} @endif</li>
                <li class="breadcrumb-item active" aria-current="page"> @if(request()->language=='en'){{$smuggling->title_en}} @else {{$smuggling->title}} @endif Photos</li>
            </ol>
        </nav>
    </div>
    <section class="single-category-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="textbox">
                        @if(request()->language=='en' )
                        <h4 class="title-dark">{{$smuggling->title_en}}</h4>
                        @else
                            <h4 class="title-dark">{{$smuggling->title}}</h4>
                        @endif
                    </div>
                    <div class="news-iframe">
                        @foreach($smuggling->files as $file)
                            <img src="{{ asset('storage/'.$file->url) }}" alt="{{$file->original_name}}"
                                 style="width: 100%;height: auto">
                        @endforeach
                    </div>
                    <div class="p-1">
                        @if(request()->language=='en')
                        <p> {!! $smuggling->description_en !!}</p>
                        @else
                            <p> {!! $smuggling->description !!}</p>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="box">
                        <h4 class="title mb-3">{{__('Related')}} Smuggling</h4>
                        <div class="tab-pane fade show">
                            @forelse($relatedSmugglings as $relatedSmuggling)
                                <a  href="{{route('subDivision.smugglingDetail',[$subDivision->slug,$relatedSmuggling,'language'=>$language])}}"
                                    class="card-01 mb-2" >
                                    @if(request()->language=='en')
                                    <h6 class="heading des">{{$relatedSmuggling->title}}</h6>
                                    @else
                                        <h6 class="heading des">{{$relatedSmuggling->title}}</h6>
                                    @endif
                                </a>
                            @empty
                                <h4>No Data !!</h4>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

