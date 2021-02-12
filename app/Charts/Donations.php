<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Donations extends BaseChart
{
    protected function retrieveNames(){
        $result = DB::table('donors')
        ->get();
       $getDonerName = array();
       foreach($result as $results){
           array_push($getDonerName, $results->DonorName);
       }
       return $getDonerName;

   }


   protected function retrieveAmount(){
      $result = DB::table('donors')
      ->get();
      $getAmount = array();
      foreach($result as $results){
          array_push($getAmount,$results->Amount);
      }
      return $getAmount;
   }
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {  

        if(count($this->retrieveAmount())){
            return Chartisan::build()
            ->labels($this->retrieveNames())
            ->dataset('Sample', $this->retrieveAmount());

        }
        else{
            return Chartisan::build()
            ->labels(['First', 'Second', 'Third'])
            ->dataset('Sample', [100, 200, 300]);

        }

    }
}