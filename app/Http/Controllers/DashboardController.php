<?php

namespace App\Http\Controllers;

use App\Models\Nomination;
use App\Notifications\Notifications\PaymentNotification;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nomination = Nomination::where('trash', false)->get();
        return view('dashboard.index', [
            'all_nomination' => $nomination,
        ]);
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
        //
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
        $update_date = Nomination::findOrFail($id);


        $update_date->update([
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Comment Added');
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
    public function makePayment(Request $request)
    {
        $user_data = Nomination::where('ukey', $request->ukey)->first();
        $user_data->notify(new PaymentNotification($user_data));
        return redirect()->route('dashboard.index')->with('success', 'Payment Link Successfully Send To ' . $user_data->name);
    }
    public function trash()
    {
        $nomination = Nomination::where('trash', true)->get();
        return view('trash.index', [
            'all_nomination' => $nomination,
        ]);
    }
    public function updateStatus($id)
    {
        $data = Nomination::where('ukey', $id)->first();

        if ($data->status) {
            $data->update([
                'status' => false,
            ]);
        } else {
            $data->update([
                'status' => true,
            ]);
        }
        return back()->with('success', 'Status updated successfully');
    }
    public function updateTrash($id)
    {
        $data = Nomination::where('ukey', $id)->first();

        if ($data->trash) {
            $data->update([
                'trash' => false,
            ]);
        } else {
            $data->update([
                'trash' => true,
            ]);
        }
        return back()->with('success', 'Trash updated successfully');
    }
    public function updatePV($id)
    {
        $data = Nomination::where('ukey', $id)->first();

        if ($data->pv) {
            $data->update([
                'pv' => false,
            ]);
        } else {
            $data->update([
                'pv' => true,
                'trash' => false,
            ]);
        }
        return back()->with('success', 'Payment Status updated successfully');
    }
    public function commentEmpty($id)
    {
        
        $update_date = Nomination::findOrFail($id)->first();
        $update_date->update([
            'comment' => null,
        ]);

        return back()->with('success', 'Comment Removed');
    }
}
