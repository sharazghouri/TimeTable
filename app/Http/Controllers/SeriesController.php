<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeriesController extends Controller
{
    //
    /*
     * returning the view for drama series
     */
    public  function index  (){

        return view('series.add');
    }

    public function getepisode($id){

        return view('series.episode',['id'=>$id]);


    }
}
