@extends('layouts.master')
@section('css')
@toastr_css
@section('title')
{{ __('university.classroom') }}
@stop
@endsection
@section('page-header')
@section('PageTitle')
{{ __('university.classroom') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- breadcrumb -->
<!-- row -->
<div class="row">
    @if ($errors->any())
    <div class="error">{{ $errors->first('Name') }}</div>
@endif

    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @role('admin')
            <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                {{ __('university.add_classroom')}}
            </button>
            @endrole
            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('classroom.name') }}</th>
                            <th>{{ __('classroom.name_college') }}</th>
                            @role('admin')
                            <th>{{ __('classroom.Processes') }}</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($details))

                        <?php $classrooms = $details; ?>
                    @else

                        <?php $classrooms = $classrooms; ?>
                    @endif
                        <?php $i = 0; ?>
                        @foreach ($classrooms as $classroom)


                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{__('classroom.'.$classroom->name)}}</td>
                                <td>{{ $classroom->colleges->name }}</td>

                                @role('admin')
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $classroom->id }}"
                                        title="edit"><i class="fa fa-edit"></i></button>

                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $classroom->id }}" title="Delete">
                                        <i class="fa fa-trash"></i></button>
                                    
                                </td>
                                @endrole
                            </tr>


                            <!-- edit_modal_Grade -->
                            <div class="modal fade" id="edit{{ $classroom->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                Edit classrooms
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <!-- update_form -->
                                            <form action="{{ route('classroom.update',$classroom->id) }}" method="post">
                                            @method('patch')
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="name" class="mr-sm-2">Name
                                                            :</label>
                                                        <input id="name" type="text" name="name" class="form-control"
                                                         value="{{ $classroom->name}}">
                                                    </div>
                                                    
                                                    <div class="box">
                                                        <select name="college_id" class="fancyselect">
                                                            <option value="{{ $classroom->colleges->id }}">
                                                                {{ $classroom->colleges->name }}</option>
                                                                @foreach ($colleges as $college )
                                                                    <option value="{{ $college->id }}">
                                                                        {{ $college->name }}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <br><br>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit"
                                                        class="btn btn-success">Submit</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- delete_modal_Grade -->
                            <div class="modal fade" id="delete{{ $classroom->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{__('general.delete')}} {{__('classroom.classt')}}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                        <!-- Delete_form -->
                                        <form action="{{ route('classroom.destroy', $classroom->id) }}"
                                            method="post">
                                          @method('Delete')
                                          @csrf
                                          <div class="row">
                                            <div class="col">
                                                <label for="Name" class="mr-sm-2">{{__('general.name')}}: {{$classroom->name}}</label>
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                 value="{{ $classroom->id }}">
                                            </div>

                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary"
                                                      data-dismiss="modal">{{__('general.close')}}</button>
                                              <button type="submit"
                                                      class="btn btn-success">{{__('general.submit')}}</button>
                                          </div>
                                      </form>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ __('university.add_classroom')}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- add_form -->
                <form action="{{ route('classroom.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        
                            <div class="col ">
                               
                                <select class="fancyselect" id="name" name="name" required>
                                    <option value="" selected disabled>select classroom name...</option>
                                    @php
                                        $classrooms=["1","2","3","4", "5", "6"];
                                    @endphp
                                    @foreach ( $classrooms as $classroom)
                                        <option value="{{$classroom}}">{{__('classroom.'.$classroom)}}</option>
                                    @endforeach
                                </select>
                            </div>

                        
                            <div class="col">
                                
                                <select class="fancyselect" name="college_id" required>
                                    <option value="" selected disabled>select college name...</option>
                                    @foreach ($colleges as $college)
                                        <option value="{{ $college->id }}">{{$college->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>

                    <br><br>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{__('general.close')}}</button>
                <button type="submit" class="btn btn-success">{{__('general.submit')}}</button>
            </div>
            </form>
        </div>
        </div>
    </div>
</div>
</div>
<!-- row closed -->
@endsection
@section('js')
{{-- @toastr_js --}}
{{-- @toastr_render --}}

<script type="text/javascript">
    $(function() {
        $("#btn_delete_all").click(function() {
            var selected = new Array();
            $("#datatable input[type=checkbox]:checked").each(function() {
                selected.push(this.value);
            });

            if (selected.length > 0) {
                $('#delete_all').modal('show')
                $('input[id="delete_all_id"]').val(selected);
            }
        });
    });

</script>




@endsection
