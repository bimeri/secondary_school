<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Expensetype;
use App\Fee;
use App\Feecontrol;
use App\Feetype;
use App\Form;
use App\Permission;
use App\Scholarship;
use App\Sector;
use App\Student;
use App\Studentinfo;
use App\Subclass;
use App\Term;
use App\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class Fees_ExpensesController extends Controller
{
    //
    public function __construct()
    {
        return $this->middleware('auth:admin');
    }

    public function createfeeType(){
        $this->authorize('create_income', Permission::class);
        return view('admin.public.fees_expenses.fee_type');
    }

    public function createexpenseType(){
        $this->authorize('create_expenses', Permission::class);
        $data['expenses'] = Expense::getAllType();
        $year = Year::getCurrentYear();
        $data['yr'] = Year::getYearName($year);
        $data['current'] = Expensetype::getCurrentYearInfo($year);
        $data['expense_sum'] = Expensetype::getCurrentYearSum($year);

        return view('admin.public.fees_expenses.expense_type')->with($data);
    }

    public function getExpenseType(Request $req){
        $decrypted = '';
        try {
            $decrypted = Crypt::decrypt($req['year']);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $notice = array('message' => 'Fail to Decrypt Id, plese cocntact the administrator', 'alert-type' => 'error');
            return redirect()->back()->with($notice);
        }

        $this->authorize('create_expenses', Permission::class);
        $data['expenses'] = Expense::getAllType();
        $year = $decrypted;
        $data['yr'] = Year::getYearName($year);
        $data['current'] = Expensetype::getCurrentYearInfo($year);
        $data['expense_sum'] = Expensetype::getCurrentYearSum($year);

        return view('admin.public.fees_expenses.expense_type')->with($data);
    }

    public function addExpenseType(Request $req){
        $this->authorize('create_expenses', Permission::class);
        $this->validate($req, array('expense_type' => 'required'));
        $exp_type = $req['expense_type'];
        $expense = new Expense();

        $expense->name = $exp_type;
        $expense->save();

        $notify = array('message' => 'Expense Type Saved successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notify);
    }


    public function collectFees(){
        $this->authorize('receive_fees', Permission::class);
        $current_year = Year::getCurrentAcademicYear();
        $data['year'] =  $current_year;
        $data['form_name'] = '';
        $data['all_year'] =  Year::getAllYear();
        $data['students'] = Studentinfo::getAllStudentPerYear($current_year->id);
        return view('admin.public.fees_expenses.collect_fee')->with($data);
    }

    public function showFeecontrolPage(){
        $this->authorize('print_fee', Permission::class);
        return view('admin.public.fees_expenses.fee-control');
    }

    public function getStudents(Request $req){
        $this->authorize('receive_fees', Permission::class);
        $this->validate($req, [
            'year' => 'required',
            'class' => 'required',
        ]);
        try {
            $yr = Crypt::decrypt($req['year']);
            $cla = Crypt::decrypt($req['class']);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $mess = array('message' => 'Fail to Decrypt ,please Contact the admin', 'alert-type' => 'error');
            return redirect()->back()->with($mess);
        }
        $year_id = $yr;
        $form_id = $cla;
        $data['form_name'] = Form::getClassDetail($form_id);
        $current_year = Year::getYear($year_id);
        $data['year'] = $current_year;
        $data['all_year'] = Year::getAllYear();
        $data['students'] = Studentinfo::getAllStudentPerYearAndClass($year_id, $form_id);
        $data['notify'] = array('message' => 'Some result were found', 'alert-type' => 'success');
        return  view('admin.public.fees_expenses.collect_fee')->with($data);
    }

    public function viewExpense(){
        $this->authorize('record_expense', Permission::class);
        return view('admin.public.fees_expenses.view_expense');
    }

    public function reportFee(Request $req){
        $this->authorize('report_fees', Permission::class);
        $current_year = Year::where('active', 1)->first();
        $data['years'] = Year::getAllYear();
        $data['sectors'] = Sector::getAllType();
        $data['sectorId'] = '';
        $year_id = $current_year->id;
        $data['years'] = Year::all();
        $data['year_name'] = $current_year->name;
        $data['year_id'] = $year_id;

        $data['fees'] = Fee::getYearlyFeeStatistics($current_year->id);
        return view('admin.public.fees_expenses.report_fee')->with($data);
    }

    public function getSatistics(Request $req){
        $this->authorize('report_fees', Permission::class);
        $yearId = $req['year'];
        $data['sectorId'] = $req['sector'];
        $year_id = $yearId;
        $data['years'] = Year::all();
        $data['sectors'] = Sector::getAllType();
        $year_name = Year::getYearName($yearId);;
        $data['year_name'] = Year::getYearName($yearId);
        $data['year_id'] = $year_id;

        $data['fees'] = Fee::getYearlyFeeStatistics($yearId);
        session()->flash('message', 'Satistics for the academic year '.$year_name.'');
        return view('admin.public.fees_expenses.report_fee')->with($data);
    }

    public function feeStatistics(Request $req){
        //$this->authorize('receive_fees', Permission::class);
        $student_id = $req['student_school_id'];
        $year_id = $req['year_id'];
        $form_id = $req['form_id'];
        $studentInfo = Studentinfo::where('student_school_id', $student_id)->first();
        $student = Student::where('school_id', $student_id)->first();
        $data['total_fees'] = Feetype::getAllFeesPerClassAndYear($year_id, $form_id);
        $data['total_paid'] = Fee::getTotalFeePaid($year_id, $student_id);
        $data['yearly_scholarship'] = Scholarship::getYearlyScholarship($year_id, $student->id);
        $data['student_fees'] = Fee::getStudentYearlyFee($year_id, $form_id, $student->id);
        $data['school_id'] = $student_id;
        $data['current_form'] = $form_id;
        $data['student_id'] = $student->id;
        $data['studentinfo'] = $studentInfo;
        $data['formName'] = $studentInfo->form->name;
        $data['bgName'] = $studentInfo->form->background->name;
        $data['sectorName'] = $studentInfo->form->background->sector->name;
        $data['currentYear'] = $year_id;
        return view('admin.public.fees_expenses.fee_statistics')->with($data);
    }

    public function SubmitType(Request $req){
        $this->authorize('create_income', Permission::class);

        $this->validate($req, [
            'year' => 'required',
            'fee_type' => 'required',
            'class' => 'required',
            'amount' => 'required',
        ]);

        $year = $req['year'];
        $feeType = $req['fee_type'];
        $class = $req['class'];
        $amount = $req['amount'];

        $fees_type = new Feetype();

        $fees_type->year_id = $year;
        $fees_type->form_id = $class;
        $fees_type->fee_type = $feeType;
        $fees_type->amount = $amount;
        try{
            $notify = array('message' => 'Fee type has been saved with Success', 'alert-type' => 'success');
            $fees_type->save();
            return redirect()->back()->with($notify);
        }
        catch(\Illuminate\Database\QueryException $e){
            $notify = array('message' => 'fail to save data, error occured at the database level', 'alert-type' => 'error');
            return redirect()->back()->with($notify);
        }
    }

    public function createexpenseSubmit(Request $req){
        $this->authorize('create_expenses', Permission::class);
        $this->validate($req, [
            'year' => 'required',
            'term' => 'required',
            'expense_type' => 'required',
            'reason' => 'required',
        ]);
        $year = $req['year'];
        $term = $req['term'];
        $expense = $req['expense_type'];
        $reason = $req['reason'];
        $amnt = $req['amount'];

        $expense_type = new Expensetype();
        $expense_type->year_id = $year;
        $expense_type->term_id = $term;
        $expense_type->expense_id = $expense;
        $expense_type->amount = $amnt;
        $expense_type->reason = $reason;

        try{
            $notify = array('message' => 'Expense type has been saved with Success', 'alert-type' => 'success');
            $expense_type->save();
            return redirect()->back()->with($notify);
        }
        catch(\Illuminate\Database\QueryException $e){
            $notify = array('message' => 'fail to save data, error occured at the database level', 'alert-type' => 'error');
            return redirect()->back()->with($notify);
        }
    }

    public function updateType(Request $req){
        $this->authorize('create_income', Permission::class);
        $this->validate($req, [
            'year' => 'required',
            'fee_type' => 'required',
            'class' => 'required',
            'amount' => 'required',
        ]);
        $id = $req['id'];
        $year = $req['year'];
        $feeType = $req['fee_type'];
        $class = $req['class'];
        $amount = $req['amount'];

        try{
            DB::table('feetypes')->where('id', $id)->update([
                'fee_type' => $feeType,
                'year_id' => $year,
                'form_id' => $class,
                'amount' => $amount,
            ]);
            $notify = array('message' => 'Fee type has been Updated with Success', 'alert-type' => 'success');
            return redirect()->back()->with($notify);
        }
        catch(\Illuminate\Database\QueryException $e){
            $notify = array('message' => 'fail to update data, error occured at the database level', 'alert-type' => 'error');
            return redirect()->back()->with($notify);
        }
    }

    public function updateExpenseType(Request $req){
        $this->authorize('create_expenses', Permission::class);
        $this->validate($req, [
            'year' => 'required',
            'term' => 'required',
            'expense_type' => 'required',
            'reason' => 'required',
        ]);
        $id = $req['id'];
        $year = $req['year'];
        $term = $req['term'];
        $expense = $req['expense_type'];
        $reason = $req['reason'];

        try{
            DB::table('expensetypes')->where('id', $id)->update([
                'year_id' => $year,
                'term_id' => $term,
                'expense_type' => $expense,
                'reason' => $reason,
            ]);
            $notify = array('message' => 'Expense type has been Updated with Success', 'alert-type' => 'success');
            return redirect()->back()->with($notify);
        }
        catch(\Illuminate\Database\QueryException $e){
            $notify = array('message' => 'fail to update data, error occured at the database level', 'alert-type' => 'error');
            return redirect()->back()->with($notify);
        }
    }

    public function deleteFeeType(Request $req){
        $this->authorize('create_income', Permission::class);
        $id = $req['id'];
        $delete = DB::table('feetypes')->where('id', $id)->delete();

        if($delete){
            $message = array('message' => 'delete was successful', 'alert-type' => 'info');
            return redirect()->back()->with($message);
        } else {
            $message = array('message' => 'fail to delete', 'alert-type' => 'error');
            return redirect()->back()->with($message);
        }
    }

    public function collectSubmit(Request $req){
        $this->validate($req, [
            'amount' => 'required',
            'year' => 'required',
            'form_id' => 'required',
        ]);
        $student_id = $req['student_id'];
        $studentschool_id = $req['student_schoold_id'];
        $year = $req['year'];
        $formId = $req['form_id'];
        (float)$amount = $req['amount'];
        $scholarship = $req['scholarship'];
        $method = $req['method'];
        $feetype = $req['feetype'];

        $getFeeTypeAmount = Feetype::getFeeTypeById($feetype);
        $feetypeName = Feetype::getFeeTypeName($feetype);
        $yearNme = Year::getYearName($year);
        (float)$sumStudentPaidFeeType = Fee::getStudentFeeTypeSum($year,$formId,$feetype, $student_id);
        $studentName = Studentinfo::getStudentByName($student_id);

        if((float)$getFeeTypeAmount->amount == $sumStudentPaidFeeType){
            session()->flash('notify', "<b>".$studentName."</b> ".trans("messages.has_completed")." <b>".$feetypeName." Fees</b> for the academic Year:<b>".$yearNme."</b>. You can't Exceed Payment");
            return redirect()->back();
        }
        if(($sumStudentPaidFeeType + $amount) > $getFeeTypeAmount->amount ){
            session()->flash('notify', "You have already paid ".$sumStudentPaidFeeType."XCFA, adding <b>".$amount." CFA</b> will make a total of: ".($sumStudentPaidFeeType+ $amount)."CFA which is Greater than the Current Fee Amount: ".$getFeeTypeAmount->amount." CFA. please you just need to add ".($getFeeTypeAmount->amount - $sumStudentPaidFeeType)." CFA");
            return redirect()->back();
        }

        $dates =  date('M d, Y - h:ia', time());
        $balance = $getFeeTypeAmount->amount - ($sumStudentPaidFeeType + $amount);

        if(Fee::where('student_school_id', $studentschool_id)->where('year_id', $year)->where('scholarship', '!=', null)->exists()){
            $scholar = null;
        } else{
            $scholar = $scholarship;
        }

        if($balance == 0){
            $status = 1;
        }
        else{ $status = 0;}

        //return $all;
        $fees = new Fee();
        $fees->year_id = $year;
        $fees->feetype_id = $feetype;
        $fees->student_id = $student_id;
        $fees->student_school_id = $studentschool_id;
        $fees->form_id = $formId;
        $fees->scholarship = $scholar;
        $fees->amount = $amount;
        $fees->payment_method = $method;
        $fees->balance = $balance;
        $fees->status = $status;
        $fees->payment_date = $dates;

        $fees->save();

        if($fees){
            $notification = array('message' => 'Fees Saves Successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
        else {
            $notification = array('message' => 'Fail to Save Record, try again', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }

    public function getFeeType(Request $req)
        {
            $year_id = $req['year'];
            $form_id = $req['form_id'];

           if(!$year_id){
               $yr = Year::getCurrentYear();
           }
           else{
               $yr = $year_id;
           }
            $cc = Feetype::getCurrentYearformFee($yr, $form_id);
            $sum = Feetype::getAllFeesPerClassAndYear($year_id, $form_id);
            //return $arr;
            return response()->json(["option" => $cc, "sum" => $sum]);
        }

    public function feeclearance(Request $req){
        $stid = (int)$req['student_id'];
        $school = $req['school_id'];
        $year = (int)$req['year_id'];
        $form = (int)$req['form_id'];
        $date = date("D, d M Y H:ia");

        $feecontrol = new Feecontrol();
        $feecontrol->student_id = $stid;
        $feecontrol->student_school_id = $school;
        $feecontrol->form_id = $form;
        $feecontrol->year_id = $year;
        $feecontrol->clearance_date = $date;

        try{
            $feecontrol->save();
            $notify = array('message' => 'Student Fees clearance was successfully approved', 'alert-type' => 'success');
            return redirect()->back()->with($notify);
        }
        catch(\Illuminate\Database\QueryException $e){
            $notify = array('message' => 'Fail to clear student, please contact the Administrator for this.', 'alert-type' => 'error');
            return redirect()->back()->with($notify);
        }
    }

    public function getClasses(Request $req){
        $year = $req['year'];
        $form = $req['class'];

        try {
            $year = Crypt::decrypt($req['year']);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $message = array('message' => 'fail to decrypt Id please contact the admin', 'alert-type' => 'error');
            return redirect()->back()->with($message);
        }
        $data['year'] = Year::getYear($year);
        $data['feetypes'] = Feetype::getclasssFeePerYear($year, $form);
        $data['form'] = Form::getClassDetail($form);
        $data['count'] = Feetype::getclasssFeePerYear($year,  $form)->count();
        return view('admin.public.fees_expenses.create_class_fee')->with($data);
    }
}
