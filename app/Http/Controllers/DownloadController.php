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

        return view('admin.public.download.fee');
            $pdf = PDF::loadView('admin.public.download.fee');
            $pdf->getDomPDF()->set_option('enable_php', true);
            return $pdf->download(''.$studentInfo->student->full_name.'.pdf');
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

    public function printFee(Request $req){
        $feeType = $req['fee_id'];
        $data['fee'] = Fee::getFeeById($feeType);
        return view('admin.public.download.print')->with($data);
    }
}
