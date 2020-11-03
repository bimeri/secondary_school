<?php

namespace App\Http\Controllers;

use App\Firsttermresult;
use App\Form;
use App\Permission;
use App\Secondtermresult;
use App\Studentinfo;
use App\Subclass;
use App\Subject;
use App\Term;
use App\Thirdtermresult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class RecordController extends Controller
{
    //
    public function __construct()
    {
        return $this->middleware('auth:admin');
    }
    public function index(){
        $this->authorize('record_mark', Permission::class);

        $data['terms'] = [];
        $data['students'] = [];
        $data['sub_students'] = [];
        $data['subjects'] = [];
        $data['first'] = false;
        $data['second'] = false;
        $data['third'] = false;
        $data['class'] = [];
        $data['b_students'] = Subclass::getStudentBysubClasses('xx', 1000000);
        $data['c_students'] = Subclass::getStudentBysubClasses('xx', 1000000);
        $data['d_students'] = Subclass::getStudentBysubClasses('xx', 1000000);
        $data['e_students'] = Subclass::getStudentBysubClasses('xx', 1000000);
        return view('admin.student_marks.record_marks')->with($data);
    }

    public function getStudents(Request $req){
        $this->authorize('record_mark', Permission::class);
        try {
            $classId = Crypt::decrypt($req['class']);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $mes = array('message' => 'fail to decrypt Id, please contact the admin', 'alert-type' => 'error');
            return redirect()->back()->with($mes);
        }
        $formId =(int)$classId;
        $data['class'] = Form::where('id', $formId)->first();
        $data['subjects'] = Subject::where('form_id', $formId)->get();
        $terms = Term::where('active', 1)->first();
        $data['terms'] = Term::where('active', 1)->first();
        if($terms->name == 'First Term'){
            $data['first'] = true;
            $data['second'] = false;
            $data['third'] = false;
        }
        if($terms->name == 'Second Term'){
            $data['first'] = false;
            $data['second'] = true;
            $data['third'] = false;
        }
        if($terms->name == 'Third Term'){
            $data['first'] = false;
            $data['second'] = false;
            $data['third'] = true;
        }

        $data['students'] = Studentinfo::where('form_id', $formId)->where('subform_id', null)->get();
        $data['b_students'] = Subclass::getStudentBysubClasses('B', $formId);
        $data['c_students'] = Subclass::getStudentBysubClasses('C', $formId);
        return view('admin.student_marks.record_marks')->with($data);
    }

    public function savefirstSequence(Request $req){
        $seq = $req['seq1'];
        $studentId = (int)$req['student'];
        $sub = (int)$req['subject'];
        $yearid = (int)$req['year'];
        try {
            $decrypted_id = Crypt::decrypt($req['form']);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $mes = array('message' => 'fail to decrypt Id, please contact the admin', 'alert-type' => 'error');
            return redirect()->back()->with($mes);
        }
        $formid = (int)$decrypted_id;
        $subject = Subject::where('id', $sub)->first();
        //return $subject->coefficient;

        if(Firsttermresult::where('year_id', $yearid)
            ->where('student_id', $studentId)
            ->where('subject_id', $sub)
            ->where('form_id', $formid)
            ->exists()){
            $seqs = Firsttermresult::where('year_id', $yearid)->where('student_id', $studentId)->where('subject_id', $sub)->where('form_id', $formid)->first();
            $av_point = (((float)$seq + (float)$seqs->seq2)/2)*$subject->coefficient;
                if($seq == "0"){
                    Firsttermresult::where('year_id', $yearid)
                    ->where('student_id', $studentId)
                    ->where('subject_id', $sub)
                    ->where('form_id', $formid)
                    ->update(['seq1' => 0, 'ave_point' => $av_point]);
                    $message = array('message' => 'SEQ 1 Mark updated', 'type' => 'update', 'seq' => $seq);
                return response()->json($message);
                }
                else if($seq == null){
                    Firsttermresult::where('year_id', $yearid)
                    ->where('student_id', $studentId)
                    ->where('subject_id', $sub)
                    ->where('form_id', $formid)
                    ->update(['seq1' => null, 'ave_point' => $av_point, 'status' => 1]);
                    $message = array('message' => 'SEQ 1 Mark deleted', 'type' => 'warning', 'seq' => $seq);
                return response()->json($message);
                }
                else {
                    Firsttermresult::where('year_id', $yearid)
                    ->where('student_id', $studentId)
                    ->where('subject_id', $sub)
                    ->where('form_id', $formid)
                    ->update([
                        'seq1' => $seq,
                        'ave_point' => $av_point,
                        'status' => 1
                    ]);
                    $message = array('message' => 'SEQ 1 Mark updated', 'type' => 'update', 'seq' => $seq);
                return response()->json($message);
                }
            }
        else {
            $firstseq = new Firsttermresult();
            $firstseq->year_id = $yearid;
            $firstseq->student_id = $studentId;
            $firstseq->form_id = $formid;
            $firstseq->subject_id = $sub;
            $firstseq->seq1 = $seq;
            $firstseq->ave_point = ($seq/2)*$subject->coefficient;
            $firstseq->status = 1;

            $firstseq->save();
            $message = array('message' => 'SEQ 1 Mark saved', 'type' => 'success');
            return response()->json($message);
        }
    }

// second sequence
    public function saveSecondSequence(Request $req){
        $seq = $req['seq2'];
        $studentId = (int)$req['student'];
        $sub = (int)$req['subject'];
        $yearid = (int)$req['year'];
        try {
            $decrypted_id = Crypt::decrypt($req['form']);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $mes = array('message' => 'fail to decrypt Id, please contact the admin', 'alert-type' => 'error');
            return redirect()->back()->with($mes);
        }
        $formid = (int)$decrypted_id;
        $subject = Subject::where('id', $sub)->first();

        if(Firsttermresult::where('year_id', $yearid)
            ->where('student_id', $studentId)
            ->where('subject_id', $sub)
            ->where('form_id', $formid)->exists()){
            $seqs = Firsttermresult::where('year_id', $yearid)->where('student_id', $studentId)->where('subject_id', $sub)->where('form_id', $formid)->first();
            $av_point = (((float)$seq + (float)$seqs->seq1)/2)*$subject->coefficient;
                if($seq == "0"){
                    Firsttermresult::where('year_id', $yearid)
                    ->where('student_id', $studentId)
                    ->where('subject_id', $sub)
                    ->where('form_id', $formid)
                    ->update(['seq2' => 0, 'ave_point' => $av_point, 'status' => 1]);
                    $message = array('message' => 'SEQ 2 Mark updated', 'type' => 'update', 'seq' => $seq);
                return response()->json($message);
                }
                else if($seq == null){
                    Firsttermresult::where('year_id', $yearid)
                    ->where('student_id', $studentId)
                    ->where('subject_id', $sub)
                    ->where('form_id', $formid)
                    ->update(['seq2' => null, 'ave_point' => $av_point, 'status' => 1]);
                    $message = array('message' => 'SEQ 2 Mark deleted', 'type' => 'warning', 'seq' => $seq);
                return response()->json($message);
                }
                else {
                    Firsttermresult::where('year_id', $yearid)
                    ->where('student_id', $studentId)
                    ->where('form_id', $formid)
                    ->where('subject_id', $sub)->update([
                        'seq2' => $seq,
                        'ave_point' => $av_point,
                        'status' => 1
                    ]);
                    $message = array('message' => 'SEQ 2 Mark updated', 'type' => 'update', 'seq' => $seq);
                return response()->json($message);
                }
            }
        else {
            $second = new Firsttermresult();
            $second->year_id = $yearid;
            $second->student_id = $studentId;
            $second->form_id = $formid;
            $second->subject_id = $sub;
            $second->seq2 = $seq;
            $second->ave_point = ($seq/2)*$subject->coefficient;
            $second->status = 1;

            $second->save();
            $message = array('message' => 'SEQ 2 Mark saved', 'type' => 'success');
            return response()->json($message);
        }
    }

    // third sequence
    public function saveThirdSequence(Request $req){
        $seq = $req['seq3'];
        $studentId = (int)$req['student'];
        $sub = (int)$req['subject'];
        $yearid = (int)$req['year'];
        try {
            $decrypted_id = Crypt::decrypt($req['form']);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $mes = array('message' => 'fail to decrypt Id, please contact the admin', 'alert-type' => 'error');
            return redirect()->back()->with($mes);
        }
        $formid = (int)$decrypted_id;
        $subject = Subject::where('id', $sub)->first();

        if(Secondtermresult::where('year_id', $yearid)
            ->where('student_id', $studentId)
            ->where('form_id', $formid)
            ->where('subject_id', $sub)->exists()){
            $seqs = Secondtermresult::where('year_id', $yearid)->where('student_id', $studentId)->where('subject_id', $sub)->where('form_id', $formid)->first();
            $av_point = (((float)$seq + (float)$seqs->seq4)/2)*$subject->coefficient;
                if($seq == "0"){
                    Secondtermresult::where('year_id', $yearid)
                    ->where('student_id', $studentId)
                    ->where('form_id', $formid)
                    ->where('subject_id', $sub)->update(['seq3' => 0, 'ave_point' => $av_point, 'status' => 1]);
                    $message = array('message' => 'SEQ 3 Mark updated', 'type' => 'update', 'seq' => $seq);
                return response()->json($message);
                }
                else if($seq == null){
                    Secondtermresult::where('year_id', $yearid)
                    ->where('student_id', $studentId)
                    ->where('form_id', $formid)
                    ->where('subject_id', $sub)->update(['seq3' => null, 'ave_point' => $av_point, 'status' => 1]);
                    $message = array('message' => 'SEQ 3 Mark deleted', 'type' => 'warning', 'seq' => $seq);
                return response()->json($message);
                }
                else {
                    Secondtermresult::where('year_id', $yearid)
                    ->where('student_id', $studentId)
                    ->where('form_id', $formid)
                    ->where('subject_id', $sub)->update([
                        'seq3' => $seq,
                        'ave_point' => $av_point,
                        'status' => 1
                    ]);
                    $message = array('message' => 'SEQ 3 Mark updated', 'type' => 'update', 'seq' => $seq);
                return response()->json($message);
                }
            }
        else {
            $third = new Secondtermresult();
            $third->year_id = $yearid;
            $third->student_id = $studentId;
            $third->form_id = $formid;
            $third->subject_id = $sub;
            $third->seq3 = $seq;
            $third->ave_point = ($seq/2)*$subject->coefficient;
            $third->status = 1;

            $third->save();
            $message = array('message' => 'SEQ 3 Mark saved', 'type' => 'success');
            return response()->json($message);
        }
    }

    public function savefourthSequence(Request $req){
        $seq = $req['seq4'];
        $studentId = (int)$req['student'];
        $sub = (int)$req['subject'];
        $yearid = (int)$req['year'];
        try {
            $decrypted_id = Crypt::decrypt($req['form']);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $mes = array('message' => 'fail to decrypt Id, please contact the admin', 'alert-type' => 'error');
            return redirect()->back()->with($mes);
        }
        $formid = (int)$decrypted_id;
        $subject = Subject::where('id', $sub)->first();

        if(Secondtermresult::where('year_id', $yearid)
            ->where('student_id', $studentId)
            ->where('form_id', $formid)
            ->where('subject_id', $sub)->exists()){
            $seqs = Secondtermresult::where('year_id', $yearid)->where('student_id', $studentId)->where('subject_id', $sub)->where('form_id', $formid)->first();
            $av_point = (((float)$seq + (float)$seqs->seq3)/2)*$subject->coefficient;
                if($seq == "0"){
                    Secondtermresult::where('year_id', $yearid)
                    ->where('student_id', $studentId)
                    ->where('form_id', $formid)
                    ->where('subject_id', $sub)->update(['seq4' => 0, 'ave_point' => $av_point, 'status' => 1]);
                    $message = array('message' => 'SEQ 4 Mark updated', 'type' => 'update', 'seq' => $seq,);
                return response()->json($message);
                }
                else if($seq == null){
                    Secondtermresult::where('year_id', $yearid)
                    ->where('student_id', $studentId)
                    ->where('form_id', $formid)
                    ->where('subject_id', $sub)->update(['seq4' => null, 'ave_point' => $av_point, 'status' => 1]);
                    $message = array('message' => 'SEQ 4 Mark deleted', 'type' => 'warning', 'seq' => $seq);
                return response()->json($message);
                }
                else {
                    Secondtermresult::where('year_id', $yearid)
                    ->where('student_id', $studentId)
                    ->where('form_id', $formid)
                    ->where('subject_id', $sub)->update([
                        'seq4' => $seq,
                        'ave_point' => $av_point,
                        'status' => 1
                    ]);
                    $message = array('message' => 'SEQ 4 Mark updated', 'type' => 'update', 'seq' => $seq);
                return response()->json($message);
                }
            }
        else {
            $fourth = new Secondtermresult();
            $fourth->year_id = $yearid;
            $fourth->student_id = $studentId;
            $fourth->form_id = $formid;
            $fourth->subject_id = $sub;
            $fourth->seq4 = $seq;
            $fourth->ave_point = ($seq/2)*$subject->coefficient;
            $fourth->status = 1;

            $fourth->save();
            $message = array('message' => 'SEQ 4 Mark saved', 'type' => 'success');
            return response()->json($message);
        }
    }

    public function savefirthSequence(Request $req){
        $seq = $req['seq5'];
        $studentId = (int)$req['student'];
        $sub = (int)$req['subject'];
        $yearid = (int)$req['year'];
        try {
            $decrypted_id = Crypt::decrypt($req['form']);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $mes = array('message' => 'fail to decrypt Id, please contact the admin', 'alert-type' => 'error');
            return redirect()->back()->with($mes);
        }
        $formid = (int)$decrypted_id;
        $subject = Subject::where('id', $sub)->first();


        if(Thirdtermresult::where('year_id', $yearid)
            ->where('student_id', $studentId)
            ->where('form_id', $formid)
            ->where('subject_id', $sub)->exists()){
        $seqs = Thirdtermresult::where('year_id', $yearid)->where('student_id', $studentId)->where('subject_id', $sub)->where('form_id', $formid)->first();
        $av_point = (((float)$seq + (float)$seqs->seq6)/2)*$subject->coefficient;
                if($seq == "0"){
                    Thirdtermresult::where('year_id', $yearid)
                    ->where('student_id', $studentId)
                    ->where('form_id', $formid)
                    ->where('subject_id', $sub)->update(['seq5' => 0, 'ave_point' => $av_point, 'status' => 1]);
                    $message = array('message' => 'SEQ 5 Mark updated', 'type' => 'update', 'seq' => $seq);
                return response()->json($message);
                }
                else if($seq == null){
                    Thirdtermresult::where('year_id', $yearid)
                    ->where('student_id', $studentId)
                    ->where('form_id', $formid)
                    ->where('subject_id', $sub)->update(['seq5' => null, 'ave_point' => $av_point, 'status' => 1]);
                    $message = array('message' => 'SEQ 5 Mark deleted', 'type' => 'warning', 'seq' => $seq);
                return response()->json($message);
                }
                else {
                    Thirdtermresult::where('year_id', $yearid)
                    ->where('student_id', $studentId)
                    ->where('form_id', $formid)
                    ->where('subject_id', $sub)->update([
                        'seq5' => $seq,
                        'ave_point' => $av_point,
                        'status' => 1
                    ]);
                    $message = array('message' => 'SEQ 5 Mark updated', 'type' => 'update', 'seq' => $seq);
                return response()->json($message);
                }
            }
        else {
            $firth = new Thirdtermresult();
            $firth->year_id = $yearid;
            $firth->student_id = $studentId;
            $firth->form_id = $formid;
            $firth->subject_id = $sub;
            $firth->seq5 = $seq;
            $firth->ave_point = ($seq/2)*$subject->coefficient;
            $firth->status = 1;

            $firth->save();
            $message = array('message' => 'SEQ 5 Mark saved', 'type' => 'success');
            return response()->json($message);
        }
    }

    // sith sequence
    public function saveSithSequence(Request $req){
        $seq = $req['seq6'];
        $studentId = (int)$req['student'];
        $sub = (int)$req['subject'];
        $yearid = (int)$req['year'];
        try {
            $decrypted_id = Crypt::decrypt($req['form']);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $mes = array('message' => 'fail to decrypt Id, please contact the admin', 'alert-type' => 'error');
            return redirect()->back()->with($mes);
        }
        $formid = (int)$decrypted_id;
        $subject = Subject::where('id', $sub)->first();

        if(Thirdtermresult::where('year_id', $yearid)
            ->where('student_id', $studentId)
            ->where('form_id', $formid)
            ->where('subject_id', $sub)->exists()){
        $seqs = Thirdtermresult::where('year_id', $yearid)->where('student_id', $studentId)->where('subject_id', $sub)->where('form_id', $formid)->first();
        $av_point = (((float)$seq + (float)$seqs->seq5)/2)*$subject->coefficient;
                if($seq == "0"){
                    Thirdtermresult::where('year_id', $yearid)
                    ->where('student_id', $studentId)
                    ->where('form_id', $formid)
                    ->where('subject_id', $sub)->update(['seq6' => 0, 'ave_point' => $av_point, 'status' => 1]);
                    $message = array('message' => 'SEQ 6 Mark updated', 'type' => 'update', 'seq' => $seq);
                return response()->json($message);
                }
                else if($seq == null){
                    Thirdtermresult::where('year_id', $yearid)
                    ->where('student_id', $studentId)
                    ->where('form_id', $formid)
                    ->where('subject_id', $sub)->update(['seq6' => null, 'ave_point' => $av_point, 'status' => 1]);
                    $message = array('message' => 'SEQ 6 Mark deleted', 'type' => 'warning', 'seq' => $seq);
                return response()->json($message);
                }
                else {
                    Thirdtermresult::where('year_id', $yearid)
                    ->where('student_id', $studentId)
                    ->where('form_id', $formid)
                    ->where('subject_id', $sub)->update([
                        'seq6' => $seq,
                        'ave_point' => $av_point,
                        'status' => 1
                    ]);
                    $message = array('message' => 'SEQ 6 Mark updated', 'type' => 'update', 'seq' => $seq);
                return response()->json($message);
                }
            }
        else {
            $sith = new Thirdtermresult();
            $sith->year_id = $yearid;
            $sith->student_id = $studentId;
            $sith->form_id = $formid;
            $sith->subject_id = $sub;
            $sith->seq6 = $seq;
            $sith->ave_point =($seq/2)*$subject->coefficient;
            $sith->status = 1;

            $sith->save();
            $message = array('message' => 'SEQ 6 Mark saved', 'type' => 'success');
            return response()->json($message);
        }
    }
}
