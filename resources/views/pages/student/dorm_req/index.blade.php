@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    طلبات التسجيل على السكن الجامعي
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
طلبات التسجيل على السكن الجامعي
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <a href="{{route('student.index')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">إضافة طالب إلى السكن</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                            
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('student.name_student_ar') }}</th>
                                            <th>{{ __('student.name_student_en') }}</th>
                                            <th>{{ __('general.email') }}</th>
                                            <th>{{ __('general.college') }}</th>
                                            <th>{{ __('general.level') }}</th>
                                            <th>{{ __('general.section') }}</th>
                                            <th>{{ __('general.gender') }}</th>
                                            <th>{{ __('dorm.city') }}</th>
                                            <th>{{ 'حالة الطلب' }}</th>
                                           <th>{{ __('general.actions') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0; ?>

                                      
                                        @foreach ($dorm_students_req as $student)

                                            <tr>
                                            @php
                                                $i++;
                                            @endphp
                                            
                                            <td>{{ $i }}</td>
                                            <th>{{$student->student->getTranslation('name','ar')}}</th>
                                            <th>{{$student->student->getTranslation('name','en')}}</th>
                                            <td>{{$student->student->email}}</td>
                                            <td>{{$student->student->college->name}}</td>
                                            <td>{{__('classroom.'.$student->student->classroom->name)}}</td>
                                            <td>{{$student->student->section->name}}</td>
                                            <td>{{__('general.'.$student->student->gender)}}</td>
                                            <td>{{$student->city}}</td>
                                            <?php $status=["0"=>"لم تتم المراجعة", "1"=>"تم قبول الطلب" , "2"=>"تم رفض الطلب"] ?>
                                            <td class="font-bold">{{$status[$student->status]}}
                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#show_note{{$student->id}}" title="show"><i class="fa fa-question-circle"></i></button>
                                            </td>

                                            
                                                <td>
                                                    @role('admin')
                                                    @if ($student->status!=1)
                                                        <a href="{{route('dorm_req.show',$student->id)}}" class="btn btn-success btn-sm" role="button" aria-pressed="true" title="Show"><i class="fa fa-regular fa-eye-slash"></i></a>
                                                    @endif
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_student{{ $student->id }}" title="Delete"><i class="fa fa-trash"></i></button>
                                                    @endrole
                                                    @role('student')
                                                    @if (auth()->user()->student->dorm_student_req->id == $student->id)
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_student{{ $student->id }}" title="Delete"><i class="fa fa-trash"></i></button>
                                                    @else
                                                        <button type="button" style="cursor:not-allowed;" class="btn btn-danger btn-sm disabled" title="Delete"><i class="fa fa-trash"></i></button>
                                                    @endif
                                                    @endrole
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="delete_student{{$student->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{route('dorm_req.destroy',$student->id)}}" method="post">
                                                        {{method_field('delete')}}
                                                        {{csrf_field()}}
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">Delete</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Worings</p>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                        class="btn btn-danger">Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>

                                            {{-- modal for show note --}}
                                            <div class="modal fade" id="show_note{{$student->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">Note</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                          
                                                            {{$student->note}}

                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                        class="btn btn-danger">Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
