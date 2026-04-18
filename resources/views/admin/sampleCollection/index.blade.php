@extends('layouts.app')
@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>नमुना संकलनहरु</h2>
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
                                नमुना संकलनहरु
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
                    <h6 class="mb-10">नमुना संकलनहरु</h6>
                </div>
                <div class="table-responsive table-hover">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="mx-1">SN</th>
                            <th>पुरा नाम</th>
                            <th>फोन नं</th>
                            <th>ठेगाना</th>
                            <th>Show on Index</th>
                            <th>Action</th>
                        </tr>
                        <!-- end table row-->
                        </thead>
                        <tbody>
                        @forelse($sampleCollections as $sampleCollection)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td>{{$sampleCollection->full_name}}</td>
                                <td>{{$sampleCollection->phone}}</td>
                                <td>{{$sampleCollection->address}}</td>
                                <td>
                                    <a href="{{route('admin.sampleCollection.showOnIndex',$sampleCollection)}}">
                                        @if($sampleCollection->show_on_index==1)
                                            <i class="mdi mdi-check mdi-24px text-success"></i>
                                        @else
                                            <i class="mdi mdi-window-close mdi-24px text-danger"></i>
                                        @endif

                                    </a>
                                </td>
                                <td>
                                    <div class="action">
                                        <a href="{{route('admin.sampleCollection.show', $sampleCollection)}}" class="text-success mx-2">
                                            <i class="lni lni-eye"></i>
                                        </a>
                                        <form action="{{route('admin.sampleCollection.destroy',$sampleCollection)}}"
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
                                <td class="text-center" colspan="6">No Any Messages</td>
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
