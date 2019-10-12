<?php

namespace App\Http\Controllers;

use App\Amount;
use App\Key;
use App\Meter;
use App\MeterDetail;
use App\TopUp;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function getDashboard()
    {
        return view('adminView.welcome');
    }

    public function getAllUsers()
    {
        $users=User::get();
        $roles=Role::get();
        return view('adminView.users')->with(['users'=>$users,'roles'=>$roles]);
    }

    public function postRemoveUser(Request $request)
    {
        $id=$request['id'];
        $user=User::whereId($id)->first();
        $user->delete();

        return redirect()->back();
    }

    public function postEditUser(Request $request)
    {
        $id=$request['id'];
        $name=$request['name'];
        $email=$request['email'];
        $role=$request['role'];
        $check=$request['verify'];

        $user=User::whereId($id)->first();
        $user->name=$name;
        $user->email=$email;
        $user->auth_check=$check;
        $user->update();
        $user->syncRoles($role);
        return redirect()->back();
    }

    public function getKey()
    {
        $amounts=Amount::get();
        $key=Key::with('amount')->get();
        return view('adminView.key_generate')->with(['amounts'=>$amounts,'keys'=>$key]);
    }

    public function getKeyCreate(Request $request)
    {
        //$amount_id=$request['amount'];
        $count=$request['count'];
        for ($i=0;$i<$count;$i++)
        {
            $key=new Key();
            $key->serial_num=date('ymd').mt_rand(100000000,999999999);
            $key->pin=mt_rand(1000000000000000, 9999999999999999);
            $key->amount_id=$request['amount'];
            $key->printed=false;
            $key->used=false;
            $key->save();

        }
         return redirect()->back();
    }

    public function getKeyPrint(){
        $key=Key::with('amount')->get();
        return view('adminView.topup')->with(['keys'=>$key]);
    }

    public function postKeyPrint(Request $request)
    {
        $ids=$request['id'];
        foreach ($ids as $id)
        {
            $key=Key::whereId($id)->first();
            $key->printed=true;
            $key->update();
        }

        return redirect()->back()->with('info','key generation is success');
    }

    public function getBarcode()
    {
        $keys=Key::with('amount')->get();

        return view('adminView.topupcode')->with(['keys'=>$keys]);
    }

    public function getAccInfo()
    {
        $total_unit=0;
        $total_cost=0;
        $keys=User::find(Auth::User()->id)->topup;
        $amount=Amount::get();
        $meters=Meter::where('user_id',Auth::User()->id)->first();
        foreach ($meters->meterD as $m)
        {
            if($m->status==true)
            {
                $total_cost+=$m->amount;
            }
            $total_unit+=$m->rate;
        }
       return view('adminView.acchistory')->with(['keys'=>$keys,'meters'=>$meters,'unit'=>$total_unit,'cost'=>$total_cost,'amount'=>$amount]);
    }

    public function postBill(Request $request)
    {

        $total=0;

        $pin=$request['pin'];
        $key=Key::wherePin($pin)->first();
        if($key) {
            if ($key->used != true && $key->printed == true) {
                $user_id = Auth::User()->id;
                $key_id = Key::wherePin($pin)->first()->id;
                DB::table('key_user')->insert([
                    'user_id'=>$user_id,
                    'key_id'=>$key_id,
                    'created_at'=>Carbon::now()->toDateTimeString(),
                    'updated_at'=>Carbon::now()->toDateTimeString()
                ]);

                $key->used=true;
                $key->update();
////////////////////////////////
                $curr_amount=User::find(Auth::User()->id)->total_amount;
                $amount=Amount::get();
                    foreach ($amount as $aa)
                    {
                        if($aa->id==$key->amount_id)
                        {
                            $total=$curr_amount+$aa->amount;
                        }
                    }
                $user=User::whereId($user_id)->first();
                $user->total_amount=$total;
                $user->update();

                return redirect()->back()->with('info',"Top Up successful");
            } else {
                return redirect()->back()->with('error', "Invalid PIN Number ");
            }
        }else
        {
            return redirect()->back()->with('error', "Invalid PIN Number ");
        }

    }

    public function getUserDetail($id)
    {
        $total_unit=0;
        $total_cost=0;
        $keys=User::find($id)->topup;
        $user=User::whereId($id)->first();
        $log=$user->logDetail;
        $amount=Amount::get();
        $meters=Meter::where('user_id',$id)->first();
        foreach ($meters->meterD as $m)
        {
            $total_unit+=$m->rate;
            $total_cost+=$m->amount;
        }

        return view('adminView.userdetail')->with(['keys'=>$keys,'user'=>$user,'amount'=>$amount,'log'=>$log,'total_cost'=>$total_cost,'total_unit'=>$total_unit,'meter'=>$meters]);
    }

    public function getKeyDetail($id)
    {
        $keys=Key::with('amount')->whereId($id)->first();
        $u=DB::table('key_user')->where('key_id',$id)->first();
        if($keys->used==false)
        {
            $user=null;
        }else
        {
            $user=User::whereId($u->user_id)->first();
            //dd($user);
        }
        return view('adminView.keyDetail')->with(['keys'=>$keys,'user'=>$user,'u'=>$u]);

    }

}
