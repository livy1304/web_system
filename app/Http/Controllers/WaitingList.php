<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class WaitingList extends Controller
{
    //
    public $promotions = array();
    public function retrieve_officers(){
        return DB::table('officers')
        ->join('patients', 'officers.OfficerUserName', '=',
         'patients.OfficerUserName')
        ->select('officers.OfficerName','officers.HospitalId',
        'officers.OfficerUserName',
        'officers.OfficerUserName',
        DB::raw('COUNT(patients.OfficerUserName) as total_patients')
        )->where('officers.HospitalCategory' , '=', "regional")
        ->groupBy(
         'officers.OfficerUserName',
         'officers.HospitalId',
          'officers.OfficerName', 'officers.OfficerUserName')
       ->get();
        }
          //convert to an array
    protected function convert_array($array_elements){
        return array_map(function($object){
            return $object;
     },$array_elements->toArray());
    

    }
    protected function filter_regional_hospital($officer_array){
        return array_filter($officer_array , function($elements){
            if($elements->total_patients >=2){
                //dd($elements);
               if(count(DB::table("promotions")->where("OfficerUserName", '=', $elements->OfficerUserName)->get())){
                   return ;
               }
               else{
                DB::insert('insert into promotions
                (OfficerName ,OfficerUserName, Award, Pending) values (?, ?, ?, ?)', 
                [$elements->OfficerName, $elements->OfficerUserName, '10000000', True]);

                
                  //dd($newpromoted);  
            
                    //print_r($newpromotedOne);
                    foreach($newpromoted as $promote){
                        array_push($this->promotions, $promote);
                    }
                    //dd($this->promote_to_list);
                    
                    //$this->newPromoted($newpromoted);
                

                 


               }


            }
         });
         

    }


    public function index(){
        if(count($this->retrieve_officers())){
           

           $convert_to_array = $this->convert_array($this->retrieve_officers());
           $this->filter_regional_hospital($convert_to_array);
           $newpromoted = DB::table('promotions')->get();
            return view("waitinglist", ['promotions'=>$newpromoted]);

        }
        else{
            return view("waitinglist", ['promotions'=>$this->promotions]);

        }
        
    }
}
