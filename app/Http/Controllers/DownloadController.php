<?php

namespace App\Http\Controllers;

use App\Fee;
use App\Feetype;
use App\Form;
use App\Setting;
use App\Studentinfo;
use App\Year;
use Illuminate\Http\Request;
use PDF;

class DownloadController extends Controller
{
    //
  public  function __construct()
    {
        return $this->middleware('auth:admin');
    }

    public function feeDownload(Request $req){
        $year = $req['year'];
        $student_id = $req['studentId'];
        $form_id = $req['form'];

        // receipt number
        $randomString = $this->generatePIN();
        $id = Setting::select('school_id')->first();
        $studentMatricule = Studentinfo::getStudentMatricule($student_id);
        $substring = substr($studentMatricule, -3);
        $receipt_number = $id->school_id.$randomString.'-'.$substring;


        $yr = Year::getYearName($year);
        $studentClass = Form::getClassDetail($form_id);
        $studentInfo = Studentinfo::getStudentInfo($student_id);
       $details = Fee::getStudentYearlyFee($year, $form_id, $student_id);
       $sumFee = Feetype::getAllFeesPerClassAndYear($year, $form_id);
       $amountPaid = Fee::getStudentYearlyFeeSum($year, $form_id, $student_id);
        view()->share(['details' => $details,
                       'total_amount' => $amountPaid,
                       'student' => $studentInfo,
                       'studentClass' => $studentClass,
                       'total_fee' => $sumFee,
                       'receipt' => $receipt_number,
                       'year' => $yr]);

        //return view('admin.public.download.fee');
            $pdf = PDF::loadView('admin.public.download.fee');
            $pdf->getDomPDF()->set_option('enable_php', true);
            return $pdf->download(''.$studentInfo->student->full_name.'.pdf');
    }

    public function printFee(Request $req){
        $feeType = $req['fee_id'];
        $fee = Fee::getFeeById($feeType);
        $studentinfo = Studentinfo::getStudentInfo($fee->student_id);
        $currentClass = Form::getClassDetail($fee->form_id);
        $classtype = $studentinfo->subform_id ? $studentinfo->subform->type:'A';
        $data['class'] = $currentClass->name." ".$classtype;

        //for this to work
        /* dd this to php.ini file or uncomment it
        extension=ext/php_intl.dll
        */
        $f = new \NumberFormatter( locale_get_default(), \NumberFormatter::SPELLOUT );
        $data['amount_in_word'] = $f->format($fee->amount)." frs";
        $data['fee'] = Fee::getFeeById($feeType);
        return view('admin.public.download.print')->with($data);
    }

    public function downloadExcel(Request $req){
        $year = $req['yearId'];
        $year_id = $year;
        $data['years'] = Year::all();
        $data['year_name'] = Year::getYearName($year);
        $data['year_id'] = $year_id;
        $data['fees'] = Fee::getYearlyFeeStatistics($year);

        $table_hear[] = array('class', 'total Student', 'Class fee',
                                'Total Amount', 'Paid Amount', 'Student completed',
                                'Percentage of student paid', 'Percentage amount Paid');

        return view('admin.public.download.excel')->with($data);
    }

    function generatePIN($digit = 4){
        $i = 0;
        $spin = "";
        while ($i < $digit) {
            $spin .= mt_rand(0,9);
            $i++;
        }
        return $spin;
    }


    function conVertNumberToWord($number){
        $one = [
            0 => 'ZERO',
            1 => 'ONE',
            2 => 'TWO',
            3 => 'THREE',
            4 => 'FOUR',
            5 => 'FIVE',
            6 => 'SIX',
            7 => 'SEVEN',
            8 => 'EIGHT',
            9 => 'NINE',
            10 => 'TEN',
            11 => 'ELEVEN',
            12 => 'TWELVE',
            13 => 'THIRTEEN',
            14 => 'FOURTEEN',
            15 => 'FIFTEEN',
            16 => 'SIXTEEN',
            18 => 'SEVENTEEN',
            19 => 'EIGHTEEN',
            "014" => 'fOURTEEN'
        ];
        $tens = [
            0 => 'ZERO',
            1 => 'TEN',
            2 => 'TWENTY',
            3 => 'THIRTY',
            4 => 'FOURTY',
            5 => 'FIFTY',
            6 => 'SIXTY',
            7 => 'SEVENTY',
            8 => 'EIGHTY',
            9 => 'NINeTY'
        ];
        $hundreds = [
            "HUNDRED",
            "THOUSAND",
            "MILLION",
            "BILLION",
            "TRILLION",
            "QUADRILLION"
        ];

        $number = number_format($number,2,".",",");
        $num_arr = explode(".", $number);
        $whole_num = $num_arr[0];
        $dec_num = $num_arr[1];

        $whole_arr = array_reverse(explode(" ",$whole_num));
        krsort($whole_arr,1);
        $rettxt = "";
        foreach ($whole_arr as $key => $i) {
            while(substr($i,0,1) == "0")
                $i = substr($i, 1, 5);

            if($i < 20){
                $rettxt .= $one[$i];
            } elseif($i < 100){
                if(substr($i,0,1)!="0") $rettxt.= $tens[substr($i,0,1)];
                if(substr($i,1,1)!="0") $rettxt.= $one[substr($i,1,1)];
            } else {
                if(substr($i,0,1)!="0") $rettxt .= $one[substr($i,0,1)]." ".$hundreds[0];
                if(substr($i,1,1)!="0") $rettxt .= " ".$tens[substr($i,1,1)];
                if(substr($i,2,1)!="0") $rettxt .= " ".$one[substr($i,2,1)];
            }
            if($key > 0){
                $rettxt .= " ".$hundreds[$key]." ";
            }
        }
        if($dec_num > 0){
            $rettxt .= " and ";
            if($dec_num < 20){
                $rettxt .= $one[$dec_num];
            } elseif($dec_num < 100){
                $rettxt .= $tens[substr($dec_num,0,1)];
                $rettxt .= " ".$one[substr($dec_num,1,1)];
            }
        }
        return $rettxt;
    }
}
