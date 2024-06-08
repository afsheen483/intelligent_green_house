<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use DB;
use Redirect;
use Input;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\Validates\Requests;
use Illuminate\Foundation\Auth\Access\Authorizes\Resources;
use Illuminate\Html\HtmlService\Provider;

use Illuminate\Support\Facades\Hash;

class ProfileSettings extends Controller
{
    use AuthenticatesUsers;
    public function profile()
    {
       try {
           $user_id = Auth::user()->id;
           $profile = User::where('id','=',$user_id)->get();
           return view('ProfileSettings.profile',compact("profile"));
       } catch (\Throwable $th) {
           //throw $th;
           dd($th);
       }
    }
    public function ChangePassword(Request $request)
    {
        try {
            $hashedPassword = Auth::user()->password;
            // dd($hashedPassword);
            if (\Hash::check($request->old_password , $hashedPassword )) {
              if (!\Hash::check($request->new_password , $hashedPassword)){
                   $users =User::find(Auth::user()->id);
                   $user_id = Auth::user()->id;
                   $users_password = $request->new_password;
                  User::where('id','=',$user_id)->update([
                      'password' => Hash::make($users_password),
                  ]);

                   return redirect()->back()->with('message','password updated successfully');
                 }

                 else{
                       return redirect()->back()->with('message','new password can not be the old password!');
                     }

                }

               else{

                    return redirect()->back()->with('message','old password doesnt matched ');
                  }



        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }
    public function LoginAndExpire(Request $request)
    {

        $customer_id = $request->customer_id;
        // dd($customer_id);
        Auth::logout();
        \Session::flush();



        $email = User::where('id','=',$customer_id)->pluck('email')->first();
        $password = User::where('id','=',$customer_id)->pluck('password_confirmation')->first();
            // Creating Rules for Email and Password
           // $password = "admin1234";
       // dd($password);
    $rules = array(
        'email' => 'required|email', // make sure the email is an actual email
        'password' => 'required|min:4'
    );
    $userdata = array(
        'email' => $email ,
        'password' => $password
      );
        // password has to be greater than 3 characters and can only be alphanumeric and);
        // checking all field
        $validator = Validator::make($userdata,$rules);
        // if the validator fails, redirect back to the form
        if ($validator->fails())
          {

          return Redirect::to('login')->withErrors($validator) // send back all errors to the login form
          ->withInput($password); // send back the input (not the password) so that we can repopulate the form
          }
          else
          {
          // create our user data for the authentication
          $userdata = array(
            'email' => $email,
            'password' => $password
          );
          //dd($userdata);
          // attempt to do the login
    //    $f = count($userdata);
    //dd(Auth::attempt($userdata));
          if (Auth::attempt($userdata))
            {
               return redirect('/customer_home/1');
            }else{
                return redirect('/login');
            }

          }

    }

}
