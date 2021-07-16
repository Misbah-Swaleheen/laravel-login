<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AxieTrack;

class AxieTrackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = AxieTrack::all();
        return view('axie_track.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('axie_track.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'web_address' => 'required|max:50',
            'cost_dollar' => 'required'
        ]);

        $data = new AxieTrack;
        $data->web_address = $request->web_address;
        $data->eth = $request->eth;
        $data->cost_dollar = $request->cost_dollar;
        $data->type = $request->type;
        $data->team = $request->team;
        $data->breed = $request->breed;
        $data->sell_eth = $request->sell_eth;
        $data->sell_dollar = $request->sell_dollar;
        $data->save();
        if ( $data->save()) {
            return redirect()->back()->with(['message' => 'Axie_track added successfully']);

            }
            else{
            return redirect()->back()->with(['message' => 'Axie_track is not added ']);

            }
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
        $data = Axietrack::find($id);
        return view('axie_track.edit',['data' => $data]);
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
        $request->validate([
            'web_address' => 'required|max:50',
            'cost_dollar' => 'required'
        ]);

        $data =  AxieTrack::find($id);
        $data->web_address = $request->web_address;
        $data->eth = $request->eth;
        $data->cost_dollar = $request->cost_dollar;
        $data->type = $request->type;
        $data->team = $request->team;
        $data->breed = $request->breed;
        $data->sell_eth = $request->sell_eth;
        $data->sell_dollar = $request->sell_dollar;
        $data->save();
        return redirect('admin/axietrack');
        
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = AxieTrack::find($id);
        $data->delete();
        return redirect()->back();
    }
}
