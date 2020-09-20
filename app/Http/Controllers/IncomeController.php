<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Expensetype;
use App\Permission;
use App\Scholarship;
use App\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class IncomeController extends Controller
{
    //
    public function __construct()
    {
        return $this->middleware('auth:admin');
    }
    public function index(){
        $this->authorize('income_statement', Permission::class);
        $data['year'] = Year::getCurrentAcademicYear();
        $year = Year::getCurrentYear();
        $data['all_year'] = Year::getAllYear();
        $data['scholarships'] = Scholarship::getSumAmount($year);
        $data['expenses_sum'] = Expensetype::getSumAmount($year);
        $data['expenses'] = Expensetype::getCurrentYearInfo($year);
        $data['expenses_type'] = Expense::getAllType();
        return view('admin.public.income.income_statement')->with($data);
    }

    public function getIncomeStatment(Request $req){
        $this->authorize('income_statement', Permission::class);
        $decrypted = '';
        try {
            $decrypted = Crypt::decrypt($req['year']);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $mess = array('message' => 'Fail to decrypt Id, pleae contact the admin', 'alert-type' => 'error');
            return redirect()->back()->with($mess);
        }

        $year = $decrypted;
        $data['year'] = Year::getYear($year);
        $data['all_year'] = Year::getAllYear();
        $data['scholarships'] = Scholarship::getSumAmount($year);
        $data['expenses_sum'] = Expensetype::getSumAmount($year);
        $data['expenses'] = Expensetype::getCurrentYearInfo($year);
        $data['expenses_type'] = Expense::getAllType();
        return view('admin.public.income.income_statement')->with($data);
    }

    public function getDetail(Request $req){
        $decrypted_year_id = '';
        $decrypted_expense_id = '';
        try {
            $decrypted_year_id = Crypt::decrypt($req['year']);
            $decrypted_expense_id = Crypt::decrypt($req['type']);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $val = array('message' => 'Fail to Decrypt Id please contact the administator', 'alert-type' => 'error');
            return redirect()->back()->with($val);
        }
        $year = $decrypted_year_id;
        $expense = $decrypted_expense_id;

        $data['year'] = Year::getYearName($year);
        $data['expenses'] = Expensetype::getYearlyDetailPerExpense($year, $expense);

        return view('admin.public.income.detail')->with($data);
    }
}
