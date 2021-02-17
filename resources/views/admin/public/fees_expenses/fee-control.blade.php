@extends('admin.layout')
@section('title') Fee control @endsection
@section('content')
<p class="w3-center">@lang('messages.welcome')</p>
<div class="row">
    <div class="col s11 w3-margin-left m10 w3-border-t offset-m1 w3-padding white w3-margin-bottom radius" style="margin-top: 5px">
        <form action="" method="" id="forms">@csrf
            <div class="row" style="font-size: 16px !important">
                <div class="col m3 s12">
                    <select name="year" class="browser-default">
                        <option value="{{ $current_year->id }}">{{ $current_year->name }}</option>
                        @foreach (App\Year::all() as $year)
                            <option value="{{ $year->id }}">{{ $year->name }}</option>
                        @endforeach
                    </select>
                </div>
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

                <div class="col s12 m3" id="classes" onchange="submtMethod(event)">
                    <select class="browser-default" name="class" id="form" required>
                        <option value="">select the Class</option>
                    </select>
                </div>
            </div>
        </form>
        <div id="hide"><hr>
            <div id="hideContent" style="overflow-x: auto"></div><hr>
            <div id="notPaid" style="overflow-x: auto"></div>
        </div>
    </div>
</div>
<script>
    $('#hide').hide();
    function submtMethod(ev){
    document.getElementById('menu').style.display = 'block';
        $('#hide').hide();
        $('#hideContent').empty();
        $('#notPaid').empty();
        var val = ev.target.value;
        $(document).ready(function(){
                                    $.ajaxSetup({
                                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                                    });
                                    /* Submit form data using ajax*/
                                $.ajax({
                                    url: "{{ route('fees.control.post') }}",
                                    method: 'post',
                                    data: $('#forms').serialize(),
                                    success: function(response){
                                        console.log('result', response[2]);
                                        document.getElementById('menu').style.display = 'none';
                                        $('#hide').show();
                                        $('#hideContent').append(response[1]);
                                        if(response[2].length > 0) {
                                        $('#notPaid').append(response[2]);
                                        } else {
                                        $('#notPaid').append('');
                                        }
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
                                        if(response[0].type == 'error'){ toastr.info(response[0].message);}
                                        if(response[0].type == 'success'){ toastr.success(response[0].message);}
                                        if(response[0].type == 'warning'){ toastr.warning(response[0].message);}

                                        //setTimeout(function(){window.location.reload();},7000);
                                    },
                                    error: function(error){
                                        document.getElementById('menu').style.display = 'none';
                                        $('#hide').hide();
                                        $('#hideContent').empty();
                                        $('#notPaid').empty();
                                        toastr.info(error);
                                    }
                                });
                            });
    }
</script>
@endsection
