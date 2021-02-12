<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfficersController extends Controller
{
    //
    public function index(){
        $totalofficers = DB::table('officers')->get();
        if(count($totalofficers)){
            return view("officerlist", 
            ['totalOfficers'=>$totalofficers,
            'total'=>count($totalofficers)
            ]);

        }
        else{
           $totalofficers = array();

            return view("officerlist", 
            ['totalOfficers'=>$totalofficers,
            'total'=>count($totalofficers)
            ]);
        }


    }
    // public function store(Request $request){
    //     $this->validate($request , [

    //     ]);
    // }
}
