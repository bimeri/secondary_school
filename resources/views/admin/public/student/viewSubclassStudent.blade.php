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
{{ $students }}
@endsection
