<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Scholarship;
use App\Student;
use App\Studentinfo;
use App\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class ScholarshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        return $this->middleware('auth:admin');
    }

    public function index()
    {
        $this->authorize('give_scholarship', Permission::class);
        //$year = Year::where('active', 1)->first();
        $data['year'] = '';
        $data['class'] = '';
        $data['studentinfos'] = Studentinfo::paginate(15);
        return view('admin.public.scholarship.create')->with($data);
    }

    public function getStudents(Request $req){
        $this->validate($req, [
            'year' => 'required',
            'class' => 'required',
        ]);
        $year_id = $req['year'];
        $form_id = $req['class'];

        $data['studentinfos'] = Studentinfo::where('year_id', $year_id)->where('form_id', $form_id)->paginate(15);
        return view('admin.public.scholarship.create')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('give_scholarship', Permission::class);
        $this->validate($request, [
            'class' => 'required',
            'year' => 'required',
            'term' => 'required',
            'student_id' => 'required',
        ]);

        $year = $request['year'];
        $term = $request['term'];
        $class = $request['class'];
        $studentId = $request['student_id'];
        $amount = $request['amount'];
        $reason = $request['reason'];

        $scholarship = new Scholarship();
        $scholarship->year_id = $year;
        $scholarship->term_id = $term;
        $scholarship->form_id = $class;
        $scholarship->student_id = $studentId;
        $scholarship->amount = $amount;
        $scholarship->reason = $reason;

        try {
            if (Scholarship::where('student_id', $studentId)->where('year_id', $year)->where('form_id', $class)-> where('term_id', $term)->exists()) {
                $message = array('message' => 'Scholarship given already to student', 'alert-type' => 'warning');
            return redirect()->back()->with($message);
            }
            $scholarship->save();
            $message = array('message' => 'Student Successfully received Scholarship', 'alert-type' => 'success');
            return redirect()->back()->with($message);
        }
        catch(\Illuminate\Database\QueryException $e){
            $message = array('message' => 'Fail to save, please contact the admin for any verification', 'alert-type' => 'error');
            return redirect()->back()->with($message);
        }
    }

    public function deleteScholarship(Request $req){
        $this->authorize('give_scholarship', Permission::class);
        $this->validate($req, [
            'class' => 'required',
            'year' => 'required',
            'term' => 'required',
            'student_id' => 'required',
        ]);

        $year = $req['year'];
        $term = $req['term'];
        $class = $req['class'];
        $studentId = $req['student_id'];

        Scholarship::where('student_id', $studentId)
                    ->where('year_id', $year)
                    ->where('form_id', $class)
                    ->where('term_id', $term)
                    ->delete();
        $message = array('message' => 'Scholarship deleted successfully', 'alert-type' => 'info');
        return redirect()->back()->with($message);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showReportView(){
        $this->authorize('scholarship_report', Permission::class);
        $yr = Year::getCurrentYear();
        $data['records'] = Scholarship::getAllScholarship($yr);
        $data['years'] = Year::getAllYear();
        $data['academic_year'] = Year::getYearName($yr);
        $data['amount'] = Scholarship::getSumAmount($yr);
        return view('admin.public.scholarship.report_scholarship')->with($data);
    }

    public function scholarshipPeryear(Request $req){
        $this->authorize('scholarship_report', Permission::class);
        try {
            $yr = Crypt::decrypt($req['year']);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $mes = array('message' => 'fail to decrypt Id, please contact the admin', 'alert-type' => 'error');
            return redirect()->back()->with($mes);
        }

        $data['records'] = Scholarship::getAllScholarship($yr);
        $data['years'] = Year::getAllYear();
        $data['academic_year'] = Year::getYearName($yr);
        $data['amount'] = Scholarship::getSumAmount($yr);
        return view('admin.public.scholarship.report_scholarship')->with($data);
    }
}
