<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDetail;
use App\Models\UserOverTime;
use App\Models\UserLeave;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class UserDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = UserDetail::all();
        return view('user_detail/view',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user_detail/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'department' => 'required',
            'shift_time_start' => 'required',
            'shift_time_end' => 'required'
        ]);

        if($validator->passes())
        {
            $emp = new UserDetail;
            $emp->name = $request->name;
            $emp->department = $request->department;
            $emp->shift_time_start = $request->shift_time_start;
            $emp->shift_time_end = $request->shift_time_end;
            $emp->save();

            $leave = new UserLeave;
            $leave->user_id = $emp->id;
            $leave->join_date = Carbon::now();
            $leave->valid_for_year = Carbon::now()->addYear();
            $leave->save();

            return redirect('/')->with('msg','Employee Registered Successfully!');
        }
        else{
            return back()->withInput()->withErrors($validator);
        }
    }

    public function add(Request  $request)
    {
        $time = new UserOverTime;
        $time->user_id = $request->id;
        $time->total_hrs = $request->hr;
        $time->total_mints = $request->min;
        $time->over_time = $request->over;
        $time->save();

        return response()->json([
            'message'=>'You are now checked out!',
            'status'=>true,
            'code'=>201
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $emp = UserOverTime::with(['emp'])->whereHas('emp',function($q) use ($id){
            $q->where('id',$id);
        })->get();
        return view('user_detail/show',compact('emp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function allow($id)
    {
        $emp = UserDetail::find($id);
        $leave = UserLeave::where('user_id',$id)->first();
        $leave->allow = $leave->allow + 1;
        $leave->save();

        return back()->with('msg','Allow the leave to '.$emp->name);
    }

    public function notAllow($id)
    {
        $emp = UserDetail::find($id);
        $leave = UserLeave::where('user_id',$id)->first();
        $leave->not_allow = $leave->not_allow + 1;
        $leave->save();

        return back()->with('msg','Not allow the leave to '.$emp->name);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function leave()
    {
        $leave = UserLeave::with(['emp'])->get();
        return view('user_detail/leave',compact('leave'));
    }


    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
