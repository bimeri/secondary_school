<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Teacher;
use App\Year;
use Illuminate\Http\Request;
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

    public function saveSubject(Request $req){
        $uname = $req['user_name'];
        $yearid = Year::getCurrentYear();
        $data = request()->all();

        $teacher = Teacher::where('user_name', $uname)->first();
        $tid = $teacher->id;
        $teacher = Teacher::find($tid);

       foreach($data as $dat){
        try {
            if($dat == $req['_token'] || $dat == $req['user_name']){} else {
                DB::table('subject_teacher')->insert(
                    ['teacher_id' => $tid, 'subject_id' => $dat, 'year_id' => $yearid]
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
}
