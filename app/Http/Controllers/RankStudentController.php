<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;

class RankStudentController extends Controller
{
    //
    public function __construct()
    {
        return $this->middleware('auth:admin');
    }

    public function index(){
        $this->authorize('rank_student', Permission::class);

        return view('admin.student_marks.rank_students');
    }
}
