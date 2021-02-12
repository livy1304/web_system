<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromotedController extends Controller
{
    //
    public $promotions = array();
    public function total_officers($category){
        return DB::table('officers')
        ->join('hospitals', 'officers.HospitalId', '=',
         'hospitals.HospitalId')
        ->select('officers.HospitalCategory',
        'officers.HospitalId',
        DB::raw('COUNT(officers.HospitalId) as total_officers')
        )->where('officers.HospitalCategory' , '=', $category)
        ->groupBy(
         'officers.HospitalId',
          'officers.HospitalCategory')
       ->get();
    
    }
    //getofficers
    public function retrieve_officers(){
        return DB::table('officers')
        ->join('patients', 'officers.OfficerUserName', '=',
         'patients.OfficerUserName')
        ->select('officers.OfficerName','officers.HospitalId',
        'officers.OfficerUserName',
        'officers.OfficerUserName',
        DB::raw('COUNT(patients.OfficerUserName) as total_patients')
        )->where('officers.HospitalCategory' , '=', "general")
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

    //filter array
    protected function filter_officers($officer_array){
     return array_filter($officer_array , function($elements){
         if($elements->total_patients >=2){
             //dd($elements->total_patients);
             //return $elements;
           $newarray =  $this->convert_array($this->total_officers("regional"));
           $converted_to_array =  array_map(function($object){
            return  array('HospitalCategory'=>$object->HospitalCategory,
            'HospitalId'=>$object->HospitalId, 
          'total_officers'=>$object->total_officers,
          )
          ;
},$newarray);
           
            usort($converted_to_array, function ($item1, $item2) {
                return $item1['total_officers'] <=> $item2['total_officers'];
            });
            //dd($converted_to_array);

               if($converted_to_array[0]['total_officers']<100){
                   //insert to db here
                   $id = $converted_to_array[0]['HospitalId'];
                   $OfficerUserName = $elements->OfficerUserName;
                   //dd($elements);
                    //print_r($elements); 
                    //print_r($OfficerUserName); 
                  DB::update('update officers
                     set HospitalId = ?,
                     OfficerRole = ?,
                     HospitalCategory = ?
                      where OfficerUserName = ?', [$id,'senior officer','regional', $OfficerUserName]);            

               }
               $get_updated = DB::table('officers')->where('OfficerUserName', '=', $OfficerUserName)->get();
              //print_r($get_updated);

               foreach($get_updated as $updated){
                   array_push($this->promotions,$updated );

               }
               
         }
      });
    }

 
    public function index(){
        if(count($this->total_officers("general"))){
            
            $converted = $this->convert_array($this->retrieve_officers());
            //dd($this->retrieve_officers());
             $this->filter_officers($converted);
            return view ("promoted", 
        ["promotions"=>$this->promotions, 'totalPromotions'=>count($this->promotions)]);

        }
        else{
            
            $promoted = array();
            return view ("promoted", ["promoted"=>$promoted]);
        }

    }
}
