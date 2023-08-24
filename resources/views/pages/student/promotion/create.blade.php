@extends('layouts.master')
@section('css')
    
<style>
/* Dropdown Button */
 .dropbtn {
    background-color: #04AA6D;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
  }
  
  /* Dropdown button on hover & focus */
  .dropbtn:hover, .dropbtn:focus {
    background-color: #3e8e41;
  }
  
  /* The search field */
  #myInput {
    box-sizing: border-box;
    background-image: url('searchicon.png');
    background-position: 14px 12px;
    background-repeat: no-repeat;
    font-size: 16px;
    padding: 14px 20px 12px 45px;
    border: none;
    border-bottom: 1px solid #ddd;
  }
  
  /* The search field when it gets focus/clicked on */
  #myInput:focus {outline: 3px solid #ddd;}
  
  /* The container <div> - needed to position the dropdown content */
  .dropdown {
    position: relative;
    display: inline-block;
  }
  
  /* Dropdown Content (Hidden by Default) */
  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f6f6f6;
    min-width: 230px;
    border: 1px solid #ddd;
    z-index: 1;
  }
  
  /* Links inside the dropdown */
  .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }
  
  /* Change color of dropdown links on hover */
  .dropdown-content a:hover {background-color: #f1f1f1}
  
  /* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
  .show {display:block;}
  </style>
@section('title')
    promotions Student
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
        ترقية الطلاب
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if (Session::has('error_promotions'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{Session::get('error_promotions')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                        <h6 style="color: red;font-family: Cairo">المرحلة الدراسية القديمة</h6><br>

                    <form method="POST" action="{{ route('promotion.store') }}">
                        @csrf
                        {{-- <div class="form-row">
                        <div class="dropdown">
                            
                            <button type="button" onclick="dropFunction()" class="dropbtn">Dropdown</button>
                            <div id="myDropdown" class="dropdown-content">
                              <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
                              <select name="" id="">
                              @foreach($students as $student)
                                        <option value="{{$student->id}}" >{{$student->name}}</option>
                              @endforeach
                            </select>
                            </div>
                          </div>
                          </div> --}}
                          
                          
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
                                <select class="custom-select mr-sm-2" name="section_id">
                                @if (isset($student))   
                                    <option class="text-danger font-weight-bold" selected value="{{$student->section->id}}">{{$student->section->name}}</option>
                                @endif
                                </select>
                                
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="academic_year">academic_year : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="academic_year">
                                        @if (isset($student))
                                            <option class="text-danger font-weight-bold" selected value="{{$student->academic_year}}">{{$student->academic_year}}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>



                        </div>
                        <br><h6 style="color: red;font-family: Cairo">المرحلة الدراسية الجديدة</h6><br>

                        <div class="form-row">
                            <div class="form-group col">
                                <label for="Classroom_id"> {{__('general.college')}}: <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="college_id_new" required>
                                    @if (isset($student))
                                    <option class="text-danger font-weight-bold" selected value="{{$student->college->id}}">{{$student->college->name}}</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="classroom_id">المرحلة الدراسية : <span
                                    class="text-danger">*</span></label>
                            <select class="custom-select mr-sm-2" name="classroom_id_new" required>
                                <option selected disabled>أختر اسم المرحلة  ...</option>
                                @if (isset($student))
                                    @foreach($student->college->classrooms as $classroom)
                                        <option value="{{$classroom->id}}">{{$classroom->name}}</option> 
                                    @endforeach
                                @endif
                            </select>
                            </div>
                            <div class="form-group col">
                                <label for="section_id">اختر القسم  : </label>
                                <select class="custom-select mr-sm-2" name="section_id_new">
                                    <option selected disabled>أختر القسم الكلية   ...</option>
                                    
                                </select>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="academic_year">اختر سنة الدراسية : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="academic_year_new">
                                        <option selected disabled>اختر سنة الدراسية   ...</option>
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
                        <button type="submit" class="btn btn-primary">تاكيد</button>
                    </form>

                </div>
            </div>
        </div>

    </div>
    <!-- row closed -->
@endsection
@section('js')

<script>
        /* When the user clicks on the button,
    toggle between hiding and showing the dropdown content */
    function dropFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
    }

    function filterFunction() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    div = document.getElementById("myDropdown");
    a = div.getElementsByTagName("a");
    for (i = 0; i < a.length; i++) {
        txtValue = a[i].textContent || a[i].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
        a[i].style.display = "";
        } else {
        a[i].style.display = "none";
        }
    }
    }
</script>
<script>
    document.getElementById('student_id').addEventListener('change', function() {
        var selectedStudentId = this.value;
        
        if (selectedStudentId) { 
            window.location.href = '/promotion/create/' + selectedStudentId;
        }
    });
</script>


@endsection
