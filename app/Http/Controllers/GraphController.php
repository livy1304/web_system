<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GraphController extends Controller
{
    //
    public function index(){
        return view("graphs");
    }
}
