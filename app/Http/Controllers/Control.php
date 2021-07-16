<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AxieTrack;
use Yajra\DataTables\Facades\DataTables;


class Control extends Controller
{
    public function list(Request $r)
    {
        $data = AxieTrack::all();
        $datatable = DataTables::of($data)
        
        ->editColumn('delete',function ($data){
            return '<a href="delete/'.$data->id.'"  class="btn btn-danger">delete</a>';

            // return '<a href="delete/'.$data->id.'"  class="btn btn-success">update</a>';
        })
        ->editColumn('update',function ($data){

            return '<a href="axietrack/'.$data->id.'/edit"  class="btn btn-success">update</a>';
        })
        ->rawColumns([ 'delete', 'update']);

    return $datatable->make(true);
    }

    public function delete($id)
    {
        $data = AxieTrack::find($id);
        $data->delete();
        return redirect()->back();
    }
}
