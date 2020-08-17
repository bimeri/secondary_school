<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>

        <!-- Fonts -->

        {{-- <script src="{{ URL::asset('toaster.js') }}"></script> --}}
        {{--  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">  --}}
        <link rel="stylesheet" href="{{ URL::asset('materialize/css/materialize.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('fontawesome/css/all.css') }}" />
        {{--  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>  --}}
        <script src="{{ URL::asset('jquery.min.js') }}"></script>
        <link rel="stylesheet" href="{{ URL::asset('teacher.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('w3.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('toaster.css') }}" />
        {{-- <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> --}}
        <style>
            .active-link{
                background-color: #ccc !important;
            }
        </style>
    </head>
    <body>
        <nav>
            <div class="nav-wrapper t-teal">
                <img src="{{ URL::asset('image/teacher/'.auth()->user()->profile.'') }}" width="50" height="50" class="w3-circle w3-border right logo-icon" id="dropbtn">
                <h6 class="right hide-on-med-and-down w3-small w3-padding" style="margin-top:-3px">Hi, <b style="text-transform: uppercase">{{ auth::user()->full_name }}</b></h6>
                <a class="right hide-on-med-and-down w3-small w3-padding"><i class="fa fa-bell white-text"></i><span class="orange-text sty">0</span></a>
                <a class="right hide-on-med-and-down w3-small w3-padding"><i class="fa fa-envelope white-text"></i><span class="orange-text sty">0</span></a>

              <ul id="nav-mobile" class="hide-on-med-and-down" style="margin-left: 120px">
                <li><a href="#" class="name">{{ $setting->school_name }} &nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-chevron-right w3-large"></i></a></li>
                <li><a href="#" class="term">{{ $current_term->name }} {{ $current_year->name }}</a></li>
              </ul>

              <ul id="nav-mobile small" class="hide-on-med-and-up">
                <li style="margin-left: 70px; margin-top:-10px"><label class="name white-text w3-medium">{{ $setting->school_name }}</label></li>
                <li style="margin-top: -30px !important; margin-left:75px"><label class="term black-text w3-small">{{ $current_term->name }} {{ $current_year->name }}</label></li>
              </ul>
            </div>
        </nav>
        <div class="w3-border w3-padding dropdownc dropbtn right"  id="myDropdown">
            <ul class="mydwn">
                <a href="#">
                    <span class="mdi-action-account-circle" id="span-in">&nbsp;Profile
                    </span>
                </a><hr class="coc">
                <a href="#">
                    <span class="mdi-content-create" id="span-in">&nbsp;Change Password
                    </span>
                </a><hr class="coc">
                <a href="#">
                    <span class="mdi-action-supervisor-account" id="span-in">&nbsp;User Account
                    </span>
                </a><hr class="coc">
                  <a href="{{ route('teacher.logout') }}">
                      <strong id="dropdown-logout"><i class="fa fa-power-off"></i>&nbsp;{{ __('messages.layout_logout') }} {{ auth()->user()->full_name }}</strong>
                  </a><hr class="coc"><hr class="coc" style="margin-top:-20px">

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
         </div>

  <a href="#" data-target="slide-out" class="sidenav-trigger white-text w3-xlarge w3-padding" style="width:40px; margin-top: -60px; position: relative; z-index:10"><i class="fa fa-th"></i></a>

  <ul id="slide-out" class="sidenav w3-ul" style="transform: translateX(-105%); overflow-y: scroll">
    <li>
      <div class="user-view">
        <div class="containeradmin w3-margin-bottom">
            <img src="{{ URL::asset('image/icon.jpg') }}" alt="Avatar" class="image">
            <span class="white-black email center">{{ auth::user()->email }}</span>
            <div class="overlay">
              <div class="textadmin">
                  <div class="row">
                    <img src="image/logo/{{ $setting->logo }}" width="40" height="40" class="w3-circle w3-border left" style="margin-left:-30px; margin-top:-30px">
                    <img src="image/logo/{{ $setting->logo }}" width="40" height="40" class="w3-circle w3-border right" style="margin-right:-30px; margin-top:-30px">
                  </div><hr style="border-top:1px solid #fff; width:133%; margin-left:-30px">
                  <label class="white-text" style="margin-top: -40px !important">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }} | Teacher </label>
              </div>
            </div>
          </div>
      </div>
    </li>
    <li><a href="#"  class="waves-effect">Notification <i class="fa fa-bell t-teal-text"></i></a></li>
    <li><a href="#"  class="waves-effect">Messages <i class="fa fa-envelope t-teal-text"></i></a></li>
        <div>
            <ul class="collapsible">
                <li>
                <div class="collapsible-header" onclick="classes()"> &nbsp;<i class="fa fa-list t-teal-text w3-small"></i> Manage Subject&nbsp;&nbsp;<i class="fa fa-chevron-down right w3-small" id="class"></i></div>
                <div class="collapsible-body">
                    <ul class="w3-border w3-padding" style="background-color: rgb(209, 251, 252)">
                        <li><a href="#!" class="t-teal-text"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All Subjects <i class="fa fa-list right t-teal-text"></i></a></li>
                        <li><a href="#!" class="t-teal-text"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Assigments <i class="fa fa-plus-square right t-teal-text"></i></a></li>
                        <li><a href="#!" class="t-teal-text"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;vidoes <i class="fa fa-play-circle right t-teal-text"></i></a></li>
                        <li><a href="#!" class="t-teal-text"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HandOut <i class="fa fa-book right t-teal-text"></i></a></li>
                    </ul>
                </div>
                </li>
                 <li>
                <div class="collapsible-header" onclick="students()"> &nbsp;<i class="fa fa-graduation-cap t-teal-text w3-small"></i> Manage Students <i class="fa fa-chevron-down right w3-small" id="student"></i></div>
                <div class="collapsible-body">
                    <ul class="w3-border w3-padding" style="background-color: rgb(209, 251, 252)">
                        <li><a href="#!" class="t-teal-text"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;See Student <i class="fa fa-graduation-cap right t-teal-text"></i></a></li>
                        <li><a href="#!" class="t-teal-text"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Student Test <i class="fa fa-wrench t-teal-text right"></i></a></li>
                        <li><a href="#!" class="t-teal-text"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Student Exam <i class="fa fa-file-pdf right t-teal-text"></i></a></li>
                        <li><a href="#!" class="t-teal-text"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Statistics <i class="fa fa-list-alt right t-teal-text"></i></a></li> <!--  -->
                    </ul>
                </div>
                </li>
                <li><a href="#"  class="waves-effect waves-light red-text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="fa fa-power-off"></span> logout</a></li>
            </ul>
        </div>
  </ul>

    <div class="cal w3-padding row">
        @yield('content')
    </div>

        <div id="menu" class="t-teal" style="height: 800px !important; width: 100% !important; position: fixed !important; top:0px; bottom: 0px; left: 0px; right: 0px; z-index: 1000;">
            <div class="w3-margin-top">
                <center>
                    <div class="preloader-wrapper big active spinner-white" style="margin-top: 200px !important;">
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

        <div class="footer_one">
            <center>
                <p id="dateField" style="color: white;">&nbsp;</p>
                <p style="text-align: center; color: #fff">&copy;Powered by
                    <a  target="_blank" href ="#" style="color:#00ccff"> Bimeri. Ltd</a>
                </p>
            </center>
        </div>
    <script src="{{ URL::asset('toaster.js') }}"></script>
    <script src="{{ URL::asset('materialize/js/materialize.min.js') }}"></script>
    <script src="{{ URL::asset('myjs.js') }}"></script>
    <script src="{{ URL::asset('sweat_alert.js') }}"></script>
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
                    "timeOut": "7000",
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
