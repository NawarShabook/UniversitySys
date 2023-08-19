<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{ __('dashboard.name') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="dashboard" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('dashboard')}}">Dashboard 01</a> </li>

                        </ul>
                    </li>
                    <!--college -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ __('university.managment') }}</li>
                    <!-- menu item Elements-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements">
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text">{{ __('university.colleges') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="elements" class="collapse" data-parent="#sidebarnav">
                            {{-- <li><a href="{{ route('college.create') }}">{{ __('university.add_fac') }}</a></li> --}}
                            <li><a href="{{ route('college.index') }}">{{ __('university.show_fac') }}</a></li>
                            <?php $i = 1; ?>
                            {{-- @foreach ($colleges as $college)
                                <li><a href="#">{{$i++;}}-{{$college->name}}</a></li>
                            @endforeach --}}
                        </ul>
                    </li>
                            <!-- classes-->
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#classes-menu">
                        <div class="pull-left"><i class="fa fa-building"></i><span
                                class="right-nav-text">{{ __('classroom.class') }}</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="classes-menu" class="collapse" data-parent="#sidebarnav">
                        <li><a href="{{ route('classroom.index') }}">{{ __('classroom.class') }}</a></li>
                    </ul>
                </li>
                {{-- sections --}}
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu">
                        <div class="pull-left"><i class="fa fa-building"></i><span
                                class="right-nav-text">{{ __('section.section') }}</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="sections-menu" class="collapse" data-parent="#sidebarnav">
                        <li><a href="{{ route('sections.index') }}">{{ __('section.section') }}</a></li>
                    </ul>
                </li>
                

                <!-- Teacher-->
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Teachers-menu">
                        <div class="pull-left"><i class="fa fa-building"></i><span
                                class="right-nav-text">{{__('teacher.teachers')}}</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Teachers-menu" class="collapse" data-parent="#sidebarnav">
                        <li><a href="{{ route('teacher.create') }}">{{__('general.add').' '.__('teacher.teacher')}}</a></li>
                        <li><a href="{{ route('teacher.index') }}">{{__('general.show').' '.__('teacher.teachers')}}</a></li>
                    </ul>
                </li>



                    <!-- the students-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#students-menu"><div class="pull-left"><i class="fa fa-solid fa-users"></i><span
                            class="right-nav-text">students</span></div><div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                        <ul id="students-menu" class="collapse">
                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#Student_information">Student_information<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                                <ul id="Student_information" class="collapse">
                                    <li> <a href="{{ route('student.create') }}">add_student</a></li>
                                    <li> <a href="{{ route('student.index') }}">list_students</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#Students_upgrade">Students_Promotions<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                                <ul id="Students_upgrade" class="collapse">
                                    <li> <a href="{{ route('promotion.create') }}">add_Promotion</a></li>
                                    <li> <a href="{{ route('promotion.index') }}">list_Promotions</a> </li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#Graduate students">Graduate_students<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                                <ul id="Graduate students" class="collapse">
                                    <li> <a href="{{ route('Graduateds.create') }}">add_Graduate</a> </li>
                                    <li> <a href="{{ route('Graduateds.index') }}">list_Graduate</a> </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Subject-menu">
                            <div class="pull-left"><i class="fa fa-building"></i><span
                                    class="right-nav-text">{{__('subject.subjects')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Subject-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('subject.create') }}">{{__('general.add').' '.__('subject.subject')}}</a></li>
                            <li><a href="{{ route('subject.index') }}">{{__('general.show').' '.__('subject.subjects')}}</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
