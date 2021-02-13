@extends('student.layout')
@section('title') {{ __('home') }} @endsection
@section('style')
<style>
td, th, tr{
    border-collapse: collapse;
    border: 1px solid black !important;
    font-size: 14px !important;
    text-align: center !important;
}
a.link{
    color: #293a86;
    text-decoration: underline;
}
</style>
@endsection
@section('content')
<div class="row">
    @if ($paidFee == $sumFee && $paidFee != 0)
        <div class="w3-padding green col s12 m10 offset-m1 white-text center w3-margin-bottom" style="border-radius: 20px">
            <b>You have completed School fees for the academic year: {{ $year }}</b>
        </div>
    @else
        <div class="w3-padding red col s12 m10 offset-m1 white-text center w3-margin-bottom">
            <b>You have not yet completed School fees for the academic year: {{ $year }} </b> <a href="#" class="link right">see details</a>
        </div>
    @endif

    <div class="col s12 m10 w3-border-s offset-m1 radius white">
        <div class="row">
            <div class="col s12 m8 offset-m2 w3-padding" style="overflow-x:auto !important;">
                <div class="black-text center w3-padding" style="background-color: #e6e6e6">
                    <b>{{ $motto }}</b><hr>
                    <h4 class="center">School Profile</h4>
                    <div class="row">
                        <div class="col s12 m4 green-text">School Start-Time <br>{{ $setting->start_time }}</div>
                        <div class="col s12 m4 orange-text">School Break-Time <br>{{ $setting->break_time }}</div>
                        <div class="col s12 m4 red-text">School Stop-Time <br>{{ $setting->stop_time }}</div>
                    </div><hr>
                </div>
            </div>
        </div>
        <div class="col s12 m10 offset-m1 w3-margin-bottom">
            <div class="blue w3-padding" style="color: #fff">
                <h4 class="w3-center">{{ $studentinfo->student->full_name }}'s Personal Profile</h4>
            </div>
            <div class="w3-padding col s12 m4 w3-card-4">
                <div class="w3-padding">
                    <img src="{{ URL::asset('image/students/'.$enrolledYear.'/'.$studentinfo->profile.'') }}" class="w3-rounded" height="240" width="240">
                </div>
                <p><b class="upper orange-text  w3-large">{{ $studentinfo->student->full_name }}</b></p>
            </div>
            <div class="col s12 m8 w3-padding w3-border">
                <p class="blue-text w3-large w3-center">Personal Information</p><hr class="divide">
                <div class="w3-left" style="margin-left: 10%">
                    <p><i class="blue-text w3-medium">First Name:</i>
                        <?php $fname = explode(' ',trim($studentinfo->student->full_name));
                            echo    '<b><i class="black-text">'.$fname[0].'</i></b><br>
                                    <i class="blue-text w3-large">Last Name:
                                    <b class="black-text">'.$fname[1].'</b></i> '
                        ?>
                    </p>

                    <i class="blue-text w3-medium left">Full Name:</i> &nbsp;&nbsp;{{ $studentinfo->student->full_name }}<br>
                    <i class="blue-text w3-medium">School ID:&nbsp;&nbsp;</i> {{ $studentinfo->student_school_id }}<br>
                    <i class="blue-text w3-medium">Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i> {{ $studentinfo->student->email }}<br>
                    <i class="blue-text w3-medium">Gender:&nbsp;&nbsp;&nbsp;&nbsp;</i> {{ $studentinfo->gender }}<br>
                    <i class="blue-text w3-medium">Admitted:&nbsp;&nbsp;</i> {{ $studentinfo->student->date_enrolled }} <br>
                    <i class="blue-text w3-medium">Class:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i> {{ $studentinfo->form->name }} {{  $studentinfo->subform_id ? $studentinfo->subform->type:'A' }}<br>
                    <i class="blue-text w3-medium">Parent email:&nbsp;&nbsp;</i> {{ $studentinfo->parent_email ? $studentinfo->parent_email:'########' }}<br>
                    <i class="blue-text w3-medium">Parent contact:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i> {{ $studentinfo->parent_contact ? $studentinfo->parent_contact:'########' }}<br>
                    <i class="blue-text w3-medium">Address:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i> {{ $studentinfo->address ? $studentinfo->address:'########' }}<br>
                    <i class="blue-text w3-medium">Date of birth:&nbsp;&nbsp;&nbsp;&nbsp;</i> {{ $studentinfo->date_of_birth }}<br>
                    <br><hr style="border-top:1px solid black; position: absolute;">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
