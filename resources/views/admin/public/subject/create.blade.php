@extends('admin.layout')
@section('title') Create Subject @endsection
@section('content')
<p class="w3-center">@lang('messages.select_subject')</p>
<div class="row">
    <div class="col s11 m10 w3-border-t offset-m1 radius white w3-margin-left">
        <form action="{{ route('subject.create.select') }}" method="get" role="form">
            {{ csrf_field() }}
            <div class="row w3-margin-top">
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

                <div class="col s12 m3" id="classes" name="formId">
                    <select class="browser-default" name="class" id="form" required>
                        <option value="">select the Class</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col m2 m3 right offset-m3" id="submit">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Add subject</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
 $('#').hide();
    function getBackground(e) {submit
        $('#background').empty();
        var valu = e.target.value;
        $.ajax({
            type: "post",
            url: "{{ route('background.ajax.get') }}",
            dataType: 'json',
            data: {
                '_token': '{{ csrf_token() }}',
                info: valu
            },
            success: function(res){
                if(res.length > 0) {
                $('#background').append(res);
                } else {
                $('#background').append("<option value=''>Sector have no Background</option>");
                }
                console.log('the response is', res);
                $tablerow = ''
                $('#clear').empty();
                $('#clear').html = '';
            },
            error: function(error){
                console.log("some error occur", error);
            }
        });
    }

    function getclasses(e) {
        $('#form').empty();
        $('#submit').show();
        var bgId = e.target.value;
        $.ajax({
            type: "post",
            url: "{{ route('classes.ajax.get') }}",
            dataType: 'json',
            data: {
                '_token': '{{ csrf_token() }}',
                info: bgId
            },
            success: function(response){
                if(response.length > 0) {
                $('#form').append(response);
                } else {
                $('#form').append("<option value=''>Background has no Class</option>");
                }
            },
            error: function(error){
                console.log("some error occur", error);
            }
        });
    }

    function myFunctionn() {
        var item = $('#myInputt').val();
        $.ajax({
            type: "post",
            url: "{{ route('live.search.student') }}",
            dataType: 'json',
            data: {
                '_token': '{{ csrf_token() }}',
                info: item
            },
            success: function(res){
                //console.log('the response is', res);
                $tablerow = ''
                $('#clear').empty();
                $('#clear').html = '';
            },
            error: function(error){
                console.log("some error occur", error);
            }
        });
    }
</script>
@endsection
