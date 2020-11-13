<?php

namespace App\Http\Controllers;

use App\File;
use App\Firsttermresult;
use App\Form;
use App\Secondtermresult;
use App\Setting;
use App\Studentinfo;
use App\Subclass;
use App\Subject;
use App\Teacher;
use App\Term;
use App\Thirdtermresult;
use App\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    //
    public function __construct(){
        return $this->middleware('auth:teacher');
    }
    public function index(){
        $notify = array('message' => 'hello noel', 'alert-type' => 'info');
        return view('teacher.public.home')->with($notify);
    }

    public function getSubjects(){
        $yearid = Year::getCurrentYear();
        $userId = auth()->user()->id;
        $data['year'] = Year::getYearName($yearid);
        $data['yearId'] = $yearid;
        $subjects = DB::table('subject_teacher')->where('teacher_id', $userId)->get();
        $arr = [];
        foreach ($subjects as $sub) {
           $subjectDetail = Subject::getSubjectDetail($sub->subject_id);
            $subjectArray = [
                'sub_name' => $subjectDetail->name,
                'sub_code' => $subjectDetail->code,
                'sub_coff' => $subjectDetail->coefficient,
                'class' => $subjectDetail->form->name.' / '.$subjectDetail->form->background->name,
                'sub_id' => $subjectDetail->id,
            ];
            array_push($arr, $subjectArray);
        }
         $data['subjects'] = $arr;
         $data['counter'] = count($arr);
        return view('teacher.public.subject.allSubjects')->with($data);
    }

    public function enterSubjectsTest(){
        $yearId =  Year::getCurrentYear();
        $userId = auth()->user()->id;
        $teacher_subject = DB::table('subject_teacher')->where('teacher_id', $userId)->get();
        $arr = [];
        foreach ($teacher_subject as $sub) {
            $subjectDetail = Subject::getSubjectDetail($sub->subject_id);
             $subjectArray = [
                 'sub_name' => $subjectDetail->name,
                 'sub_code' => $subjectDetail->code,
                 'sub_coff' => $subjectDetail->coefficient,
                 'sub_id' => $subjectDetail->id,
                 'class' => $subjectDetail->form->name.' / '.$subjectDetail->form->background->name,
                 'class_id' => $subjectDetail->form->id,
             ];
             array_push($arr, $subjectArray);
         }
        $data['teacherSubjecs'] = $arr;
        return view('teacher.public.student.marks')->with($data);
    }


    // teacher side to get students and input their marks
    public function getStudents(Request $req){
        // $this->authorize('record_mark', Permission::class);
        $this->validate($req, [
            'class' => 'required'
        ]);
        $data['recordingMarks'] = '';
        try {
            $classId = Crypt::decrypt($req['class']);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $mes = array('message' => 'fail to decrypt Id, please contact the admin', 'alert-type' => 'error');
            return redirect()->back()->with($mes);
        }
        $formId =(int)$classId;
        $data['class'] = Form::where('id', $formId)->first();
        // $data['subjects'] = Subject::where('form_id', $formId)->get();
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

        $yearId =  Year::getCurrentYear();
        $userId = auth()->user()->id;
        $teacher_subject = DB::table('subject_teacher')->where('teacher_id', $userId)->get();
        $arr = [];
        $data['subjects'] = DB::table('subjects')
                        ->select('*')
                        ->join('subject_teacher', 'subject_teacher.subject_id', 'subjects.id')
                        ->where('subject_teacher.teacher_id', auth()->user()->id)
                        ->where('subjects.form_id', $formId)
                        ->get();
        foreach ($teacher_subject as $sub) {
            $subjectDetail = Subject::getSubjectDetail($sub->subject_id);
             $subjectArray = [
                 'sub_name' => $subjectDetail->name,
                 'sub_code' => $subjectDetail->code,
                 'sub_coff' => $subjectDetail->coefficient,
                 'sub_id' => $subjectDetail->id,
                 'class' => $subjectDetail->form->name.' / '.$subjectDetail->form->background->name,
                 'class_id' => $subjectDetail->form->id,
             ];
             array_push($arr, $subjectArray);
         }
        $data['teacherSubjecs'] = $arr;
        if(DB::table('subject_teacher')->where('status', 0)->where('year_id', $yearId)->exists()){
            $data['recordingMarks'] = true;
        } else {
            $data['recordingMarks'] = false;
        }

        $data['students'] = Studentinfo::where('form_id', $formId)->where('subform_id', null)->get();
        $data['b_students'] = Subclass::getStudentBysubClasses('B', $formId);
        $data['c_students'] = Subclass::getStudentBysubClasses('C', $formId);
        $data['d_students'] = Subclass::getStudentBysubClasses('D', $formId);
        $data['e_students'] = Subclass::getStudentBysubClasses('E', $formId);
        return view('teacher.public.student.recordMarks')->with($data);
    }

    public function pdfShare(Request $req){
        $fileId = $req['file_id'];
        $update = File::where('id', $fileId)->update([
            'share' => 1
        ]);
        if($update){
            $notify = array('message' => 'File was Published successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notify);
        } else {
            $notify = array('message' => 'Fail to spublish File', 'alert-type' => 'error');
            return redirect()->back()->with($notify);
        }
    }


    // start saving students result
    // first sequence
    public function savefirstSequence(Request $req){
        $seq = $req['seq1'];
        $studentId = (int)$req['student'];
        $sub = (int)$req['subject'];
        $yearid = (int)$req['year'];
        $formid = (int)$req['form'];
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
        $formid = (int)$req['form'];
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
        $formid = (int)$req['form'];
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
        $formid = (int)$req['form'];
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
        $formid = (int)$req['form'];
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
        $formid = (int)$req['form'];
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

    public function uploadFilePage(Request $req){
        $yearId = Year::getCurrentYear();
        $subjectId = '';

        try {
            $subjectId = Crypt::decrypt( $req['subjectId']);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $mess = array('message' => 'Fail to decrypt Id please contact the administrator', 'alert-type' => 'error');
            return redirect()->back()->with($mess);
        }
        $data['files'] = File::getTeachersFiles($yearId, auth()->user()->id, $subjectId);
        $teacherSubject = DB::table('subject_teacher')
                            ->where('teacher_id', auth()->user()->id)
                            ->where('subject_id', $subjectId)->get();
        $array = [];
        foreach ($teacherSubject as $value) {
            $subjectDetail = Subject::getSubjectDetail($value->subject_id);
            $newArray = [
                'subject_name' => $subjectDetail->name,
                'subject_code' => $subjectDetail->code,
                'subject_id' => $subjectDetail->id,
                'yearId' => $yearId
            ];
            array_push($array, $newArray);
        }
        $data['subject'] = $array;
        return view('teacher.public.subject.uploadFile')->with($data);
    }

    public function uploadPfdf(Request $req){
        $this->validate($req,[
            'pdf_file' => 'required'
        ]);
        $yearId = $req['yearId'];
        $subject = $req['subjectId'];
        $type = $req['type'];

        $fileExtension = request()->pdf_file->getclientOriginalExtension();
        if(strtolower($fileExtension) != strtolower($type)){
            $message = array('message' => 'Please upload the correct file type. '.strtolower($type).' is different from '.$fileExtension.'', 'alert-type' => 'error');
            return redirect()->back()->with($message);
        }
        $userId = auth()->user()->id;
        $counter = File::where('teacher_id', $userId)
                        ->where('file_type', $type)
                        ->where('year_id', $yearId)
                        ->where('subject_id', $subject)
                        ->count();
         $fullFileName = explode('.', trim(request()->pdf_file->getClientOriginalName()));
         $fileName = $fullFileName[0];
        $year = Year::where('active', 1)->first();
        $folder = explode('/', trim($year->name));
        $destinationPath = '/image/files/'.$folder[0].'';
        // file name is of tpe: SUBJECTNAME_USERID_NUMBEROFFILES.FILEEXTENSION
        $filename = $fileName.'_'.$userId. '_'.($counter+1).'.'.request()->pdf_file->getClientOriginalExtension();
        request()->pdf_file->move(public_path($destinationPath), $filename);

        $files = new File();
        $files->year_id = $yearId;
        $files->subject_id = $subject;
        $files->teacher_id = $userId;
        $files->file_name =  $filename;
        $files->file_path = $destinationPath;
        $files->file_type = $type;

        $saveFile = $files->save();
        if($saveFile){
            $notify = array('message' => 'PDF file was uploaded successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notify);
        }
        else {
            $notify = array('message' => 'Fail to save PDF file', 'alert-type' => 'error');
            return redirect()->back()->with($notify);
        }
    }

    public function previewPfdf(Request $req){
        $fileId = '';
        try {
            $fileId = Crypt::decrypt($req['file_id']);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $notify = array('message' => 'Fail to decypt file, please contact the admin', 'alert-type' => 'error');
            return redirect()->back()->with($notify);
        }
        $fileDetail = File::getFileDetail($fileId);
        $data['fileDetail'] = $fileDetail;
        $data['subjectDetail'] = Subject::getSubjectDetail($fileDetail->subject_id);

        return view('teacher.public.subject.previewPdf')->with($data);
    }
}
