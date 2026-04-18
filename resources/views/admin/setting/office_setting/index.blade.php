@extends('layouts.app')
@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>कार्यालय सेटिंग</h2>
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
                                कार्यालय सेटिंग
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
        <form action="{{route('admin.officeSetting.update',$officeSetting)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-md-6">
                    <div class="input-style-1">
                        <label for="office_name">कार्यालयको नाम *</label>
                        <input type="text" id="office_name" name="office_name"
                               placeholder="कार्यालयको नाम" value="{{old('office_name',$officeSetting->office_name)}}">
                        @error('office_name')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                @if(config('default.dual_language'))
                    <div class="col-md-6">
                        <div class="input-style-1">
                            <label for="office_name_en">कार्यालयको नाम * English</label>
                            <input type="text" id="office_name_en" name="office_name_en"
                                   placeholder="कार्यालयको नाम English" value="{{old('office_name_en',$officeSetting->office_name_en)}}">
                            @error('office_name_en')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                @endif
                <div class="col-md-6">
                    <div class="input-style-1">
                        <label for="office_address">कार्यालय ठेगाना *</label>
                        <input type="text" id="office_address" name="office_address"
                               placeholder="कार्यालय ठेगाना" value="{{old('office_address',$officeSetting->office_address)}}">
                        @error('office_address')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                @if(config('default.dual_language'))
                    <div class="col-md-6">
                        <div class="input-style-1">
                            <label for="office_address_en">कार्यालय ठेगाना *English</label>
                            <input type="text" id="office_address_en" name="office_address_en"
                                   placeholder="कार्यालय ठेगाना English" value="{{old('office_address_en',$officeSetting->office_address_en)}}">
                            @error('office_address_en')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                @endif
                <div class="col-md-6">
                    <div class="input-style-1">
                        <label for="office_phone">फोन नं. *</label>
                        <input type="text" id="office_phone" name="office_phone"
                               placeholder="फोन नं." value="{{old('office_phone',$officeSetting->office_phone)}}">
                        @error('office_phone')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-style-1">
                        <label for="office_email">इमेल</label>
                        <input type="text" id="office_email" name="office_email"
                               placeholder="इमेल" value="{{old('office_email',$officeSetting->office_email)}}">
                        @error('office_email')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-style-1">
                        <label for="cover_photo">Cover Photo</label>
                        <span>
                            <img src="{{asset('storage/'.$officeSetting->cover_photo)}}" width="90" alt="Cover Photo">
                        </span>
                        <input type="file" id="cover_photo" name="cover_photo">
                        @error('cover_photo')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-style-1">
                        <label for="en_header">Logo 1</label>
                        <span>
                            <img src="{{asset('storage/'.$officeSetting->en_header)}}" width="90" alt="Logo1">
                        </span>
                        <input type="file" id="en_header" name="en_header">
                        @error('en_header')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-style-1">
                        <label for="ne_header">logo 2</label>
                        <span>
                            <img src="{{asset('storage/'.$officeSetting->ne_header)}}" width="90" alt="Logo2">
                        </span>
                        <input type="file" id="ne_header" name="ne_header">
                        @error('ne_header')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-style-1">
                        <label for="background_img">Background Image</label>
                        <span>
                            <img src="{{asset('storage/'.$officeSetting->background_img)}}" width="90" alt="backgroundImg">
                        </span>
                        <input type="file" id="background_img" name="background_img">
                        @error('background_img')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-style-1">
                        <label for="chief_id">कार्यालय प्रमुख</label>
                        <select name="chief_id" id="chief_id" class="form-control">
                            <option value="">- - छान्नुहोस् - -</option>
                            @foreach($employees as $employee)
                                <option value="{{$employee->id}}" {{$officeSetting->chief_id==$employee->id ? 'selected' : ''}}>{{$employee->name}}</option>
                            @endforeach
                        </select>
                        @error('chief_id')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-style-1">
                        <label for="information_officer_id">सूचना अधिकारी</label>
                        <select name="information_officer_id" id="information_officer_id" class="form-control">
                            <option value="">- - छान्नुहोस् - -</option>
                            @foreach($employees as $employee)
                                <option value="{{$employee->id}}" {{$officeSetting->information_officer_id==$employee->id ? 'selected' : ''}}>{{$employee->name}}</option>
                            @endforeach
                        </select>
                        @error('information_officer_id')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-style-1">
                        <label for="grivance_officer_id">गुनासो सुने अधिकारी</label>
                        <select name="grivance_officer_id" id="grivance_officer_id" class="form-control">
                            <option value="">- - छान्नुहोस् - -</option>
                            @foreach($employees as $employee)
                                <option value="{{$employee->id}}" {{$officeSetting->grivance_officer_id==$employee->id ? 'selected' : ''}}>{{$employee->name}}</option>
                            @endforeach
                        </select>
                        @error('siemens_officer_id')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>

            
                <div class="col-md-4">
                    <div class="input-style-1">
                        <label for="document_list_type">कागजात सूची प्रकार</label>
                        <select name="document_list_type" id="document_list_type" class="form-control">
                            <option value="card" {{$officeSetting->document_list_type=="card" ? 'selected' : ''}}>Card</option>
                            <option value="list" {{$officeSetting->document_list_type=="list" ? 'selected' : ''}}>List</option>
                        </select>
                        @error('information_officer_id')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="input-style-1">
                        <label for="map_iframe">Map Url</label>
                        <textarea name="map_iframe" id="map_iframe" cols="30" rows="4" placeholder="Map Url">{{$officeSetting->map_iframe}}</textarea>
                        @error('map_iframe')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="input-style-1">
                        <label for="facebook_iframe">Facebook Url</label>
                        <textarea name="facebook_iframe" id="facebook_iframe" cols="30" rows="4" placeholder="Facebook Url">{{$officeSetting->facebook_iframe}}</textarea>
                        @error('facebook_iframe')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="input-style-1">
                        <label for="twitter_iframe">Twitter Url</label>
                        <textarea name="twitter_iframe" id="twitter_iframe" cols="30" rows="4" placeholder="Twitter Url">{{$officeSetting->twitter_iframe}}</textarea>
                        @error('twitter_iframe')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-sm btn-primary">
                        Submit
                    </button>
                </div>

            </div>
        </form>
        @livewire('office-setting-header')
        <div class="row">
            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <h6 class="mb-10">
                        Office Header
                    </h6>

                    <div class="table-wrapper table-responsive table-hover">
                        <table class="table">
                            <thead>
                            <tr>
                                <th><h6>#</h6></th>
                                <th><h6>English</h6></th>
                                <th><h6>Nepali</h6></th>
                                <th><h6>Position</h6></th>
                                <th><h6>Action</h6></th>
                            </tr>
                            <!-- end table row-->
                            </thead>
                            <tbody>

                            @foreach($officeSettingHeaders as $officeSettingHeader)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td class="min-width">
                                    <p>{{$officeSettingHeader->english}}</p>
                                </td>
                                <td class="min-width">
                                    <p>{{$officeSettingHeader->nepali}}</p>
                                </td>
                                <td class="min-width">
                                    <p>{{$officeSettingHeader->position}}</p>
                                </td>
                                <td>
                                    <div class="action">
                                        <a href="{{route('admin.officeSettingHeader.edit',$officeSettingHeader)}}"
                                           class="text-info">
                                            <i class="lni lni-pencil"></i>
                                        </a>
                                        <form
                                            action="{{route('admin.officeSettingHeader.destroy',$officeSettingHeader)}}"
                                            method="POST">

                                            @csrf
                                            @method('delete')
                                            <button class="text-danger show_confirm" type="submit">
                                                <i class="lni lni-trash-can"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- end table -->
                    </div>
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
    </div>

@endsection
