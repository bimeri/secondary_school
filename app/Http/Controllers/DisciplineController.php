<?php

namespace App\Http\Controllers;

use App\Discipline;
use App\Permission;
use App\Student;
use App\Studentdiscipline;
use App\Term;
use App\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DisciplineController extends Controller
{
    //
    public function __construct()
    {
        return $this->middleware('auth:admin');
    }
    public function create(){
        $this->authorize('add_type', Permission::class);
        return view('admin.public.discipline.create');
    }

    public function record(){
        $this->authorize('record_student', Permission::class);

        $data['years'] = Year::getAllYear();
        $data['students'] = Student::getAllStudent();
        $data['terms'] = Term::getAllTerm();
        $data['disciplines'] = Discipline::getalldisciplineType();
        $data['records'] = Studentdiscipline::getalldiscipline();
        return view('admin.public.discipline.record')->with($data);
    }

    public function saveStudentDiscipline(Request $req){
        $this->validate($req, [
            'year_id' => 'required',
            'term_id' => 'required',
            'student_name' => 'required',
            'dicipline_id' => 'required',
        ]);
        $year = $req['year_id'];
        $term = $req['term_id'];
        $stud_name = $req['student_name'];
        $dis_id = $req['dicipline_id'];
        $cons = $req['consequences'];

        $matricule = explode('/', trim($stud_name));
        $student = Student::getStudentByMatricule($matricule[1]);

        $discipline = new Studentdiscipline();
        $discipline->year_id = $year;
        $discipline->term_id = $term;
        $discipline->student_id = $student->id;
        $discipline->discipline_id = $dis_id;
        $discipline->consequences = $cons;

        $discipline->save();
        $notif = array('message' => 'Student Record Saved Successfully', 'alert-type' => 'success');

        return redirect()->back()->with($notif);
    }

    public function deleteStudentDiscipline(Request $req){
        $d_id = $req['id'];
        $delete = Studentdiscipline::where('id', $d_id)->delete();
        if($delete){
            $notification = array('message' => 'delete was Successful', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
        else{
            $notification = array('message' => 'delete was not Successful', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }


    }

    public function getStudent(){
        $this->authorize('record_student', Permission::class);

        $students = Student::getAllStudent();
        $arr = array();

        foreach($students as $stud){
            $newarr = [
                'stud_name' => $stud->full_name,
                'stud_school_id' => $stud->school_id,
                'stud_id' => $stud->id,
            ];
            array_push($arr, $newarr);
        }
        return response()->json($arr);
    }

    public function view(){
        $this->authorize('view_record_student', Permission::class);
        return view('admin.public.discipline.view');
    }

    public function submit(Request $req){
        $this->authorize('add_type', Permission::class);
        $this->validate($req, ['discipline_type' => 'required']);

        $type = $req['discipline_type'];
        $describe = $req['description'];

        $description = new Discipline();

        $description->type = $type;
        $description->description = $describe;
        $description->save();

        $notification = array('message' => 'Description Type Saved Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function update(Request $req){
        $this->authorize('add_type', Permission::class);
        $this->validate($req, ['discipline_type' => 'required']);

        $id = $req['id'];
        $type = $req['discipline_type'];
        $describe = $req['description'];

        $description = DB::table('disciplines')->where('id', $id)->update([
            'type' => $type,
            'description' => $describe,
        ]);
        if($description){
            $notification = array('message' => 'Description Type updated Successfully', 'alert-type' => 'info');
        return redirect()->back()->with($notification);
        }
        else {
            $notification = array('message' => 'Description Type remain unchanged', 'alert-type' => 'warning');
            return redirect()->back()->with($notification);
        }
    }

    public function delete(Request $req){
        $this->authorize('add_type', Permission::class);

        $id = $req['id'];

        $delete = DB::table('disciplines')->where('id', $id)->delete();

        if($delete){
            $notification = array('message' => 'Delete Successfully', 'alert-type' => 'info');
            return redirect()->back()->with($notification);
        }
        else {
            $notification = array('message' => 'Description Type remain unchanged. Fail to delete type.', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }
}
