<?php

namespace App\Http\Controllers;

use App\Form;
use App\Permission;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    //
    public function __construct()
    {
        return $this->middleware('auth:admin');
    }

    public function index(){
        $this->authorize('create_subject', Permission::class);
        $subjects = Subject::orderBy('form_id', 'ASC')->get();

        return view('admin.public.subject.create', compact('subjects'));
    }

    public function getClassSujects(Request $req){
        $classId = $req['class'];
        $this->authorize('all_subject', Permission::class);

        $data['classSubjects'] = Subject::getClassSubject($classId);
        $data['class'] = Form::getClassDetail($classId);
        $data['subjects'] = Subject::all();

        return view('admin.public.subject.view')->with($data);
    }

    public function view(){
        $this->authorize('all_subject', Permission::class);
        $data['classSubjects'] = Subject::all();
        $data['subjects'] = Subject::all();
        $data['class'] = [];

        return view('admin.public.subject.view')->with($data);
    }

    public function select(Request $req){
        $formid = $req['class'];
        $data['formsDetail'] = Form::getClassDetail($formid);
        $data['subjects'] = Subject::getClassSubject($formid);

        return view('admin.public.subject.submitSubject')->with($data);
    }

    public function submit(Request $req){
        $this->validate($req, [
            'name' => 'required',
            'coefficient' => 'required',
            'class_id' => 'required',
        ]);

        $name = $req['name'];
        $coff = $req['coefficient'];
        $form_id = $req['class_id'];

        $subject = new Subject;

        $subject->name = $name;
        $subject->code = '';
        $subject->coefficient = $coff;
        $subject->form_id = $form_id;

        try {
            $subject->save();
            $notify = array('message' => 'Subject titled '.$name.' has been Successfully created', 'alert-type' => 'success');
            return redirect()->back()->with($notify);
        } catch (\Exception $th) {
            $notify = array('message' => 'fail to create new Subject, It exist already. Add a different one', 'alert-type' => 'error');
        return redirect()->back()->with($notify);
        }

    }

    public function edit(Request $req){
        $this->validate($req, [
            'name' => 'required',
            'coefficient' => 'required',
            'class_id' => 'required',
        ]);

        $id = $req['id'];
        $name = $req['name'];
        $coff = $req['coefficient'];
        $form_id = $req['class_id'];

        $subject = DB::table('subjects')->where('id', $id)->update([
            'name' => $name,
            'code' => '',
            'coefficient' => $coff,
            'form_id' => $form_id,
        ]);

        if($subject){
            $notify = array('message' => 'Subject titled '.$name.' has been Successfully updated', 'alert-type' => 'info');
            return redirect()->back()->with($notify);
        }
        else {
            $notify = array('message' => 'fail to update new Subject, please try again', 'alert-type' => 'error');
            return redirect()->back()->with($notify);
        }
    }
}
