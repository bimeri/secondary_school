@extends('student.layout')
@section('title') {{ __('student_subjects') }} @endsection
@section('style')
<style>
td, th, tr{
    border-collapse: collapse;
    border: 1px solid black !important;
    font-size: 14px !important;
    text-align: center !important;
}
</style>
@endsection
@section('content')
<div class="row">
    <div class="col s11 m10 w3-border-s offset-m1 radius white">
        <div class="col s12 m12 w3-padding" style="overflow-x:auto !important;">
            <table class="w3-table w3-striped w3-border-blue" style="font-size: 15px !important;">
                @if ($currentClass)
                <tr class="green lighten-4 green-text center">
                    <td colspan="8">
                        All Subjects For Class: <b>{{$currentClass->form->name}}</b> for the academic year : <b>{{ $year }}</b>
                    </td>
                </tr>
                @else
                <tr class="orange lighten-4 orange-text center">
                    <td colspan="8">
                        Your class for the academic year: <b>{{ $year }}</b> is not yet set, please Hold on or visit the Pricipal for any retification.
                    </td>
                </tr>
                @endif
                <tr class="teacher w3-blue">
                    <th>S/N</th>
                    <th>Subject Name</th>
                    <th>Subject Code</th>
                    <th>Subject coefficient</th>
                    <th>Teacher's Name</th>
                    <th colspan="3">Action</th>
                </tr>
                <tbody>
                    @if (count($subjects) > 0)
                    @foreach ($subjects as $key => $subject)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $subject->name }}</td>
                        <td>{{ $subject->code }}</td>
                        <td>{{ $subject->coefficient }}</td>
                        <td>
                            <?php
                            $tb = DB::table('teachers')->select('full_name')
                                    ->join('subject_teacher', 'subject_teacher.teacher_id', 'teachers.id')
                                    ->where('subject_teacher.subject_id', $subject->id)->get();
                                    $ar = [];
                                   foreach($tb as $t){
                                    array_push($ar, $t->full_name);
                                   }
                                   if($tb->count() == 0) {
                                       echo "Unknown";
                                   } else {
                                    echo  current($ar);
                                   }
                                 ?>
                        </td>
                        <td><a class="w3-btn w3-green w3-small lighten-1 waves-effect waves-light">Assignment <i class="fa fa-pen w3-small"></i></a></td>
                        <td><a class="w3-btn w3-pink w3-text-white w3-small lighten-1 waves-effect waves-light">Videos <i class="fa fa-play-circle w3-small"></i></a></td>
                        <td><a href="{{ route('student.get.note', ['subjectId' => Crypt::encrypt($subject->id)]) }}" class="w3-btn w3-blue w3-small lighten-1 waves-effect waves-light">Note <i class="fa fa-book w3-small"></i></a></td>
                    </tr>
                    @endforeach
                    @else
                        <tr class="red red-text lighten-4 center">
                            <td colspan="8">
                                There are no Subjects for the current academic year.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
