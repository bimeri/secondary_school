@extends('admin.layout')
@section('title') home @endsection
@section('content')
<p class="w3-center">@lang('messages.import_csv')</p>
{{-- added by magaza --}}
<div class="row w3-margin-top">
    <div class="col s11 m10 w3-border-t offset-m1 radius white w3-margin-left">
        <form action="" method="" enctype="multipart/form-data" id="fm">
            <div class="row w3-margin-top" style="font-size: 16px !important">
                <div class="col m3 s12">
                    <select name="sector" class="browser-default" id="sector" onchange="getBackground(event)">
                        <option value="" disabled selected>select the Sector</option>
                      @foreach (App\Sector::all() as $sector)
                        <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                      @endforeach
                    </select>
                </div>
                <div class="col s12 m3" id="backgrounds">
                    <select class="browser-default" name="background" id="background" required onchange="getclasses(event)">
                        <option value="">select the Background</option>
                    </select>
                </div>

                <div class="col s12 m3" id="classes">
                    <select class="browser-default" name="class" id="form" required>
                        <option value="">select the Class</option>
                    </select>
                </div>
                <div class="col s12 m3" id="subclass"></div>
            </div>
            <div class="row">
                <div class="col s12 m12" id="type">
                </div>
            </div>
            <center>
                <div id="submit_hidden" class="w3-padding" style="margin-top: -10px !important" style="width: 50%;">
                    <button class="btn teal waves-effect waves-light w3-medium" type="button" style="width: 40%">Import Excel file</button>
                </div>
            </center>
        </form>
    </div>
</div>
<script>
    $("#submit_hidden").hide();
  $(document).ready(function(){
      createCookie("class", document.getElementById('form').value);
  });
 function createCookie(name, valu){
    document.cookie = escape(name) + "=" + escape(valu);
 }
$('#form').on('change', function(){
    $("#subclass").empty();
    $("#submit_hidden").hide();
    $("#type").empty();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
var data = $('#fm').serialize();
var semesterid = $(this).val();
if(semesterid){
    $.ajax({
       type:"POST",
       url:"{{route('class.getsize')}}",
       data: $('#fm').serialize(),
       success:function(res){
        $("#submit_hidden").show();
        if(res){
            $("#type").empty();
                document.getElementById('subclass').style.display = 'block';
                $("#type").append("<div class='green black-text lighten-5'>"+res[2] +" </div> ");
                $('#subclass').append("<div style='width:100%'>"+
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
