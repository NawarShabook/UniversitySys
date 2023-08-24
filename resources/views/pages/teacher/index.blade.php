@extends('layouts.master')
@section('css')
@section('title')
@toastr_css
Teacher
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    Teacher
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
        <div class="col">
            {{-- <form method="GET" action="{{ route('teacher.index') }}">
                <div class="form-row align-items-center">
                    <div class="col">
                        <input type="search" name="search" class="form-control mb-2" id="inlineFormInput"
                            placeholder="البحث هنا Email">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary mb-2">Search</button>
                    </div>
                </div>
            </form> --}}
        </div>
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                @role('admin')
                                <a href="{{route('teacher.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{__('general.add').' '.__('teacher.teacher')}}</a><br><br>
                                @endrole
                                   <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{__('teacher.edu_level')}}</th>
                                            <th>{{__('general.name')}}</th>
                                            <th>{{__('general.email')}}</th>
                                            <th>{{__('general.college')}}</th>
                                            <th>{{__('general.gender')}}</th>
                                            @role('admin')<th>{{__('general.actions')}}</th>@endrole
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; ?>
                                        @foreach($teachers as $teacher)
                                            <tr>
                                            
                                            <td>{{ $i++ }}</td>
                                            <td>{{__('teacher.'.$teacher->level)}}</td>
                                            <td>{{$teacher->name}}</td>
                                            <td>{{$teacher->email}}</td>
                                            <td>{{$teacher->college->name}}</td>
                                            <td>{{__('general.'.$teacher->gender)}}</td>

                                            @role('admin')
                                                <td>
                                                    <a href="{{route('teacher.edit',$teacher->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_doctor{{ $teacher->id }}" title="Delete"><i class="fa fa-trash"></i></button>
                                                </td>
                                            @endrole
                                            </tr>

                                            <div class="modal fade" id="delete_doctor{{$teacher->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{route('teacher.destroy',$teacher->id)}}" method="post">
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
                                                            <label for="Name" class="mr-sm-2">Name: {{$teacher->name}}</label>
                                                            <input type="hidden" name="id"  value="{{$teacher->id}}">
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
