<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class Patients extends Controller
{
    //
    protected function patient_by_hospitals($category){
        return DB::table('officers')
        ->join('patients', 'officers.OfficerUserName', '=',
         'patients.OfficerUserName')
         ->join('hospitals', 'hospitals.HospitalId', '=', 
         'officers.HospitalId')
        ->select('officers.OfficerName','hospitals.HospitalName',
        'patients.*'
        )->where('officers.HospitalCategory' , '=', $category)
       ->get();


    }
    
    protected function total_patients(){
        return DB::table('patients')->count();
    }


    public function index(){
        if(DB::table('patients')->count()){
            //for general hospitals
            $patients_general = $this->patient_by_hospitals('general');
            $patient_regional = $this->patient_by_hospitals('regional');
            $patient_national = $this->patient_by_hospitals('national');
            $total = $this->total_patients();

            return view("patients",
            ['patients_general'=>$patients_general,
            'patients_regional'=>$patient_regional,
            'patients_national'=>$patient_national,
            'total'=>$total
            ]);

        }
        else{
            //create empty array
            $patients_general = array();
            $patients_regional = array();
            $patients_national = array();
            $patients_total = array();
            return view("patients",
            ['patients_general'=>$patients_general,
            'patients_regional'=>$patients_regional,
            'patients_national'=>$patients_national,
            'total'=>$patients_total
            ]
        );
        }
    

    }
}
