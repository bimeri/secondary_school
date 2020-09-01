<?php

namespace App\Http\Controllers;

use App\Firsttermresult;
use Illuminate\Http\Request;

class ClassResultController extends Controller
{
    //
    public function __construct()
    {
        return $this->middleware('auth:admin');
    }

    public function getStudentResultPerclass(Request $req){
        $year = $req['year_id'];
        $class = $req['class_id'];
        $term = $req['term_id'];

        $result = Firsttermresult::getResultByClass($year, $class);
        return $result;
    }
}
