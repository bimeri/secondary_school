@extends('student.layout')
@section('title') {{ __('student_result') }} @endsection
@section('style')
<style>
    table{
        border-collapse: collapse;
    }
    td, tr{
        border-collapse: collapse;
        border: 1px solid black !important;
        font-size: 12px !important;
        text-align: center !important;
    }
    th{
        border: 1px solid black !important;
        font-size: 13px;
        text-align: center;
    }
    </style>
@endsection
@section('content')
<div class="row">
    <div class="col s12 m10 w3-border-s offset-m1 radius white">
        <div class="col s12 m12 w3-padding">
            <div class="row">
                <form action="{{ route('get_student.tes_result') }}" method="get">
                    @csrf
                    <div class="input-field col s12 m3">
                        <option value="{{ Crypt::encrypt($current_year->id) }}" selected>{{ $current_year->name }}</option>
                        <select name="year" id="year">
                            @foreach ($years as $year)
                                <option value="{{ Crypt::encrypt($year->id) }}">{{ $year->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-field col s12 m3">
                        <option value="{{ Crypt::encrypt($current_term->id) }}" selected>{{ $current_term->name }}</option>
                        <select name="term">
                            @foreach ($terms as $term)
                                <option value="{{ Crypt::encrypt($term->id) }}">{{ $term->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-field col s12 m3">
                        <option value="{{ Crypt::encrypt($promotions[0]['id']) }}" selected>class: {{ App\Form::getClassDetail($promotions[0]['form_id'])->name }}</option>
                        <select name="class">
                            @foreach ($promotions as $promotion)
                                <option value="{{ Crypt::encrypt($promotion->form_id) }}">{{ $promotion->year->name }}--{{ $promotion->form->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-field">
                        <button type="submit" class="col s12 m3 btn w3-blue waves-effect waves-light">Get Result</button>
                    </div>
                </form>
            </div><hr>
            <div class="row">
                <div class="col s12 m10 offset-m1">
                    @if ($result != null)
                    <h5 class="center w3-padding orange-text orange lighten-4">
                        Semester Result for <b>{{ $termName }}</b> for the academic year <b>{{ $yearName }}</b>
                    </h5>
                    @else
                    <h5 class="center w3-padding red-text red lighten-4">
                        There is no result for <b>{{ $termName }}</b>, <b>{{ $yearName }}</b>
                    </h5>
                    @endif
                </div>
            </div>
            <div class="col s12 m12 w3-padding" style="overflow-x:auto !important;">
                <div class="col s12 m6">
                    <table class="w3-table w3-striped w3-border-blue">
                        <tr class="w3-blue">
                            <td colspan="5">{{$result? $result[0][1]:'No Result' }}</td>
                        </tr>
                        <tr>
                            <th>S/N</th>
                            <th>Subject code</th>
                            <th>Subject Name</th>
                            <th>Marks</th>
                            <th>Average point</th>
                        </tr>
                        <tbody>
                                @if($result == null || $result[0][0] == 'NO_FIRST_RESULT')
                                    <tr class="red red-text lighten-4 center">
                                        <td colspan="5">
                                            Result has not yet been Published
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($result[0][0] as $key => $value)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $value['code'] }}</td>
                                            <td>{{ $value['subject'] }}</td>
                                            <td class="{{ $value['mark'] > 9 ? 'blue-text':'red-text' }}">{{ $value['mark'] == null? '0':$value['mark'] }}</td>
                                            <td class="blue-text">{{ $value['ave_point'] }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                        </tbody>
                    </table>
                </div>
                {{--  second test  --}}
                <div class="col s12 m6">
                    <table class="w3-table w3-striped w3-border-blue" style="font-size: 15px !important;">
                        <tr class="w3-blue">
                            <td colspan="5">{{ $result? $result[1][1]:'No result' }}</td>
                        </tr>
                        <tr>
                            <th>S/N</th>
                            <th>Subject code</th>
                            <th>Subject Name</th>
                            <th>Marks</th>
                            <th>Average point</th>
                        </tr>
                        <tbody>
                            @if($result == null || $result[1][0] == 'NO_SECOND_RESULT')
                                <tr class="red red-text lighten-4 center">
                                    <td colspan="5">
                                        Result has not yet been Published
                                    </td>
                                </tr>
                            @else
                                @foreach ($result[1][0] as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value['code'] }}</td>
                                        <td>{{ $value['subject'] }}</td>
                                        <td class="{{ $value['mark'] > 9? 'blue-text':'red-text' }}">{{ $value['mark'] == null? '0':$value['mark'] }}</td>
                                        <td class="blue-text">{{ $value['ave_point'] }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
