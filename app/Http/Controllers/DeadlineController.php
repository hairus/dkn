<?php

namespace App\Http\Controllers;

use App\Models\deadline;
use App\Models\kab_kota;
use Illuminate\Http\Request;

class DeadlineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deadlines = deadline::all();

        return view('admin.deadline.index', compact('deadlines'));
    }

    public function addDead()
    {
        $kabs = kab_kota::all();

        return view('admin.deadline.addDead', compact('kabs'));
    }

    public function saveDead(Request $request)
    {
        $sim = deadline::create([
            "deadline" => $request->date,
            'kab_id' => $request->kab_id
        ]);

        return redirect('/admin/deadline');
    }

    public function delDead($id)
    {
        $del = deadline::find($id);
        $del->delete();

        return back();
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
     * @param  \App\Models\deadline  $deadline
     * @return \Illuminate\Http\Response
     */
    public function show(deadline $deadline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\deadline  $deadline
     * @return \Illuminate\Http\Response
     */
    public function edit(deadline $deadline)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\deadline  $deadline
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, deadline $deadline)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\deadline  $deadline
     * @return \Illuminate\Http\Response
     */
    public function destroy(deadline $deadline)
    {
        //
    }
}
