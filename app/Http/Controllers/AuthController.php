<?php

namespace App\Http\Controllers;

use App\login;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function getNewUser()
    {
        $roles=Role::all();
        return view('auth.new-user')->with(['roles'=>$roles]);
    }

    public function postNewUser(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:users',
            'email'=>'required|email|unique:users',
            'role'=>'required',
            'password'=>'required|min:5'
        ]);

        $user=new User();
        $user->name=$request['name'];
        $user->email=$request['email'];
        $user->password=bcrypt($request['password']);
        $user->auth_check=true;
        $user->total_amount=0;
        $user->save();
        $user->syncRoles($request['role']);
        return redirect()->back()->with('info', 'The new user account have been created.');
    }


    public function logout()
    {
        $log_status=new login();
        $log_status->user_id=Auth::User()->id;
        $log_status->status=false;
        $log_status->save();
        Auth::logout();
        return redirect()->back();
    }

    public function passwordChangeView()
    {
        return view('adminView.changePassword');
    }

    public function passwordChange(Request $request)
    {
        $this->validate($request,[
            'new_password'=>'required',
            'con_password'=>'required'
        ]);
        $id=$request['id'];
        //$password=bcrypt($request['password']);
        $new_password=$request['new_password'];
        $con_password=$request['con_password'];
        if($new_password==$con_password)
        {
            $user=User::whereId($id)->first();
//            if(User::where('password',$password)->first())
//            {
                $user->password=bcrypt($new_password);
                $user->update();
                return redirect()->back()->with('info','Your password is changed');
//            }else
//            {
//                return redirect()->back()->with('error','Your password is not match');
//            }
        }else
        {
            return redirect()->back()->with('error','Password Does not match!');
        }
    }

    public function getSignIn()
    {
        return view('auth.signin');
    }

    public function postSignIn(Request $request)
{
    $this->validate($request,[
        'email'=>'required|exists:users',
        'password'=>'required'
    ]);

    $email=$request['email'];
    $password=$request['password'];


        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            if(Auth::User()->auth_check==true)
            {
                $log_status=new login();
                $log_status->user_id=Auth::User()->id;
                $log_status->status=true;
                $log_status->save();

                return redirect()->route('dashboard');
            }else {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Your Account had been ban');
            }
        } else {
            return redirect()->back()->with('error', 'Validation is invalid');
        }
    }



}
