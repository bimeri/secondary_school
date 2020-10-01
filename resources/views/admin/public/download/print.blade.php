
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Receipt</title>
<link href="style.css" type="text/css" rel="stylesheet" />
<style>
body{
	font-size:16px;


}
.ff{
	width:50px;
	 height:auto;
	 padding:10px 10px;
	  border:1px solid#000;
	  text-align:center;
	  margin-left:5px;
	  float:left;

}
.s{
	width:100px;
	 height:auto;
	 padding:10px 10px;
	  border:1px solid#000;
	  text-align:center;
	   float:left;
}
.t{
	width:160px;
	 height:auto;
	 padding:10px 10px;
	  border:1px solid#000;
	  text-align:center;
	   float:left;
}
.f{
	width:190px;
	height:auto;
	 padding:10px 10px;
	  border:1px solid#000;
	  text-align:center;
	   float:left;
}
</style>
</head>

<!---
<input type="button" value="Print Ticket"
onClick="window.print()"/>
------>
<body onload="window.print();">

<div class="receipt">
<div class="mainbox">

	@if($fee)
<img src="{{ URL::asset('image/logo/header.png') }}" alt="School header" width="100%" height="100px">
<div style=" float:left; width:800px; margin-top:10px;text-align:center; background:#fff; border-bottom:1px ;height:50px;font-size:28px; ">
    <div style=" float:left; width:550px;text-align:center !important;height:34px;font-size:17px;">
    CASH RECEIPT <br>{{ $class }}<br><br>
    </div>
<div style=" float:left; width:140px; margin-top:17px;text-align:center; height:34px;font-size:18px; ">
    N<SUP>0</SUP> {{ $fee->id }} {{ $fee->student->name }}
</div>

<div style=" float:left; width:720px; margin-top:0px;text-align:center; font-family:arial; height:300px;font-size:13px;">
<div style=" float:left; width:170px; height:25px;font-size:17px;"> Received From :</div>
<div style=" float:left; width:500px;border-bottom:1px solid #000;font-weight:normal; height:25px;font-size:17px;">
    <div style=" float:left; width:300px;margin-top:3px;">
    {{ $fee->student->full_name }}
    </div>
    <div style=" float:left; width:200px;  height:25px;margin-top:3px;"></div>
</div>
<div style="clear:both; margin-top:30px; height:10px"></div>
<div style=" float:left; width:170px; height:25px;font-size:17px;"> Channel :</div>
<div style=" float:left; width:500px;border-bottom:1px solid #000;font-weight:normal; height:25px;font-size:17px;">
    <div style=" float:left; width:500px;margin-top:3px; font-size:2vw">
        <b>{{ $fee->payment_method }}</b>, Paid for: <b>{{ $fee->feetype->fee_type }}</b>
    </div>
    <div style=" float:left; width:200px;  height:25px;margin-top:3px;"></div>
</div>

<div style=" float:left; width:170px; height:25px;font-size:17px;"> Academic year:</div>
<div style=" float:left; width:500px;border-bottom:1px solid #000;font-weight:normal; height:25px;font-size:17px;">
    <div style=" float:left; width:300px;margin-top:3px;">
    {{ $fee->year->name }}
    </div>
    <div style=" float:left; width:200px;  height:25px;margin-top:3px;"></div>
</div>


<div style=" float:left; width:700px;margin-top:15px;text-align:center; font-family:arial; height:300px;font-size:13px; ">
<div style=" float:left; width:170px; height:25px;font-size:17px;"> Amount in Figure</div>
<div style=" float:left; width:500px; height:25px;font-size:17px;">
<div style=" float:left; width:200px;border:1px solid #000;margin-top:3px;">
{{$fee->amount}} <i>frs C. F. A</i>
</div>
<div style=" float:left; width:100px;margin-top:3px;">
DATE
</div>
<div style=" float:right; width:200px;border-bottom:1px solid #000;margin-top:-20px;">
    {{ date('M d, Y - h:ia', strtotime($fee->created_at)) }}
</div>
</div>


<div style=" float:left; width:700px;margin-top:20px;text-align:center; font-family:arial; height:30px; border-bottom:none;font-size:13px; ">
    <div style=" float:left; width:170px; height:25px;font-size:17px;"> <i>Amount in Words</i></div>
    <div style=" float:left; width:500px; height:25px; border-bottom:none; font-size:16px; font-family:Chaparral Pro Light; border-bottom:1PX dashed#000">
        <i>{!! $amount_in_word !!}</i>
    </div>
   </div>
<div style=" float:left; width:170px; height:25px;font-size:17px; margin-top:10px"> <i>Balance Due</i></div>
<div style=" float:left; width:500px; height:25px; border-bottom:none; font-size:16px; font-family:Chaparral Pro Light; border-bottom:1PX dashed#000"><i>
    {!! $fee->balance.'&nbsp; FCFA' !!}</i></div>


<div style="float:left; margin:10px 30px; height:30px; "><br>

___________________<br /><br />Bursar Signature
</div>


<div style="float:right; margin:10px 30px; height:30px;"><br>

___________________<br /><br />Student Signature
</div>


</div>
</div>
</div></div>
</div>

<br><br><br><br><br><br>
<br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>
<hr style="width: 100% !important; border-bottom:dotted !important">
<br><br><br>


        <img src="{{ URL::asset('image/logo/header.png') }}" alt="School header" width="100%" height="100px">
<div style=" float:left; width:800px; margin-top:10px;text-align:center; border-bottom:1px;font-size:28px; ">
    <div style=" float:left; width:550px;text-align:center !important;height:34px;font-size:17px;">
        CASH RECEIPT <br>{{ $class }}<br><br>
        </div>

<div style=" float:left; width:140px; margin-top:17px;text-align:center; height:34px;font-size:18px; ">
    N<SUP>0</SUP> {{ $fee->id }} {{ $fee->student->name }}
</div>

<div style=" float:left; width:720px; margin-top:10px;text-align:center; font-family:arial; height:300px;
font-size:13px; ">

<div style=" float:left; width:170px; height:25px;font-size:17px;"> Received From :</div>

<div style=" float:left; width:500px;border-bottom:1px solid #000;font-weight:normal; height:25px;font-size:17px;">
    <div style=" float:left; width:300px;margin-top:3px;">
    {{ $fee->student->full_name }} / {{ $fee->student_school_id }}
    </div>
    <div style=" float:left; width:200px;  height:25px;margin-top:3px;"></div>
</div>

<div style="clear:both; margin-top:30px; height:10px"></div>

<div style=" float:left; width:170px; height:25px;font-size:17px;"> Channel :</div>

<div style=" float:left; width:500px;border-bottom:1px solid #000;font-weight:normal; height:25px;font-size:17px;">
    <div style=" float:left; width:500px;margin-top:3px; font-size:2vw">
        <b>{{ $fee->payment_method }}</b>, Paid for: <b>{{ $fee->feetype->fee_type }}</b>
    </div>
    <div style=" float:left; width:200px;  height:25px;margin-top:3px;"></div>
</div>

<div style=" float:left; width:170px; height:25px;font-size:17px;"> Academic year:</div>
<div style=" float:left; width:500px;border-bottom:1px solid #000;font-weight:normal; height:25px;font-size:17px;">
    <div style=" float:left; width:300px;margin-top:3px;">
    {{ $fee->year->name }}
    </div>
    <div style=" float:left; width:200px;  height:25px;margin-top:3px;"></div>
</div>


<div style=" float:left; width:700px;margin-top:15px;text-align:center; font-family:arial; height:300px;font-size:13px; ">
<div style=" float:left; width:170px; height:25px;font-size:17px;"> Amount in Figure</div>
<div style=" float:left; width:500px; height:25px;font-size:17px;">
<div style=" float:left; width:200px;border:1px solid #000;margin-top:3px;">
{{$fee->amount}} <i>frs C. F. A</i>
</div>
<div style=" float:left; width:100px;margin-top:3px;">
DATE
</div>
<div style=" float:right; width:200px;border-bottom:1px solid #000;margin-top:-20px;">
    {{ date('M d, Y - h:ia', strtotime($fee->created_at)) }}
</div>
</div>


<div style=" float:left; width:700px;margin-top:20px;text-align:center; font-family:arial; height:30px; border-bottom:none;font-size:13px; ">
    <div style=" float:left; width:170px; height:25px;font-size:17px;"> <i>Amount in Words</i></div>
    <div style=" float:left; width:500px; height:25px; border-bottom:none; font-size:16px; font-family:Chaparral Pro Light; border-bottom:1PX dashed#000">
        <i>{!! $amount_in_word !!}</i>
    </div>
   </div>
<div style=" float:left; width:170px; height:25px;font-size:17px; margin-top:10px"> <i>Balance Due</i></div>
<div style=" float:left; width:500px; height:25px; border-bottom:none; font-size:16px; font-family:Chaparral Pro Light; border-bottom:1PX dashed#000"><i>
    {!! $fee->balance.'&nbsp; FCFA' !!}</i></div>


<div style="float:left; margin:10px 30px; height:30px; "><br>

___________________<br /><br />Bursar Signature
</div>


<div style="float:right; margin:10px 30px; height:30px;"><br>

___________________<br /><br />Student Signature
</div>


</div>
</div>
</div></div>
</div>
@endif
