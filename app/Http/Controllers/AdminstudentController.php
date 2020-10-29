<?php

namespace App\Http\Controllers;

use App\Background;
use App\Form;
use App\Permission;
use App\Setting;
use App\Student;
use App\Studentinfo;
use App\Subclass;
use App\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
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
        $data['students'] = Studentinfo::getTenStudents();
        $current_year = Year::getCurrentAcademicYear();
        $countStudentPerYear = Studentinfo::countAllSchoolStudentPerYear($current_year->id);
        //return $year;
        $yearLastDigits = explode('/', trim($current_year->name));
        $year = substr($yearLastDigits[0], -2);
        $count = $countStudentPerYear + 1;
        $letter = 'A';
        $trans_count = sprintf('%03d', $count);

        if($count > 4995){
            $letter = 'F';
            $trans_count = sprintf('%03d', $count - 4995);
        } elseif($count > 3996){
            $letter = 'E';
            $trans_count = sprintf('%03d', $count - 3996);
        }
        elseif($count > 2997){
            $letter = 'D';
            $trans_count = sprintf('%03d', $count - 2997);
        } elseif($count > 1998){
            $letter = 'C';
            $trans_count = sprintf('%03d', $count - 1998);
        } elseif($count > 999){
            $letter = 'B';
            $trans_count = sprintf('%03d', $count - 999);
        } else {
            $letter = 'A';
            $trans_count = sprintf('%03d', $count);
        }
        $matricule = $first.$year.$letter.$trans_count;
        $data['matricule'] = $matricule;


        if($id->school_id == null){
            $notify = array('message' => 'Please go to Setting and set the School Unique Identifier. You can\'t register any student without the Identifier','alert-type' => 'info');
            return redirect()->back()->with($notify);
        }

        return view('admin.public.student.addStudent')->with($data);
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
                $notify = array('message' => 'Fail to add '.$fname.', in '.$forms->form->name.' '.$forms->type.' The Sub class is full already, please considered creating another sub class or extending this sub-class size to fit in the student.','alert-type' => 'warning');
                session()->flash('notify', 'Fail to add '.$fname.', in '.$forms->form->name.' '.$forms->type.' The sub class is full already, please considered creating another sub class or extending this sub-class size to fit in the student.','alert-type');
                return redirect()->back()->with($notify);
            }
        }
        else {
            if($form->max_number == $all_student || $form->max_number < $all_student){
                $notify = array('message' => 'Fail to add '.$fname.', in '.$form->name.' A, the class is full already, please considered creating a sub class or extending this class size to fit in the student.','alert-type' => 'warning');
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
        $data['data'] = [];
        $data['form'] = '';
        $data['count'] = 0;
        $data['years'] = Year::where('active', 1)->first();
        return view('admin.public.student.viewStudent')->with($data);
    }

    public function getStudent(Request $req){
        $this->validate($req, [
            'year' => 'required',
            'class' => 'required',
        ]);

        $year_id = $req['year'];
        $form_id =  $req['class'];
        $years = Year::where('id', $year_id)->first();
        $data['years'] = $years;
        $subClasses = Subclass::where('form_id', $form_id)->get();
        $getFormDetail = Form::getClassDetail($form_id);
        $numberOfstudents = null;
        $className = $getFormDetail->name;
        $Astudents = Studentinfo::countAllclassStudent($year_id, $form_id, null);
        $classAstudents = [
            "subId" => null,
            "formId" => $form_id,
            "yearId" => $year_id,
            "className" => $className,
            "classType" => 'A',
            "students" => $Astudents
        ];
        $arr = [$classAstudents];

        foreach($subClasses as $subclass){
            $subclassType = $subclass->type;
            $numberOfstudents = Studentinfo::countAllclassStudent($year_id, $form_id, $subclass->id);
            $arrayElement = [
                "subId" => $subclass->id,
                "formId" => $form_id,
                "yearId" => $year_id,
                "className" => $className,
                "classType" => $subclassType,
                "students" => $numberOfstudents
            ];
            array_push($arr, $arrayElement);
        }
        $data['data'] = $arr;
        $data['form'] = $getFormDetail;
        $data['count'] = $numberOfstudents;
        session()->flash('message', 'Student for the academic year '.$years->name.' ');
        return view('admin.public.student.viewStudent')->with($data);
    }

    public function studentSubclasses(Request $req){
        $yr = $req['yearId'];
        $subfm = $req['subform_id'];
        $fm = $req['formId'];
        $year = '';
        $subform = null;
        $form = '';

        try {
            $year = Crypt::decrypt($yr);
            $subform = Crypt::decrypt($subfm);
            $form = Crypt::decrypt($fm);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $notify = array('message' => 'fail to decrypt IDs please contact the admin', 'alert-tpye' => 'error');
            return redirect()->back()->with($notify);
        }

        $data['students'] = Studentinfo::getAllStudentPerYearClassAndSubClass($year, $form, $subform);

        return view('admin.public.student.viewSubclassStudent')->with($data);
    }

    public function searchStudentLive(Request $req){
        $value = $req['info'];
        //$getFullName = Student::where('full_name', 'like', '%'.$value.'%')->first();
        //$name = $getFullName->id;
        $studentinfo = Studentinfo::select('*')->where('student_school_id', 'like', '%'.$value.'%')
        ->join('students', 'students.id', 'studentinfos.student_id')
        ->orWhere('students.full_name', '%'.$value.'%')
        ->get();
        return json_encode($studentinfo);
    }

    public function ajaxGetBackground(Request $req){
        $sectorId = $req['info'];
        $backgrounds = Background::where('sector_id', $sectorId)->get();
        $array = ["<option value=''>Select the Background</option>"];
        foreach($backgrounds as $background){
            $arrayValue = "<option value='".$background->id."'>".$background->name."</option>";
            array_push($array, $arrayValue);
        }

        return json_encode($array);
    }

    public function ajaxGetClass(Request $req){
        $backgroundId = $req['info'];
        $forms = Form::where('background_id', $backgroundId)->get();
        $array = ["<option value=''>Select the Class</option>"];
        foreach($forms as $form){
            $arrayValue = "<option value='".$form->id."'>".$form->name."/".$form->code."-- size: ".$form->max_number."</option>";
            array_push($array, $arrayValue);
        }
        return json_encode($array);
    }

    public function getSize(Request $req){
        $id = (int)$req['class'];
        $year = $req['year'];
        $all_students = Studentinfo::countAllclassStudent($year, $id, null);
        $class = Form::where('id', $id)->first();
        $size = $class->max_number;
        $diff = $size - $all_students;

        // this is what i will do with this branch



        $arr = array('size' => $size, 'student' => $all_students, 'diff' => $diff);

        $getAllSubclasses = Subclass::where('form_id', $id)->orderBy('type')->get();

        $textColr = $this->getColor($diff, $size);

        $table = "
        <table>
            <tr class='blue lighten-1 center w3-small'>
                <th>Type</th>
                <th>Max size</th>
                <th>Student</th>
                <th>Status</th>
            </tr>
            <tr>
                <td>A</td>
                <td>".$size."</td>
                <td>".$all_students."</td>
                <td class='".$textColr[0]."' title='".$textColr[1]."'></td>
            </tr>
            ";
            foreach($getAllSubclasses as $subc){
                $substudent = Studentinfo::countAllclassStudent($year, $id, $subc->id);
                $siz = $subc->max_number;
                $dif = $siz - $substudent;
                $colorText = $this->getColor($dif, $siz);
                $table .= "
                <tr>
                    <td>".$subc->type."</td>
                    <td>".$subc->max_number."</td>
                    <td>".$substudent."</td>
                    <td class='".$colorText[0]."' title='".$colorText[1]."'></td>
                </tr>
            ";
            }
        $table .= "</table>";

        $subclassArray = [];
        $initial_push = "<option value=''>".$class->name."-".$class->type."/".$class->background->name."/".$class->background->sector->name."</option>";
        array_push($subclassArray, $initial_push);
        foreach($getAllSubclasses as $subclass){
            $value = "<option value='".$subclass->id."'>".$subclass->form->name."-".$subclass->type."/".$subclass->form->background->name."/".$subclass->form->background->sector->name."</option>";
            array_push($subclassArray, $value);
        }

        return response()->json([$arr, $subclassArray, $table]);
    }

    public function getColor($diff, $size){
        $color = "";
        $message = "";
        if($diff == 0){
            $color = "red";
            $message = "class Full";
        }elseif($diff > 0 && $diff > $size/2){
            $color = "green";
            $message = "More space still available";
        }elseif($diff > 0 && $diff <= $size/2 && $diff < $size){
            $color = "orange";
            $message = "class almost full";
        }
        else {
            $color = "grey";
            $message = "class Undefined";
        }

        return [$color, $message];
    }
}
