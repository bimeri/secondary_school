<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Resultcontrol;
use App\Sequence;
use App\Setting;
use App\Term;
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

    public function moreSetting(){
        $this->authorize('school_theme', Permission::class);
        $year = Year::getCurrentYear();
        $data['recordingMarks'] = '';
        $data['year'] = Year::getAllYear();
        $data['term'] = Term::getAllTerm();
        $data['resultscontrol'] = Resultcontrol::all();
        if(DB::table('subject_teacher')->where('status', 0)->where('year_id', $year)->exists()){
            $data['recordingMarks'] = true;
        } else {
            $data['recordingMarks'] = false;
        }
        return view('admin.public.setting.more_setting')->with($data);
    }

    public function allSetting(){
        $this->authorize('school_theme', Permission::class);
        return view('admin.public.setting.all_setting');
    }

    public function recordTeacherMarks(){
        $year = Year::getCurrentYear();
        if(DB::Table('subject_teacher')->where('status', 0)->where('year_id', $year)->exists()){
             DB::table('subject_teacher')->where('status', 0)->where('year_id', $year)->update([
                'status' => 1
            ]);
            $mess = array('message' => 'Teacher can\'t record marks again', 'alert-type' => 'info');
                return redirect()->back()->with($mess);
        } else {
            DB::table('subject_teacher')->where('status', 1)->where('year_id', $year)->update([
                'status' => 0
            ]);
            $mes = array('message' => 'Teacher can record their subjects marks', 'alert-type' => 'succcess');
            return redirect()->back()->with($mes);
        }
    }

    public function createSequence(Request $req){
        $this->validate($req, [
            'sequence' => 'required|unique:App\Sequence,name',

        ]);
        $sequence = $req['sequence'];
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
        } else {
            $notification = array('message' => 'Nothing changed!',
            'alert-type' => 'warning' );
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

    function resultTable(Request $req){
        $year = $req['year'];
        $term = $req['term'];
        $terms = Term::where('id', $term)->first();
        $sequence_one = null;
        $sequence_two = null;
        $years = Year::getYear($year);
        if($terms->name == 'First Term'){
            $tem = Term::getTermByName('First Term');
            $sequence_one = '1<sup>st</sup> Sequence';
            $sequence_two = '2<sup>nd</sup> Sequence';
            $sequence1Id = Sequence::where('term_id', $tem->id)->where('name', 'First Sequence')->first();
            $sequence2ID = Sequence::where('term_id', $tem->id)->where('name', 'Second Sequence')->first();
        }
        if($terms->name == 'Second Term') {
            $tem = Term::getTermByName('Second Term');
            $sequence_one = '3<sup>rd</sup> Sequence';
            $sequence_two = '4<sup>th</sup> Sequence';
            $sequence1Id = Sequence::where('term_id', $tem->id)->where('name', 'Third Sequence')->first();
            $sequence2ID = Sequence::where('term_id', $tem->id)->where('name', 'Fourth Sequence')->first();
        }
        if($terms->name == 'Third Term')
        {
            $tem = Term::getTermByName('Third Term');
            $sequence_one ='5<sup>th</sup> Sequence';
            $sequence_two = '6<sup>th</sup> Sequence';
            $sequence1Id = Sequence::where('term_id', $tem->id)->where('name', 'Firth Sequence')->first();
            $sequence2ID = Sequence::where('term_id', $tem->id)->where('name', 'Sixth Sequence')->first();
        }

        $data = "
        <div style='overflow:auto !important'>
            <table class='w3-table w3-striped w3-border-t' style='font-size: 13px !important;'>
                <tr class='orange white-text'>
                    <th class='w3-large' rowspan='2'>S/N</th>
                    <th class='w3-large' rowspan='2'>Year</th>
                    <th class='w3-large' rowspan='2'>Term</th>
                    <th class='' colspan='3'>Action</th>
                    <tr>
                        <td class='w3-medium'>".$sequence_one."</td>
                        <td class='w3-medium'>".$sequence_two."</td>
                        <td class='w3-medium'>Exam</td>
                    </tr>
                </tr>

                <tr>
                    <td>1</td>
                    <td>".$years->name."</td>
                    <td>".$terms->name."</td>
                    <td>
                        <form method='post' id='publish_first'>
                            ".csrf_field()."
                            <input type='hidden' name='seq' value='".$sequence1Id->id."' />
                            <input type='hidden' name='year' value='".$years->id."' />
                        <input type='hidden' name='term' value='".$tem->id."' />
                        ";
                        if(Resultcontrol::where('term_id', $tem->id)
                                        ->where('year_id', $years->id)
                                        ->where('seq1_id', $sequence1Id->id)->exists())
                                {
                                    $data .= "
                                                <button type='button' class='btn red red-text lighten-4 waves-effect waves-light'>Published Already</button>
                                            ";
                                } else {
                                    $data .= "
                                        <div id='button1'>
                                        <button type='button' class='btn orange orange-text lighten-4 waves-effect waves-light' onClick='publishfirstResult()'>Publish</button>
                                        </div>
                                            ";
                                    };
                        $data .= "
                        </form>
                    </td>

                    <td>
                    <form method='post' id='publish_second'>
                            ".csrf_field()."
                            <input type='hidden' name='seq' value='".$sequence2ID->id."' />
                            <input type='hidden' name='year' value='".$years->id."' />
                        <input type='hidden' name='term' value='".$tem->id."' />
                        ";
                        if(Resultcontrol::where('term_id', $tem->id)
                                        ->where('year_id', $years->id)
                                        ->where('seq2_id', $sequence2ID->id)->exists())
                                {
                                    $data .= "
                                                <button type='button' class='btn red red-text lighten-4 waves-effect waves-light'>Publish Already</button>
                                            ";
                                } else {
                                    $data .= " <div id='button2'>
                                    <button type='button' id='button2' class='btn  orange orange-text lighten-4 waves-effect waves-light' onClick='publishsecondResult()'>Publish</button>
                                    </div>
                                            ";
                                    };
                        $data .= "
                        </form>
                    </td>
                    <td><button type='submit' class='w3-btn w3-teal teal-text lighten-4' waves-effect waves-light>Publish exam results</button></td>
                </tr>
            </table>
        </div>
        ";
        return response()->json($data);
    }

    public function PublishFirstResult(Request $req){
        $seq = $req['seq'];
        $term = $req['term'];
        $year = $req['year'];
        $sequence = Sequence::where('id', $seq)->first();

        if(Resultcontrol::where('year_id', $year)->where('term_id', $term)->exists()){
             Resultcontrol::where('year_id', $year)->where('term_id', $term)->update(['seq1_id' => $seq]);
                return response()->json($sequence->name);
        } else {
            $resultcontrol = new Resultcontrol();
            $resultcontrol->year_id = $year;
            $resultcontrol->term_id = $term;
            $resultcontrol->seq1_id = $seq;
            $resultcontrol->save();
            return response()->json($sequence->name);
        }
    }

    public function PublishSecondResult(Request $req){
        $seq = $req['seq'];
        $term = $req['term'];
        $year = $req['year'];
        // return response()->json($req->input());
        $sequence = Sequence::where('id', $seq)->first();

        if(Resultcontrol::where('year_id', $year)->where('term_id', $term)->exists()){
             Resultcontrol::where('year_id', $year)->where('term_id', $term)->update(['seq2_id' => $seq]);
                return response()->json($sequence->name);
        } else {
            $resultcontrol = new Resultcontrol();
            $resultcontrol->year_id = $year;
            $resultcontrol->term_id = $term;
            $resultcontrol->seq2_id = $seq;
            $resultcontrol->save();
            return response()->json($sequence->name);
        }
    }
}
