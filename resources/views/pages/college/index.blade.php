@extends('layouts.master')
@section('css')
@section('title')
{{ __('university.show_fac') }}
@stop
@endsection
@section('page-header')
@section('PageTitle')
{{ __('university.show_fac') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- breadcrumb -->
{{-- @toastr_css  --}}
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
            <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                {{ __('university.add_fac')}}
            </button>
            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('college.name_college_ar') }}</th>
                            <th>{{ __('college.name_college_en') }}</th>
                            <th>{{__('college.note')}}</th>
                            <th>{{__('college.Processes')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($colleges as $college)

                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{$college->getTranslation('name','ar') }}</td>
                                <td>{{$college->getTranslation('name','en') }}</td>
                                <td>{{ $college->note }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $college->id }}"
                                        title="edit"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $college->id }}" title="Delete"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>


                            <!-- edit_modal_Grade -->
                            <div class="modal fade" id="edit{{ $college->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                Edit college
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- update_form -->
                                            <form action="{{ route('college.update',$college->id) }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="Name"
                                                            class="mr-sm-2">Name
                                                            :</label>
                                                        <input id="name" type="text" name="name"
                                                            class="form-control"
                                                            value="{{ $college->getTranslation('name', 'ar') }}"
                                                            required>
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                            value="{{ $college->id }}">
                                                    </div>
                                                    <div class="col">
                                                        <label for="Name_en"
                                                            class="mr-sm-2">Name_En
                                                            :</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $college->getTranslation('name', 'en') }}"
                                                            name="name_en" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label
                                                        for="exampleFormControlTextarea1">Notes
                                                        :</label>
                                                    <textarea class="form-control" name="note"
                                                        id="exampleFormControlTextarea1"
                                                        rows="3">{{ $college->Notes }}</textarea>
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
                            {{-- message for submit delete --}}
                            <div class="modal fade" id="delete{{ $college->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                Delete college
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- delete_form -->
                                            <form action="{{ route('college.destroy',$college->id) }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="Name" class="mr-sm-2">Name: {{$college->name}}</label>
                                                        <input id="id" type="hidden" name="id"
                                                            class="form-control"
                                                            value="{{ $college->id}}">
                                                    </div>


                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit"
                                                        class="btn btn-success">Submit</button>
                                                </div>
                                            </form>
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
                    {{ __('university.add_fac')}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('college.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="name" class="mr-sm-2">Name
                                :</label>
                            <input id="name" type="text" name="name" class="form-control">
                        </div>
                        <div class="col">
                            <label for="name" class="mr-sm-2">Name_en
                                :</label>
                            <input id="name" type="text" name="name_en" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Note
                            :</label>
                        <textarea class="form-control" name="note" id="exampleFormControlTextarea1"
                            rows="3"></textarea>
                    </div>
                    <br><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success">Submit</button>
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

@endsection
