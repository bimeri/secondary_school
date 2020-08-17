<?php

namespace App\Http\Controllers;

use App\Setting;
use App\Term;
use App\Year;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //
    public function __construct(){
        return $this->middleware('auth:student');
    }

    public function index(){
        return view('student.public.home');
    }
}
