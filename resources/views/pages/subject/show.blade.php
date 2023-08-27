@extends('layouts.master')
@section('css')
@section('title')

طلاب المادة
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    طلاب مادة {{$subject->name}} _ {{$subject->college->name}}
    <br>
    {{__('classroom.'.$subject->classroom->name)}} _ {{$subject->section->name}}
    
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
                                            <th>{{__('general.email')}}</th>
                                            <th>{{__('general.level')}}</th>
                                            <th>{{__('general.gender')}}</th>
                                            <th>{{"الدرجة"}}</th>
                                            <th>{{"النتيجة"}}</th>
                                            @role('admin')<th>{{__('general.actions')}}</th>@endrole
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; ?>
                                        @foreach($subject->students as $student)
                                            <tr>
                                            
                                            <td>{{ $i++ }}</td>
                                            <td>{{$student->name}}</td>
                                            <td>{{$student->email}}</td>
                                            <td>{{__('classroom.'.$student->classroom->name)}}</td>
                                            <td>{{__('general.'.$student->gender)}}</td>
                                            @if ($student->pivot->mark<60)
                                            <td class="bg-danger text-white">{{$student->pivot->mark}}</td>
                                            <td class="bg-danger text-white">راسب</td>
                                            @else
                                            <td class="bg-success text-white">{{$student->pivot->mark}}</td>
                                            <td class="bg-success text-white">ناجح</td>
                                            @endif
                                            
                                            
                                                <td>
                                                    {{-- <a href="{{route('subject.edit',$teacher->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a> --}}
                                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit_mark{{ $student->id }}" title="edit"><i class="fa fa-edit"></i></button>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="edit_mark{{$student->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    
                                                    <form action="{{route('edit_mark')}}" method="post">
                                                        {{-- {{method_field('PUT')}} --}}
                                                        {{csrf_field()}}
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">Edit</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <label for="Name" class="mr-sm-2">Name: {{$student->name}}</label>
                                                            <input type="number" class="form-control" name="mark" value="{{$student->pivot->mark}}" min='0' max='100' required>
                                                            <input type="hidden" name="student_id"  value="{{$student->id}}">
                                                            <input type="hidden" name="subject_id"  value="{{$subject->id}}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                        class="btn btn-success">Submit</button>
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
