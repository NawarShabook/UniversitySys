@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    Add Student
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    Add Student
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
                            <form action="{{route('student.store')}}" method="post" autocomplete="off" enctype="multipart/form-data" >
                             @csrf
                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{__('general.email')}}</label>
                                    <input required type="email" name="email" class="form-control">
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{__('general.password')}}</label>
                                    <input required type="password" name="password" class="form-control">
                                    @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>


                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{__('general.name_ar')}}</label>
                                    <input required type="text" name="name" class="form-control">
                                    @error('name_ar')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{__('general.name_en')}}</label>
                                    <input required type="text" name="name_en" class="form-control">
                                    @error('name_en')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputState">{{__('general.birthday')}}</label> <br>
                                        <input required class="form-control" type="date"  id="datepicker-action" name="birthday" data-date-format="yyyy-mm-dd">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="inputCity">{{__('general.college')}}</label>
                                    <select  class="custom-select my-1 mr-sm-2" name="college_id" required>
                                        <option value="" selected >اختر الكلية</option>
                                        @foreach($colleges as $college)
                                            <option value="{{$college->id}}">{{$college->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('college_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <label for="inputCity">{{__('general.level')}}</label>
                                    <select  class="custom-select my-1 mr-sm-2" name="classroom_id" required>
                                        <option value="" selected >اختر الفرقة الدراسية</option>
                                       
                                    </select>
                                    @error('classroom_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <label for="inputCity">{{__('general.section')}}</label>
                                    <select  class="custom-select my-1 mr-sm-2" name="section_id" required>
                                        <option value="" selected >اختر  قسم الكلية</option>
                                        
                                    </select>
                                    @error('section_id')
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
                                    @error('gender_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="academic_year">academic_year : </label>
                                        <select  class="custom-select mr-sm-2" name="academic_year" required>
                                            <option selected disabled>academic_year...</option>
                                            @php
                                                $current_year = date("Y");
                                            @endphp
                                            @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                                <option value="{{ $year}}">{{ $year }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="student">Upload Image : </label>
                                    <input required type="file" accept="image/*" name="photos[]" multiple>
                                </div>
                            </div>


                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">Next</button>
                    </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
