@extends('admin.layout')
@section('title')
{{ __('income statement') }}
@stop
@section('style')
<style>
    .st{
        font-size: 13px !important;
        color: white;
        border: none;
    }
    td, th, tr{
        border: 1px solid black !important;
        font-size: 11px !important
    }
    td:nth-child(2){
        border-left: 2px solid black !important;
    }
    /* table{
        font-size: 13px !important;
        background-image:url('image/logo/logo.png');
        background-attachment:fixed;
        background-size:100% 100%;
        background-repeat:no-repeat;
        filter: blur(8px);
        -webkit-filter: blur(8px);
    } */
</style>
@endsection
@section('content')
<p class="center">detail here</p>
<h5 class="center teal-text under"></h5>
<div class="row container">
    <table id="myTable" class="w3-table w3-border-t">
        <tr>
            <td colspan="8" class="center teal lighten-5 teal-text">{{ __('messages.income_statement_full', ['year' => $year]) }}.</td>
        </tr>
        <tr class="teal">
            <th>id</th>
            <th>Year</th>
            <th>Term</th>
            <th>Amount/XCFA</th>
            <th>Reason</th>
        </tr>
        @foreach ($expenses as $key => $type)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{ $type->year->name }}</td>
                <td>{{ $type->term->name }}</td>
                <td>{{ $type->amount }}</td>
                <td>{{ $type->reason }}</td>
            </tr>
        @endforeach
    </table>
</div>
<a href="{{ route('admin.income.statement') }}" style="position: fixed; left:30px; top:400px" class="orange white-text btn"><i class="fa fa-arrow-alt-circle-left"></i> go back</a>
@endsection
