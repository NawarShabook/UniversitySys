@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    Add Teacher
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    Add Teacher
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">


                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{route('teacher.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                             @csrf
                            <div class='border p-2 bg-white'>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label for="title">user id</label>
                                        <input required readonly type="text" name="user_id" value="{{$user->id}}"  class="form-control">
                                    </div>
                                    <div class="col">
                                        <label for="title">user name</label>
                                        <input required readonly type="text" name="" value="{{$user->name}}"  class="form-control">
                                    </div>
                                    <div class="col">
                                        <label for="title">{{__('general.email')}}</label>
                                        <input required readonly type="email" name="email" value="{{$user->email}}" class="form-control">
                                        @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    
                                </div>
                                <br>


                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{__('general.name_ar')}}</label>
                                        <input type="text" name="name" class="form-control" required>
                                        @error('name_ar')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="title">{{__('general.name_en')}}</label>
                                        <input type="text" name="name_en" class="form-control" required>
                                        @error('name_en')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="inputCity">{{__('general.college')}}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="college_id" required>
                                            <option value=""  selected >{{__('general.choose').' '.__('general.college')}}</option>
                                            @foreach ($colleges as $college )
                                            <option value="{{ $college->id }}">
                                                {{ $college->name }}</option>
                                        @endforeach
                                        </select>
                                        @error('college_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col">
                                        <label for="inputCity">{{__('teacher.edu_level')}}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="level" required>
                                            <option value=""  selected >{{__('general.choose').' '.__('teacher.edu_level')}}</option>
                                            
                                            <option value="bachelor">{{ __('teacher.bachelor') }}</option>
                                            <option value="master">{{ __('teacher.master') }}</option>
                                            <option value="doctor">{{ __('teacher.doctor') }}</option>
                                
                                        </select>
                                        @error('college_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    
                                    
                                    <div class="form-group col">
                                        <label for="inputState">{{__('general.gender')}}</label>
                                        <select class="custom-select my-1 mr-md-2" name="gender" required>
                                            <option value="" selected>{{__('general.choose').' '.__('general.gender')}}</option>
                                            <option value="male" >{{__('general.male')}}</option>
                                            <option value="female">{{__('general.female')}}</option>
                                        </select>
                                        
                                    </div>
                                    <div class="form-group col">
                                        <label for="inputState">{{__('general.birthday')}}</label> <br>
                                        <input type="date" name="birthday" id="" class="form-control bg-white border p-2 mt-1" required>
                                        
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center pt-3 pb-3 border mt-2">
                                    <input type="submit" value="{{__('general.submit')}}" class="btn btn-success btn-lg" />
                                    <input type="reset" value="{{__('general.reset')}}" class="btn btn-danger btn-lg" />
                                </div>
                                
                
                            </div>
                            </form>
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
