@extends('layouts.app')
@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>बिल सार्बजनिकरण अपडेट गर्नुहोस</h2>
                </div>
            </div>
            <!-- end col -->
            <div class="col-md-6">
                <div class="breadcrumb-wrapper mb-30">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.dashboard')}}">ड्यासबोर्ड</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.bill.index')}}">
                                    बिल सार्बजनिकरण लिस्ट
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                बिल सार्बजनिकरण अपडेट गर्नुहोस
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <div class="card-style mb-30">
        <form action="{{route('admin.bill.update',$bill)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-md-6">
                    <div class="input-style-1">
                        <label for="budget_no">बजेट नं.</label>
                        <input type="text" id="budget_no" name="budget_no"
                               placeholder="बजेट नं." value="{{old('budget_no',$bill->budget_no)}}">
                        @error('budget_no')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-style-1">
                        <label for="expense_head">खर्च शिर्षक</label>
                        <input type="text" id="expense_head" name="expense_head"
                               placeholder="खर्च शिर्षक" value="{{old('expense_head',$bill->expense_head)}}">
                        @error('expense_head')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                @if(config('default.dual_language'))
                    <div class="col-md-6">
                        <div class="input-style-1">
                            <label for="expense_head_en">खर्च शिर्षक (English)</label>
                            <input type="text" id="expense_head_en" name="expense_head_en"
                                   placeholder="खर्च शिर्षक English" value="{{old('expense_head_en',$bill->expense_head_en)}}">
                            @error('expense_head_en')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                @endif
                <div class="col-md-6">
                    <div class="input-style-1">
                        <label for="buying_process">खरिद प्रक्रिया</label>
                        <input type="text" id="buying_process" name="buying_process" placeholder="खरिद प्रक्रिया" value="{{old('buying_process',$bill->buying_process)}}">
                        @error('buying_process')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                @if(config('default.dual_language'))
                    <div class="col-md-6">
                        <div class="input-style-1">
                            <label for="buying_process_en">खरिद प्रक्रिया(English)</label>
                            <input type="text" id="buying_process_en" name="buying_process_en" placeholder="खरिद प्रक्रिया English" value="{{old('buying_process_en',$bill->buying_process_en)}}">
                            @error('buying_process_en')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                @endif
                <div class="col-md-6">
                    <div class="input-style-1">
                        <label for="pan_no">पान न.</label>
                        <input type="text" id="pan_no" name="pan_no" placeholder="पान न." value="{{old('pan_no',$bill->pan_no)}}">
                        @error('pan_no')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-style-1">
                        <label for="bill_photo">बिल फोटो</label>
                        <input type="file" id="bill_photo" name="bill_photo">
                        @error('bill_photo')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-style-1">
                        <label for="bill_date">बिल मिति</label>
                        <input type="text" id="bill_date" value="{{old('bill_date',$bill->bill_date->toDateString())}}" name="bill_date" class="nepali-date" placeholder="बिल मिति">
                        @error('bill_date')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-style-1">
                        <label for="receipt_date">रसिद मिति</label>
                        <input type="text" id="receipt_date" value="{{old('receipt_date',$bill->receipt_date->toDateString())}}" name="receipt_date" class="nepali-date" placeholder="रसिद मिति">
                        @error('receipt_date')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-style-1">
                        <label for="amount">रकम</label>
                        <input type="number" id="amount" value="{{old('amount',$bill->amount)}}" name="amount" placeholder="रकम">
                        @error('amount')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-style-1">
                        <label for="remarks">कैफियत</label>
                        <input type="text" id="remarks" name="remarks" value="{{old('remarks',$bill->remarks)}}" placeholder="कैफियत">
                        @error('remarks')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                @if(config('default.dual_language'))
                    <div class="col-md-6">
                        <div class="input-style-1">
                            <label for="remarks_en">कैफियत (English)</label>
                            <input type="text" id="remarks_en" name="remarks_en" value="{{old('remarks_en',$bill->remarks_en)}}" placeholder="कैफियत English">
                            @error('remarks_en')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                @endif
                <div class="col-md-12">
                    <div class="input-style-1">
                        <label for="description">विवरण</label>
                        <textarea name="description" id="description" cols="30" rows="4" placeholder="विवरण">{{$bill->description}}</textarea>
                        @error('description')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                @if(config('default.dual_language'))
                    <div class="col-md-12">
                        <div class="input-style-1">
                            <label for="description_en">विवरण (English)</label>
                            <textarea name="description_en" id="description_en" cols="30" rows="4" placeholder="विवरण English">{{old('description_en',$bill->description_en)}}</textarea>
                            @error('description_en')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                @endif
                <div class="col-md-12">
                    <button type="submit" class="btn btn-sm btn-primary">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
    @push('script')
        <!-- Nepali Date Picker Js -->
        <script src="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v3.7.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(".nepali-date").nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10
            })
        </script>
    @endpush

@endsection
