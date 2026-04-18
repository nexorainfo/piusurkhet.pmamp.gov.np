@extends('frontend.sub-division.index')
@section('subDivisionContent')
<div class="container-fluid mt-2">
    <div class="well-heading" style="border-left: 10px solid #b31b1b; position: relative;">
        <i class="fa fa-users"></i> {{__('Employee details')}}<h6 class="content_title">  <span class="pull-right"></span>
        </h6>
    </div>
    <div class="col-md-12" id="team_card">
        <div class="card-container">
            <img class="rounded" src="{{$subDivisionChief->photo ?? ''}}" height="120" width="120"
                 alt="{{$subDivisionChief->name ?? ''}}">
            @if(request()->language=='en')
            <p>{{$subDivisionChief->name_en ?? ''}}<br>
                {{$subDivisionChief->designation_en ?? ''}}<br>
                {{$subDivisionChief->phone ?? ''}}<br>
                {{$subDivisionChief->email ?? ''}}
            </p>
            @else
                <p>{{$subDivisionChief->name_en ?? ''}}<br>
                    {{$subDivisionChief->designation_en ?? ''}}<br>
                    {{$subDivisionChief->phone ?? ''}}<br>
                    {{$subDivisionChief->email ?? ''}}
                </p>
            @endif
        </div>
    </div>
    <div class="row">
        @foreach($subDivision->subDivisionEmployee as $employee)
        <div class="col-md-3">
            <div class="card-container">
                <img class="rounded" src="{{$employee->photo}}" height="120" width="120"
                     alt="{{$employee->name}}">
                @if(request()->language=='en')
                <p>{{$employee->name_en}}<br>
                    {{$employee->designation_en}}<br>
                    {{$employee->phone}}<br>
                    {{$employee->email}}
                </p>
                @else
                    <p>{{$employee->name}}<br>
                        {{$employee->designation}}<br>
                        {{$employee->phone}}<br>
                        {{$employee->email}}
                    </p>
                @endif
            </div>
        </div>
        @endforeach
</div>
@endsection
