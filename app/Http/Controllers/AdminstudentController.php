<?php

namespace App\Http\Controllers;

use App\Form;
use App\Permission;
use App\Setting;
use App\Student;
use App\Studentinfo;
use App\Subclass;
use App\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminstudentController extends Controller
{
    //
    public function __construct()
    {
        return $this->middleware('auth:admin');
    }

    public function create(){
        $this->authorize('add_student', Permission::class);
        $id = Setting::find(1);
        $first = $id->school_id;

        if($id->school_id == null){
            $notify = array('message' => 'Please go to Setting and set the School Unique Identifier. You can\'t register any student without the Identifier','alert-type' => 'info');
            return redirect()->back()->with($notify);
        }
        else {
             $count = Student::count() + 1;
            //$count = 1683;
            $last_digits = sprintf("%02d", $count);

             if($count >= 1684){
                $count_transform = sprintf("%02d", ($count - 1683));
                $matricule = $first .'0Q'. $count_transform;
               // return $matricule;
            }
            else if($count >= 1585){
                $count_transform = sprintf("%02d", ($count - 1584));
                $matricule = $first .'0P'. $count_transform;
                //return $matricule;
            }
            else if($count >= 1486){
                $count_transform = sprintf("%02d", ($count - 1485));
                $matricule = $first .'0O'. $count_transform;
               // return $matricule;
            }
            else if($count >= 1387){
                $count_transform = sprintf("%02d", ($count - 1386));
                $matricule = $first .'0N'. $count_transform;
               // return $matricule;
            }
            else if($count >= 1288){
                $count_transform = sprintf("%02d", ($count - 1287));
                $matricule = $first .'0M'. $count_transform;
               // return $matricule;
            }
            else if($count >= 1189){
                $count_transform = sprintf("%02d", ($count - 1188));
                $matricule = $first .'0L'. $count_transform;
               // return $matricule;
            }
            else if($count >= 1090){
                $count_transform = sprintf("%02d", ($count - 1089));
                $matricule = $first .'0L'. $count_transform;
               // return $matricule;
            }
            else if($count >= 991){
                $count_transform = sprintf("%02d", ($count - 990));
                $matricule = $first .'0K'. $count_transform;
               // return $matricule;
            }
            else if($count >= 892){
                $count_transform = sprintf("%02d", ($count - 891));
                $matricule = $first .'0J'. $count_transform;
               // return $matricule;
            }
            else if($count >= 793){
                $count_transform = sprintf("%02d", ($count - 792));
                $matricule = $first .'0I'. $count_transform;
               // return $matricule;
            }
            else if($count >= 694){
                $count_transform = sprintf("%02d", ($count - 693));
                $matricule = $first .'0H'. $count_transform;
               // return $matricule;
            }
            else if($count >= 595){
                $count_transform = sprintf("%02d", ($count - 594));
                $matricule = $first .'0G'. $count_transform;
                //return $matricule;
            }
            else if($count >= 496){
                $count_transform = sprintf("%02d", ($count - 495));
                $matricule = $first .'0F'. $count_transform;
               // return $matricule;
            }
            else if($count >= 397){
                $count_transform = sprintf("%02d", ($count - 396));
                $matricule = $first .'0E'. $count_transform;
               // return $matricule;
            }
            else if($count >= 298){
                $count_transform = sprintf("%02d", ($count - 297));
                $matricule = $first .'0D'. $count_transform;
               // return $matricule;
            }
            else if($count >= 199){
                $count_transform = sprintf("%02d", ($count - 198));
                $matricule = $first .'0C'. $count_transform;
                //return $matricule;
            }
            else if($count > 99){
                $count_transform = sprintf("%02d", ($count - 99));
                $matricule = $first .'0B'. $count_transform;
               // return $matricule;
            }
            else if($count < 99){
                $count_transform = sprintf("%02d", ($count));
                $matricule = $first .'0A'. $count_transform;
               // return $matricule;
            }
            else if($count == 99){
                $count_transform = sprintf("%02d", ($count));
                $matricule = $first .'0A'. $count_transform;
               // return $matricule;
            }

            return view('admin.public.student.addStudent', compact('matricule'));
        }
    }

    public function submitInfo(Request $req){
        $this->authorize('add_student', Permission::class);
        $this->validate($req, [
            'fullName' => 'required',
            'gender' => 'required',
            'class' => 'required',
            'school_id' => 'required|unique:App\Student,school_id',
        ]);

        //for the first form
        $fname = $req['fullName'];
        $email = $req['email'];
        $schoolId = $req['school_id'];
        $date_enroll = date("D, d M Y H:ia");
        $password = bcrypt('123456');

        //for the secode form
        $year = $req['year'];
        $school_id = $req['school_id'];
        $form_id = $req['class'];
        $pcontact = $req['parent_contact'];
        $address = $req['address'];
        $pemail = $req['parent_email'];
        $gender = $req['gender'];
        $dob = $req['date_of_birth'];
        $subclass = $req['subclass'];

        $form = Form::where('id', $form_id)->first();
        $all_student = Studentinfo::where('form_id', $form_id)->where('subform_id', null)->count();

        if($subclass != null){
            $forms = Subclass::where('id', $subclass)->first();
            $all_students = Studentinfo::where('subform_id', $subclass)->count();
            if($forms->max_number == $all_students || $forms->max_number < $all_students){
                $notify = array('message' => 'Fail to add '.$fname.', in '.$form->name.' The Sub class is full already, please considered creating another sub class or extending this sub-class size to fit in the student.','alert-type' => 'warning');
                session()->flash('notify', 'Fail to add '.$fname.', in '.$form->name.' The sub class is full already, please considered creating another sub class or extending this sub-class size to fit in the student.','alert-type');
                return redirect()->back()->with($notify);
            }
        }
        else {
            if($form->max_number == $all_student || $form->max_number < $all_student){
                $notify = array('message' => 'Fail to add '.$fname.', in '.$form->name.' the class is full already, please considered creating a sub class or extending this class size to fit in the student.','alert-type' => 'warning');
                session()->flash('notify', 'Fail to add '.$fname.', in '.$form->name.' the class is full already, please considered creating a sub class or extending this class size to fit in the student.','alert-type');
                return redirect()->back()->with($notify);
            }
        }

        $student = new Student();
        $student->full_name = $fname;
        $student->school_id = $schoolId;
        $student->email = $email;
        $student->password = $password;
        $student->date_enrolled = $date_enroll;

        $student->save();

        if($student){
            $student_id = Student::where('school_id', $school_id)->first();

            $studentinfo = new Studentinfo();
            if($subclass != null){
                $studentinfo->form_id = $form_id;
                $studentinfo->subform_id = $subclass;
            }
            else {
                $studentinfo->form_id = $form_id;
            }
            $studentinfo->year_id = $year;
            $studentinfo->student_school_id = $school_id;
            $studentinfo->student_id = $student_id->id;
            $studentinfo->parent_contact = $pcontact;
            $studentinfo->parent_email = $pemail;
            $studentinfo->address = $address;
            $studentinfo->date_of_birth = $dob;
            $studentinfo->gender = $gender;
            $studentinfo->save();

            if($studentinfo && $req['profile_image']){
                $year = Year::where('active', 1)->first();
                $folder = explode('/', trim($year->name));
                $destinationPath = '/image/students/'.$folder[1].'';
                $filename = $school_id.'.'.request()->profile_image->getClientOriginalExtension();
                request()->profile_image->move(public_path($destinationPath), $filename);
                DB::table('studentinfos')->where('student_school_id', $school_id)->update(['profile' => $filename]);

                $notification = array(
                    'message' => 'You successfully registeted '.$fname.', and successfully uploaded his Profile image.!',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }
            else {
                $notify = array('message' => 'All information are saved, but the User profile is not set at this time','alert-type' => 'info');
            return redirect()->back()->with($notify);
            }
        }

        else{
            $notify = array('message' => 'Fail to save Value, the Matricule Number Exist already. Please contact the super Admin for Adjustment','alert-type' => 'error');
            return redirect()->back()->with($notify);
        }
    }

    public function viewStudent(){
        $this->authorize('class_list', Permission::class);
        $years = Year::where('active', 1)->first();
        $students = Studentinfo::where('year_id', $years->id)->paginate(10);
        $path = 'admin/student/list?_tSlIExxyy3wYsmScPxFP1EiqgXVDr4PJPeWrxxnDdP1EiqgXVDr4PJPeWrxxnDdP1EiqgXVDr4PJPeWrxxnDd';
        return view('admin.public.student.viewStudent', compact('students', 'years'));
    }

    public function getStudent(Request $req){
        $this->validate($req, [
            'year' => 'required',
            'class' => 'required',
        ]);

        $year_id = $req['year'];
        $form_id = $req['class'];
        $years = Year::where('id', $year_id)->first();

        $students = Studentinfo::where('year_id', $year_id)->where('form_id', $form_id)->paginate(4);
        $path = '';
        session()->flash('message', 'Student for the academic year '.$years->name.' ');
        return view('admin.public.student.viewStudent', compact('students', 'years'));
    }
    public function getSize(Request $req){
        $id = (int)$req['class'];
        $all_students = Studentinfo::where('form_id', $id)->where('subform_id', null)->count();
        $class = Form::where('id', $id)->first();
        $size = $class->max_number;
        $diff = $size - $all_students;
        $arr = array('size' => $size, 'student' => $all_students, 'diff' => $diff);
        return response()->json($arr);
    }
}
