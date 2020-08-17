<?php

namespace App\Http\Controllers;

use App\Setting;
use App\Term;
use App\Year;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    //
    public function __construct(){
        return $this->middleware('auth:teacher');
    }
    public function index(){
        $notify = array('message' => 'hello noel', 'alert-type' => 'info');
        return view('teacher.public.home')->with($notify);
    }
}
