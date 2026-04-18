@extends('layouts.app')
@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>बिल सार्बजनिकरण</h2>
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
                                बिल सार्बजनिकरण
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
                    <h6 class="mb-10">बिल सार्बजनिकरण</h6>
                    <a href="{{route('admin.bill.create')}}" class="btn btn-sm btn-primary">Add New</a>
                </div>
                <div class=" table-responsive table-hover">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>बजेट नं.</th>
                            <th>खर्च शिर्षक</th>
                            <th>खरिद प्रक्रिया</th>
                            <th>पान न.</th>
                            <th>बिल फोटो</th>
                            <th>बिल मिति</th>
                            <th>रसिद मिति</th>
                            <th>रकम</th>
                            <th>विवरण</th>
                            <th>कैफियत</th>
                            <th>Action</th>
                        </tr>
                        <!-- end table row-->
                        </thead>
                        <tbody>
                        @forelse($bills as $bill)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td>{{$bill->budget_no}}</td>
                                <td>{{$bill->expense_head}}</td>
                                <td>{{$bill->buying_process}}</td>
                                <td>{{$bill->pan_no}}</td>
                                <td>
                                    <img src="{{asset('storage/'.$bill->bill_photo)}}" width="70" alt="Bill Photo">
                                </td>
                                <td>{{!empty($bill->bill_date) ? $bill->bill_date->toDateString() : ''}}</td>
                                <td>{{!empty($bill->receipt_date) ? $bill->receipt_date->toDateString() : ''}}</td>
                                <td>{{$bill->amount}}</td>
                                <td>{{$bill->description}}</td>
                                <td>{{$bill->remarks}}</td>
                                <td>
                                    <div class="action">
                                        <a href="{{route('admin.bill.edit', $bill)}}" class="text-info">
                                            <i class="lni lni-pencil"></i>
                                        </a>
                                        <form action="{{route('admin.bill.destroy',$bill)}}"
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
                                <td class="text-center" colspan="4">No Result Found</td>
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
