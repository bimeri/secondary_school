@extends('admin.layout')
@section('title') Fee statistics @endsection
@section('style')
    <style>
        .tabs .indicator{
            background-color:#ff9800;/*your color*/
            }
    </style>
@endsection
@section('content')
<h4 class="w3-center">School Fees Statistics for <b>{{ $studentinfo->student->full_name }} ({{ $studentinfo->student_school_id }})</b></h4>
<div class="left" style="position: fixed">
    <?php $enroll = explode('/', trim($studentinfo->year->name)); ?>
    <img src="{{ URL::asset('image/students/'.$enroll[0].'/'.$studentinfo->profile.'') }}" width="100" height="100" class="w3-circle w3-border-t" style="margin: 5px">
</div>
<div class="row w3-margin-top">
    <div class="col s11 m10 w3-border-t offset-m1 w3-padding white w3-margin-bottom radius w3-margin-left" style="margin-top: -13px">
        <div class="row">
            <div class="col s12 m12" style="overflow-x:scroll !important;">
                <table id="myTable" class="w3-table w3-striped w3-border-t" style="font-size: 13px !important;">
                    <tr class="teal">
                        <th>S/N</th>
                        <th>year</th>
                        <th>Payment Date</th>
                        <th>Fee Type</th>
                        <th>Amount</th>
                        <th>Amount Paid</th>
                        <th>Balance</th>
                        <th>Scholarship</th>
                        <th>Status</th>
                        <th>action</th>
                    </tr>
                    @foreach ($student_fees as $key => $fee1)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $fee1->year->name }}</td>
                        <td>{{ $fee1->payment_date }}</td>
                        <td>{{ $fee1->feetype->fee_type }}</td>
                        <td>{{ $fee1->feetype->amount }}</td>
                        <td>{{ $fee1->amount }}</td>
                        <td>{{ $fee1->balance }}</td>
                        <td>
                            @if ($fee1->scholarship == 0 || null)
                            <b class="orange-text">No Scholarship</b>
                            @else
                            {{ $fee1->scholarship }}
                            @endif
                        </td>
                        <td>@if ($fee1->status == 0)
                            <b class="red-text">Not Completed</b>
                            @else
                            <b class="green-text">Completed</b>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('downoad.print', ['fee_id' => $fee1->id]) }}" class="btn w3-small blue lighten-1 waves-effect waves-light">print</a>
                        </td>
                    </tr>
                    @endforeach
                    <?php $scholarsh = App\Fee::where('year_id',$current_year->id)->where('student_id', $studentinfo->student->id)->sum('scholarship'); ?>

                    <tr class="w3-center">
                        <td colspan="10" class="teal lighten-5">
                            <div class="row">
                                <div class="col 12 m8">
                                    Total fees for {{ $current_year->name }}:
                                    <b class="blue-text">{{ $total_fees }},</b>
                                    Student Paid: <b>{{ $total_paid }} XCFA {{ $scholarsh ? ' + Scholarship of: '.$scholarsh.' FCFA':'' }} <br><u class="w3-medium blue-text"> {{$scholarsh ?'Total: '.($total_paid + $scholarsh).' FCFA':''}}</u></b><br>
                                    <b>Status:
                                        @if($total_fees == 0)
                                            <b class="orange-text">Unavailable</b>
                                            @else
                                            @if($total_paid + $yearly_scholarship >= $total_fees)
                                                <b class="green-text w3-medium">Completed</b><br>
                                                @if(App\Feecontrol::where('year_id', $currentYear)->where('student_id', $studentinfo->student->id)->where('form_id', $current_form)->exists())
                                                        <button class="btn green waves-light lighten-1 waves-effect w3-small">Student Fee Clearance Validated <i class="fa fa-check"></i></button>
                                                    @else
                                                        <form action="{{ route('student.fee_clearance') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="student_id" value="{{ $studentinfo->student->id }}">
                                                            <input type="hidden" name="school_id" value="{{ $studentinfo->student_school_id }}">
                                                            <input type="hidden" name="form_id" value="{{ $current_form }}">
                                                            <input type="hidden" name="year_id" value="{{ $currentYear }}">
                                                            <button class="btn red waves-light lighten-1 waves-effect w3-small">Validate Student Fees Clearance</button>
                                                        </form>
                                                    @endif
                                            @else
                                                <b class="red-text w3-medium">Not Completed, Oweing: {{ $total_fees - $total_paid -  $yearly_scholarship}} FCFA</b>
                                            @endif
                                        @endif
                                    </b>
                                </div>
                                <div class="col s12 m4 w3-right">
                                    <h4 class="center"><b style="color: teal">{{ $formName }} {{ $studentinfo->subform_id ? ''.$studentinfo->subform->type.'':'A' }}</b></h4>
                                    <h6 class="center upper"><b>{{ $sectorName }} @if($sectorName)<i class="fa fa-arrow-right"></i>@endif {{ $bgName }}</b></h6>
                                    @if(App\Feecontrol::where('year_id', $currentYear)->where('student_id', $studentinfo->student->id)->where('form_id', $current_form)->exists())
                                    <form method="#" action="#">
                                        <a href="{{ route('fee.download', ['year' => $fee1->year, 'studentId' => $studentinfo->student_id, 'form' => $current_form]) }}" class="teal btn waves-effect waves-light" onmouseover="func()">Print Receipt <i class="fa fa-file-pdf w3-small"></i></a>
                                        <a href="" class="teal-text w3-margin-left w3-border w3-padding-small" id="csv" onclick="load()">CSV file <i class="fa fa-file-csv"></i></a>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <hr>

{{-- other yearly fees statistics --}}
        <div class="row">
            <div class="col s12">
              <ul class="tabs orange">
                  @foreach (App\Year::all() as $key => $y)
                <li class="tab col s2">
                    <a class="@if($y->id == $current_year->id) active @endif"
                    href="#test{{ $key + 1 }}">
                    {{ $y->name }}
                    </a>
                </li>
                  @endforeach
                </ul>
            </div>
            @foreach (App\Year::all() as $keyy => $year)
            <div id="test{{ $keyy + 1 }}" style="margin-top: 15px">
            <?php
            $formIds = array();
            $formname = array();
            $bg = array();
            $sector = array();
            $me = App\Fee::getStudentFees($student_id, $year->id);
            foreach ($me as $key => $value) {
                array_push($formIds, $value->formId);
                array_push($formname, $value->fname);
                array_push($bg, $value->bg_name);
                array_push($sector, $value->sec_name );
            }

            $formid = current($formIds);
            $form_name = current($formname);
            $bg_name = current($bg);
            $sector_name = current($sector);

            $total = App\Feetype::getAllFeesPerClassAndYear($year->id, $formid);
            $paid = App\Fee::getTotalFeePaid($year->id, $school_id);
            $scholarship = App\Scholarship::getYearlyScholarship($year->id, $student_id);
             ?>
            <div class="col s12 m12" style="overflow-x:scroll !important; margin-top:2px">
                <table id="myTable" class="w3-table w3-striped w3-border-t" style="font-size: 13px !important;">
                    <tr class="teal">
                        <th>S/N</th>
                        <th>year</th>
                        <th>Payment Date</th>
                        <th>Fee Type</th>
                        <th>Amount</th>
                        <th>Amount Paid</th>
                        <th>Scholarship</th>
                        <th>Status</th>
                        <th>action</th>
                    </tr>
                    @foreach (App\Fee::getStudentYearlyFee($year->id, $formid, $student_id) as $key => $fe1)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $fe1->year->name }}</td>
                        <td>{{ $fe1->payment_date }}</td>
                        <td>{{ $fe1->feetype->fee_type }}</td>
                        <td>{{ $fe1->feetype->amount }}</td>
                        <td>{{ $fe1->amount }}</td>
                        <td>
                            @if ($fe1->scholarship == 0 || null)
                            <b class="orange-text">No Scholarship</b>
                            @else
                            {{ $fe1->scholarship }}
                            @endif
                        </td>
                        <td>@if ($fe1->status == 0)
                            <b class="red-text">Not Completed</b>
                            @else
                            <b class="green-text">Completed</b>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('downoad.print', ['fee_id' => $fe1->id]) }}" class="btn w3-small blue lighten-1 waves-effect waves-light">print</a>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="9">
                            <div class="row">
                                <div class="col s12 m8">
                                    Total fees for {{ $year->name}}:
                                    @if($year->id == $current_year->id) <b class="blue-text">{{ $total_fees }}</b> @else <b class="blue-text">{{ $total }}</b>@endif
                                    Student Paid: <b class="blue-text">{{ $paid }} FCFA</b><br>
                                    <b>Status:
                                        @if($year->id == $current_year->id)
                                            @if($total_fees == 0)
                                                <b class="orange-text">Unavailable</b>
                                                @else
                                                @if($total_paid + $yearly_scholarship >= $total_fees)
                                                    <b class="green-text w3-medium">Completed</b><br>
                                                    @if(App\Feecontrol::where('year_id', $year->id)->where('student_id', $studentinfo->student->id)->where('form_id', $formid)->exists())
                                                        <button class="btn green waves-light waves-effect w3-small">Student Fee Clearance Validated <i class="fa fa-check"></i></button>
                                                    @else
                                                        <form method="{{ route('student.fee_clearance') }}" action="post">
                                                            @csrf
                                                            <input type="hidden" name="student_id" value="{{ $studentinfo->id }}">
                                                            <input type="hidden" name="school_id" value="{{ $studentinfo->student_school_id }}">
                                                            <input type="hidden" name="form_id" value="{{ $formid }}">
                                                            <input type="hidden" name="year_id" value="{{ $year->id }}">
                                                            <button class="btn red waves-light waves-effect w3-small">Validate Student Fees Clearance</button>
                                                        </form>
                                                    @endif

                                                @else
                                                    <b class="red-text w3-medium">Not Completed, Oweing: {{ $total_fees - $total_paid }}</br>
                                                @endif
                                            @endif
                                        @else
                                            @if($total == 0)
                                                <b class="orange-text">Unavailable</b>
                                                @else
                                                @if($paid + $scholarship >= $total)
                                                <b class="green-text w3-medium">Completed</b>
                                                @else
                                                <b class="red-text w3-medium">Not Completed, Oweing: {{ $total - $paid -  $scholarship }} FCFA</b>
                                                @endif
                                            @endif
                                        @endif
                                    </b>
                                </div>
                                <div class="col s12 m4 w3-right">
                                    @if($sector_name)
                                    <h4 class="center"><b style="color: teal">{{ $form_name }} {{ $studentinfo->subform_id ? ''.$studentinfo->subform->type.'':'A' }}</b></h4>
                                    <h6 class="center upper"><b>{{ $sector_name }}<i class="fa fa-arrow-right"></i> {{ $bg_name }}</b></h6>
                                        <a href="{{ route('fee.download', ['year' => $fe1->year, 'studentId' => $studentinfo->student_id, 'form' => $formid]) }}" class="teal btn waves-effect waves-light">Print Receipt <i class="fa fa-file-pdf w3-small"></i></a>
                                        {{-- <a href="" class="teal-text w3-margin-left w3-border w3-padding-small" id="csv" onclick="load()">CSV file <i class="fa fa-file-csv"></i></a> --}}
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        @endforeach
        </div>
    </div>
</div>

<script>
    $('#csv').hide();
    function func(){
        $('#csv').fadeIn();
    }
</script>
@endsection
