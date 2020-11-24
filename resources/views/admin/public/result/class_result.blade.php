@extends('admin.layout')
@section('title') Result @endsection
@section('style')
    <style>
        table{
        border: 1px solid black !important;
    }
    td, th, tr{
        border: 1px solid black !important;
        font-size: 13px !important
    }
    </style>
@endsection
@section('content')
<div class="row">
    <div class="col s11 m10 w3-border-t offset-m1 radius white w3-margin-left">
        <div class="center w3-padding teal teal-text lighten-4 w3-margin-top">
            Result for <b>{{ $class->name }}</b> for the academic year: <b>{{ $year->name }}</b>, <b>{{ $term->name }}</b>
        </div>
        <div class="row w3-padding" style="overflow-x: auto">
            <table class="w3-table w3-border-t" style="font-size: 15px !important;">
                <tr class="teal">
                    <th>S/N</th>
                    <th>Student Name</th>
                    <th>Average point</th>
                    <th>Average</th>
                    <th>general class Position</th>
                    <th>Individual class position</th>
                    <th>Remark</th>
                    <th>action</th>
                </tr>
                {{-- A students --}}
                @include('admin.public.includes.result.class_a')
                {{-- B students --}}
                @if($resultB->count() > 0)
                    @include('admin.public.includes.result.class_b')
                @endif
                {{-- C students --}}
                @if($resultC->count() > 0)
                    @include('admin.public.includes.result.class_c')
                @endif
                {{-- D students --}}
                @if($resultD->count() > 0)
                    @include('admin.public.includes.result.class_d')
                @endif
                {{-- E students --}}
                @if($resultE->count() > 0)
                    @include('admin.public.includes.result.class_e')
                @endif
                {{-- F students --}}
                @if($resultF->count() > 0)
                    @include('admin.public.includes.result.class_f')
                @endif
                {{-- G students --}}
                @if($resultG->count() > 0)
                    @include('admin.public.includes.result.class_g')
                @endif
                {{-- H students --}}
                @if($resultH->count() > 0)
                    @include('admin.public.includes.result.class_h')
                @endif
                {{-- I students --}}
                @if($resultI->count() > 0)
                    @include('admin.public.includes.result.class_i')
                @endif
            </table>
        </div>
    </div>
</div>
@endsection
