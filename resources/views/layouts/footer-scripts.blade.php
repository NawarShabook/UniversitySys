<!-- jquery -->
<script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<!-- plugins-jquery -->
<script src="{{ URL::asset('assets/js/plugins-jquery.js') }}"></script>
<!-- plugin_path -->
<script type="text/javascript">var plugin_path = '{{ asset('assets/js') }}/';</script>

<!-- chart -->
<script src="{{ URL::asset('assets/js/chart-init.js') }}"></script>
<!-- calendar -->
<script src="{{ URL::asset('assets/js/calendar.init.js') }}"></script>
<!-- charts sparkline -->
<script src="{{ URL::asset('assets/js/sparkline.init.js') }}"></script>
<!-- charts morris -->
<script src="{{ URL::asset('assets/js/morris.init.js') }}"></script>
<!-- datepicker -->
<script src="{{ URL::asset('assets/js/datepicker.js') }}"></script>
<!-- sweetalert2 -->
<script src="{{ URL::asset('assets/js/sweetalert2.js') }}"></script>
<!-- toastr -->
@yield('js')
<script src="{{ URL::asset('assets/js/toastr.js') }}"></script>
<!-- validation -->
<script src="{{ URL::asset('assets/js/validation.js') }}"></script>
<!-- lobilist -->
<script src="{{ URL::asset('assets/js/lobilist.js') }}"></script>
<!-- custom -->
<script src="{{ URL::asset('assets/js/custom.js') }}"></script>
<script src="{{ URL('https://use.fontawesome.com/c2df8da394.js') }}"></script>
@livewireScripts
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    } );
</script>


@if (App::getLocale() == 'en')
    <script src="{{ URL::asset('assets/js/bootstrap-datatables/en/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-datatables/en/dataTables.bootstrap4.min.js') }}"></script>
@else
    <script src="{{ URL::asset('assets/js/bootstrap-datatables/ar/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-datatables/ar/dataTables.bootstrap4.min.js') }}"></script>
@endif


<script>
    function CheckAll(name, elem) {
        var elements = document.getElementsname(name);
        var l = elements.length;

        if (elem.checked) {
            for (var i = 0; i < l; i++) {
                elements[i].checked = true;
            }
        } else {
            for (var i = 0; i < l; i++) {
                elements[i].checked = false;
            }
        }
    }
</script>


<script>
    $(document).ready(function () {
        $('select[name="college_id"]').on('change', function () {
            $('select[name="classroom_id"]').empty();
            $('select[name="classroom_id"]').append('<option selected disabled >اختر المرحلة الدراسية...</option>');

            var college_id = $(this).val();
            if (college_id) {
                $.ajax({
                    url: "{{ URL::to(Illuminate\Support\Facades\App::getLocale().'/Get_classrooms') }}/" + college_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        console.log(data)
                        $('select[name="classroom_id"]').empty();
                        $('select[name="classroom_id"]').append('<option selected disabled >اختر المرحلة...</option>');
                        $.each(data, function (key, value) {
                            $('select[name="classroom_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });

                    },
                });
            }

            else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>



<script>
    $(document).ready(function () {
        $('select[name="college_id"]').on('change', function () {
            $('select[name="section_id"]').empty();
            $('select[name="section_id"]').append('<option selected disabled >اختر القسم...</option>');
        });
        $('select[name="classroom_id"]').on('change', function () {
            var classroom_id = $(this).val();
            if (classroom_id) {
                $.ajax({
                    url: "{{ URL::to(Illuminate\Support\Facades\App::getLocale().'/Get_Sections') }}/" + classroom_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="section_id"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="section_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });

                    },
                });
            }

            else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('select[name="college_id_new"]').on('change', function () {
            var college_id = $(this).val();
            if (college_id) {
                $.ajax({
                    url: "{{ URL::to(Illuminate\Support\Facades\App::getLocale().'/Get_Classrooms') }}/" + college_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="classroom_id_new"]').empty();
                        $('select[name="classroom_id_new"]').append('<option selected disabled >اختر المرحلة الدراسية...</option>');
                        console.log(data);
                        $.each(data, function (key, value) {
                            $('select[name="classroom_id_new"]').append('<option value="' + key + '">' + value + '</option>');
                        });

                    },
                });
            }

            else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>


<script>
    $(document).ready(function () {
        $('select[name="classroom_id_new"]').on('change', function () {
            var classroom_id = $(this).val();
            if (classroom_id) {
                console.log("asdasd");
                $.ajax({
                    url: "{{ URL::to(Illuminate\Support\Facades\App::getLocale().'/Get_Sections') }}/" + classroom_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="section_id_new"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="section_id_new"]').append('<option value="' + key + '">' + value + '</option>');
                        });

                    },
                });
            }

            else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('select[name="college_id"]').on('change', function () {
            var college_id = $(this).val();
            if (college_id) {
                
                $.ajax({
                    
                    url: "{{ URL::to(Illuminate\Support\Facades\App::getLocale().'/Get_Teachers') }}/" + college_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        
                        $('select[name="teacher_id"]').empty();
                        $.each(data, function (key, value) {
                            console.log('googogoo');
                            $('select[name="teacher_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });

                    },
                });
            }

            else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>

{{-- hidden select fo colllege for promotion create --}}
{{-- <script>
    
    $(document).ready(function () {
        $('select[name="student_id"]').on('change', function () {
            
            var student_id = $(this).val();
            if (student_id) {
                
                $.ajax({
                    url: "{{ URL::to(Illuminate\Support\Facades\App::getLocale().'/Get_College') }}/" + student_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        
                        $('select[name="college_id"]').empty();
                        console.log(data)
                        $.each(data, function (key, value) {
                            
                            $('select[name="college_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });

                    },
                });
            }

            else {
                console.log('AJAX load did not work');
            }
        });
    });
</script> --}}