<?php

namespace App\Http\Controllers;

use App\Discipline;
use App\Permission;
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
        return view('admin.public.discipline.record')->with($data);
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
