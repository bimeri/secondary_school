<?php

namespace App\Http\Controllers;

use App\Background;
use App\Form;
use App\Permission;
use App\Studentinfo;
use App\Subclass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        return $this->middleware('auth:admin');
    }

    public function index()
    {
        $this->authorize('see_class', Permission::class);
        return view('admin.public.classes.viewclass');
    }
    public function subClass()
    {
        $this->authorize('sub_class', Permission::class);
        return view('admin.public.classes.subClass');
    }

    public function create()
    {
        $this->authorize('create_class', Permission::class);

        return view('admin.public.classes.create');
    }

    public function getclassSubjects(Request $req){
        $this->authorize('create_class', Permission::class);
        $background = $req['background'];
        $decrypted = '';
        try {
            $decrypted = Crypt::decrypt($background);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
           $message = array('message' => 'Fail to decrypt ID, please contact the administrator', 'alert-type' => 'error');
           return redirect()->back()->with($message);
        }

        $data['background'] = Background::where('id', $decrypted)->first();
        $data['forms'] = Form::where('background_id', $decrypted)->get();

        return view('admin.public.classes.create_submit')->with($data);
    }

    public function submitClass(Request $req){
        $this->authorize('create_class', Permission::class);
        $this->validate($req, [
            'name' => 'required',
            'maximum_number' => 'required',
            'ClassCode' => 'required|unique:App\Form,code',
            'background' => 'required',
        ]);
        $name = $req['name'];
        $max = $req['maximum_number'];
        $type = $req['type'];
        $code = $req['ClassCode'];
        $bg = $req['background'];

        $forms = new Form();
        $forms->name = $name;
        $forms->code = $code;
        $forms->type = $type;
        $forms->max_number = $max;
        $forms->background_id = $bg;

        $forms->save();

        if($forms){
            $info = array('message'=> 'Class created with success', 'alert-type' => 'success');
            return redirect()->back()->with($info);
        } else {
            $error = array('message'=> 'Fail to register class', 'alert-type' => 'error');
            return redirect()->back()->with($error);
        }
    }

    public function subClassSubmit(Request $req){
        $this->authorize('sub_class', Permission::class);
        $this->validate($req, [
            'classId' => 'required',
            'maximum_number' => 'required',
            'type' => 'required',
        ]);
        $class_id = $req['classId'];
        $max = $req['maximum_number'];
        $type = $req['type'];

        $subclass = new Subclass();
        $subclass->form_id = $class_id;
        $subclass->type = $type;
        $subclass->max_number = $max;

        $subclass->save();

        if($subclass){
            $info = array('message'=> 'Sub-Class created with success', 'alert-type' => 'success');
            return redirect()->back()->with($info);
        } else {
            $error = array('message'=> 'Fail to create Sub class', 'alert-type' => 'error');
            return redirect()->back()->with($error);
        }
    }

    public function edit(Request $req){
        $this->authorize('edit_delete_class', Permission::class);
        $this->validate($req, [
            'id' => 'required',
            'name' => 'required',
            'maximum_number' => 'required',
            'ClassCode' => 'required',
            'background' => 'required',
        ]);
        $id = $req['id'];
        $name = $req['name'];
        $max = $req['maximum_number'];
        $type = $req['type'];
        $code = $req['ClassCode'];
        $bg = $req['background'];

       $update_form = DB::table('forms')->where('id', $id)->update([
           'name' => $name,
           'code' => $code,
           'max_number' => $max,
           'type' => $type,
           'background_id' => $bg
       ]);

       if($update_form){
        $info = array('message'=> 'Class Updated with success', 'alert-type' => 'info');
        return redirect()->back()->with($info);
       }
       else {
        $info = array('message'=> 'fail to update class, no value was changed', 'alert-type' => 'warning');
        return redirect()->back()->with($info);
       }
    }

    public function EditsubClassSubmit(Request $req){
        $this->authorize('sub_class', Permission::class);
        $this->validate($req, [
            'id' => 'required',
            'classId' => 'required',
            'type' => 'required',
            'maximum_number' => 'required',
        ]);
        $id = $req['id'];
        $classId = $req['classId'];
        $type = $req['type'];
        $max = $req['maximum_number'];

       $update_subform = DB::table('subclasses')->where('id', $id)->update([
           'form_id' => $classId,
           'type' => $type,
           'max_number' => $max
       ]);

       if($update_subform){
        $info = array('message'=> 'SubClass Updated with success', 'alert-type' => 'info');
        return redirect()->back()->with($info);
       }
       else {
        $info = array('message'=> 'fail to update sub-class, no value was changed', 'alert-type' => 'warning');
        return redirect()->back()->with($info);
       }
    }

    public function delete(Request $req){
        $this->authorize('edit_delete_class', Permission::class);
        $id = $req['formid'];

        $delete_class = DB::table('forms')->where('id', $id)->delete();
        DB::table('subclasses')->where('form_id', $id)->delete();
        if($delete_class){
            $info = array('message'=> 'Class deleted with success', 'alert-type' => 'success');
            return redirect()->back()->with($info);
        } else {
            $info = array('message'=> 'Fail to delete class. Student have enrolled already', 'alert-type' => 'info');
            return redirect()->back()->with($info);
        }
    }

    public function deletesubClass(Request $req){
        $this->authorize('sub_class', Permission::class);
        $id = $req['subclassid'];

        $delete_class = DB::table('subclasses')->where('id', $id)->delete();
        if($delete_class){
            $info = array('message'=> 'Sub-Class deleted with success', 'alert-type' => 'success');
            return redirect()->back()->with($info);
        } else {
            $info = array('message'=> 'Fail to delete Sub-Class. Student have enrolled already', 'alert-type' => 'info');
            return redirect()->back()->with($info);
        }
    }
    public function getType(Request $req){
        $class = $req['classId'];
        $arr1 = array();
        $arr2 = ['B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K'];
        $subclass = Subclass::where('form_id', $class)->get();
        foreach($subclass as $sub){
            if(in_array($sub->type, $arr2)){
            array_push($arr1, $sub->type);
            }
        }
        $newar = array_diff($arr2, $arr1);
        $var = $newar;

        return current($var);
    }

    public function showClassLiss(){

        $data['table'] = Form::getAllClasses();

        return view('admin.public.student.viewAllStudent')->with($data);
    }

    public function changeClass(){
        $this->authorize('change_class', Permission::class);
        $data['table'] = Form::getAllClasses();
        $data['studentinfo'] = Studentinfo::all();

        return view('admin.public.classes.change_class')->with($data);
    }

    public function getStudentclassDetails(Request $req){
        $this->authorize('change_class', Permission::class);
            $details = $req['user'];
            $u = explode('/', trim($details));
            $matricule = $u[1];
            $studentInfo = Studentinfo::getStudentByMatricule($matricule);

            $previousclass = $studentInfo->form->name." / ".$studentInfo->form->background->name." / ".$studentInfo->form->background->sector->name;
            $previoussubclass = $studentInfo->subform_id ? $studentInfo->subform->type: 'A';
        return response()->json([$previousclass, $previoussubclass]);
    }

    public function changeClassFunction(Request $req){
        $this->authorize('change_class', Permission::class);
        $student_name = $req['student_name'];
        $formId = $req['class'];
        $student_subclass = $req['subclass'];

        $u = explode('/', trim($student_name));
        $matricule = $u[1];

        $form = Form::where('id', $formId)->first();
        $all_student = Studentinfo::where('form_id', $formId)->where('subform_id', null)->count();

        if($student_subclass != null){
            $forms = Subclass::where('id', $student_subclass)->first();
            $all_students = Studentinfo::where('subform_id', $student_subclass)->count();
            if($forms->max_number == $all_students || $forms->max_number < $all_students){
                $notify = array('message' => 'Fail to update '.$matricule = $u[0].', in '.$forms->form->name.' '.$forms->type.' The Sub class is full already, please considered creating another sub class or extending this sub-class size to fit in the student.','alert-type' => 'warning');
                session()->flash('notify', 'Fail to update '.$matricule = $u[0].', in '.$forms->form->name.' '.$forms->type.' The sub class is full already, please considered creating another sub class or extending this sub-class size to fit in the student.','alert-type');
                return redirect()->back()->with($notify);
            }
        }
        else {
            if($form->max_number == $all_student || $form->max_number < $all_student){
                $notify = array('message' => 'Fail to update '.$matricule = $u[0].', in '.$form->name.' A, the class is full already, please considered creating a sub class or extending this class size to fit in the student.','alert-type' => 'warning');
                session()->flash('notify', 'Fail to update '.$matricule = $u[0].', in '.$form->name.' the class is full already, please considered creating a sub class or extending this class size to fit in the student.','alert-type');
                return redirect()->back()->with($notify);
            }
        }


        if($student_subclass != null){
            $update = DB::table('studentinfos')
                        ->where('student_school_id', $matricule)
                        ->update(['form_id' => $formId, 'subform_id' => $student_subclass]);

                            $message = array('message' => 'successfully updated '.$matricule = $u[0].' class', 'alert-type' => 'success');
                            return redirect()->back()->with($message);

        }
        else {
            $update = DB::table('studentinfos')
                        ->where('student_school_id', $matricule)
                        ->update(['form_id' => $formId, 'subform_id' => $student_subclass]);

                            $message = array('message' => 'successfully updated '.$matricule = $u[0].' class', 'alert-type' => 'success');
                            return redirect()->back()->with($message);

        }

        return redirect()->back();
    }
}
