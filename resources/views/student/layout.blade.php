<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->

        {{-- <script src="{{ URL::asset('toaster.js') }}"></script> --}}
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ URL::asset('materialize/css/materialize.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('fontawesome/css/all.css') }}" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <link rel="stylesheet" href="{{ URL::asset('student.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('w3.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('toaster.css') }}" />
        {{-- <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> --}}
    </head>
    <body>
        <nav class="blue">
            <div class="nav-wrapper blue navs">
                  <img src="{{ URL::asset('image/2.png') }}" width="30" height="30" class="w3-circle w3-border right logo-icon" id="dropbtn">

              <ul id="nav-mobile" class="hide-on-med-and-down" style="margin-left: 50px">
                <li><a href="#" class="name">{{ $setting->school_name }} &nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-chevron-right w3-large"></i></a></li>
                <li><a href="#" class="term">{{ $current_term->name }} {{ $current_year->name }}</a></li>
              </ul>

              <ul id="nav-mobile small" class="hide-on-med-and-up">
                <li style="margin-left: 70px; margin-top:-10px"><label class="name white-text w3-medium">{{ $setting->school_name }}</label></li>
                <li style="margin-top: -30px !important; margin-left:75px"><label class="term black-text w3-small">{{ $current_term->name }} {{ $current_year->name }}</label></li>
              </ul>
            </div>

            <div class="row hide-on-med-and-down" style="margin-top:-48px">
                <div class="col s12">
                  <ul class="tabs blue">
                    <li class="tab col s2"><a class="{{ Request::is('student/structure') ? 'active' : '' }}" href="#test1">Structure</a></li>
                    <li class="tab col s2"><a class="{{ Request::is('student/home') ? 'active' : '' }}" href="#test2">Home</a></li>
                    <li class="tab col s2"><a class="{{ Request::is('student/subjects') ? 'active' : '' }}" href="#test3">Subjects</a></li>
                    <li class="tab col s2"><a class="{{ Request::is('student/test_result') ? 'active' : '' }}" href="#test4">Test Result</a></li>
                    <li class="tab col s2"><a class="{{ Request::is('student/final_result') ? 'active' : '' }}" href="#test5">Final Result</a></li>
                    <li class="tab col s2"><a class="{{ Request::is('student/fees') ? 'active' : '' }}" href="#test6">Pay Fees</a></li>
                  </ul>
                </div>
            </div>
        </nav>
        <div class="w3-border w3-padding dropdownc dropbtn right"  id="myDropdown">
            <ul class="mydwn">
                <li class="w3-small hide-on-med-and-down"><a href="#"  class="waves-effect"><i class="fa fa-bell blue-text"></i> &nbsp;&nbsp; Notification</a></li><hr class="coc hide-on-med-and-down">
                <li class="w3-small hide-on-med-and-down"><a href="#"  class="waves-effect"><i class="fa fa-envelope blue-text"></i> &nbsp;&nbsp; Messages</a></li><hr class="coc hide-on-med-and-down">
                <a href="#">
                    <span class="mdi-action-account-circle" id="span-in">&nbsp;Profile &nbsp;&nbsp;&nbsp;<i class="fa fa-users blue-text w3-small"></i>
                    </span>
                </a><hr class="coc">
                <a href="#">
                    <span class="mdi-content-create" id="span-in">&nbsp;Change Password &nbsp;&nbsp;&nbsp;<i class="fa fa-unlock-alt blue-text w3-small"></i>
                    </span>
                </a><hr class="coc">
                <a href="#">
                    <span class="mdi-action-supervisor-account" id="span-in">&nbsp;User Account &nbsp;&nbsp;&nbsp;<i class="fa fa-tasks blue-text w3-small"></i>
                    </span>
                </a><hr class="coc">
                  <a href="{{ route('student.logout') }}">
                      <strong id="dropdown-logout"><i class="fa fa-power-off"></i>&nbsp;logout {{auth()->user()->last_name}}</strong>
                  </a><hr class="coc"><hr class="coc" style="margin-top:-20px">
                  <a href="#">
                    <span class="mdi-content-create" id="span-in">&nbsp;<i class="fa fa-google-wallet"></i> French
                    </span>
                </a>
            </ul>
         </div>

  <a href="#" data-target="slide-out" class="sidenav-trigger white-text w3-xlarge w3-padding hide-on-med-and-up" style="width:40px; margin-top: -60px; position: relative; z-index:10"><i class="fa fa-th"></i></a>

  <ul id="slide-out" class="sidenav w3-ul" style="transform: translateX(-105%); overflow-y: scroll">
    <li>
      <div class="user-view">
        <div class="containeradmin w3-margin-bottom">
            <img src="{{ URL::asset('image/icon.jpg') }}" alt="Avatar" class="image">
            <span class="blue-text email center">{{auth()->user()->email}}</span>
            <div class="overlay">
              <div class="textadmin">
                  <div class="row">
                    <img src="image/logo/{{ $setting->logo }}" width="40" height="40" class="w3-circle w3-border left" style="margin-left:-30px; margin-top:-30px">
                    <img src="image/logo/{{ $setting->logo }}" width="40" height="40" class="w3-circle w3-border right" style="margin-right:-30px; margin-top:-30px">
                  </div>
                  <label class="white-text" style="margin-top: -40px !important">{{auth()->user()->first_name}} {{auth()->user()->last_name}} | Student</label>
              </div>
            </div>
          </div>
      </div>
    </li>
    <li><a href="#"  class="waves-effect">Notification <span class="w3-badge orange w3-padding right" style="width: 10px !important; height:30px !important; margin-top:10px"><b style="position:absolute !important; margin-top:-17px; margin-left:-5px">0</b></span> <i class="fa fa-bell blue-text"></i></a></li>
    <li><a href="#"  class="waves-effect">Messages <span class="w3-badge orange w3-padding right" style="width: 10px !important; height:30px !important; margin-top:10px"><b style="position:absolute !important; margin-top:-17px; margin-left:-5px">0</b></span><i class="fa fa-envelope blue-text"></i></a></li><hr style="margin-top:-4px; border-top:1px solid rgb(53, 186, 219)">
        <li><a onclick="load()"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Structure <i class="fa fa-university w3-small right gray-text"></i></a></li>
        <li><a onclick="load()"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Home <i class="fa fa-home w3-small right gray-text"></i></a></li>
        <li><a onclick="load()"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Subjects <i class="fa fa-tasks w3-small right gray-text"></i></a></li>
        <li><a onclick="load()"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Test Result <i class="fa fa-file w3-small right gray-text"></i></a></li>
        <li><a onclick="load()"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Final Result <i class="fa fa-file-pdf w3-small right gray-text"></i></a></li>
        <li><a onclick="load()"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pay fees <i class="fa fa-money-bill-alt w3-small right gray-text"></i></a></li>
        <li><a onclick="load()" class="red-text"><span class="fa fa-power-off"></span> &nbsp;&nbsp;&nbsp;&nbsp; Logout {{auth()->user()->last_name}}</a></li>
        <li><a style="background-color:transparent"> <span class=""></span> </a></li>
  </ul>

    <div class="cal w3-padding row">
        @yield('content')
    </div>

        <div id="menu" class="blue" style="height: 800px !important; width: 100% !important; position: fixed !important; top:0px; bottom: 0px; left: 0px; right: 0px; z-index: 1000;">
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
        <script>
            function change(){
                var v = document.getElementById("teacher");
                    if(v.classList.contains('fa-chevron-up')) {
                        v.className = "teal-text right fa fa-chevron-down w3-small";
                    }
                   else if(v.classList.contains('fa-chevron-down')) {
                        v.className = "teal-text right fa fa-chevron-up w3-small";
                    }
            }
            function students(){
                var v = document.getElementById("student");
                    if(v.classList.contains('fa-chevron-up')) {
                        v.className = "teal-text right fa fa-chevron-down w3-small";
                    }
                   else if(v.classList.contains('fa-chevron-down')) {
                        v.className = "teal-text right fa fa-chevron-up w3-small";
                    }
            }
            function expenses(){
                var v = document.getElementById("expense");
                    if(v.classList.contains('fa-chevron-up')) {
                        v.className = "teal-text right fa fa-chevron-down w3-small";
                    }
                   else if(v.classList.contains('fa-chevron-down')) {
                        v.className = "teal-text right fa fa-chevron-up w3-small";
                    }
            }
            function settings(){
                var v = document.getElementById("setting");
                    if(v.classList.contains('fa-chevron-up')) {
                        v.className = "teal-text right fa fa-chevron-down w3-small";
                    }
                   else if(v.classList.contains('fa-chevron-down')) {
                        v.className = "teal-text right fa fa-chevron-up w3-small";
                    }
            }
            function classes(){
                var v = document.getElementById("class");
                    if(v.classList.contains('fa-chevron-up')) {
                        v.className = "teal-text right fa fa-chevron-down w3-small";
                    }
                   else if(v.classList.contains('fa-chevron-down')) {
                        v.className = "teal-text right fa fa-chevron-up w3-small";
                    }
            }
        </script>
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
