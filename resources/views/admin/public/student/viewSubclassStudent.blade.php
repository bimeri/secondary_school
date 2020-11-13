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
                    <td colspan="6">
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
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
