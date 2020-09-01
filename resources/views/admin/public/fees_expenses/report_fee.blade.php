@extends('admin.layout')
@section('title') Report Fee @endsection
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
            <div class="col s12 m10 offset-m1 waves-effect waves-orange orange lighten-4 orange-text w3-margin-top" style="border-radius: 10px;">
            <span onclick="this.parentElement.style.display='none'" class="w3-close w3-padding right white-text w3-hover">&times;</span>
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

            </table>
        </div>
        <form method="#" action="#">
            <button type="button" class="orange btn waves-effect waves-light right" style="margin:5px">Download Statistics <i class="fa fa-download w3-small"></i></button>
        </form>
    </div>
</div>
@endsection
