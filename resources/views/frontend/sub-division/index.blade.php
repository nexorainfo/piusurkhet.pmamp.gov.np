@extends('layouts.master')
@section('content')
    <div class="container-fluid mt-2">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('welcome')}}"><i class="fa fa-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page"> {{__('Sub Division')}} </li>
            </ol>
        </nav>
    </div>
    <div class="text-center text-red">
        <h4>
            @if(request()->language=='en')
            {{$subDivision->title_en}}
            @else
                {{$subDivision->title}}
            @endif
        </h4>
        <h6><i class="fa fa-phone"></i> {{$subDivision->phone}}</h6>
        <h6><i class="fa fa-envelope"></i> {{$subDivision->email}}</h6>
      </div>
@include('frontend.sub-division.menu')
    <section class="detail-section mt-2">
    <div class="container-fluid">
        @yield('subDivisionContent')
    </div>
    </section>
@endsection
