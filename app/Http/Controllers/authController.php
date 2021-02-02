<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
use Auth;

class authController extends Controller
{
    //
    public function login(Request $req){
        $this->validate($req, [
            'user_name' => 'required',
            'password' => 'required',
        ]);

        $email = $req['user_name'];
        $password = $req['password'];
        $remember = $req['remember'];

        //all admins using email
        if(Auth::guard('admin')->attempt(['email' => $email, 'password' => $password], $remember)){
            $notification = array(
                'message' => 'Hello, '.$email.' your login was Successfull!',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.home')->with($notification);
        }
        //all admins using user name
        else if(Auth::guard('admin')->attempt(['user_name' => $email, 'password' => $password], $remember)){
            $notification = array(
                'message' => 'Hello, '.$email.' your login was Successfull!',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.home')->with($notification);
        }
        //all student
        else if(Auth::guard('student')->attempt(['school_id' => $email, 'password' => $password], $remember)){
            $notification = array(
                'message' => 'Hello, your login was Successfull!',
                'alert-type' => 'success'
            );
            return redirect()->route('student.home')->with($notification);
        }
        //all teachers
        else if(Auth::guard('teacher')->attempt(['email' => $email, 'password' => $password, 'suspend' => 0], $remember)){
            $notification = array(
                'message' => 'Hello, '.$email.' your login was Successfull!',
                'alert-type' => 'success'
            );
            return redirect()->route('teacher.home')->with($notification);
        }
        else {
            $notification = array(
                'message' => 'you entered '.$email.', sorry, it is incorrect, please check your credentials and try again!',
                'alert-type' => 'error'
            );
            return redirect()->back()->withInput()->with($notification);
        }
    }

    public function adminLogout(){
        $notification = array(
            'message' => 'bye! bye!, logout successfully',
            'alert-type' => 'info'
        );
        Auth::guard('admin')->logout();
        return redirect('/')->with($notification);
        }

    public function studentLogout(){
        $notification = array(
            'message' => 'you successfully logout.',
            'alert-type' => 'info'
        );
        Auth::guard('student')->logout();
        return redirect('/')->with($notification);
        }
    public function teacherLogout(){
        $notification = array(
            'message' => 'bye! bye!, logout successfully',
            'alert-type' => 'info'
        );
        Auth::guard('teacher')->logout();
        return redirect('/')->with($notification);
        }
}
