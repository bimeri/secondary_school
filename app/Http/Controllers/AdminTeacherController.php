<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Subject;
use App\Teacher;
use App\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class AdminTeacherController extends Controller
{
    //
    public function __construct()
    {
        return $this->middleware('auth:admin');
    }

    public function index(){
        $this->authorize('add_teacher', Permission::class);

        return view('admin.public.teacher.create');
    }

    public function view(){
        $this->authorize('teacher_subjects', Permission::class);
        $teachers = Teacher::paginate(4);
        return view('admin.public.teacher.allTeacher', compact('teachers'));
    }

    public function assign(){
        $this->authorize('assign_subjects', Permission::class);
        $teachers = Teacher::paginate(4);
        return view('admin.public.teacher.assign_subject', compact('teachers'));
    }

    public function submit(Request $req){
        $this->authorize('add_teacher', Permission::class);

        $this->validate($req, [
            'fname' => 'required',
            'uname' => 'required',
            'gender' => 'required',
        ]);

        $fname = $req['fname'];
        $uname = $req['uname'];
        $email = $req['email'];
        $gender = $req['gender'];
        $dob = $req['date_of_birth'];
        $password = bcrypt('123456');
        $destinationPath = '/image/teacher';
        $filename = $uname.'.'.request()->profile_image->getClientOriginalExtension();
        request()->profile_image->move(public_path($destinationPath), $filename);

        $teacher = new Teacher();
        $teacher->full_name = $fname;
        $teacher->user_name = $uname;
        $teacher->email = $email;
        $teacher->gender = $gender;
        $teacher->date_of_birth = $dob;
        $teacher->profile = $filename;
        $teacher->password = $password;

        $teacher->save();
        if($gender == 'Male'){
            $t = 'Mr.';
        } else {$t = 'Mrs.';}

        if($teacher){
            $info = array('message' => ' '.$t.'  '.$fname.' has been added Successfully as Teacher', 'alert-type' => 'success');
        return redirect()->back()->with($info);
        } else {
            $info = array('message' => 'Fail to add new Teacher', 'alert-type' => 'error');
            return redirect()->back()->with($info);
        }
    }

    public function update(Request $req){
        $this->authorize('add_teacher', Permission::class);

        $this->validate($req, [
            'fname' => 'required',
            'uname' => 'required',
            'gender' => 'required',
        ]);

        $teacherId = $req['teacherId'];
        $fname = $req['fname'];
        $uname = $req['uname'];
        $email = $req['email'];
        $gender = $req['gender'];
        $dob = $req['date_of_birth'];

       $update = Teacher::where('id', $teacherId)->update([
            'full_name' => $fname,
            'user_name' => $uname,
            'email' => $email,
            'gender' => $gender,
            'date_of_birth' => $dob,
        ]);
        if($gender == 'Male'){
            $t = 'Mr.';
        } else {$t = 'Mrs.';}

        if($update){
            $info = array('message' => ' '.$t.'  '.$fname.' information has been updated Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($info);
        } else {
            $info = array('message' => 'Fail to update Teacher information', 'alert-type' => 'error');
            return redirect()->back()->with($info);
        }
    }

    public function suspendTeacher(Request $req) {
        $tid = $req['teacherId'];
        Teacher::where('id', $tid)->update(['suspend' => 1]);
        $mess = array('message' => 'Teacher suspended successfully', 'alert-type' => 'warning');
        return redirect()->back()->with($mess);
    }

    public function permitTeacher(Request $req) {
        $tid = $req['teacherId'];
        Teacher::where('id', $tid)->update(['suspend' => 0]);
        $mess = array('message' => 'Request was successful', 'alert-type' => 'success');
        return redirect()->back()->with($mess);
    }

    public function saveSubject(Request $req){
        $tId = $req['user_name'];
        $yearid = Year::getCurrentYear();
        $data = request()->all();

        $teacher = Teacher::find($tId);

       foreach($data as $dat){
        try {
            if($dat == $req['_token'] || $dat == $req['user_name']){} else {
                DB::table('subject_teacher')->insert(
                    ['teacher_id' => $tId, 'subject_id' => $dat, 'year_id' => $yearid]
                );
               //$teacher->subjects()->attach($dat);
            }
          } catch (\Illuminate\Database\QueryException $e) {
              var_dump($e->errorInfo);
              $notify = array('message' => 'Fail to assign Subjects to '.$teacher->full_name.'. Subject has been assigned already', 'alert-type' => 'error');
              return redirect()->back()->with($notify);
          }
       }
       $notify = array('message' => 'Subjects assign successfully', 'alert-type' => 'success');
       return redirect()->back()->with($notify);
    }

    public function selectSubtect(Request $req){
        $teacherId = $this->decryptId($req['userId']);
        $data['teacher'] = Teacher::getTeacherName($teacherId);
        return view('admin.public.teacher.selectSubject')->with($data);
    }

    public function getAjaxSubject(Request $req){
        $classId = $req['info'];
        $arr = [];
        $subjects = Subject::getClassSubject($classId);
        foreach($subjects as $key => $subject){
            $filter = "
            <li>".($key+1).".
                ".$subject->name."/".$subject->code." <i class='fa fa-arrow-right teal-text w3-tiny'></i>
                ".$subject->form->name." <i class='fa fa-arrow-right teal-text w3-tiny'></i>
                ".$subject->form->background->name." <i class='fa fa-arrow-right teal-text w3-tiny'></i>
                ".$subject->form->background->sector->name."
                        <label class='right'>
                            <input type='checkbox'
                            class='right'
                            name='".$subject->id."'
                            value='".$subject->id."'
                            ";
                    if(DB::table('subject_teacher')->where('subject_id', $subject->id)->exists()){
                        $filter .= "disabled checked";
                    }
                $filter .= "/>
                            <span>";
                    if(DB::table('subject_teacher')->where('subject_id', $subject->id)->exists()){
                        $filter .= "assigned";
                    } else {
                        $filter .= "<b class='green-text'>select</b>";
                    }
                $filter .= "
                            </span>
                        </label>
                    </li>
            ";
            array_push($arr, $filter);
        }
        return response()->json($arr);
    }

    public function decryptId($value) {
        $decrypted = '';
        try {
            $decrypted = Crypt::decrypt($value);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $notify = array('messasge' => 'fail to decrypt Id, please contact the admin', 'alert-type' => 'error');
            return redirect()->back()->with($notify);
        }
        return $decrypted;
    }
}
