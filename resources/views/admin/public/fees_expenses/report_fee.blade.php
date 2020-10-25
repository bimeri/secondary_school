@extends('admin.layout')
@section('title') Report Fee @endsection
@section('style')
<style>

</style>
@endsection
@section('content')
<p class="w3-center">@lang('messages.welcome')</p>
<div class="row w3-margin-top">
    <div class="col s12 m10 offset-m3">
        <form action="{{ route('fees.statistics.all') }}" method="get">
            @csrf
            <div class="input-field col s12 m4">
                <select name="year" class="validate" id="year">
                    <option value="{{ $year_id }}" selected>{{ $year_name }}</option>
                    @foreach ($years as $year)
                        <option value="{{ $year->id }}">{{ $year->name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Crypt::encrypt(['id' => $user->id]) -->
            <div class="input-field col s12 m3 offset-m1">
                <button type="submit" class="btn teal waves-effect waves-light lighten-3">Get Statistics</button>
            </div>
        </form>
    </div>
    <div class="col s11 m10 w3-border-t offset-m1 w3-padding white w3-margin-bottom radius w3-margin-left" style="margin-top: -13px">
        @if(Session::has('message'))
            <div class="col s12 m10 offset-m1 waves-effect waves-orange orange lighten-5 orange-text w3-margin-top" style="border-radius: 10px;">
            <span onclick="this.parentElement.style.display='none'" class="w3-close w3-padding right orange-text w3-hover">&times;</span>
                <h5 class=" w3-center">{{Session::get('message')}}</h5>
            </div>
        @endif
        <div class="col s12 m12" style="overflow-x:scroll !important; margin-top:2px">
            <b class="right teal-text">{{ $year_name }} Academic Year</b>
            <table class="w3-table w3-striped w3-border-t" style="border:1px solid black; font-size:12px !important">
                <tr style="color: white; background-color:teal">
                    <th>#</th>
                    <th>Class</th>
                    <th>Total Student</th>
                    <th>Class Fees</th>
                    <th>Total Amount</th>
                    <th>Paid Amount</th>
                    <th>Student Completed</th>
                    <th>Percentage of Studends Paid</th>
                    <th>Percentage Amount Paid</th>
                </tr>
                @foreach (App\Form::all() as $key => $form)
               @php
                $student = App\Studentinfo::where('form_id', $form->id)->where('year_id', $year_id)->count();
                $all_student = App\Studentinfo::where('year_id', $year_id)->count();
                $total_class_fee = App\Feetype::where('year_id', $year_id)->where('form_id', $form->id)->sum('amount');
                $all_total_class_fee = App\Feetype::where('year_id', $year_id)->sum('amount');
                $total_paid_amount = App\Fee::where('year_id', $year_id)->where('form_id', $form->id)->sum('amount');
                $all_total_paid_amount = App\Fee::where('year_id', $year_id)->sum('amount');
                //$all_total_amount_tobepaid = $all_student * $all_total_class_fee;
                $total_amount_tobepaid = $student * $total_class_fee;
                $total_paid_student = App\Feecontrol::where('year_id', $year_id)->where('form_id', $form->id)->count();
                $all_total_paid_student = App\Feecontrol::where('year_id', $year_id)->count();

                if($student == 0 || $total_paid_student == 0){
                    $percent_student_paid = 0;
                } else {
                    $percent_student_paid =  ($total_paid_student/ $student) * 100;
                }
                if($total_class_fee == 0 || $student == 0){
                    $percent_amount_paid = 0;
                } else {
                    $percent_amount_paid =  ($total_paid_amount/ ($student * $total_class_fee)) * 100;
                }
                // total row
                if($all_student == 0 || $all_total_paid_student == 0){
                    $all_percent_student_paid = 0;
                } else {
                    $all_percent_student_paid =  ($all_total_paid_student/ $all_student) * 100;
                }
                if($all_total_class_fee == 0 || $all_student == 0){
                    $all_percent_amount_paid = 0;
                } else {
                    $all_percent_amount_paid =  ($total_paid_amount/ ($all_student * $all_total_class_fee)) * 100;
                }
                @endphp
                   <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $form->name }}</td>
                        <td>{{ $student }}</td>
                        <td>{{ $total_class_fee }}</td>
                        <td>{{ $total_amount_tobepaid }}</td>
                        <td>{{ $total_paid_amount }}</td>
                        <td>{{ $total_paid_student }}</td>
                        <td>{{ number_format((float)$percent_student_paid, 2, '.', '') }}%</td>
                        <td>{{ number_format((float)$percent_amount_paid, 2, '.', '') }}%</td>
                   </tr>
                @endforeach
                    <tr style="background-color: rgb(172, 241, 241); color:teal">
                        <td>#</td>
                        <td><b>total</b></td>
                        <td>{{ $all_student }}</td>
                        <td>{{ $all_total_class_fee }}</td>
                        <td>#####</td>
                        <td>{{ $all_total_paid_amount }}</td>
                        <td>{{ $all_total_paid_student }}</td>
                        <td>{{ number_format((float)$all_percent_student_paid, 2, '.', ' ') }}%</td>
                        <td>{{ number_format((float)$all_percent_amount_paid, 2, '.', '') }}%</td>
                   </tr>
                   <tr>
                       <td colspan="10">
                           <div class="right">
                            <form method="#" action="#">
                                <a type="button" class="orange btn waves-effect waves-light" style="margin:5px" onmouseover="func()">Download Statistics <i class="fa fa-download w3-small"></i></a>
                                <a href="{{ route('report.fee.excel', ['yearId' => $year_id]) }}" class="teal-text w3-border w3-padding-small teal lighten-4 w3-shadow w3-margin w3-medium" onclick="load()" id="csv">CSV file <i class="fa fa-file-csv"></i></a>
                            </form>
                           </div>
                       </td>
                   </tr>
            </table>
            <div class="row"><hr>
                <div class="container w3-margin-top">
                    <ul class="tabs teal teal-text w3-border">
                        <li class="tab col s4"><a href="#t1" class="active">daily statistics</a></li>
                        <li class="tab col s4"><a href="#t2" class="">Monthly statistics</a></li>
                        <li class="tab col s4"><a href="#t3" class="">Yearly Statistics</a></li>
                    </ul>
                </div>
                {{-- daily stastistics --}}
                <div class="col s12 w3-border" id="t1">
                    <div class="row">
                        <div class="col s3 m3">
                            <div class="input-field">
                                <select class="validate browser-default" name="year">
                                    <option value="">select the year</option>
                                    @foreach($years as $year)
                                        <option value="{{ $year->id }}">{{ $year->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col s3 m3">
                            <div class="input-field">
                                <select class="validate browser-default" name="year">
                                    <option value="">select the month</option>
                                    <option value="january">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">Augut</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                </select>
                            </div>
                        </div>
                        <div class="col s3 m3">
                            <div class="input-field">
                                <select class="validate browser-default" name="year">
                                    <option value="">select the day</option>
                                    @for ($i = 0; $i < 30; $i++)
                                        <option value="{{ $i+1 }}">{{ $i+1 }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col s3 m3">
                            <div class="input-field">
                               <button class="btn green waves-effect waves-light w3-small">get statistics</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>

                {{-- monthly statistics --}}
                <div class="col s12" id="t2">
                    <div class="row">
                        <div class="col s3 m3 offset-m2">
                            <div class="input-field">
                                <select class="validate browser-default" name="year">
                                    <option value="">select the year</option>
                                    @foreach($years as $year)
                                        <option value="{{ $year->id }}">{{ $year->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col s3 m3">
                            <div class="input-field">
                                <select class="validate browser-default" name="year">
                                    <option value="">select the month</option>
                                    <option value="january">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">Augut</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                </select>
                            </div>
                        </div>
                        <div class="col s3 m3">
                            <div class="input-field">
                               <button class="btn green waves-effect waves-light w3-small">get statistics</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- yearly statistics --}}
                <div class="col s12" id="t3">
                    <div class="row">
                        <div class="col s3 m3 offset-m4">
                            <div class="input-field">
                                <select class="validate browser-default" name="year">
                                    <option value="">select the year</option>
                                    @foreach($years as $year)
                                        <option value="{{ $year->id }}">{{ $year->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col s3 m3">
                            <div class="input-field">
                               <button class="btn green waves-effect waves-light w3-small">get statistics</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
