<?php

namespace App\Http\Controllers;

use App\Firsttermresult;
use App\Form;
use App\Generateresult;
use App\Permission;
use App\Secondtermresult;
use App\Studentinfo;
use App\Studentresult;
use App\Subclass;
use App\Subject;
use App\Term;
use App\Thirdtermresult;
use App\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class RankStudentController extends Controller
{
    //
    public function __construct()
    {
        return $this->middleware('auth:admin');
    }

    public function index(){
        $this->authorize('rank_student', Permission::class);

        $data['ranked'] = Generateresult::where('rank_student', 1)->get();
        return view('admin.student_marks.rank_students')->with($data);
    }

    public function classResult(Request $req){
        $this->authorize('rank_student', Permission::class);
        $this->validate($req, [
            'class' => 'required'
        ]);

         try {
            $class_id = Crypt::decrypt($req['class']);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $mes = array('message' => 'fail to decrypt Id, please contact the admin', 'alert-type' => 'error');
            return redirect()->back()->with($mes);
        }

        $arr = array();
        $arr_sum = array();

        $current_year = Year::where('active', 1)->first();
        $current_term = Term::where('active', 1)->first();

        if(strcmp($current_term->name, "First Term") == 0){
            $term = Firsttermresult::where('year_id', $current_year->id)->where('form_id', $class_id)->get();
            $nu1 = 1;
            $nu2 = 2;
        }elseif(strcmp($current_term->name, "Second Term") == 0){
            $term = Secondtermresult::where('year_id', $current_year->id)->where('form_id', $class_id)->get();
            $nu1 = 3;
            $nu2 = 4;
        } else{
            $term = Thirdtermresult::where('year_id', $current_year->id)->where('form_id', $class_id)->get();
            $nu1 = 5;
            $nu2 = 6;
        }
        if($nu1 == 1){
            $data['seq_name1'] = "First Sequence";
        }elseif($nu1 == 3){
            $data['seq_name1'] = "Third Sequence";
        }else {
            $data['seq_name1'] = "Firth Sequence";
            $data['seq_term'] =  Term::where('name', 'First Term')->first();
            $data['year'] = Year::where('id', $current_year->id)->first();
            if(!(Firsttermresult::where('form_id', $class_id)->where('year_id', $current_year->id)->exists())){
                session()->flash('message', 'There is no First Term result for this class. Students results are not yet recorded');
                $notification = array('message' => 'There is no First Term result for this class. Students results are not yet recorded', 'alert-type' => 'info');
                return redirect()->back()->with($notification);
            }
        }
        elseif($nu1 == 3){
            $data['seq_name1'] = "Third Sequence";
            $data['seq_term'] =  Term::where('name', 'Second Term')->first();
            $data['year'] = Year::where('id', $current_year->id)->first();
            if(!(Secondtermresult::where('form_id', $class_id)->where('year_id', $current_year->id)->exists())){
                session()->flash('message', 'There is no Second Term result for this class. Students results are not yet recorded');
                $notification = array('message' => 'There is no result Second Term result for this class. Students results are not yet recorded', 'alert-type' => 'info');
                return redirect()->back()->with($notification);
            }
        }
        else {
            $data['seq_name1'] = "Firth Sequence";
            $data['seq_term'] = Term::where('name', 'Third Term')->first();
            $data['year'] = Year::where('id', $current_year->id)->first();
            if(!(Thirdtermresult::where('form_id', $class_id)->where('year_id', $current_year->id)->exists())){
                session()->flash('message', 'There is no Third Term result for this class. Students results are not yet recorded');
                $notification = array('message' => 'There is no Third Term for this class. Students results are not yet recorded', 'alert-type' => 'info');
                return redirect()->back()->with($notification);
            }
        }

    if($nu2 == 2){
            $data['seq_name2'] = "Second Sequence";
        }elseif($nu2 == 4){
            $data['seq_name2'] = "Fourth Sequence";
        }else {
            $data['seq_name2'] = "Sith Sequence";
        }
        $total_student = Studentinfo::where('form_id', $class_id)->count();
        $total_student = Studentinfo::where('form_id', $class_id)->where('year_id', $current_year->id)->count();

        $form = Form::where('id', $class_id)->first();
        $sub_form = Subclass::where('form_id', $form->id)->get();

        // selecting alll the subjects from the form
        $subjects = Subject::where('form_id', $form->id)->get();
        $sub_coff = Subject::where('form_id', $form->id)->sum('coefficient');

        if($total_student == 0){
            $message = array('message' => 'No result for the class you are Searching');
            session()->flash('message', 'No result found for the class you just search');
            return redirect()->back()->with($message);
        }

        if($sub_coff == 0){
            $subjects_coefficient = 1;
        }
        else{
            $subjects_coefficient = $sub_coff;
        }

        foreach($subjects as $subject){
            if($nu1 == 1 || $nu2 == 2){
                $count_student = Firsttermresult::where('subject_id', $subject->id)->where('form_id', $class_id)->where('year_id', $current_year->id)->count();
            }elseif($nu1 == 3 || $nu2 == 4){
                $count_student = Secondtermresult::where('subject_id', $subject->id)->where('form_id', $class_id)->where('year_id', $current_year->id)->count();
            }
            else{
                $count_student = Thirdtermresult::where('subject_id', $subject->id)->where('form_id', $class_id)->where('year_id', $current_year->id)->count();
            }
            $sub = ['subject_name' => $subject->name,
                    'subject_coff' => $subject->coefficient,
                    'point' => 20*(int)$subject->coefficient,
                    'number_student' => $count_student
                ];
            array_push($arr, $sub);
            array_push($arr_sum, 20*(int)$subject->coefficient);
        }
        // first test
        $arr_first = array();
        $sum_ave = array();
        $sum_percent = array();
        $number_of_subject = $subjects->count();
        if($number_of_subject == 0){
            session()->flash('message', 'There are no subjects assign for this Class');
            $notification = array('message' => 'There are no subjects assign for this Class', 'alert-type' => 'info');
            return redirect()->back()->with($notification);
        }
        foreach ($subjects as $sb) {
        foreach ($subjects as $key => $sb) {
            $first_test_student = $term->where('subject_id', $sb->id)->count();
            $total_wrote = $term->where('seq'.$nu1.'', '!=', null)->where('subject_id', $sb->id)->count();
            $total_pass = $term->where('seq'.$nu1.'', '>=', 10)->where('subject_id', $sb->id)->count();
            $highest_mark = $term->where('subject_id', $sb->id)->max('seq'.$nu1.'');
            $sum_marks = $term->where('subject_id', $sb->id)->sum('seq'.$nu1.'');
        if($first_test_student == 0){
            $all_students = 1;
        }
        else {
            $all_students = $total_student;
        }

        if($number_of_subject == 0){
            $all_subjects = 1;
        }
        else {
            $all_subjects = $number_of_subject;
        }
        $subject_percentage_pass = $sum_marks*100/(20*$all_students);
        $average = 20*$subject_percentage_pass/100;

            array_push($sum_ave, $average);
            array_push($sum_percent, $subject_percentage_pass);
            $total_percent = array_sum($sum_percent)/$all_subjects;
            $total_ave = array_sum($sum_ave)/$all_subjects;
            $farr = [
                'sub_name' => $sb->name.' '.$sb->code,
                'sub_name' => '<b class="left">'.($key+1) .'. '.$sb->name.'</b> '. '<em class="right">'.$sb->code.'</em>',
                'total_student' => $all_students,
                'first_test_student' => $first_test_student,
                'total_wrote' => $total_wrote,
                'total_pass' => $total_pass,
                'highest_mark' => $highest_mark,
                'percentage' => number_format((float)$subject_percentage_pass, 2, '.', ' '),
                'average' =>  number_format((float)$average, 2, '.', ' '),
                'total_percent' => number_format((float)$total_percent, 2, '.', ' '),
                'total_average' => number_format((float)$total_ave, 2, '.', ''),
            ];
            array_push($arr_first, $farr);
        }

        // second result
        //
        $arr_second = array();
        $sum_ave_second = array();
        $sum_percent_second = array();
        $number_of_subject_second = $subjects->count();
        if($number_of_subject_second == 0){
            session()->flash('message', 'There are no subjects assign for this Class');
            $notification = array('message' => 'There are no subjects assign for this Class', 'alert-type' => 'info');
            return redirect()->back()->with($notification);
        }
        foreach ($subjects as $sb) {
            $second_test_student = $term->where('subject_id', $sb->id)->count();
            $total_wrote_second = $term->where('seq'.$nu2.'', '!=', null)->where('subject_id', $sb->id)->count();
            $total_pass_second = $term->where('seq'.$nu2.'', '>=', 10)->where('subject_id', $sb->id)->count();
            $highest_mark_second = $term->where('subject_id', $sb->id)->max('seq'.$nu2.'');
            $sum_marks_second = $term->where('subject_id', $sb->id)->sum('seq'.$nu2.'');
        if($second_test_student == 0){
            $all_students_second = 1;
        }
        else {
            $all_students_second = $total_student;
        }

        if($number_of_subject_second == 0){
            $all_subjects_second = 1;
        }
        else {
            $all_subjects_second = $number_of_subject_second;
        }
        $subject_percentage_pass_second = $sum_marks_second*100/(20*$all_students_second);
        $average_second = 20*$subject_percentage_pass_second/100;
            if($second_test_student == 0){
                $all_students_second = 1;
            }
            else {
                $all_students_second = $total_student;
            }

            if($number_of_subject_second == 0){
                $all_subjects_second = 1;
            }
            else {
                $all_subjects_second = $number_of_subject_second;
            }
            $subject_percentage_pass_second = $sum_marks_second*100/(20*$all_students_second);
            $average_second = 20*$subject_percentage_pass_second/100;

            array_push($sum_ave_second, $average_second);
            array_push($sum_percent_second, $subject_percentage_pass_second);
            $total_percent_second = array_sum($sum_percent_second)/$all_subjects_second;
            $total_ave_second = array_sum($sum_ave_second)/$all_subjects_second;
            $farrs = [
                'sub_name_two' => $sb->name.' '.$sb->code,
                'total_student_two' => $all_students_second,
                'second_test_student' => $second_test_student,
                'total_wrote_two' => $total_wrote_second,
                'total_pass_two' => $total_pass_second,
                'highest_mark_two' => $highest_mark_second,
                'percentage_two' => number_format((float)$subject_percentage_pass_second, 2, '.', ' '),
                'average_two' =>  number_format((float)$average_second, 2, '.', ' '),
                'total_percent_two' => number_format((float)$total_percent_second, 2, '.', ' '),
                'total_average_two' => number_format((float)$total_ave_second, 2, '.', ''),
            ];
            array_push($arr_second, $farrs);
        }

        $class_percentage = ($total_percent + $total_percent_second )/2;
        $class_average = ($total_ave + $total_ave_second )/ 2;


        $data['check'] = Generateresult::getStudentsResult($current_year->id, $current_term->id, $class_id);

        $data['term'] = $arr_first;
        $data['term_name'] = $current_term->name;
        $data['year_name'] = $current_year->name;
        $data['class_percentage'] = number_format((float)$class_percentage, 2, '.', '');
        $data['class_average'] =number_format((float)$class_average, 2, '.', '');
        $data['term'] = $arr_first;
        $data['class'] = $class_id;
        $data['terms'] = $arr_second;
        $data['avg'] = array_sum($arr_sum)/$subjects_coefficient;
        $data['total_point'] = array_sum($arr_sum);
        $data['total_student'] =$total_student;
        $data['form'] = $form;
        $data['subjects'] = $arr;
        $data['sum_coff'] = $subjects_coefficient;
        $data['ranked'] = Generateresult::where('term_id', $current_term)->where('year_id', $current_year)->get();

        return view('admin.student_marks.rank_final')->with($data);
    }



    /*
    this ranking of students was done
    by Engineer bimeri Magaza for the
    benefit of Secondary school that will
    want to use the system to facilate their
    result generation.


    The algorithm used here is very unique and
    efficient enought to sum up till thousands
    of students result
    */

    public function studentResult(Request $req){
        $class = $req['class_id'];
        $id = $req['term_id'];
        $year = $req['year_id'];

        $terms = Term::where('id', $id)->first();
        if(strcmp($terms->name, 'First Term') == 0){
            $data = Firsttermresult::getStudentClassRecord($year, $class);
        //    return $data;
           $arr = array();
           foreach($data as $dat){
               if(in_array($dat->stud_id, $arr)){}
               else{
                    $pnt = $data->where('stud_id', $dat->stud_id)->sum('points');
                    $coff = $data->where('stud_id', $dat->stud_id)->sum('subject_coff');
                    $info = [
                        'stud_id' => $dat->stud_id,
                        'student_card' =>$dat->stud_card,
                        'point' =>$pnt,
                        'sum_coff' =>$coff,
                        'average' =>(float)$pnt/(float)$coff
                    ];
                    array_push($arr, $info);
                }
            }
            $newarr = array_unique($arr, $dat->stud_id);
           // return $newarr;
           // $empty = array();
            foreach($newarr as $key => $new){
                // $st = [
                //     'stud_id' => $new['stud_id'],
                //     'student_card' => $new['student_card'],
                //     'points' => $new['point'],
                //     'sum_coffs' => $new['sum_coff'],
                //     'stud_ave' => $new['average']
                // ];
              //  array_push($empty, $st);
                $studentresults = new Studentresult();
                $studentresults->year_id = $year;
                $studentresults->term_id = $terms->id;
                $studentresults->form_id = $class;
                $studentresults->student_id = $new['stud_id'];
                $studentresults->student_school_id = $new['student_card'];
                $studentresults->average_point = $new['point'];
                $studentresults->sum_coff = $new['sum_coff'];
                $studentresults->stud_ave = $new['average'];

                if(Studentresult::where('year_id', $year)
                                ->where('term_id', $terms->id)
                                ->where('student_id', $new['stud_id'])
                                ->where('form_id', $class)->exists())
                                {
                                   $updateresult = Studentresult::where('year_id', $year)
                                    ->where('term_id', $terms->id)
                                    ->where('student_id', $new['stud_id'])
                                    ->where('form_id', $class)
                                    ->update([
                                                'average_point' =>  $new['point'],
                                                'sum_coff' => $new['sum_coff'],
                                                'stud_ave' => $new['average']
                                            ]);
                                }
                                else {
                                    $studentresults->save();
                                }
            }
            if($studentresults || $updateresult){

                $ranking_student = Studentresult::getStudent($year, $terms->id, $class);
                //return $ranking_student;
                foreach( $ranking_student as $key => $rank){
                    $ranking = Studentresult::where('year_id', $year)
                    ->where('term_id', $terms->id)
                    ->where('student_id', $rank->student_id)
                    ->where('form_id', $class)
                    ->update(['position' => ($key+1)]);
                }
                //get highest ave
                $highest_ave = Studentresult::getHighestAverage($year, $terms->id, $class);
                $lowest_ave = Studentresult::getLowestAverage($year, $terms->id, $class);
                $ave = Studentresult::getAverage($year, $terms->id, $class);
                $student_count = count($newarr);
                $class_ave =  $ave/$student_count;
                $number_pass = Studentresult::getPassedStudent($year, $terms->id, $class);
               // return $number_passed;

                $general_result = new Generateresult();

                $general_result->year_id = $year;
                $general_result->term_id = $terms->id;
                $general_result->form_id = $class;
                $general_result->number_of_student = $student_count;
                $general_result->number_passed = $number_pass;
                $general_result->class_avg = $class_ave;
                $general_result->highest_avg = $highest_ave;
                $general_result->lowest_avg = $lowest_ave;
                $general_result->rank_student = 1;


                if(Generateresult::where('year_id', $year)
                                ->where('form_id', $class)
                                ->where('term_id', $terms->id)
                                ->exists()){
                                    Generateresult::where('year_id', $year)
                                    ->where('form_id', $class)
                                    ->where('term_id', $terms->id)
                                    ->update([
                                        'number_of_student' =>  $student_count,
                                        'number_passed' =>  $number_pass,
                                        'class_avg' =>  $class_ave,
                                        'highest_avg' =>  $highest_ave,
                                        'lowest_avg' =>  $lowest_ave,
                                        'rank_student' =>  1
                                    ]);
                                }
                                else{
                                    $general_result->save();
                                }
                }
                if($general_result){
                    $notification = array('message' => 'Student '. $terms->name.' result has been Generated Successfuly', 'alert-type' => 'success');
                    return redirect()->back()->with($notification);
                }
                else {
                    $notification = array('message' => 'Fail to Generated result, please contact the admin', 'alert-type' => 'error');
                    return redirect()->back()->with($notification);
                }
        }


        //second term result
        elseif(strcmp($terms->name, 'Second Term') == 0){

        }
        else {

        }

    }
}
