@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    طلاب السكن الجامعي
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
طلاب السكن الجامعي
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
                                            <th>{{ __('dorm.unit_name') }}</th>
                                            <th>{{ __('dorm.room_number') }}</th>
                                            <th>{{ __('dorm.city') }}</th>
                                            @role('admin') <th>{{ __('general.actions') }}</th> @endrole
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0; ?>

                                      
                                        @foreach ($dorm_students as $student)

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
                                            <td>{{$student->unit_name}}</td>
                                            <td>{{$student->room_number}}</td>
                                            <td>{{$student->city}}</td>
                                            @role('admin')
                                                <td>
                                                    
                                                    <a href="{{route('dorm.show',$student->id)}}" class="btn btn-success btn-sm" role="button" aria-pressed="true" title="Show"><i class="fa fa-regular fa-eye-slash"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_student{{ $student->id }}" title="Delete"><i class="fa fa-trash"></i></button>
                                                </td>
                                            @endrole
                                            </tr>

                                            <div class="modal fade" id="delete_student{{$student->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{route('dorm.destroy',$student->id)}}" method="post">
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
                                                            <input type="hidden" name="id"  value="{{$student->id}}">
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
