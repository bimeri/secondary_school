@extends('admin.layout')
@section('title') view classes @endsection
@section('style')
<style>
</style>
@endsection
@section('content')
<div class="row">
    <div class="col s11 w3-margin-left m10 offset-m1  blue blue-text lighten-4">
    <span onclick="this.parentElement.style.display='none'" class="w3-close right blue-text w3-hover w3-medium w3-padding" style="cursor: pointer">&times;</span>
        <h5 class="w3-center w3-medium bold">{{ __('messages.change_student_class') }}
        </h5>
    </div>
</div>

<div class="row">
    <div class="col s11 w3-margin-left m10 w3-border-t offset-m1 w3-padding white w3-margin-bottom radius" style="margin-top: 5px">
        @if(Session::has('notify'))
            <div class="col s12 m10 offset-m1 waves-effect waves-red red lighten-4 red-text w3-margin-top" style="border-radius: 10px;">
            <span onclick="this.parentElement.style.display='none'" class="w3-close w3-padding right white-text w3-hover">&times;</span>
                <h5 class=" w3-center">{{Session::get('notify')}}</h5>
            </div>
        @endif
        <form action="{{ route('change.student_class') }}" method="post" id="form">
            @csrf
            <div class="row">
                <div class="col m3 s12 browser-default">
                    <input list="students" name="student_name" id="student_name" onchange="dofunc(event)">
                    <datalist id="students">
                        <option value="" selected>select Students</option>
                        @foreach ($studentinfo as $students)
                            <option value="{{ $students->student->full_name }}/{{ $students->student_school_id }}"></option>
                        @endforeach
                    </datalist>
                    <label for="student_name">Select Student</label>
                </div>

                <div class="input field col s12 m5" id="cla"></div>
                <div class="input field col s12 m3" id="sub"></div>
            </div><br>
            <div class="row" id="hides">
                <div class="input-field col s12 m4">
                    <input type="hidden" name="year" value="{{ $current_year->id }}">
                    <select name="class" id="select" required>
                        <option value="" disabled selected> Class / Background / Sector</option>
                      @foreach (App\Form::all() as $form)
                      @php
                      $class_check = App\Form::where('id', $form->id)->first();
                      $student_count = App\Studentinfo::where('form_id', $form->id)->where('year_id', $current_year->id)->first();
                      @endphp
                        <option value="{{ $form->id }}">{{ $form->name }}  / {{ $form->background->name }} / {{ $form->background->sector->name }}</option>
                      @endforeach
                    </select>
                    <label>Select the new class</label>
                </div>
                <div class="input-field col s12 m4" id="subclass"></div>
                <div class="col m4 s12" id="type"></div>

                <div class="row">
                    <div class="input-field col offset-m3 s12">
                        <button class="btn teal lighten-1 waves-effect waves-light w3-medium" type="submit">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $('#hides').hide();
  function dofunc(e){
    document.getElementById('menu').style.display = 'block';
        var user = e.target.value;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
           type:"POST",
           url:"{{route('student.getDetail')}}",
           data: {'user': user},
           success:function(res){

            $('#hides').show();
            $("#cla").empty();
            $("#sub").empty();
               console.log('the response is: ',res);
            if(res[0]){
                    $("#cla").append("<div class='w3-border w3-padding green black-text lighten-5 w3-small'> Student Previous Class: <b class='green-text'>"+res[0] +"</b></br> </div> ");
                    $('#sub').append("<div class='w3-border w3-padding green black-text lighten-5 w3-small'>Class Type: <b class='green-text'>"+res[1] +"</b></br> </div> ");
            }else{
               $("#type").empty();
            }
            document.getElementById('menu').style.display = 'none';
           },
           error: function(error){
                document.getElementById('menu').style.display = 'none';
               console.log('some error occur');
               $("#cla").empty();
               $("#sub").empty();
               $("#cla").append("<div class='w3-border w3-padding red red-text lighten-5'> The Information selected matches no student, please selecrt from the list.</div> ");
           }
        });
    }
    //  new function to select vclass
    $(document).ready(function(){
          createCookie("class", document.getElementById('select').value);
      });
     function createCookie(name, valu){
        document.cookie = escape(name) + "=" + escape(valu);
     }
    $('#select').on('change', function(){
        $("#subclass").empty();
        $("#type").empty();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    var data = $('#form').serialize();
    var semesterid = $(this).val();
    if(semesterid){
        $.ajax({
           type:"POST",
           url:"{{route('class.getsize')}}",
           data: $('#form').serialize(),
           success:function(res){
               console.log('the response is: ',res);
            if(res){
                $("#type").empty();
                 console.log('result', res);
                    document.getElementById('subclass').style.display = 'block';
                    $("#type").append("<div class='w3-border w3-padding w3-margin-right green black-text lighten-5'>"+res[2] +"</br> </div> ");
                    $('#subclass').append("<div class='form-control'><label for='sub'>Select the class Type</label>"+
                    "<select class='browser-default' name='subclass' id='sub' required>"+
                    "<option value=''>select sub class</option>"+
                    " "+ res[1]+" "+
                    "</div></select> ");
            }else{
               $("#type").empty();
            }
           },
           error: function(error){
           }
        });
    }else{
        $("#type").empty();
    }

   });
</script>
@endsection
