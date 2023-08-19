@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    تخرج الطلاب
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    تخرج الطلاب
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if (Session::has('error_Graduated'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{Session::get('error_Graduated')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                        <form action="{{route('Graduateds.store')}}" method="post">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">اسم الطالب </label>
                                <select class="custom-select mr-sm-2" id="student_id" name="student_id" required>
                                    <option selected disabled>اختر اسم الطالب ...</option>
                                    @if (isset($student))
                                        <option class="text-warning font-weight-bold" selected value="{{$student->id}}">{{$student->name}}</option>
                                    @endif
                                    @foreach($students as $stu)
                                        @if (isset($student)&&($student->id!=$stu->id))
                                            <option value="{{$stu->id}}">{{$stu->name}}</option> 
                                        
                                        @elseif(!isset($student))
                                            <option value="{{$stu->id}}">{{$stu->name}}</option> 
                                        @endif

                                    @endforeach
                                    
                                </select>
                                
                            </div>

                            <div class="form-group col">
                                <label for="Classroom_id"> {{__('general.college')}}: <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="college_id" required>
                                
                                    @if (isset($student))
                                    <option class="text-danger font-weight-bold"  selected value="{{$student->college->id}}">{{$student->college->name}}</option>
                                    @endif
                                </select>
                            </div>
                            
                            <div class="form-group col">
                                <label for="Classroom_id"> {{__('general.level')}}:<span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="classroom_id" required>
                                    @if (isset($student))
                                    <option class="text-danger font-weight-bold" selected value="{{$student->classroom->id}}">{{$student->classroom->name}}</option>
                                    @endif
                                </select>
                            </div>
                            
                            <div class="form-group col">
                                <label for="section_id">{{__('general.section')}}:</label>
                                <select class="custom-select mr-sm-2" name="section_id" required>
                                    @if (isset($student->secion))
                                    <option class="text-danger font-weight-bold" selected value="{{$student->section}}">{{$student->section->name}}</option>
                                    
                                    @else
                                    <option class="text-danger font-weight-bold" selected value="">____</option>

                                    @endif
                                </select>
                                
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary">تاكيد</button>
                    </form>

                </div>
            </div>
        </div>

    </div>
    <!-- row closed -->
@endsection
@section('js')

    @toastr_js
    @toastr_render

<script>
        document.getElementById('student_id').addEventListener('change', function() {
            var selectedStudentId = this.value;
            
            if (selectedStudentId) {
                window.location.href = '/Graduateds/create/' + selectedStudentId;
            }
        });
</script>
@endsection
