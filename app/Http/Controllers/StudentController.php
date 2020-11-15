<?php

namespace App\Http\Controllers;

use App\Fee;
use App\Feetype;
use App\File;
use App\Firsttermresult;
use App\Promotion;
use App\Secondtermresult;
use App\Setting;
use App\Studentinfo;
use App\Subject;
use App\Term;
use App\Thirdtermresult;
use App\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class StudentController extends Controller
{
    //
    public function __construct(){
        return $this->middleware('auth:student');
    }

    public function index(){
        $data['motto'] = Setting::getSchoolMotto();
        $sum = null;
        $paid = null;
        $studentId = auth()->user()->id;
        $yearId = Year::getCurrentYear();
        $data['year'] = Year::getYearName($yearId);
        $currentClass = Promotion::where('student_id', $studentId)->where('year_id', $yearId)->first();
        if($currentClass){
        $sum = Feetype::SumClassFeePerYear($currentClass->form_id,$yearId);
        }
        $paid = Fee::getTotalFeePaid($yearId, auth()->user()->school_id);
        $data['setting'] = Setting::first();
        $data['sumFee'] = $sum;
        $data['paidFee'] = $paid;
        $studentinfo = Studentinfo::where('student_id', $studentId)->first();
        $fullYear = explode('/', trim($studentinfo->year->name));
        $data['enrolledYear'] = $fullYear[0];
        $data['studentinfo'] = $studentinfo;
        return view('student.public.home')->with($data);
    }

    public function studentSubjectPage(){
        $data['subjects'] = [];
        $yearId = Year::getCurrentYear();
        $data['year'] = Year::getYearName($yearId);
        $data['currentClass'] = Promotion::where('student_id', auth()->user()->id)->where('year_id', $yearId)->first();
        $userId = auth()->user()->id;
        $userClass = Promotion::where('student_id', $userId)->where('year_id', $yearId)->first();
        if( $userClass){
        $data['subjects'] = Subject::getClassSubject($userClass->form_id);
        }

        return view('student.public.subject')->with($data);
    }

    public function studentResultPage(){
        $data['years'] = Year::getAllYear();
        $data['terms'] = Term::getAllTerm();
        $promotions = Promotion::where('student_id', auth()->user()->id)->get();
        $data['promotions'] =$promotions;
        $result = null;
        $termId = Term::getCurrentTerm();
        $yearId = Year::getCurrentYear();
        $studentInfo = Studentinfo::where('student_id', auth()->user()->id)->first();
        $formDetail = $promotions->where('year_id', $yearId)->first();
        $formId = $formDetail ? $formDetail->form_id : $studentInfo->form_id;
        $termName = Term::getTermById($termId);
        if($termName->name == 'First Term'){
            $result = Firsttermresult::getStudentResult(auth()->user()->id, $yearId, $termId, $formId);
        } elseif($termName->name == 'Second Term'){
            $result = Secondtermresult::getStudentResult(auth()->user()->id, $yearId, $termId, $formId);
        } elseif($termName->name == 'Third Term'){
            $result = Thirdtermresult::getStudentResult(auth()->user()->id, $yearId, $termId, $formId);
        }
         $data['result']  = $result;
         $data['termName']  = $termName->name;
         $data['yearName']  = Year::getYearName($yearId);
        return view('student.public.result')->with($data);
    }


    public function studentTestResult(Request $req){
        $term_id ='';
        $year_id = '';
        $form_id = '';
        try {
            $term_id = Crypt::decrypt( $req['term']);
            $year_id = Crypt::decrypt($req['year']);
            $form_id = Crypt::decrypt($req['class']);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $notify = array('message' => 'fail to decrypt IDs please contact the administrator.', 'alert-tpye' => 'error');
            return redirect()->back()->with($notify);
        }
        $data['years'] = Year::getAllYear();
        $data['terms'] = Term::getAllTerm();
        $promotions = Promotion::where('student_id', auth()->user()->id)->get();
        $data['promotions'] =$promotions;
        $result = null;
        $termId = $term_id;
        $yearId = $year_id;
        $formId = $form_id;
        $termName = Term::getTermById($termId);
        if($termName->name == 'First Term'){
            $result = Firsttermresult::getStudentResult(auth()->user()->id, $yearId, $termId, $formId);
        } elseif($termName->name == 'Second Term'){
            $result = Secondtermresult::getStudentResult(auth()->user()->id, $yearId, $termId, $formId);
        } elseif($termName->name == 'Third Term'){
            $result = Thirdtermresult::getStudentResult(auth()->user()->id, $yearId, $termId, $formId);
        }

         $data['result']  = $result;
         $data['termName']  = $termName->name;
         $data['yearName']  = Year::getYearName($yearId);
         return  view('student.public.result')->with($data);
    }

    public function studentTeacherNote(Request $req){
        $subjectId = '';
        $yearId = Year::getCurrentYear();
        try {
            $subjectId = Crypt::decrypt($req['subjectId']);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $notify = array('message' => 'fail to decrypt IDs please contact the administrator.', 'alert-tpye' => 'error');
            return redirect()->back()->with($notify);
        }
        $data['files'] = File::where('subject_id', $subjectId)->where('year_id', $yearId)->get();

        return view('student.public.viewNote')->with($data);
    }

    public function studentFileView(Request $req){
        $fileId = '';
        $subId = '';
        $yearId = Year::getCurrentYear();
        try {
            $fileId = Crypt::decrypt($req['fileId']);
            $subId = Crypt::decrypt($req['subjectId']);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $notify = array('message' => 'fail to decrypt IDs please contact the administrator.', 'alert-tpye' => 'error');
            return redirect()->back()->with($notify);
        }
        $data['subjectDetail'] = Subject::where('id', $subId)->first();
        $data['fileDetail'] = File::where('id', $fileId)->where('year_id', $yearId)->first();

        return view('student.public.note')->with($data);
    }

}
