<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Subject;
use App\Year;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class teacherAssignmentController extends Controller
{
    //
    public function __construct(){
        return $this->middleware('auth:teacher');
    }
    public function assignments(Request $req){
        $subject_id = '';
        $year_id = '';
        try {
            $subject_id = Crypt::decrypt($req['subjectId']);
            $year_id = Crypt::decrypt($req['yearId']);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $message = array('message' => 'fail to decrypt Id please contact the administrator', 'alert-type' => 'error');
            return redirect()->back()->with($message);
        }
        $data['subject'] = Subject::getSubjectDetail($subject_id);
        $data['year'] = Year::getYearName($year_id);
        $data['yearid'] = $year_id;
        $data['assignments'] = Assignment::getTeacherAssigment(auth()->user()->id, $subject_id);

        return view('teacher.public.subject.assignments')->with($data);
    }

    public function assignmentsAddFunction(Request $req){
        $this->validate($req, [
            'text' => 'required',
            'name' => 'required'
        ]);
        $year = $req['yearId'];
        $subjectid = $req['subjectId'];
        $userId = auth()->user()->id;
        $title = $req['name'];
        $text = $req['text'];
        $date = date('D, d M yy', \strtotime(Carbon::now()));

        $assigment = new Assignment();
        $assigment->year_id = $year;
        $assigment->teacher_id = $userId;
        $assigment->subject_id = $subjectid;
        $assigment->name = $title;
        $assigment->text = $text;
        $assigment->create_date = $date;
        $assigment->save();

        $notify = array('message' => 'Assigment saved successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notify);
    }

    public function assignmentPreview(Request $req){
        $subject_id = '';
        $year_id = '';
        $assignment_id = '';
        $teacher_id = auth()->user()->id;

        try {
            $subject_id = Crypt::decrypt($req['subjectId']);
            $year_id = Crypt::decrypt($req['yearId']);
            $assignment_id = Crypt::decrypt($req['assignmentId']);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $notify = array('message' => 'Fail to decrypt id, please contact the administrator', 'alert-type' => 'error');
        return redirect()->back()->with($notify);
        }

        $data['assignments'] = Assignment::getTeachersPreviewAssignment($teacher_id, $subject_id, $assignment_id, $year_id);

        return view('teacher.public.subject.previewAssignment')->with($data);
    }
}
