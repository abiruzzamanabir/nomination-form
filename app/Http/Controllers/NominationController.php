<?php

namespace App\Http\Controllers;

use App\Models\Nomination;
use Illuminate\Http\Request;

class NominationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('nomination.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:nominations',
            'phone' => 'required|numeric|unique:nominations|starts_with:+8801,01',
        ]);

        $ukey=rand().time();

        Nomination::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'uid' => '',
            'ukey' => $ukey,
        ]);

        return redirect()->route('form.hosted',$ukey);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'invoice' => 'required|numeric',
        ]);
        $update_date = Nomination::where('ukey', $id)->first();

        $update_date->update([
            'invoice' => $request->invoice,
        ]);

        return redirect()->route('form.index')->with('success', 'Nomination Submitted');
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
    public function hosted($ukey=null)
    {
        if($ukey===null){
            return redirect()->route('form.index')->with('danger', 'User Key Not Found');
        }
        if ($ukey) {
            $user_date = Nomination::where('ukey', $ukey)->first();
            if ($user_date) {
                return view('nomination.checkout',[
                    'name' => $user_date->name,
                    'email' => $user_date->email,
                    'phone' => $user_date->phone,
                    'payment' => $user_date->payment,
                    'invoice' => $user_date->invoice,
                    'ukey' => $user_date->ukey,
                ]);
            } else {
                return redirect()->route('form.index')->with('warning', 'User Key not matched');
            }
        }
    }
}
