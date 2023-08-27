@extends('layouts.master')
@section('css')
@section('title')

طلاب المادة
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    مواد الطالب {{$student->name}} _ {{$student->college->name}}
    <br>
    {{__('classroom.'.$student->classroom->name)}} _ {{$student->section->name}}
    
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
        <div class="col">
        
        </div>
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                   <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{__('student.name')}}</th>
                                            <th>{{__('general.level')}}</th>
                                            <th>{{"الدرجة"}}</th>
                                            <th>{{"النتيجة"}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; ?>
                                        @foreach($student->subjects as $subject)
                                            <tr>
                                            
                                            <td>{{ $i++ }}</td>
                                            <td>{{$subject->name}}</td>
                                            <td>{{__('classroom.'.$subject->classroom->name)}}</td>
                                            @if ($subject->pivot->mark<60)
                                            <td class="bg-danger text-white">{{$subject->pivot->mark}}</td>
                                            <td class="bg-danger text-white">راسب</td>
                                            @else
                                            <td class="bg-success text-white">{{$subject->pivot->mark}}</td>
                                            <td class="bg-success text-white">ناجح</td>
                                            @endif
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
