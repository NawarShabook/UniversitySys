@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    Show Student
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
Show Student
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="card-body">
                        <div class="tab nav-border">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02"
                                       role="tab" aria-controls="home-02"
                                       aria-selected="true">Show Student</a>
                                </li>
                              
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#profile-02"
                                       role="tab" aria-controls="profile-02"
                                       aria-selected="false">Attachments</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                
                                <div class="tab-pane fade active show" id="home-02" role="tabpanel"
                                     aria-labelledby="home-02-tab">
                                    <table class="table table-striped table-hover" style="text-align:center">
                                        <tbody>
                                        <tr>
                                            <th scope="row">{{ __('student.name_student_ar') }}</th>
                                            <td>{{$student->student->getTranslation('name','ar')}}</td>
                                            <th>{{ __('student.name_student_en') }}</th>
                                            <td>{{$student->student->getTranslation('name','en')}}</td>
                                            <th scope="row">{{__('general.email')}}</th>
                                            <td>{{$student->student->email}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{__('general.college')}}</th>
                                            <td>{{$student->student->college->name}}</td>
                                            <th scope="row">{{__('general.level')}}</th>
                                            <td>{{ $student->student->classroom->name }}</td>
                                            <th scope="row">{{__('general.section')}}</th>
                                            <td>{{$student->student->section->name}}</td>
                                            
                                        </tr>

                                        <tr>
                                            <th scope="row">{{__('general.birthday')}}</th>
                                            <td>{{ $student->student->birthday}}</td>
                                            <th scope="row">السنة الدراسية</th>
                                            <td>{{ $student->student->academic_year}}</td>
                                            {{-- <th scope="row">Images</th>
                                            @foreach ($student->student->images as $image)
                                            <td>{{ $image->filename }}</td>
                                            <img src="{{asset('attachments/students/kmail/'.$image->filename) }}" alt="" width="100" height="100" >
                                            @endforeach --}}
                                            <th scope="row">{{__('general.gender')}}</th>
                                            <td>{{__('general.'.$student->student->gender)}}</td>
                                        </tr>

                                        <tr>
                                            
                                            <th>{{"المدينة"}}</th>
                                            <td>{{$student->city}}</td>
                                            <th>{{"اسم الوحدة السكنية"}}</th>
                                            <td>{{$student->unit_name}}</td>
                                            <th>{{"رقم الغرفة"}}</th>
                                            <td>{{$student->room_number}}</td>
                                            
                                        </tr>
                                        </tbody>
                                    </table>
                                    <button type="button" class="btn btn-md btn-success " data-toggle="modal" data-target="#exampleModal">
                                        {{'تعديل بيانات الطالب'}}
                                    </button>
                                </div>

                                <div class="tab-pane fade" id="profile-02" role="tabpanel"
                                     aria-labelledby="profile-02-tab">
                                    <div class="card card-statistics">
                                        <div class="card-body">
                                            <form method="post" action="{{route('Upload_attachment')}}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label
                                                            for="academic_year">Attachments
                                                            : <span class="text-danger">*</span></label>
                                                        <input type="file" accept="image/*" name="photos[]" multiple required>
                                                        <input type="hidden" name="name" value="{{$student->student->name}}">
                                                        <input type="hidden" name="student_id" value="{{$student->id}}">
                                                    </div>
                                                </div>
                                                <br><br>
                                                <button type="submit" class="button button-border x-small">
                                                       Submit
                                                </button>
                                            </form>
                                        </div>
                                        <br>
                                        <table class="table center-aligned-table mb-0 table table-hover"
                                               style="text-align:center">
                                            <thead>
                                            <tr class="table-secondary">
                                                <th scope="col">#</th>
                                                <th scope="col">filename</th>
                                                <th scope="col">created_at</th>
                                                <th scope="col">Processes</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            
                                           
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- row closed -->

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{'تعديل بيانات الطالب'}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- edit_form -->
                <form action="{{ route('dorm.update',$student->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col">
                            <label for="city" class="mr-sm-2">المدينة
                                :</label>
                            <input id="city" type="text" name="city" class="form-control" value="{{$student->city}}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="unit" class="mr-sm-2">اسم الوحدة السكنية
                                :</label>
                            <input id="unit" type="text" name="unit_name" class="form-control" value="{{$student->unit_name}}">
                        </div>
                    
                    <div class="col">
                        <label for="exampleFormControlTextarea1">رقم الغرفة
                            :</label>
                        <input class="form-control" name="room_number" type="number" min="0" value='{{$student->room_number}}'>
                    </div></div>
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
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
