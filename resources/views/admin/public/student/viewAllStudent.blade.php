@extends('admin.layout')
@section('title') all students @endsection
@section('style')
<style>
    td, th, tr{
        border-collapse: collapse;
        border: 1px solid black !important;
        font-size: 11px !important
    }
    td{
        font-size: 3px;
    }
</style>
@endsection
@section('content')
    <p class="w3-center">@lang('messages.view_all_students')</p>
    {!! $table !!}
@endsection
