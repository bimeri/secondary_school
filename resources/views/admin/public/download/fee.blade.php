<style>
.row {
  margin-left: auto;
  margin-right: auto;
  margin-bottom: 20px;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

.container {
  margin: 0 auto;
  max-width: 1280px;
  width: 90%;
}

@media only screen and (min-width: 601px) {
  .container {
    width: 85%;
  }
}

@media only screen and (min-width: 993px) {
  .container {
    width: 70%;
  }
}
.w3-white, .w3-hover-white:hover{color:#000 !important;background-color:#fff !important}

.w3-margin{margin:16px !important}
.w3-border{border:1px solid #ccc !important}
.w3-circle{border-radius:50% !important}
.w3-center{text-align:center !important}
.w3-medium{font-size:15px !important}
.w3-left{float:left !important}.w3-right{float:right !important}


.row .col {
  float: left;
  box-sizing: border-box;
  padding: 0 0.75rem;
}


.row .col.s12 {
  width: 100%;
  margin-left: auto;
  left: auto;
  right: auto;
}


@media only screen and (min-width: 601px) {
  .row .col.m1 {
    width: 8.3333333333%;
    margin-left: auto;
    left: auto;
    right: auto;
  }

  .row .col.m12 {
    width: 100%;
    margin-left: auto;
    left: auto;
    right: auto;
  }

}

@media only screen and (min-width: 993px) {
  .row .col.l1 {
    width: 8.3333333333%;
    margin-left: auto;
    left: auto;
    right: auto;
  }

  .row .col.l12 {
    width: 100%;
    margin-left: auto;
    left: auto;
    right: auto;
  }



}

.download{
    min-height: 400px;
    width: 70%;
    position: relative;
    margin-top: 10px;


}
.view-box{
  box-shadow: 0px 0px 4px 4px rgba(0,0,0,0.2);
}

.border{
  border-left: 3px solid #000; border-top: 3px solid #000; border-bottom: 3px solid #000; border-right: 3px solid #000;
}
.divide{
  border-bottom: 0.1px solid  #000 !important;
}
.circle {
  border-radius: 50%;
}
.center, .center-align {
  text-align: center;
}

.left {
  float: left !important;
}

.right {
  float: right !important;
}
.white {
  background-color: #FFFFFF !important;
}

.white-text {
  color: #FFFFFF !important;
}
.blue-text {
  color: #2196F3 !important;
}
#bord{
    border: 1px solid #ccc;
    margin: 5px;
}
table, th, td tr {
  border: 1px solid black;
}

table {
  width: 100%;
}

tr {
  height: 120px;
}
tr, td {
  text-align: center !important;
}

.upper{
  text-transform: uppercase;
  font-weight: bold;
}
.teal {
  background-color: #009688 !important;
  color: white;
}
td, th, tr{
        border: 1px solid black !important;
    }
.tr{
    text-align: center;
    background-color: #b2dfdb !important;
  color: #009688 !important;
}

.gr{
    text-align: center;
    background-color: #C8E6C9 !important;
    color: #4CAF50 !important;
}
</style>
<div class="container w3-white view-box" style="width: 95%; margin-top: 0px;">
    <div id="bord">
        <center>
            <img src="./image/logo/logo.png" class="w3-circle w3-center w3-margin" width="150" height="150">
        </center>
    </div>
    <center>
    <em style="font-size: 25px; font-weight: bold;">School Fee Receipt</em>
    </center><br><hr class="divide">

    <p class="w3-medium right w3-margin">
    <b class="w3-margin">printed date:</b> <small> {{ date('M j, Y h:i a', strtotime( Carbon\Carbon::now())) }}</small>
    </p>
<br><br>

<p class="left w3-margin" style="font-size: 17px">
    Receipt Number : <b>{{ 'reciet_number' }}</b><br>
    Student Name: <b style="text-transform: uppercase;">
        {{ $student->student->full_name }} {{ $student->student_school_id }}/{{ $studentClass->name }} {{ $student->subform_id ? $student->subform->type:'A' }}</b>
</p> <p><br><br></p>

<table class="w3-table w3-striped w3-border-t" style="font-size: 16px !important;">
    <tr class="tr">
        <td colspan="9">
            Total Amount Paid for Fees for the  academic year: <b>{{ $year }}: {{ $total_amount }} XCFA</b>
        </td>
    </tr>
    <tr class="teal">
        <th>S/N</th>
        <th>year</th>
        <th>Payment Date</th>
        <th>Fee Type</th>
        <th>Payment Method</th>
        <th>Amount</th>
        <th>Amount Paid</th>
        <th>Scholarship</th>
        <th>Status</th>
    </tr>
    @foreach ($details as $key => $detail)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $detail->year->name }}</td>
        <td>{{ $detail->payment_date }}</td>
        <td>{{ $detail->feetype->fee_type }}</td>
        <td>{{ $detail->payment_method }}</td>
        <td>{{ $detail->feetype->amount }}</td>
        <td>{{ $detail->amount }}</td>
        <td>
            @if ($detail->scholarship == 0 || null)
            <b class="orange-text">No Scholarship</b>
            @else
            {{ $detail->scholarship }}
            @endif
        </td>
        <td>0</td>
    </tr>
    @endforeach
    <tr class="gr">
        <td colspan="9">
            School Fee Reccommedation, weather complete or not. still to Implement
        </td>
    </tr>
</table>
</div>

<div class="row">
    <div class="col s11 m10 white w3-margin-bottom radius w3-margin-left" style="margin-top: -13px">
        <div class="row">
            <div class="col s12 m12">

            </div>
        </div>
    </div>
</div>


<script type="text/php">
    if(isset($pdf)){
    $text = "page {PAGE_NUM} / {PAGE_COUNT}";
    $size = 10;
    $font = $fontMetrics->getFont("Verdana");
    $width = $fontMetrics->get_text_width($text, $font, $size)/2;
    $x = ($pdf->get_width() - $width) / 2;
    $y = $pdf->get_height() - 35;
    $pdf->page_text($x, $y, $text, $font, $size);
  }
</script>
