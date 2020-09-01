<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Scholarship;
use App\Student;
use App\Studentinfo;
use App\Year;
use Illuminate\Http\Request;
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
        $students = Studentinfo::paginate(5);
        return view('admin.public.scholarship.create', compact('students'));
    }

    public function getStudents(Request $req){
        $this->validate($req, [
            'year' => 'required',
            'class' => 'required',
        ]);
        $year_id = $req['year'];
        $form_id = $req['class'];

        $students = DB::table('studentinfos')->where('year_id', $year_id)->where('form_id', $form_id)->paginate(4);
        $path = '';
        return view('admin.public.scholarship.create', compact('students'));
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
            $scholarship->save();
            $message = array('message' => 'Student Successfully received Scholarship', 'alert-type' => 'success');
            return redirect()->back()->with($message);
        }
        catch(\Illuminate\Database\QueryException $e){
            $message = array('message' => 'Fail to save, please contact gthe admin for any verification', 'alert-type' => 'error');
            return redirect()->back()->with($message);
        }
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
        return view('admin.public.scholarship.report_scholarship');
    }
}
