@extends('layouts.master')
@section('css')
@section('title')
{{ __('general.show').' '.__('general.Users') }}
@stop
@endsection
@section('page-header')
@section('PageTitle')
{{ __('general.show').' '.__('general.Users') }}
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
                {{ __('general.add').' '.__('general.user')}}
            </button>
            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('general.name').' '.__('general.User') }}</th>
                            <th>{{__('general.email')}}</th>
                            <th>{{__('general.role')}}</th>
                            <th>{{__('general.actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($users as $user)

                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{$user->name }}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @foreach ($user->roles as $role)
                                    @php
                                        $user_role=$role->name;
                                    @endphp
                                    {{__('general.'. $role->name) }}
                                    @endforeach
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $user->id }}"
                                        title="edit"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $user->id }}" title="Delete"><i class="fa fa-trash"></i></button>
                                        
                                    @if (($user_role=='teacher')&&(!$user->teacher))
                                        <a class="btn btn-outline-success btn-sm" href="{{route('teacher_create',["user_id"=>$user->id])}}">
                                             Add This Teacher</a>
                                    @elseif (($user_role=='teacher')&&($user->teacher))
                                        <a class="btn btn-outline-secondary btn-sm" href="{{route('teacher.index')}}">
                                            Show Teachers</a>
                                     
                                    @elseif ($user_role=='student'&&(!$user->student))
                                        <a class="btn btn-outline-success btn-sm" href="{{route('student_create',["user_id"=>$user->id])}}">
                                        Add This Student</a>

                                    @elseif (($user_role=='student')&&($user->student))
                                        <a class="btn btn-outline-secondary btn-sm" href="{{route('student.show',$user->student->id)}}">
                                            Show This Student</a>
                                    @endif
                                     
                                </td>
                            </tr>


                            <!-- edit_modal_Grade -->
                            <div class="modal fade" id="edit{{ $user->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                Edit User
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- update_form -->
                                            <form action="{{ route('users.update',$user->id) }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="name" class="mr-sm-2"> {{ __('general.Name')}}
                                                                :</label>
                                                            <input id="name" type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                                                        </div>
                                                        <div class="col">
                                                            <label for="email" class="mr-sm-2">{{ __('general.email')}}
                                                                :</label>
                                                            <input id="email" type="email" name="email" class="form-control" value="{{ $user->email }}" required> 
                                                        </div>
                                                    </div>
                                
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="password" class="mr-sm-2"> {{ __('general.password')}}
                                                                :</label>
                                                            <input id="password" type="password" name="password" class="form-control" required>
                                                        </div>
                                                        <div class="col">
                                                            <label for="password_confirmation" class="mr-sm-2">{{ __('general.confirm_password')}}
                                                                :</label>
                                                            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row box justify-content-center mt-2">
                                                        <select class="fancyselect" name="role" id="" required>
                                                            <option disabled selected value="">Select Role...</option>
                                                            <option value="admin">admin</option>
                                                            <option value="teacher">teacher</option>
                                                            <option value="student">student</option>
                                                        </select>
                                                    </div>
                                
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

                            <!-- delete_modal_Grade -->
                            {{-- message for submit delete --}}
                            <div class="modal fade" id="delete{{ $user->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                Delete User
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- delete_form -->
                                            <form action="{{ route('users.destroy',$user->id) }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="Name" class="mr-sm-2">Name: {{$user->name}}</label>
                                                        <input id="id" type="hidden" name="id"
                                                            class="form-control"
                                                            value="{{ $user->id}}">
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
                    {{ __('general.add').' '.__('general.user')}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <!-- add_form -->
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="name" class="mr-sm-2"> {{ __('general.Name')}}
                                :</label>
                            <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                        <div class="col">
                            <label for="email" class="mr-sm-2">{{ __('general.email')}}
                                :</label>
                            <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required> 
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="password" class="mr-sm-2"> {{ __('general.password')}}
                                :</label>
                            <input id="password" type="password" name="password" class="form-control" required>
                        </div>
                        <div class="col">
                            <label for="password_confirmation" class="mr-sm-2">{{ __('general.confirm_password')}}
                                :</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="row box justify-content-center mt-2">
                        <select class="fancyselect" name="role" id="" required>
                            <option disabled selected value="">Select Role...</option>
                            <option value="admin">admin</option>
                            <option value="teacher">teacher</option>
                            <option value="student">student</option>
                        </select>
                    </div>

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
