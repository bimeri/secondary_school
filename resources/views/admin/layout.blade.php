<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>

        <!-- Fonts -->
        {{-- <script src="{{ URL::asset('toaster.js') }}"></script> --}}
        {{-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"> --}}
        <link rel="icon" href="{{URL::asset('/image/2.png')}}" type="image/x-icon">
        <link rel="stylesheet" href="{{ URL::asset('materialize/css/materialize.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('fontawesome/css/all.css') }}" />
        {{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> --}}
        <script src="{{ URL::asset('jquery.min.js') }}"></script>
        <link rel="stylesheet" href="{{ URL::asset('admin.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('w3.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('toaster.css') }}" />
        {{-- <link rel="stylesheet" href="{{ URL::asset('mdb.css') }}" /> --}}
         <style>
            .active-link{
                background-color: #ccc !important;
            }
        </style>
        @yield('style')
    </head>
    <body>
        <nav class="">
            <div class="nav-wrapper teal">
                  <img src="{{ URL::asset('image/profile/'.auth()->user()->profile.'') }}" width="55" height="50" class="w3-circle w3-border right logo-icon" id="dropbtn" style="margin-right:14px !important; margin-top:0.7px !important">
                  <h6 class="right hide-on-med-and-down w3-small w3-padding" style="margin-top:-3px">Hi, <b style="text-transform: uppercase">{{ auth::user()->first_name }}</b></h6>
                  <a class="right hide-on-med-and-down w3-small w3-padding"><i class="fa fa-bell white-text"></i><span class="orange-text sty">0</span></a>
                  <a class="right hide-on-med-and-down w3-small w3-padding"><i class="fa fa-envelope white-text"></i><span class="orange-text sty">0</span></a>
              <ul id="nav-mobile" class="hide-on-med-and-down" style="margin-left: 120px">
                <li><a href="{{ route('admin.home') }}" class="name">{{ $setting->school_name }} &nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-chevron-right w3-large"></i></a></li>
                <li><a href="#" class="term">{{ $current_term->name }} {{ $current_year->name }}</a></li>
              </ul>

              <ul id="nav-mobile small" class="hide-on-med-and-up">
                <li style="margin-left: 20px; margin-top: 16px; position: absolute;"><label class="name white-text w3-medium">{{ $setting->school_name }}</label></li>
                <li style="margin-top: -17px !important; margin-left:75px; position: absolute;"><label class="term black-text w3-small">{{ $current_term->name }} {{ $current_year->name }}</label></li>
              </ul>
            </div>
        </nav>
        <div class="w3-border w3-padding dropdownc dropbtn right"  id="myDropdown">
            <ul class="mydwn">
                <a class="hide-on-med-and-up">
                    <span class="fa fa-bell teal-text" id="span-in">&nbsp;&nbsp;&nbsp; {{ __('messages.layout_messages') }} <b class="orange-text">0</b></span>
                </a>
                <a class="hide-on-med-and-up">
                    <span class="fa fa-envelope teal-text" id="span-in">&nbsp;&nbsp;&nbsp; {{ __('messages.layout_notification') }} <b class="orange-text">0</b></span>
                </a><hr class="hide-on-med-and-up coc">
                <a href="#">
                    <span class="mdi-action-account-circle" id="span-in">&nbsp;{{ __('messages.layout_profile') }}
                    </span>
                </a><hr class="coc">
                <a href="#">
                    <span class="mdi-content-create" id="span-in">&nbsp;{{ __('messages.change_password') }}
                    </span>
                </a><hr class="coc">
                <a href="#">
                    <span class="mdi-action-supervisor-account" id="span-in">&nbsp;{{ __('messages.user_account') }}
                    </span>
                </a><hr class="coc">
                    <form action="{{ route('language.english') }}" method="post" class="w3-padding">@csrf
                        <button class="btn default waves-effect waves-green" type="submit">
                            <span class="mdi-content-create" id="span-in">&nbsp;<img src="{{ URL::asset('image/uk.png') }}" alt="flag" height="20" width="20"> English @if(DB::table('languages')->where('active', 1)->where('locale', 'en')->exists())<i class="fa fa-check w3-small green-text"></i>@endif</span>
                        </button>
                    </form>
                     <form action="{{ route('language.french') }}" method="post" class="w3-padding">@csrf
                            <button class="btn default waves-effect waves-green" type="submit">
                                <span class="mdi-content-create" id="span-in">&nbsp;<img src="{{ URL::asset('image/fr.png') }}" alt="flag" height="20" width="20"> French @if(DB::table('languages')->where('active', 1)->where('locale', 'fr')->exists()) <i class="fa fa-check w3-small green-text"></i>@endif</span>
                            </button>
                    </form>
            </ul>
            <hr class="coc" style="margin-top:-20px">
            <a href="{{ route('admin.logout') }}">
                <strong id="dropdown-logout"><i class="fa fa-power-off"></i>&nbsp;{{ __('messages.layout_logout') }} {{ auth()->user()->first_name }}</strong>
            </a>
         </div>

  <a href="#" data-target="slide-out" class="sidenav-trigger white-text w3-xlarge w3-padding" style="width:40px; margin-top: -60px; position: relative; z-index:10"><i class="fa fa-th"></i></a>

  <ul id="slide-out" class="sidenav" style="transform: translateX(-105%); overflow-y: scroll;">
    <li>
      <div class="user-view">
        <div class="containeradmin w3-margin-bottom">
            <img src="{{ URL::asset('image/logo/'.$setting->logo.' ') }}"  class="image left" alt="logo" style="margin-top:4px; height:40px; width:40px">
            <img src="{{ URL::asset('image/icon.jpg') }}" alt="Avatar" class="image right">
            <span class="white-black email">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ auth()->user()->email }}</span>
            <div class="overlay">
              <div class="textadmin">
                  <div class="row">
                    <h6 class="center white-text" style="text-align: center">{{ $setting->motto ?? '' }}</h6><hr style="margin-top: -10px;">
                  </div>
              </div>
            </div>
          </div>
      </div>
    </li><hr style="margin-top: 43px !important; border-top:1px solid rgb(60, 182, 182)">
        <div>
            <ul class="collapsible w3-ul" style="margin-top:-15px">
                <li>
            @canany(['add_role', 'add_user', 'user_role'], App\Permission::class)<div class="collapsible-header waves-effect waves-teal" onclick="roles()" @if( Request::is('admin/role', 'admin/add_user', 'view_roles/'.request()->route("id").'', 'edit_user/'.request()->route("id").'', 'admin/edit_role/'.request()->route("id").'', 'admin/all_user'))  style="background-color: rgb(173, 231, 217)" @endif ><i class="fa fa-user teal-text w3-small"></i>{{ __('messages.manage_role_permission') }}<i class="fa fa-chevron-down right w3-small" id="role"></i></div>@endcanany
                <div class="collapsible-body">
                    <ul class="w3-border w3-padding" style="background-color: rgb(209, 251, 252)">
                        @can('add_role', App\Permission::class) <li><a href="{{ route('admin.manage.role') }}" @if( Request::is('admin/role', 'add_user/'.request()->route("id").'', 'admin/edit_role/'.request()->route("id").'')) style="background-color:rgb(229, 233, 232)" @endif class="teal-text"  onclick="load()"> &nbsp;{{ __('messages.add_role') }}</a></li>@endcan
                        @can('add_user', App\Permission::class)<li><a href="{{ route('manage.user') }}" @if( Request::is('admin/add_user', 'edit_user/'.request()->route("id").'')) style="background-color:rgb(229, 233, 232)" @endif  onclick="load()" class="teal-text">{{ __('messages.add_user') }}</a></li>@endcan
                        @can('user_role', App\Permission::class)<li><a href="{{ route('view.admin.user') }}" @if( Request::is('admin/all_user')) style="background-color:rgb(229, 233, 232)" @endif class="teal-text"  onclick="load()">{{ __('messages.see_all_user') }}</a></li>@endcan
                    </ul>
                </div>
                </li>

                <li>
            @canany(['create_income', 'create_expenses', 'record_expense','receive_fees','report_fees', 'give_scholarship', 'income_statement', 'print_reciept'], App\Permission::class)<div class="collapsible-header waves-effect waves-teal" onclick="fees()" @if( Request::is('fees/create', 'expense/create', 'admin/collect_fees', 'scholarship/create', 'admin/fee_statistics', 'scholarship/student', 'expense/view', 'fees/report', 'admin/collect/fees', 'admin/fees/statistics', 'student/scholarship/report'))  style="background-color: rgb(173, 231, 217)" @endif> &nbsp;<i class="fa fa-money-bill-wave-alt teal-text w3-small"></i> Fees and Expenses&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-down right w3-small" id="fee"></i></div>@endcanany
                <div class="collapsible-body">
                    <ul class="w3-border w3-padding" style="background-color: rgb(209, 251, 252)">
                        @can('create_income', App\Permission::class)<li><a href="{{ route('admin.create.fees.type') }}" class="teal-text"  @if( Request::is('fees/create'))  style="background-color: rgb(229, 233, 232)" @endif  onclick="load()">Create Income Type</a></li>@endcan
                        @can('create_expenses', App\Permission::class)<li><a href="{{ route('admin.create.expense.type') }}" class="teal-text" @if( Request::is('expense/create'))  style="background-color: rgb(229, 233, 232)" @endif  onclick="load()">Create Expense Type</a></li>@endcan
                        @can('give_scholarship', App\Permission::class)<li><a href="{{ route('scholarship.create') }}" class="teal-text" @if(Request::is('scholarship/create')) style="background-color: rgb(229, 233, 232)" @endif  onclick="load()">Give Scholarship</a></li>@endcan
                        @can('receive_fees', App\Permission::class)<li><a href="{{ route('admin.collect.fees') }}" class="teal-text" @if( Request::is('admin/collect_fees', 'admin/fee_statistics', 'scholarship/student', 'admin/collect/fees'))  style="background-color: rgb(229, 233, 232)" @endif  onclick="load()">Receive Fees</a></li>@endcan
                        @can('record_expense', App\Permission::class)<li><a href="{{ route('admin.view.expense') }}" class="teal-text" @if(Request::is('expense/view')) style="background-color: rgb(229, 233, 232)" @endif  onclick="load()">view/Edit expense</a></li>@endcan
                        @can('report_fees', App\Permission::class)<li><a href="{{ route('fees.report') }}" class="teal-text"  @if(Request::is('fees/report', 'admin/fees/statistics')) style="background-color: rgb(229, 233, 232)" @endif  onclick="load()">Fees Report</a></li>@endcan
                        @can('scholarship_report', App\Permission::class)<li><a href="{{ route('admin.scholarship.view') }}" class="teal-text" @if(Request::is('student/scholarship/report')) style="background-color: rgb(229, 233, 232)" @endif>Report Scholarship</a></li>@endcan
                        @can('income_statement', App\Permission::class)<li><a href="#" class="teal-text">Income Statement</a></li>@endcan
                        @can('print_reciept', App\Permission::class)<li><a href="#" class="teal-text">Print Receipts</a></li>@endcan
                    </ul>
                </div>
                </li>

                <li>
            @canany(['create_sector', 'create_backgorund', 'see_sector', 'see_background'], App\Permission::class)<div class="collapsible-header waves-effect waves-teal" onclick="sectors()"  @if( Request::is('admin/sector', 'admin/background', 'admin/view/background', 'admin/view/sector'))  style="background-color: rgb(173, 231, 217)" @endif> &nbsp;<i class="fa fa-list teal-text w3-small"></i> {{ __('messages.sector_background') }}&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-down right w3-small" id="sector"></i></div>@endcanany
                    <div class="collapsible-body">
                        <ul class="w3-border w3-padding" style="background-color: rgb(209, 251, 252)">
                            @can('create_sector', App\Permission::class) <li><a href="{{ route('admin.add.sector') }}" class="teal-text"  @if( Request::is('admin/sector'))  style="background-color: rgb(229, 233, 232)" @endif  onclick="load()">{{ __('messages.create_sector') }}</a></li>@endcan
                            @can('create_backgorund', App\Permission::class)<li><a href="{{ route('admin.create.background') }}" class="teal-text"  @if( Request::is('admin/background'))  style="background-color: rgb(229, 233, 232)" @endif  onclick="load()">{{ __('messages.create_background') }}</a></li>@endcan
                            @can('see_sector', App\Permission::class) <li><a href="{{ route('sector.view') }}" class="teal-text"  @if( Request::is('admin/view/sector'))  style="background-color: rgb(229, 233, 232)" @endif  onclick="load()">{{ __('messages.all_sector') }}</a></li>@endcan
                            @can('see_background', App\Permission::class)<li><a href="{{ route('background.view') }}" class="teal-text"  @if( Request::is('admin/view/background'))  style="background-color: rgb(229, 233, 232)" @endif  onclick="load()">{{ __('messages.all_background') }}</a></li>@endcan
                        </ul>
                    </div>
                </li>

                <li>
            @canany(['create_class', 'edit_delete_class', 'sub_class', 'see_class'], App\Permission::class)<div class="collapsible-header waves-effect waves-teal" onclick="classes()" @if(Request::is('admin/create/class', 'admin/create/subclass', 'admin/view/class')) style="background-color: rgb(173, 231, 217)" @endif><i class="fa fa-asterisk teal-text w3-small"></i> {{ __('messages.manage_class') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-down right w3-small" id="class"></i></div>@endcanany
                <div class="collapsible-body">
                    <ul class="w3-border w3-padding" style="background-color: rgb(209, 251, 252)">
                        @can('create_class', App\Permission::class)<li><a href="{{ route('admin.create.class') }}" class="teal-text"  @if( Request::is('admin/create/class'))  style="background-color: rgb(229, 233, 232)" @endif  onclick="load()">{{ __('messages.create_class') }}</a></li>@endcan
                        @can('sub_class', App\Permission::class)<li><a href="{{ route('admin.create.subclass') }}" class="teal-text"  @if( Request::is('admin/create/subclass'))  style="background-color: rgb(229, 233, 232)" @endif  onclick="load()">{{ __('messages.create_subclass') }}</a></li>@endcan
                        @can('see_class', App\Permission::class)<li><a href="{{ route('admin.view.class') }}" class="teal-text"  @if( Request::is('admin/view/class'))  style="background-color: rgb(229, 233, 232)" @endif  onclick="load()">{{ __('messages.all_subclass') }}</a></li>@endcan
                    </ul>
                </div>
                </li>

                <li>
            @canany(['add_student', 'class_list', 'promote_student', 'change_class'], App\Permission::class) <div class="collapsible-header waves-effect waves-teal" onclick="students()"  @if(Request::is('admin/student/create', 'admin/student/list', 'admin/student')) style="background-color: rgb(173, 231, 217)" @endif><i class="fa fa-graduation-cap teal-text w3-small"></i> Manage Students &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-down right w3-small" id="student"></i></div>@endcanany
                <div class="collapsible-body">
                    <ul class="w3-border w3-padding" style="background-color: rgb(209, 251, 252)">
                       @can('add_student', App\Permission::class) <li><a href="{{ route('amin.create.student') }}" class="teal-text"  @if(Request::is('admin/student/create')) style="background-color: rgb(229, 233, 232)" @endif  onclick="load()">Enroll Student</a></li>@endcan
                       @can('class_list', App\Permission::class)<li><a href="{{ route('amdin.view.student') }}" class="teal-text" @if(Request::is('admin/student/list', 'admin/student')) style="background-color: rgb(229, 233, 232)" @endif  onclick="load()">Class List</a></li>@endcan
                       @can('change_class', App\Permission::class)<li><a href="#!" class="teal-text">change class</a></li>@endcan
                    </ul>
                </div>
                </li>

                <li>
            @canany(['create_subject', 'all_subject'], App\Permission::class)<div class="collapsible-header waves-effect waves-teal" onclick="subjects()" @if(Request::is('admin/subject', 'admin/subject/all')) style="background-color: rgb(173, 231, 217)" @endif> &nbsp;<i class="fa fa-book teal-text w3-small"></i> Manage Subjects &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-down right w3-small" id="subject"></i></div>@endcanany
                <div class="collapsible-body">
                    <ul class="w3-border w3-padding" style="background-color: rgb(209, 251, 252)">
                       @can('create_subject', App\Permission::class) <li><a href="{{ route('admin.subject') }}" class="teal-text w3-small" @if(Request::is('admin/subject')) style="background-color: rgb(229, 233, 232)" @endif  onclick="load()"> Create Subject per class</a></li>@endcan
                       @can('all_subject', App\Permission::class)<li><a href="{{ route('admin.subject.view') }}" class="teal-text"  @if(Request::is('admin/subject/all')) style="background-color: rgb(229, 233, 232)" @endif  onclick="load()">See all subjects</a></li>@endcan
                    </ul>
                </div>
                </li>

                <li>
            @canany(['add_teacher', 'assign_subjects', 'assign_subjects','teacher_subjects'], App\Permission::class) <div class="collapsible-header waves-effect waves-teal" onclick="change()" @if(Request::is('admin/create/teacher', 'admin/teacher/view', 'admin/teacher/assign')) style="background-color: rgb(173, 231, 217)" @endif> &nbsp;<i class="fa fa-university teal-text w3-small"></i> Manage Teachers &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-down right w3-small" id="teacher"></i></div>@endcanany
                <div class="collapsible-body">
                    <ul class="w3-border w3-padding" style="background-color: rgb(209, 251, 252)">
                        @can('add_teacher', App\Permission::class)<li><a href="{{ route('admin.teacher.create') }}" class="teal-text" @if(Request::is('admin/create/teacher')) style="background-color: rgb(229, 233, 232)" @endif  onclick="load()">Add Teacher</a></li>@endcan
                        @can('assign_subjects', App\Permission::class)<li><a href="{{ route('admin.subject.assign') }}" class="teal-text" @if(Request::is('admin/teacher/assign')) style="background-color: rgb(229, 233, 232)" @endif  onclick="load()">assign Subjects</a></li>@endcan
                        @can('teacher_subjects', App\Permission::class)<li><a href="{{ route('admin.teacher.view') }}" class="teal-text" @if(Request::is('admin/teacher/view')) style="background-color: rgb(229, 233, 232)" @endif  onclick="load()">All Teacher</a></li>@endcan
                    </ul
                </div>
                </li>

                <li>
            @canany(['add_type', 'record_student', 'view_record_student'], App\Permission::class)<div class="collapsible-header waves-effect waves-teal" onclick="expenses()" @if(Request::is('admin/create/discipline', 'admin/record/discipline', 'admin/view/discipline')) style="background-color: rgb(173, 231, 217)" @endif><i class="fa fa-pencil-ruler teal-text w3-small"></i> Discipline &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-down right w3-small" id="expense"></i></div>@endcanany
                <div class="collapsible-body">
                    <ul class="w3-border w3-padding" style="background-color: rgb(209, 251, 252)">
                        @can('add_type', App\Permission::class)<li><a href="{{ route('admin.create.discipline') }}" class="teal-text" @if(Request::is('admin/create/discipline')) style="background-color: rgb(229, 233, 232)" @endif  onclick="load()">Create type</a></li>@endcan
                        @can('record_student', App\Permission::class)<li><a href="{{ route('admin.record.discipline') }}" class="teal-text" @if(Request::is('admin/record/discipline')) style="background-color: rgb(229, 233, 232)" @endif  onclick="load()"> Record for Student</a></li>@endcan
                        @can('view_record_student', App\Permission::class)<li><a href="{{ route('admin.view.discipline') }}" class="teal-text" @if(Request::is('admin/view/discipline')) style="background-color: rgb(229, 233, 232)" @endif  onclick="load()">View All</a></li>@endcan
                    </ul>
                </div>
                </li>

                <li>
            @canany(['record_mark', 'rank_student', 'print_result', 'print_rank', 'print_fee'], App\Permission::class) <div class="collapsible-header waves-effect waves-teal" onclick="results()" @if(Request::is('student/marks/record', 'student/rank', 'class/result')) style="background-color: rgb(173, 231, 217)" @endif><i class="fa fa-pencil-alt teal-text w3-small"></i> Results &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-down right w3-small" id="result"></i></div>@endcanany
                <div class="collapsible-body">
                    <ul class="w3-border w3-padding" style="background-color: rgb(209, 251, 252)">
                        @can('record_mark', App\Permission::class)<li><a href="{{ route('admin.record.marks') }}" class="teal-text" @if(Request::is('student/marks/record'))style="background-color: rgb(229, 233, 232)"@endif  onclick="load()">Record Mark</a></li>@endcan
                        @can('rank_student', App\Permission::class)<li><a href="{{ route('student.rank.result') }}" class="teal-text" @if(Request::is('student/rank', 'class/result'))style="background-color: rgb(229, 233, 232)"@endif  onclick="load()">Rank Students</a></li>@endcan
                        @can('print_result', App\Permission::class)<li><a href="#!" class="teal-text">Print Result</a></li>@endcan
                        @can('promote_student', App\Permission::class)<li><a href="#!" class="teal-text">Promote Student</a></li>@endcan
                        @can('print_rank', App\Permission::class)<li><a href="#!" class="teal-text">Print Rank Sheets</a></li>@endcan
                        @can('print_fee', App\Permission::class)<li><a href="#!" class="teal-text">Fees Controlled Print</a></li>@endcan
                    </ul>
                </div>
                </li>

                <li>
               @canany(['school_theme', 'school_profile'], App\Permission::class) <div class="collapsible-header waves-effect waves-teal" onclick="settings()" @if( Request::is('admin/school_theme', 'admin/school_profile'))   style="background-color: rgb(173, 231, 217)"  @endif><i class="fa fa-wrench w3-medium teal-text"></i> Setting/Configuration &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-down right w3-small" id="setting"></i></div>@endcanany
                <div class="collapsible-body">
                    <ul class="w3-border w3-padding" style="background-color: rgb(209, 251, 252)">
                        @can('school_theme', App\Permission::class)<li><a href="{{ route('view.admin.theme') }}" class="teal-text" @if( Request::is('admin/school_theme'))  style="background-color:rgb(229, 233, 232)" @endif onclick="load()">School theme</a></li>@endcan <!-- year, term, sequesnces -->
                        @can('school_profile', App\Permission::class)<li><a href="{{ route('view.admin.profile') }}" class="teal-text" @if( Request::is('admin/school_profile'))  style="background-color:rgb(229, 233, 232)" @endif onclick="load()">School profile</a></li> @endcan<!-- name, motto, logo, exam/test session,  -->
                    </ul>
                </div>
                </li>
                <li><a href="{{ route('admin.logout') }}"  class="waves-effect waves-light red-text"  onclick="load()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="fa fa-power-off"></span> logout</a></li>
            </ul>
        </div>
  </ul>

    <div class="cal">
        <div class="row">
            <div class="col s10 offset-s1 m6 offset-m3">
                @if(count($errors) > 0)
                <center>
                    <div class="w3-container red-text w3-card-8 w3-margin-top materialize-red lighten-4" style="display: block; position: relative; z-index: 30">
                        <span onclick="this.parentElement.style.display='none'" class="close right w3-padding-16 w3-margin-top" style="cursor: pointer">x</span>
                        <ul id="error" class="w3-margin w3-padding">
                            @foreach($errors->all() as $error)
                                <li style="text-align: center;">{{ $error }} </li>
                            @endforeach  <center><i class="mdi-action-thumb-down" style="font-size: 25px;"></i></center>
                        </ul>
                    </div>
                </center>
                @endif
            </div>
        </div>
        @yield('content')
    </div>

        <div id="menu" class="teal" style="height: 800px !important; width: 100% !important; position: fixed !important; top:0px; bottom: 0px; left: 0px; right: 0px; z-index: 1000; opacity:.5 !important">
            <div class="w3-margin-top">
                <center>
                    <div class="preloader-wrapper big active spinner-white" style="margin-top: 220px !important;">
                        <div class="spinner-layer spinner-white-only">
                            <div class="circle-clipper left">
                                <div class="circle"></div>
                            </div>
                            <div class="gap-patch">
                                <div class="circle"></div>
                            </div>
                            <div class="circle-clipper right">
                                <div class="circle"></div>
                            </div>
                        </div>
                    </div>
                </center>
            </div>
        </div>
        <a class="scrollToTop btn-floating btn-large waves-effect waves-light teal"><i class="fa fa-arrow-up"></i></a>

        <div class="footer_one">
            <center>
                <p id="dateField" style="color: white;">&nbsp;</p>
                <p style="text-align: center; color: #fff">&copy;Powered by
                    <a  target="_blank" href ="#" style="color:#00ccff"> Bimeri. Ltd</a>
                </p>
            </center>
        </div>
        <script src="{{ URL::asset('toaster.js') }}"></script>
        {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}
    <script src="{{ URL::asset('materialize/js/materialize.min.js') }}"></script>
    <script src="{{ URL::asset('myjs.js') }}"></script>
    <script src="{{ URL::asset('sweat_alert.js') }}"></script>
    {{-- <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script> --}}
        <script>
            @if(Session::has('message'))
              var type = "{{ Session::get('alert-type', 'info') }}";
              toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "9000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                    }
              switch(type){
                  case 'info':
                      toastr.info("{{ Session::get('message') }}");
                      break;

                  case 'warning':
                      toastr.warning("{{ Session::get('message') }}");
                      break;

                  case 'success':
                      Command: toastr["success"]("{{ Session::get('message') }}")
                      break;

                  case 'error':
                      toastr.error("{{ Session::get('message') }}");
                      break;
              }
            @endif
          </script>
    </body>
</html>
