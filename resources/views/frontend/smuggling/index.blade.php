@extends('layouts.master')
@section('content')

    <div class="container-fluid mt-2">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('welcome')}}"><i class="fa fa-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page"> तस्करी </li>
            </ol>
        </nav>
    </div>
    <div class="container-fluid mt-2">
        <div class="row mt-3">
            @foreach($smugglings as $smuggling)
            <div class="col-md-4">
                <div class="card">
                    <img src="{{asset('storage/'.$smuggling->files->first()->url)}}" class="card-img-top img-fluid" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$smuggling->title}}</h5>
                        <p class="card-text">{{\Illuminate\Support\Str::words($smuggling->description,60,"...")}}</p>
                    </div>
                    <div class="card-body">
                        <a href="{{route('smugglingDetail',$smuggling)}}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
