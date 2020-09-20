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
<p class="w3-center">@lang('messages.income_statement')</p>
<form method="get" action="{{ route('get.income.statment') }}">
    @csrf
    <div class="row">
        <div class="col s12 m4 offset-m3">
            <label for="year">select the year</label>
            <select name="year" class="validate" id="year">
                <option value="{{ Crypt::encrypt($year->id) }}">{{ $year->name }}</option>
                @foreach ($all_year->where('id', '!=', $year->id) as $all)
                    <option value="{{ Crypt::encrypt($all->id) }}">{{ $all->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col s12 m2 input-field">
            <button type="submit" onclick="load()" class="btn btn-primary lighten-2 waves-effect waves-light">get Statistics</button>
        </div>
    </div>
</form>

@if($expenses->count() > 0)

<div class="row">
    <div class="col s11 m10 w3-border-t offset-m1 w3-padding white w3-margin-bottom radius w3-margin-left" style="margin-top: -13px">
        <div class="col s12 m12 refl" style="overflow-x:scroll !important;">

             <h5 class="center teal-text under">{{ __('messages.income_statement_header', ['year' => $year->name]) }}.</h5>

            <table id="myTable" class="w3-table w3-border-t" style="font-size: 13px !important;">
                <tr>
                    <td colspan="8" class="center teal lighten-5 teal-text">Total Amount giving for Scholarship: <b>{{ $scholarships }} XCFA</b></td>
                </tr>
                 <tr>
                    <td colspan="8" class="center blue blue-text lighten-4">Total Amount spend for Other Expenses: <b>{{ $expenses_sum }} XCFA</b></td>
                </tr>
                <tr class="teal">
                    <th>id</th>
                    <th>expense Type</th>
                    <th>Total Amount/XCFA</th>
                    <th colspan="2">Action</th>
                </tr>
                @foreach ($expenses_type as $key => $type)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{ $type->name }}</td>
                        <td>{{ App\Expensetype::getYearlyAmountPerExpense($year->id, $type->id) }}</td>

                        <td>
                            @if (App\Expensetype::getYearlyAmountPerExpense($year->id, $type->id) == 0)
                            <button disabled class="teal-text w3-border w3-medium w3-padding-small">More detail</button>
                            @else
                            <a href="{{ route('get.detail', ['year' => Crypt::encrypt( $year->id), 'type' => Crypt::encrypt($type->id)]) }}" class="teal-text w3-border w3-medium waves-effect waves-light w3-padding-small tt">More detail</a>
                            @endif
                        </td>
                        <td><button class="blue st waves-effect waves-light">download <i class="fa fa-download w3-small"></i></button></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

@else
<div class="row">
    <div class="col offset-m3 m6 center w3-padding waves-light waves-effect red lighten-4 red-text w3-border">
        There is no result for the academic year: {{ $year->name }}
    </div>
</div>
@endif

@endsection
