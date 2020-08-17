@extends('admin.layout')
@section('title') All Teacher @endsection
@section('content')
<p class="w3-center">@lang('messages.welcome')</p>

<div class="row w3-margin-top">
    <div class="col s11 m10 w3-border-t offset-m1 w3-padding white w3-margin-bottom radius w3-margin-left" style="margin-top: -13px">
        @if ($teachers->count() == 0)
        <div class="red lighten-4 red-text w3-padding w3-border w3-center bold">Not yet Registered any teacher</div>
        @endif
        <div class="col s6 m2 right topnav">
            <input type="text" placeholder="Search Email..." onkeyup="myFunctionn()" id="myInputt">
            <i class="fa fa-search right w3-large teal-text search"></i>
        </div>
        <div class="col s6 m2 right topnav" style="margin-right: 10px !important">
            <input type="text" placeholder="Search Name..." onkeyup="myFunction()"  id="myInput">
            <i class="fa fa-search right w3-large teal-text search"></i>
        </div>
        <div class="col s12 m12" style="overflow-x:scroll !important;">
            <table id="myTable" class="w3-table w3-striped w3-border-t" style="font-size: 13px !important;">
                <tr class="teal">
                    <th>S/N</th>
                    <th>profile</th>
                    <th>Full Name</th>
                    <th>email</th>
                    <th>gender</th>
                    <th>date of birth</th>
                    <th colspan="2">Action</th>
                </tr>
                @foreach ($teachers as $key => $user)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        <img src="{{ URL::asset('image/teacher/'.$user->profile.'') }}" width="50" height="50" class="w3-circle w3-border-t">
                    </td>
                    <td>{{ $user->full_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->gender }}</td>
                    <td>{{ $user->date_of_birth }}</td>

                    <td>
                    <button class="btn blue waves-light waves-effect"
                            onclick="document.getElementById('{{ $key+1 }}').style.display='block'">
                        View <i class="fa fa-eye w3-small"></i>
                    </button>
                    </td>
                    <td>
                    <button class="red btn waves-light waves-effect" disabled>Delete <i class="fa fa-trash w3-small"></i></button>
                    </td>
                </tr>

                <style>
                    .teacherinfo{
                  max-height: 400px;overflow-y: auto; overflow-x: hidden;
                }
                .teacherinfo::-webkit-scrollbar {
                  width: 8px;
                }
                .teacherinfo::-webkit-scrollbar-thumb {
                  border-radius: 100px;
                  background: #009688 !important;
                }
                </style>


                <div id="{{ $key+1 }}" class="w3-modal">
                    <div class="w3-modal-content w3-animate-right">
                        <header class="w3-container teal" style="color: #fff">
                            <span onclick="document.getElementById('{{ $key+1 }}').style.display='none'"
                            class="w3-button w3-display-topright w3-padding w3-hover">X</span>
                                <h2 class="w3-center">{{ $user->full_name }}'s Personal Profile</h2>
                        </header>

                        <div class="row">
                            <div class="w3-margin-left col s12 m12 l4 w3-card-4 w3-padding">
                                <div class="w3-container w3-padding">
                                    <img src="{{ URL::asset('image/teacher/'.$user->profile.'') }}" class="w3-rounded" height="240" width="240">
                                </div>
                                <p><b class="upper orange-text w3-padding w3-large">{{ $user->full_name }}</b></p>
                            </div>

                            <div class="w3-margin col s12 m12 l7 w3-padding w3-border teacherinfo">
                                <p class="teal-text w3-xlarge w3-center">Personal Information</p><hr class="divide">
                                <div class="w3-center">
                                    <p><i class="teal-text w3-large">First Name:</i> <?php $fname = explode(' ',trim($user->full_name)); echo ' <b><i class="black-text">'.$fname[0].'</i></b> ,&nbsp; <i class="teal-text w3-large">Last Name: <b class="black-text">'.$fname[1].'</b></i> ' ?></p>

                                    <i class="teal-text w3-large">Full Name:</i> {{ $user->full_name }}<br>
                                    <i class="teal-text w3-large">Email:</i> {{ $user->email }}<br>
                                    <i class="teal-text w3-large">Gender:</i> {{ $user->gender }}
                                </div><hr class="divide"><hr class="divide" style="margin-top: -15px;">
                                @foreach($currentyear = App\Year::where('active', 1)->get() as $current)
                                 <p class="center w3-xlarge" style="font-family: Times New Roman">
                                    <b>All subjects assigned for the year <i class="w3-xlarge blue-text">{{ $current->name }}</i></b></p>
                                 @endforeach
                                <div class="row">
                                    <div class="col s12 m10 offset-m1 w3-center w3-small">
                                        <ul class="w3-ul">
                                            <li class="w3-center blue-text">Subject Name/Code <i class="fa fa-arrow-right teal-text"></i>
                                                Subject Class <i class="fa fa-arrow-right teal-text"></i>
                                                Class Background <i class="fa fa-arrow-right teal-text"></i>
                                                Class Sector
                                            </li>
                                            <?php $user_subject =DB::table('subject_teacher')->where('teacher_id', $user->id)->get(); ?>
                                            @foreach ($user_subject as $k => $sub)
                                                <?php $subjects = App\Subject::where('id', $sub->subject_id)->get(); ?>
                                                @foreach ($subjects as $subject)
                                                    <li>{{ $k + 1 }}).
                                                        {{ $subject->name }}/{{ $subject->code }} <i class="fa fa-arrow-right teal-text w3-tiny"></i>
                                                        {{ $subject->form->name }} <i class="fa fa-arrow-right teal-text w3-tiny"></i>
                                                        {{ $subject->form->background->name }} <i class="fa fa-arrow-right teal-text w3-tiny"></i>
                                                        {{ $subject->form->background->sector->name }}
                                                    </li>
                                                @endforeach
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </table>
        </div>
            {{ $teachers->onEachSide(5)->links() }}
    </div>
</div>
<script>
    function myFunction() {
      // Declare variables
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
    function myFunctionn() {
      // Declare variables
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInputt");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[3];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
</script>
@endsection
