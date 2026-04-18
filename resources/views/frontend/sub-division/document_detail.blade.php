@extends('frontend.sub-division.index')
@section('subDivisionContent')
    <div class="container-fluid mt-2">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('welcome')}}"><i class="fa fa-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    @if(request()->language=='en')
                    {{$subDivision->title_en}}
                    @else
                        {{$subDivision->title}}
                    @endif
                </li>
            </ol>
        </nav>
    </div>
    <section class="single-category-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="textbox">
                        <h4 class="title-dark">
                            @if(request()->language=='en')
                            {{$subDivisionDocument->title_en}}
                            @else
                                {{$subDivisionDocument->title}}
                            @endif
                        </h4>
                        <div class="mt-2 text">{{$subDivisionDocument->date}} | @if(request()->language=='en'){{$subDivisionDocument->publisher_en}}@else{{$subDivisionDocument->publisher}} @endif</div>
                    </div>
                    <div class="news-iframe">
                        @foreach($subDivisionDocument->files as $file)
                            @if(in_array($file->extension,['jpg','jpeg','png']))
                                <img src="{{ asset('storage/'.$file->url) }}" alt="{{$file->original_name}}"
                                     style="width: 100%;height: auto">
                            @elseif($file->extension=="pdf")
                                <iframe src="{{asset('storage/'.$file->url)}}" height="600px" width="100%"></iframe>
                            @else
                                <a href="{{asset('storage/'.$file->url)}}" download="{{asset('storage/'.$file->url)}}">
                                    <i class="fa fa-download"></i> {{__('Download')}}
                                </a>
                            @endif
                        @endforeach
                    </div>
                    <div class="p-1">
                        @if(request()->language=='en')
                        <p> {!! $subDivisionDocument->description_en !!}</p>
                        @else
                            <p> {!! $subDivisionDocument->description !!}</p>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="box">
                        <h4 class="title mb-3">{{__('Related Information')}}</h4>
                        <div class="tab-pane fade show">
                            @foreach($subDivisionDocuments as $document)
                            <a  href="{{route('subDivision.documentDetail',[$subDivision->slug,$document,'language'=>$language])}}"
                                class="card-01 mb-2" >
                                @if(request()->language=='en')
                                <h6 class="heading des">{{$document->title_en}}</h6>
                                <p class="mt-2 sub-title">{{$document->date}} | {{$document->publisher_en}}</p>
                                @else
                                    <h6 class="heading des">{{$document->title}}</h6>
                                    <p class="mt-2 sub-title">{{$document->date}} | {{$document->publisher}}</p>
                                @endif
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

