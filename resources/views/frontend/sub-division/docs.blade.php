@extends('frontend.sub-division.index')
@section('subDivisionContent')
    <div class="container-fluid mt-2">
        <div class="well-heading" style="border-left: 10px solid #b31b1b; position: relative;background-color: {{$colors->nav}};">
            <i class="fa fa-newspaper-o"></i> {{__('Notice / Publications')}}
        </div>
        <div class="table-responsive mt-2">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>{{__('S.N')}}</th>
                    <th>{{__('Title')}}</th>
                    <th>{{__('Category')}}</th>
                    <th>{{__('Published Date')}}</th>
                    <th>{{__('Publisher')}}:</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($subDivision->subDivisionDocuments as $document)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        @if(request()->language=='en')
                            <td>{{$document->title_en}}</td>
                            <td>{{$document->subDivisionDocumentCategory->title_en ?? ''}}</td>
                            <td>{{$document->date}}</td>
                            <td>{{$document->publisher_en}}</td>
                        @else
                        <td>{{$document->title}}</td>
                        <td>{{$document->subDivisionDocumentCategory->title ?? ''}}</td>
                        <td>{{$document->date}}</td>
                        <td>{{$document->publisher}}</td>
                        @endif
                        <td>
                            <a href="{{route('subDivision.documentDetail',[$subDivision->slug,$document,'language'=>$language])}}"
                               class="btn btn-sm btn-info">
                                <i class="fa fa-eye"></i> {{__('View Details')}}
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
