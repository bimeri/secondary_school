<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Expensetype;
use App\Fee;
use App\Feecontrol;
use App\Feetype;
use App\Permission;
use App\Scholarship;
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
        $current_year = Year::where('active', 1)->first();
        $students = Studentinfo::where('year_id', $current_year->id)->paginate(5);
        return view('admin.public.fees_expenses.collect_fee', compact('students'));
    }

    public function getStudents(Request $req){
        $this->authorize('receive_fees', Permission::class);
        $this->validate($req, [
            'year' => 'required',
            'class' => 'required',
        ]);
        $year_id = $req['year'];
        $form_id = $req['class'];

        $students = Studentinfo::where('year_id', $year_id)->where('form_id', $form_id)->paginate(5);
        $path = '';
        if($students){
        $notify = array('message' => 'Some result were found', 'alert-type' => 'success');
        return  view('admin.public.fees_expenses.collect_fee', compact('students'))->with($notify);
        }
        else {
            $notify = array('message' => 'Your seach matched not result found', 'alert-type' => 'info');
            return  view('admin.public.fees_expenses.collect_fee', compact('students'))->with($notify);
        }
    }

    public function viewExpense(){
        $this->authorize('record_expense', Permission::class);
        return view('admin.public.fees_expenses.view_expense');
    }

    public function reportFee(Request $req){
        $this->authorize('report_fees', Permission::class);
        $current_year = Year::where('active', 1)->first();
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
        $yearName = Year::where('id', $yearId)->first();
        $year_id = $yearId;
        $data['years'] = Year::all();
        $data['year_name'] = $yearName->name;
        $data['year_id'] = $year_id;

        $data['fees'] = Fee::getYearlyFeeStatistics($yearId);
        session()->flash('message', 'Satistics for the academic year '.$yearName->name.' ');
        return view('admin.public.fees_expenses.report_fee')->with($data);
    }

    public function feeStatistics(Request $req){
        //$this->authorize('receive_fees', Permission::class);
        $student_id = $req['student_school_id'];
        $year_id = $req['year_id'];
        $form_id = $req['form_id'];
        $studentInfo = Studentinfo::where('student_school_id', $student_id)->first();
        if($studentInfo->subform_id == null){
            $subclass = null;
        } else {
            $sub = Subclass::where('form_id', $studentInfo->form_id)->first();
            $subclass = $sub->type;
        };
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
            'amount' => 'required'
        ]);

        $student_id = $req['student_id'];
        $studentschool_id = $req['student_schoold_id'];
        $year = $req['year'];
        $formId = $req['firm_id'];
        $amount = $req['amount'];
        $scholarship = $req['scholarship'];
        $method = $req['method'];
        $feetype = $req['feetype'];
        $dates =  date('M d, Y - h:ia', time());
        $sum_paid = Fee::where('year_id', $year)->where('feetype_id', $feetype)->where('student_id', $student_id)->sum('amount');
        $type_amount = Feetype::where('year_id', $year)->where('id', $feetype)->first();
        $total_amount = $type_amount->amount;
        if($sum_paid >= $total_amount){
            $balance = 0;
        }
        elseif($total_amount > $amount){
            $holder = $total_amount - ($sum_paid + $amount);
            if($holder > 0){
                $balance = $holder;
            }
            else {
                $balance = 0;
            }
        }
        elseif($total_amount == ($sum_paid + $amount)){
            $balance = 0;
        }
         else {
            $balance = 0;
        }
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

           // $all = $req->input();
            $cc = array();
             $feetype = DB::table("feetypes")
            ->where("year_id", $year_id)
            ->where("form_id", $form_id)
            ->get();

            $sum = Feetype::getAllFeesPerClassAndYear($year_id, $form_id);

            foreach ($feetype as $type) {
                $arr = array('feetype' => $type->fee_type, 'amount' => $type->amount, 'id' => $type->id, 'sum' => $sum);
                array_push($cc, $arr);
            }
            return response()->json($cc);
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
            $notify = array('message' => 'Student clearance was successfully made', 'alert-type' => 'success');
            return redirect()->back()->with($notify);
        }
        catch(\Illuminate\Database\QueryException $e){
            $notify = array('message' => 'Fail to clear student, please contact the Administrator for this.', 'alert-type' => 'error');
            return redirect()->back()->with($notify);
        }
    }
}
