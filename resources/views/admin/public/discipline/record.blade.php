@extends('admin.layout')
@section('title') record discipline @endsection
@section('content')
<p class="w3-center">@lang('messages.welcome')</p>
<div class="row">
    <div class="col s12 m10 offset-m1 orange lighten-4 orange-text">
        <span onclick="this.parentElement.style.display='none'" class="w3-close right red-text w3-hover w3-medium w3-padding-16" style="cursor: pointer">&times;</span>
            <h5 class="w3-center w3-medium w3-padding bold">{{ __('messages.student_discipine_header') }}
            </h5>
        </div>
    <div class="col s11 w3-margin-left m10 w3-border-t offset-m1 w3-padding white w3-margin-bottom radius" style="margin-top: 5px">
        <form action="{{ route('save.student.discipline') }}" method="post">
            @csrf
            <div class="row">
                <div class="col m3 s12 browser-default">
                    <input list="students" name="student_name" id="student_name">
                    <datalist id="students">
                        <option value="" selected>select Students</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->full_name }}/{{ $student->school_id }}"></option>
                        @endforeach
                    </datalist>
                    <label for="student_name">Select Student</label>
                </div>
                <div class="input field col s12 m3">
                    <select name="year_id">
                        <option value="{{$current_year->id}}">{{ $current_year->name}}</option>
                        @foreach($years->where('id', '!=', $current_year->id) as $year)
                        <option value="{{$year->id}}">{{ $year->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input field col s12 m3">
                    <select name="term_id">
                        <option value="{{$current_term->id}}">{{ $current_term->name}}</option>
                        @foreach($terms->where('id', '!=', $current_term->id) as $tm)
                        <option value="{{$tm->id}}">{{ $tm->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input field col s12 m3">
                    <select name="dicipline_id">
                        <option value="" selected>select type</option>
                        @foreach($disciplines as $dis)
                        <option tooltip="{{ $dis->description }}" value="{{$dis->id}}">{{ $dis->type}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col m5 s12 offset-m3 input-field">
                    <label for="textarea1">Enter the Consequences (optional)</label>
                    <textarea class="materialize-textarea" name="consequences" id="textarea1" length="10"></textarea>
                </div>
            </div>
            <div class="row">
                <button type="submit" class="btn btn-primary waves-effect waves-light col offset-m3 offset-s3" style="width: 40%">Add Type</button>
            </div>
        </form>
    </div>
</div>
@if($records->count() > 0)
<div class="row">
    <div class="col s12 m10 offset-m1" style="overflow-x:scroll !important;">
        <table id="myTable" class="w3-table w3-striped w3-border-t" style="font-size: 13px !important;">
            <tr class="teal">
                <th>S/N</th>
                <th>Year</th>
                <th>Term</th>
                <th>Student Name</th>
                <th>Student Id</th>
                <th>Discipline</th>
                <th>Consequence</th>
                <th colspan="2">Action</th>
            </tr>
            @foreach ($records as $key => $record)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $record->year->name }}</td>
                <td>{{ $record->term->name }}</td>
                <td>{{ $record->student->full_name }}</td>
                <td>{{ $record->student->school_id }}</td>
                <td>{{ $record->discipline->type }}</td>
                <td>{{ $record->consequences }}</td>
                <td><button class="btn my-orange waves-light waves-effect capitalize modal-trigger"  href="#modal{{  $key + 1 }}">Edit <i class="fa fa-pencil-alt w3-small"></i></button></td>
                <td>
                    <form action="{{ route('delete.student.discipline') }}" method="post" id="form{{ $record->id }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $record->id }}">
                        <button class="btn my-red waves-light waves-effect capitalize" onclick="save{{ $record->id }}()" id="btn-submit{{ $record->id }}">Delete <i class="fa fa-trash w3-small"></i></button>
                    </form>
                </td>
            </tr>
            <script>
                function save{{ $record->id }}(){
              $(document).on('click', '#btn-submit{{ $record->id }}', function(e) {
                  e.preventDefault();
                 swal({
                        title: "Are you sure you want to delete?",
                        text: "You are allow to delete class for now but as soon as student registered to this class, you won't be able!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
              }).then(function (willUpdate) {
                if (willUpdate) {
                  swal("Poof! The Record {{ $record->discipline->type }} for {{ $record->student->full_name }} has been deleted successfully", {
                    icon: "success",
                  });
                  $('#form{{ $record->id }}').submit();
                } else {
                  swal("the record {{ $record->discipline->type }} for {{ $record->student->full_name }} remain unchanged!");
                }
                  });
              });
              }
              </script>
            @endforeach
        </table>
    </div>
</div>
@endif
<script>
    $(document).ready(function(){
        $.ajax({
        url: "{{ route('get.student.all') }}",
        method: 'get',
        data: '',
        success: function(response){
            //console.log('the students are', response);
            $('input.autocompletey').autocomplete({
      data: {
          'noel':null,
          'coffe':null,
          'magaza':null,
        for (let i = 0; i <= response.length; i++) {
                ''+response[i].stud_name+'':null,
                }
      },
    });
        }
    });
    });

</script>
@endsection
