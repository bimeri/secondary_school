@extends('admin.layout')
@section('title') Select Subjects @endsection
@section('content')
<p class="w3-center">@lang('messages.welcome')</p>
{{--  model to assign subjects  --}}
<div class="row w3-margin-top">
    <div class="col s11 m10 w3-border-t offset-m1 w3-padding white w3-margin-bottom radius w3-margin-left" style="margin-top: -13px">

    <h4 class="w3-center teal-text">Select the Subjects to be assign to <b class="upper">{{ $teacher->full_name }}.</b> </h4>
    <hr style="border-top: 1px solid orange">

    <form method="" action="">
        @csrf
        <div class="row" style="font-size: 16px !important">
            <div class="col m4 s12">
                <select name="sector" class="browser-default" id="sector" onchange="getBackground(event)">
                    <option value="" disabled selected>select the Sector</option>
                  @foreach (App\Sector::all() as $sector)
                    <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                  @endforeach
                </select>
            </div>
            <div class="col s12 m4" id="backgrounds">
                <select class="browser-default" name="background" id="background" required onchange="getclasses(event)">
                    <option value="">select the Background</option>
                </select>
            </div>

            <div class="col s12 m4" id="classes" onchange="getClasses(event)">
                <select class="browser-default" name="class" id="form" required>
                    <option value="">select the Class</option>
                </select>
            </div>
        </div>
    </form>

    <div class="row" id="error">
    </div>
        <form action="{{ route('teacher.subject') }}" method="post" id="subject_hide">
            @csrf
            <input type="hidden" name="user_name" value="{{ $teacher->id }}">
            <div class="row">
                <div class="col s12">
                    <h6 class="center green-text">Select the Subject</h6>
                </div>
            </div>
            <div class="row">
                <ul class="w3-ul">
                    <li class="w3-center blue-text">Subject Name/Code <i class="fa fa-arrow-right teal-text"></i>
                        Subject Class <i class="fa fa-arrow-right teal-text"></i>
                        Class Background <i class="fa fa-arrow-right teal-text"></i>
                        Class Sector
                    </li>
                    <div id="response"></div>
                </ul>
            </div>
            <div class="col s6 m3 offset-m4 offset-s3 w3-center" style="margin-top: 4px !important">
                <button class="btn teal waves-effect waves-light w3-small" type="submit">Save subjects</button>
            </div>
        </form>
    </div>
</div>
<a class="btn black white-text" href="{{ route('admin.subject.assign') }}" onclick="load()" style="position: fixed; bottom:50px; left: 10px; z-index:10"><i class="fa fa-arrow-circle-left"></i> Go back</a>
<script>
    $('#error').hide();
    $('#subject_hide').hide();
   function getClasses(e) {
        $('#error').hide();
        $('#subject_hide').hide();
        $('#response').empty();
        var valu = e.target.value;
        $.ajax({
            type: "post",
            url: "{{ route('subject.class.get') }}",
            dataType: 'json',
            data: {
                '_token': '{{ csrf_token() }}',
                info: valu
            },
            success: function(res){
                if(res.length > 0) {
                $('#response').append(res);
                $('#subject_hide').show();
                } else {
                    $('#response').empty();
                    $('#error').empty();
                    $('#error').show();
                    $('#error').append("<h5 class='w3-padding center w3-border red-text'>No Subjects for the class Selected</h5>");
                }
            },
            error: function(error){
                console.log("some error occur", error);
            }
        });
    }
</script>
@endsection
