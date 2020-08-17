<?php

namespace App\Http\Controllers;

use App\Form;
use App\Permission;
use App\Subclass;
use Illuminate\Http\Request;
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
}
