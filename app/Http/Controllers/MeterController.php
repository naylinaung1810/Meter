<?php

namespace App\Http\Controllers;

use App\Meter;
use App\MeterDetail;
use App\Mt;
use App\Type;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MeterController extends Controller
{
    public function getMeter()
    {
        $curr_month=Carbon::parse(now())->format('m');
        $users=User::get();
        $meters=Meter::get();
        $types=Type::get();

        foreach ($meters as $meter)
        {
            $month=Carbon::parse($meter->updated_at)->format('m');
            if($curr_month>$month)
            {
                $m=Meter::whereId($meter->id)->first();
                $m->status=false;
                $m->update();
            }
        }
        //dd($meters);
        return view('adminView.new-meter')->with(['users'=>$users,'meters'=>$meters,'types'=>$types]);
    }

    public function postMeter(Request $request)
    {
        $this->validate($request,[
            'user'=>'required',
            'type'=>'required',
            'home'=>'required|numeric'
        ]);
        $user_id=$request['user'];
        $home_no=$request['home'];
        $type=$request['type'];

        $meter=new Meter();
        $meter->user_id=$user_id;
        $meter->home=$home_no;
        $meter->type_id=$type;
        $meter->status=true;
        $meter->save();

        return redirect()->back()->with('info',"New Meter Adding is successful ");
    }

    public function getCheckMeter()
    {
        $meters=Meter::get();
        $meter_detail=MeterDetail::get();

       return view('adminView.meter.check-meter')->with(['meters'=>$meters,'meter_detail'=>$meter_detail]);
    }

    public function postCheckMeter(Request $request)
    {
        $this->validate($request,[
            'meter_id'=>'required',
            'unit'=>'required|numeric'
        ]);


        $meter_id=$request['meter_id'];
        $unit=$request['unit'];
        $user_id = Meter::whereId($meter_id)->first()->user->id;

        if(MeterDetail::where('meter_id',$meter_id)->get()->count()!=0)
        {
            $pre_unit=MeterDetail::where('meter_id',$meter_id)->get()->last()->curr_unit;
        }else
        {
            $pre_unit=0;
        }

        $cost=Meter::whereId($meter_id)->first()->type->cost;
        if($pre_unit<=$unit) {

           $rate=$unit-$pre_unit;

            $meter = new MeterDetail();
            $meter->meter_id = $meter_id;
            $meter->status=false;
            $meter->pre_unit = $pre_unit;
            $meter->curr_unit = $unit;
            $meter->rate=$unit-$pre_unit;
            $meter->amount=$rate*$cost;
            $meter->save();
            $m = Meter::whereId($user_id)->first();
            $m->status = true;
            $m->update();

            return redirect()->back()->with('info','Unit Registration is successful');

        }else
        {
            return redirect()->back()->with('error','Your meter unit is wrong');
        }

    }

    public function postMeterCheckout()
    {

        $meter_id=Meter::where('user_id',Auth::User()->id)->first()->id;
        //dd($meter_id);
        if(Meter::whereId($meter_id)->first()->status==true)
        {
            $curr_amount = Meter::whereId($meter_id)->first()->user->total_amount;
            $user_id = Meter::whereId($meter_id)->first()->user->id;
            $cost = Meter::whereId($meter_id)->first()->type->cost;
            $meter_detail=MeterDetail::where('meter_id', $meter_id)->first();
            $rate =$meter_detail->rate;

            if ($curr_amount <= ($rate * $cost)) {
                return redirect()->back()->with('error', 'Your balance is not enough');
            } else {
                $user = User::whereId($user_id)->first();
                $user->total_amount = $curr_amount - ($rate * $cost);
                $user->update();

                $meter_detail->status = true;
                $meter_detail->update();

                return redirect()->back()->with('info', 'Check out is successful');
            }
        }else
        {
            return redirect()->back()->with('error','You account has been checked');
        }
    }

    public function adminCheckout($id)
    {
        $meter_detail=MeterDetail::whereId($id)->first();
        $amount=$meter_detail->amount;
        $meter_id=$meter_detail->meter_id;

        $user=Meter::whereId($meter_id)->first()->user;

        if($user->total_amount<$amount)
        {
            return redirect()->back()->with('error','This User has not enough for billing');
        }else
        {
            $user->total_amount=$user->total_amount-$amount;
            $user->update();
//            $m = Meter::whereId($user->id)->first();
//            $m->status = true;
            $meter_detail->status=true;
            $meter_detail->update();
            return redirect()->back()->with('info', 'Check out is successful');
        }
    }

    public function getMeterUser($id)
    {
        $total_unit=0;
        $total_cost=0;
        $meter=Meter::where('user_id',$id)->first();
       // $meters=Meter::where('user_id',$id)->first();
        foreach ($meter->meterD as $m)
        {
            if($m->status==true)
            {
                $total_cost+=$m->amount;
            }
            $total_unit+=$m->rate;
        }
        //dd(count($meter->meterD));
        return view('adminView.meter.user-meter')->with(['meter'=>$meter,'total_amount'=>$total_cost,'total_unit'=>$total_unit]);
    }

}
