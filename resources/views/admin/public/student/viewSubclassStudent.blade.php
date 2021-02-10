@extends('admin.layout')
@section('title') View class Student @endsection
@section('style')
<style>
    td, th, tr{
        border-collapse: collapse;
        border: 1px solid #ccc !important;
        font-size: 11px !important
    }
    .under{
        border-bottom: double 3px;
        /* text-decoration: underline double; */
    }
    .tt:hover{
        background-color: rgb(187, 231, 231);
    }
</style>
@stop

@section('content')
<div class="row">
    <div class="col s11 m10 w3-border-t offset-m1 radius white w3-margin-left">
        <div class="col s12 m12  w3-padding" style="overflow-x:auto !important;">
            <table id="myTable" class="w3-table w3-striped w3-border-t" style="font-size: 13px !important;">
                <tr class="green green-text lighten-4 center">
                    <td colspan="10">
                    All <b>{{ $clas->name }}/{{ $clas->code }} {{ $type }}</b> Students from <b>{{ $clas->background->name }}/{{ $clas->background->sector->name }}</b> for the academic year: <b>{{ $years }}</b>
                    </td>
                </tr>
                <tr class="teal">
                    <th>S/N</th>
                    <th>Full Name</th>
                    <th>School Id</th>
                    <th>Class</th>
                    <th>gender</th>
                    <th>date of birth</th>
                    <th colspan="4">Action</th>
                </tr>
                <tbody id="clear">

                    @foreach ($students as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value->student->full_name }}</td>
                    <td>{{ $value->student_school_id }}</td>
                    <td>{{ $value->form->name }}</td>
                    <td>{{ $value->gender }}</td>
                    <td>{{ date('D d, M-yy', strtotime($value->date_of_birth)) }}</td>
                    {{-- manage student privilege --}}
                    <td>
                        <button class="btn w3-tiny blue lighten-4 blue-text waves-effect waves-light">view <i class="fa fa-eye w3-tiny"></i></button>
                    </td>
                    {{-- edit --}}
                    <td>
                        <button href="#modal{{ $key+1 }}" class="modal-trigger btn w3-tiny orange lighten-4 orange-text waves-effect waves-light">edit <i class="fa fa-pen w3-tiny"></i> </button>
                    </td>
                    @include('admin.public.includes.edit_student_modal')
                    {{-- suspend --}}
                    <td>
                        <form action="{{ route('student.suspend') }}" method="post" id="form{{ $key + 1 }}">
                            @csrf
                            <input type="hidden" value="{{ $value->student->id }}" name="studentId">
                            @if($value->student->suspend == 1)
                                <button class="btn w3-tiny red lighten-4 red-text waves-effect waves-light">unsuspend <i class="fa fa-unlock w3-tiny"></i> </button>
                            @else
                                <button class="btn w3-tiny red lighten-5 pink-text waves-effect waves-light" onclick="suspend{{ $key + 1 }}()" id="btn-submit{{ $key + 1 }}">suspend <i class="fa fa-lock w3-tiny"></i> </button>
                            @endif
                        </form>
                        {{-- suspend alert --}}
                        @include('admin.public.includes.alert.suspend_alert')
                    </td>

                    <td>
                        <form action="{{ route('student.dismiss') }}" method="post" id="forms{{ $key + 1 }}">
                            @csrf
                            <input type="hidden" value="{{ $value->student->id }}" name="studentId">
                            @if($value->student->dismissed == 1)
                                <button class="btn w3-tiny red lighten-4 red-text waves-effect waves-light">dismissed <i class="fa fa-close w3-tiny"></i> </button>
                            @else
                                <button class="btn w3-tiny red waves-effect waves-light" onclick="dismiss{{ $key + 1 }}()" id="btn-submits{{ $key + 1 }}">Dismiss <i class="fa fa-times w3-tiny"></i> </button>
                            @endif
                        </form>
                        {{-- dismiss alert --}}
                        @include('admin.public.includes.alert.dismiss_alert')
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
