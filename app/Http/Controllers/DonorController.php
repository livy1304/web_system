<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonorController extends Controller
{
    //
    public function index(){
        return view("donorfunds");
    }
    //getmonth
    protected function  get_month($array_month, $number){
        foreach($array_month as $months=>$value){
            if((int)$value=== (int)$number)
            return $months;
        }
        return ;
     }
     
    public function store(Request $request){
        $this->validate($request,
        ['amount'=>'required',
        'month'=>'required',
        'name'=>'required'
        ]
    );
   // dd($request);
    
    //array of months
    $array_of_months = ['January'=>'1', 'February'=>'2', 'March'=>'3', 'April'=>'4',
    'May'=>'5', 'June'=>'6', 'July'=>'7', 'August'=>'8', 
    'September'=>'9', 'October'=>'10', 'November'=>'11', 'December'=>'12'];

   
    $expode = explode("-", $request->month, 2)[1];
    //dd($expode);
    $found_month = $this->get_month($array_of_months, $expode);
    //dd($found_month);

    //checkdb
    $checker = DB::table('totalAmount')->where('Month', '=', $found_month)->get();
    //print_r($checker);
    if(count($checker)){
        
        //echo 'AM her in the databasae';
        //aupdate the column
        $Amount = DB::select('select Amount from totalAmount where Month = ?', [$found_month]);
        //print_r($Amount[0]->Amount);


        //loop
        $myAmount = "";
        foreach($Amount as $needed_amount){
                $myAmount = $needed_amount->Amount;
        }
        echo $myAmount;
        //add on amount
        $sum_amount = $request->amount + $myAmount;
        //update Amount table
        DB::update('update totalAmount set Amount = ? where Month = ?', [$sum_amount, $found_month]);

        //insert the donor name table
        // $newDate = \Carbon\Carbon::createFromFormat('m/d/y', $request->month)
        // ->format('Y-m-d');


        DB::insert('insert into donors
        (DonorName, Amount, Month) values (?, ?,?)', 
        [$request->name, $request->amount, $found_month]);


        //redirect donor list
        return redirect("/donorlist");


    }
    else{

        // $newDate = \Carbon\Carbon::createFromFormat('m/d/y', $request->month)
        //             ->format('Y-m-d');
        // echo 'First day : 
        // '. date("Y-m-01", strtotime($newDate)).' - Last day : '. date("Y-m-t", strtotime($newDate));

        DB::insert('insert into donors
        (DonorName, Amount, Month) values (?, ?,?)', 
        [$request->name, $request->amount, $found_month]);

          DB::insert('insert into totalAmount (Amount, Month) 
          values (?, ?)', [$request->amount, $found_month]);
            return redirect("/donorlist");
    }
        

    }

    

}

















