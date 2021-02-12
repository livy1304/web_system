<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterOfficer extends Controller
{
    //
    public function index(){
        return view("officer");
    }
    public function get_officers(){
        return DB::table('officers')
        ->join('hospitals', 'officers.HospitalId', '=',
         'hospitals.HospitalId')
        ->select('officers.HospitalCategory',
        'officers.HospitalId',
        DB::raw('COUNT(officers.HospitalId) as total_officers')
        )->where('officers.HospitalCategory' , '=', 'general')
        ->groupBy(
         'officers.HospitalId',
          'officers.HospitalCategory')
       ->get();

    }

    public function store(Request $request){
        $this->validate($request,
        ['name'=>'required',
        'username'=>'required'
        ]);
 if(count($this->get_officers())){
             //retreive data
        $result = $this->get_officers();
    

        //change to array
     $change_to_array = array_map(function($object){

       return array("hospitalId"=>$object->HospitalId, 
       "total_officers"=>$object->total_officers);
}, 
$result->toArray());
//print_r($change_to_array);

//sort associative array
usort($change_to_array, function ($item1, $item2) {
    return $item1['total_officers'] <=> $item2['total_officers'];
});
//dd($change_to_array);
//first element and id
$totalofficers = $change_to_array[0]['total_officers'];
$id = $change_to_array[0]["hospitalId"];
echo $totalofficers;
if($totalofficers > 15){
    return back()->with("status", "All general hospitals are full");
}
else{
    $hospital_details = DB::table('hospitals')->where('HospitalId', $id)->get();
//print_r($hospital_details);

DB::insert('insert into officers (OfficerName,officerUserName, HospitalId)
 values (?, ?,?)', [$request->name, $request->username
  , $hospital_details[0]->HospitalId]);

  $totalofficers = DB::table('officers')->get();
  if(count($totalofficers)){
      return view("officerlist", 
      ['totalOfficers'=>$totalofficers,
      'total'=>count($totalofficers)
      ]);

  }
    
}


   }
        else{
            return back()->with("status", "Hospitals lack data");
        }



    }
}
