<?php

namespace App\Http\Controllers;

use App\Firsttermresult;
use App\Form;
use App\Generateresult;
use App\Promotion;
use App\Secondtermresult;
use App\Studentinfo;
use App\Studentresult;
use App\Subject;
use App\Term;
use App\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ClassResultController extends Controller
{
    //
    public function __construct()
    {
        return $this->middleware('auth:admin');
    }

    public function getStudentResultPerclass(Request $req){
        $year = $req['year_id'];
        $class = $req['class_id'];
        $termId = $req['term_id'];
            $resultA = Studentresult::getStudentPerClass($year, $termId, $class, 'A');
            $resultB = Studentresult::getStudentPerClass($year, $termId, $class, 'B');
            $resultC = Studentresult::getStudentPerClass($year, $termId, $class, 'C');
            $resultD = Studentresult::getStudentPerClass($year, $termId, $class, 'D');
            $resultE = Studentresult::getStudentPerClass($year, $termId, $class, 'E');
            $resultF = Studentresult::getStudentPerClass($year, $termId, $class, 'F');
            $resultG = Studentresult::getStudentPerClass($year, $termId, $class, 'G');
            $resultH = Studentresult::getStudentPerClass($year, $termId, $class, 'H');
            $resultI = Studentresult::getStudentPerClass($year, $termId, $class, 'I');

        if($resultA || $resultB){
            $message = ['message' => 'Class result generated successfully', 'alert-tpye' => 'successs'];
            return redirect()->back()->with($message);
        } else {
            $message = ['message' => 'Fail to generte class result', 'alert-tpye' => 'error'];
            return redirect()->back()->with($message);
        }
    }

    public function getClassResult(Request $req){
        $termId = $this->decryptIds($req['termId']);
        $class = $this->decryptIds($req['formId']);
        $year = $this->decryptIds($req['yearId']);
        $data['term'] = Term::getTermById($termId);
        $data['class'] = Form::getClassDetail($class);
        $data['year'] = Year::getYear($year);
        $data['resultA'] = Studentresult::getStudentClassResult($year, $termId, $class, 'A');
        $data['resultB'] = Studentresult::getStudentClassResult($year, $termId, $class, 'B');
        $data['resultC'] = Studentresult::getStudentClassResult($year, $termId, $class, 'C');
        $data['resultD'] = Studentresult::getStudentClassResult($year, $termId, $class, 'D');
        $data['resultE'] = Studentresult::getStudentClassResult($year, $termId, $class, 'E');
        $data['resultF'] = Studentresult::getStudentClassResult($year, $termId, $class, 'F');
        $data['resultG'] = Studentresult::getStudentClassResult($year, $termId, $class, 'G');
        $data['resultH'] = Studentresult::getStudentClassResult($year, $termId, $class, 'H');
        $data['resultI'] = Studentresult::getStudentClassResult($year, $termId, $class, 'I');

        return view('admin.public.result.class_result')->with($data);
    }

    public function showStudentReportCardPage(Request $req){
        $student_id = $this->decryptIds($req['studentId']);
        $form_id = $this->decryptIds($req['formId']);
        $formType = $this->decryptIds($req['form_type']);
        $year_id = $this->decryptIds($req['yearId']);
        $term_id = $this->decryptIds($req['termId']);
        $test1 = '';
        $test2 = '';
        $term1 = '';
        $data['ave'] = '';
        $data['first'] = '';
        $data['second'] = '';
        if($term_id == 1){
            $test1 = '1';
            $test2 = '2';
        }
        if($term_id == 2){
            $test1 = '3';
            $test2 = '4';
        }
        $data['t1'] = $test1;
        $data['t2'] = $test2;

        $data['year'] = Year::getYearName($year_id);
        $data['term'] = Term::getTermById($term_id);
        $data['class'] = Form::getClassDetail($form_id);
        $data['student'] = Promotion::getStudentcurrentClass($year_id, $student_id, $form_id);
        $data['studentInfo'] = Studentinfo::getStudentInfo($student_id);
        $data['formType'] = $formType;
        $subjects = Subject::getClassSubject($form_id);
        $count = count($subjects);
        $data['subjects'] = $subjects;
        $data['classResult'] = Generateresult::getClassTermResult($year_id, $term_id, $form_id);
        $data['studentResult'] = Studentresult::getStudentResult($year_id, $term_id, $form_id, $student_id);

        $data['tr'] = "<tr>";
        foreach ($subjects as $key => $subject) {
            $data['tr'] .= "
            <td>".$subject->name."</td>";
            if($term_id == 1) {
            $term1 = Firsttermresult::getStudentTest1($student_id, $form_id, $year_id, $subject->id);
            if($term1->seq1<10){
                $col1 = 'red';
            } else {
                $col1 = 'blue';
            }
            if($term1->seq2<10){
                $col2 = 'red';
            } else {
                $col2 = 'blue';
            }
            $data['tr'] .= "
            <td class='".$col1."'>".$term1->seq1."</td>
            <td class='".$col2."'>".$term1->seq2."</td>
            <td>".$term1->ave_point/$subject->coefficient."</td>
            <td>".$subject->coefficient."</td>
            <td></td>
            <td></td>
            <td>Leonard</td>
            <tr>
            <td>Average </td>";
            }
            if($term_id == 2) {
            $term2 = Secondtermresult::getStudentTest1($student_id, $form_id, $year_id, $subject->id);
            if($term2->seq3<10){
                $col3 = 'red';
            } else {
                $col3 = 'blue';
            }
            if($term2->seq4<10){
                $col4 = 'red';
            } else {
                $col4 = 'blue';
            }
            $data['tr'] .= "
            <td class='".$col3."'>".$term2->seq3."</td>
            <td class='".$col4."'>".$term2->seq4."</td>
            <td>".$term2->ave_point/$subject->coefficient."</td>
            <td>".$subject->coefficient."</td>
            <td></td>
            <td></td>
            <td>".Subject::getTeacher($subject->id)."</td>
           ";
            }
            $data['tr'] .= "</tr>";
        }
        if($term_id == 1){
            $sumOne = Firsttermresult::sumSequenceOne($student_id, $form_id, $year_id)/$count;
            $sumTwo = Firsttermresult::sumSequenceTwo($student_id, $form_id, $year_id)/$count;
            if($sumOne<10){
                $sumCol1 = 'red vold';
            } else {
                $sumCol1 = 'blue bold';
            }
            if($sumTwo<10){
                $sumCol2 = 'red bold';
            } else {
                $sumCol2 = 'blue bold';
            }
            $data['first'] = $sumOne;
            $data['second'] = $sumTwo;
        $data['ave'] =
        "<tr>
        <td>Average </td>
        <td class='".$sumCol1."'>".$sumOne."</td>
        <td class='".$sumCol2."'>".$sumTwo."</td>
        <td></td>
        <td>".Subject::sumClassCoefficient($form_id)."</td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
        ";
        }
        if ($term_id == 2) {
            $sumThree = Secondtermresult::sumSequenceThree($student_id, $form_id, $year_id)/$count;
            $sumFour = Secondtermresult::sumSequenceFour($student_id, $form_id, $year_id)/$count;
            if($sumThree<10){
                $sumCol3 = 'red bold';
            } else {
                $sumCol3 = 'blue bold';
            }
            if($sumFour<10){
                $sumCol4 = 'red bold';
            } else {
                $sumCol4 = 'blue bold';
            }
            $data['first'] = $sumThree;
            $data['second'] = $sumFour;
            $data['ave'] =
            "<tr>
            <td>Average </td>
            <td class='".$sumCol3."'>".$sumThree."</td>
            <td class='".$sumCol4."'>".$sumFour."</td>
            <td></td>
            <td>".Subject::sumClassCoefficient($form_id)."</td>
            <td></td>
            <td></td>
            <td>___________</td>
            </tr>
            ";
        }
        if($term_id == 3) {
            return view('admin.public.result.report_thid_term')->with($data);
        } else {
            return view('admin.public.result.reports')->with($data);
        }
    }

    public function decryptIds($key){
        try {
            $decrypted = Crypt::decrypt($key);
            return $decrypted;
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $notification = array('message' => 'Fail to decrypt Id, please contact the admin', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }
}
