@extends('teacher.layout')
@section('title') {{ __('teacher_subjects') }} @endsection
@section('content')
<div class="row w3-margin-top">
    <div class="col s11 m10 w3-border-teacher offset-m1 radius white">
        <div class="col s12 m12 w3-padding" style="overflow-x:auto !important;">
            <div class="green lighten-4 green-text center">
                All Subjects assign for the academic year : <b>{{ $year }}</b>
            </div>
            <table class="w3-table w3-striped w3-border-teacher" style="font-size: 15px !important;">
                <tr class="teacher">
                    <th>S/N</th>
                    <th>Subject Name</th>
                    <th>Subject Code</th>
                    <th>Subject coefficient</th>
                    <th>Subject Class/background</th>
                    <th colspan="3">Action</th>
                </tr>
                <tbody id="clear">
                    @if ($counter > 0)
                    @foreach ($subjects as $key => $subject)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $subject['sub_name'] }}</td>
                        <td>{{ $subject['sub_code'] }}</td>
                        <td>{{ $subject['sub_coff'] }}</td>
                        <td>{{ $subject['class'] }}</td>
                        <td><a class="w3-btn w3-teal w3-teacher w3-small lighten-1 waves-effect waves-light">Assignment <i class="fa fa-wrench w3-small"></i></a></td>
                        <td><a class="w3-btn w3-orange w3-text-white w3-small lighten-1 waves-effect waves-light">Videos <i class="fa fa-play-circle w3-small"></i></a></td>
                        <td><a href="{{ route('teacher.upload.file', ['subjectId' => Crypt::encrypt($subject['sub_id']), 'yearId' => Crypt::encrypt($yearId)]) }}" class="w3-btn w3-green w3-small lighten-1 waves-effect waves-light">Note <i class="fa fa-book w3-small"></i></a></td>
                    </tr>
                    @endforeach
                    @else
                        <tr class="red lighten-4 red-text">
                            <td colspan="8">
                                <div class="center" style="font-size: 16px !important">
                                    There is no subject assign for the academic year : <b>{{ $year }}</b>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
