<?php

namespace App\Http\Controllers;

use App\Fee;
use App\Form;
use App\Studentinfo;
use App\Year;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
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

        $yr = Year::getYearName($year);
        $studentClass = Form::getClassDetail($form_id);
        $studentInfo = Studentinfo::getStudentInfo($student_id);
       $details = Fee::getStudentYearlyFee($year, $form_id, $student_id);
       $amountPaid = Fee::getStudentYearlyFeeSum($year, $form_id, $student_id);
        view()->share(['details' => $details,
                       'total_amount' => $amountPaid,
                       'student' => $studentInfo,
                       'studentClass' => $studentClass,
                       'year' => $yr]);

        //return view('admin.public.download.fee');
            $pdf = PDF::loadView('admin.public.download.fee');
            $pdf->getDomPDF()->set_option('enable_php', true);
            return $pdf->download('Biaka_Transaction_detail.pdf');
    }
}
