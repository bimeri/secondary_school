@extends('admin.layout')
@section('title') View Student @endsection
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
<p class="w3-center">@lang('messages.welcome')</p>
<div class="row w3-margin-top">
    @include('admin.public.includes.select_class')

    <div class="col s11 m10 w3-border-t offset-m1 w3-padding white w3-margin-bottom radius w3-margin-left" style="margin-top: -13px">
        @if ($count == 0)
        <div class="red lighten-4 red-text w3-padding w3-border w3-center bold w3-margin-bottom">No record found, please search again</div>
        @else
        <div class="green lighten-4 green-text w3-padding w3-border w3-center w3-margin-bottom">All <b>{{ $form->name }}</b> Students from <b>{{ $form->background->name }}/{{ $form->background->sector->name }}</b> for the academic year: <b>{{ $years->name }}</b></div>

        <div class="col s12 m12" style="overflow-x:auto !important;">
            <table id="myTable" class="w3-table w3-striped w3-border-t" style="font-size: 13px !important;">
                <tr class="teal">
                    <th>S/N</th>
                    <th>Class Name</th>
                    <th>Class Type</th>
                    <th>Number of Students</th>
                    <th colspan="3">Action</th>
                </tr>
                <tbody id="clear">

                    @foreach ($data as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value['className'] }}</td>
                    <td>{{ $value['classType'] }}</td>
                    <td>{{ $value['students'] }}</td>
                    <td>
                    <a href="{{ route('view.student.class', ['yearId' => Crypt::encrypt($value['yearId']), 'subform_id' => Crypt::encrypt($value['subId']), 'formId' => Crypt::encrypt($value['formId']) ]) }}" class="btn orange orange-text lighten-4 waves-light waves-effect">view students <i class="fa fa-eye w3-small"></i></a>
                    </td>
                    <td>
                    <a href="{{ route('export.excel.student', ['yearId' => Crypt::encrypt($value['yearId']), 'subform_id' => Crypt::encrypt($value['subId']), 'formId' => Crypt::encrypt($value['formId']) ]) }}" class="btn green lighten-4 green-text waves-light waves-effect">class list <i class="fa fa-file-csv w3-small"></i></a>
                    </td>
                    <td>
                    <a class="btn blue blue-text lighten-4 waves-light waves-effect">print <i class="fa fa-file-pdf w3-small"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@endsection
