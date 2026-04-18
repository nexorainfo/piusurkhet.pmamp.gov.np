@extends('frontend.sub-division.index')
@section('subDivisionContent')
<div class="row">
    <div class="col-md-8">
        <div class="card-01 h-100">
            <p class="text-withlink">
                @if(request()->language=='en')
                {{$subDivision->introduction_en}}
                @else
                    {{$subDivision->introduction}}
                @endif

            </p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card-01 text-center">
            <img src="{{$subDivisionChief->photo ?? ''}}" height="100" width="100" class="rounded-circle mb-3">
            @if(request()->language=='en')
            <h5 class="mb-0">{{$subDivisionChief->name_en ?? ''}}</h5>
            <span class="small text-uppercase text-muted">{{$subDivisionChief->designation_en ?? ''}}</span> <br>
            @else
                <h5 class="mb-0">{{$subDivisionChief->name ?? ''}}</h5>
                <span class="small text-uppercase text-muted">{{$subDivisionChief->designation ?? ''}}</span> <br>
            @endif
            <span class="small text-muted">{{$subDivisionChief->phone ?? ''}}</span> <br>
            <span class="small text-muted">{{$subDivisionChief->email ?? ''}}</span>
        </div>
    </div>
    <div class="col-md-6 mt-4">
        <div class="card-01">
            <div style="width: 100%">
                <iframe scrolling="no" marginheight="0" marginwidth="0"
                        src="{{$subDivision->map}}"
                        width="100%" height="350" frameborder="0">
                </iframe>
            </div>
        </div>
    </div>
    <div class="col-md-6 mt-4">
        <div class="card-01">
            <iframe scrolling="no" marginheight="0px" marginwidth="0px" allowfullscreen=""
                    style="border: 0px #ffffff none;"
                    src="{{$subDivision->facebook}}"
                    width="100%" height="350px" frameborder="1">

            </iframe>
        </div>
    </div>
</div>
@endsection
