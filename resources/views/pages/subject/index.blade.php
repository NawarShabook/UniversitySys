@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    Show Subjects
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
Show Subjects
<br>
@if (isset($for_type) && count($subjects)>0)
    @if ($for_type=="college_id")
        <a class="text-warning" href="{{route('get_subjects_for',["for_type"=>"college_id" , "id"=>$subjects->first()->college->id])}}">{{$subjects->first()->college->name}}</a>
                                
    @elseif($for_type=="classroom_id")
        <a class="text-warning" href="{{route('get_subjects_for',["for_type"=>"college_id" , "id"=>$subjects->first()->college->id])}}">{{$subjects->first()->college->name}}</a>
        <a class="text-primary" href="{{route('get_subjects_for',["for_type"=>"classroom_id" , "id"=>$subjects->first()->classroom->id])}}"> _{{$subjects->first()->classroom->name}}</a>
                                
    @elseif($for_type=="section_id")
        <a class="text-warning" href="{{route('get_subjects_for',["for_type"=>"college_id" , "id"=>$subjects->first()->college->id])}}">{{$subjects->first()->college->name}}</a>
        <a class="text-primary" href="{{route('get_subjects_for',["for_type"=>"classroom_id" , "id"=>$subjects->first()->classroom->id])}}"> _{{$subjects->first()->classroom->name}}</a>
        <a class="text-success" href="{{route('get_subjects_for',["for_type"=>"section_id" , "id"=>$subjects->first()->section->id])}}">_{{$subjects->first()->section->name}}</a>
                                
    @endif
                                 
@endif

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
                                @role('admin')
                                <a href="{{route('subject.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">Add subject</a><br><br>
                                @endrole
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                            
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('subject.subject') }}</th>
                                            <th>{{ __('general.college') }}</th>
                                            <th>{{ __('general.level') }}</th>
                                            <th>{{ __('general.section') }}</th>
                                            <th>{{ __('general.teacher') }}</th>
                                            <th>{{ __('college.note') }}</th>
                                            @role('student')
                                            @else
                                            <th>{{ __('general.actions') }}</th>
                                            @endrole
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; ?>

                                      
                                        @foreach ($subjects as  $subject)

                                            <tr>
                                            
                                            <td>{{ $i++ }}</td>
                                            <th>{{$subject->name}}</th>
                                            <td>{{$subject->college->name}}</td>
                                            <td>{{__('classroom.'.$subject->classroom->name)}}</td>
                                            <td>{{$subject->section->name}}</td>
                                            <td>
                                                @if ($subject->teacher)
                                                {{$subject->teacher->name}}
                                                @else
                                                ______
                                                @endif
                                            </td>
                                            <td>
                                                @if ($subject->note)
                                                {{$subject->note}}
                                                @else
                                                ______
                                                @endif
                                            
                                           
                                            </td>
                                            <td>
                                                @role('admin')
                                                    <a href="{{route('subject.edit',$subject->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="Edit"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_student{{ $subject->id }}" title="Delete"><i class="fa fa-trash"></i></button>
                                                @endrole
                                                @role('student')
                                                @else
                                                    <a class="btn btn-outline-secondary btn-sm" href="{{route('subject.show', $subject->id)}}">Show students</a>
                                                @endrole
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="delete_student{{$subject->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{route('subject.destroy',$subject->id)}}" method="post">
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
                                                            <input type="hidden" name="id"  value="{{$subject->id}}">
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
