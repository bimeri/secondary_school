<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Sequence;
use App\Setting;
use App\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    //
    public function __construct(){
        return $this->middleware('auth:admin');
    }

    public function index(){
        $this->authorize('school_theme', Permission::class);
        return view('admin.public.setting.theme');
    }

    public function profile(){
        $this->authorize('school_profile', Permission::class);
        return view('admin.public.setting.profile');
    }

    public function createSequence(Request $req){
        $this->validate($req, [
            'sequence' => 'required',
        ]);
        $sequence = $req['sequnce'];
        $termid = $req['termId'];

        $sequnceObject = new Sequence();
        $sequnceObject->name = $sequence;
        $sequnceObject->term_id = $termid;
        $sequnceObject->save();

        if($sequnceObject){
        $notification = array('message' => ' '.$sequence.' created and saved successfully!',
            'alert-type' => 'success' );
            return redirect()->back()->with($notification);
        }
    }

    public function OnTest(){
        $settings = DB::table('settings')->where('test_session', 0)->update([
            'test_session' => 1
        ]);
        if($settings){
            $notification = array('message' => 'Test or Sequence session has been started successfully!',
                'alert-type' => 'success' );
                return redirect()->back()->with($notification);
            }
    }

    public function OffTest(){
        $settings = DB::table('settings')->where('test_session', 1)->update([
            'test_session' => 0
        ]);
        if($settings){
            $notification = array('message' => 'Test or Sequence session has been Switched OFF!',
                'alert-type' => 'info' );
                return redirect()->back()->with($notification);
            }
    }

    public function OnExam(){
        $settings = DB::table('settings')->where('exam_session', 0)->update([
            'exam_session' => 1
        ]);
        if($settings){
            $notification = array('message' => 'Exam Session has been Switched ONN successfully!',
                'alert-type' => 'success' );
            return redirect()->back()->with($notification);
        }
    }

public function OffExam(){
        $settings = DB::table('settings')->where('exam_session', 1)->update([
            'exam_session' => 0
        ]);
        if($settings){
            $notification = array('message' => 'Exam Session has been Switched OFF!',
                'alert-type' => 'info' );
            return redirect()->back()->with($notification);
        }
    }

    public function schoolTime(Request $req){
        $startTime = $req['start_time'];
        $stoptTime = $req['stop_time'];
        $breakTime = $req['break_time'];
        $lectureTime = $req['lecture_time'];

        $settings = DB::table('settings')->where('year_id', '!=', 0)->update([
            'start_time' => $startTime,
            'break_time' => $breakTime,
            'stop_time' => $stoptTime,
            'hours_per_period' => $lectureTime
        ]);
        if($settings){
            $notification = array('message' => 'Time are configured successfully!',
                'alert-type' => 'success' );
            return redirect()->back()->with($notification);
        }
    }

    public function schoolCurrentInformation(Request $req){
        $this->validate($req, []);

        $termId = $req['tearmId'];
        $sequence = $req['sequence'];
        $yearId = $req['yearId'];

        if($termId){
         DB::table('terms')->where('active', 1)->update(['active' => 0]);
         DB::table('terms')->where('id', $termId)->update(['active' => 1]);

        }
        if($sequence){
            DB::table('sequences')->where('active', 1)->update(['active' => 0]);
            DB::table('sequences')->where('id', $sequence)->update(['active' => 1]);
        }
        if($yearId){
            DB::table('years')->where('active', 1)->update(['active' => 0]);
            DB::table('years')->where('id', $yearId)->update(['active' => 1]);
            DB::table('settings')->where('year_id', '!=', 0)->update(['year_id' => $yearId]);
        }

        $notification = array('message' => 'School Team has be configured successfully!',
        'alert-type' => 'success' );
     return redirect()->back()->with($notification)->withInput();
    }

    public function schoolProfile(Request $req){
        $schoolName = $req['school_name'];
        $schoolMotto = $req['school_motto'];
        $schoolLogo = $req['profile_image'];
        $school_id = $req['school_id'];

        $count = strlen($school_id);
        $upper = strtoupper($school_id);

        if(DB::table('settings')->where('school_id', '=', null)->exists()){
            if($count != 2){
                $notification = array(
                    'message' => 'The character you enter should be exactly two (2).!',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            } else{
                DB::table('settings')->update([
                    'school_id' => $upper,
                ]);
            }
        }

        if($schoolLogo != null){
            $this->validate($req, [
                'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048'
            ]);

            $destinationPath = '/image/logo';
                        $filename = 'logo'.'.'.request()->profile_image->getClientOriginalExtension();
                        request()->profile_image->move(public_path($destinationPath), $filename);

            if(DB::table('settings')->where('school_id', '=', null)->exists()){
                DB::table('settings')->update([
                    'school_name' => $schoolName,
                    'motto' => $schoolMotto,
                    'logo' => $filename,
                    'school_id' => $upper,
                ]);
            } else {
                DB::table('settings')->update([
                    'school_name' => $schoolName,
                    'motto' => $schoolMotto,
                    'logo' => $filename,
                ]);
            }


            $notification = array(
                'message' => 'You successfully uodated school profile and uploaded School logo.!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
        else{

             DB::table('settings')->update([
                'school_name' => $schoolName,
                'motto' => $schoolMotto
            ]);

            $notification = array(
                'message' => 'You successfully updated school profile, but fail to upload a new logo!',
                'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    }
    public function addYear(Request $req){
        $this->validate($req, ['year' => 'required']);
        $year_name = $req['year'];

        $year = new Year();
        $year->name = $year_name;
        $year->active = 0;

        try{
            $year->save();
            $notification = array(
                'message' => 'the year '.$year_name.' has been added successfully !',
                'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
        catch(\Illuminate\Database\QueryException $e){
            $notification = array(
                'message' => 'The Academic Year '.$year_name.' already Exists. Add another!',
                'alert-type' => 'warning');
            return redirect()->back()->with($notification);
        }

    }

}
