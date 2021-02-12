<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    //
    public string $default_month;
    public  string $set_month;
    public $set =False;
    protected function  getMonth(){

        if($this->set){
              $store_month = $this->set_month;
            
            $donor_money = DB::select('select Month ,Amount from 
            totalAmount where Month = ?', [$store_month]);
            $this->default_month = $store_month;
            return $donor_money[0]->Amount;
            //return $donor_money[0]->Amount;
      
    
         }
         else{
            $donor_money = DB::table('totalAmount')
            ->select('Amount','Month')
            ->where('AmountId', '=', 1)->
            get();
            if(count($donor_money)){
                //print_r($donor_money);
                $this->default_month = $donor_money[0]->Month;
                return $donor_money[0]->Amount;
            }
            else{
                return;
            }

      
         }
    }

    //renaiing amount
    private function  cal_payments($first_amount, $second_amount){
        $remaining_amount = (int)$first_amount-(int)$second_amount;
        return (int)$remaining_amount;
    }

    //format currency
    protected function  format_currency($array_currency){
        return  array_map(function($currency){
              if($currency->Payments){
                 $currency->Payments = number_format($currency->Payments, 2, '.', ',');
                 return $currency;
              }
         }, $array_currency);
     }
     //format currency staff
     protected function  format_currency_staff($array_currency){
        return  array_map(function($currency){
              if($currency->Payments){
                 $currency->Payments = number_format($currency->Payments, 2, '.', ',');
                 return $currency;
              }
         }, $array_currency);
     }

     //count officers
     protected function count_officers($role){
         return DB::table('officers')
         ->where("OfficerRole","=", $role)
         ->count();
     }
     //update officer salary
     protected function update_payments($salary, $officerRole){
         return DB::update("update officers set Payments = $salary
         where OfficerRole = ?", [$officerRole]);
     }
     //officer salary
     protected function update_payments_staff($salary){
        return DB::update("update users set Payments = $salary");
    }


     //pass for formating
     protected function pass_to_format($hospitalCategory){
         return DB::select('select OfficerRole, Payments , OfficerName from officers
          where HospitalCategory = ?', [$hospitalCategory]);
     }
     //pass to frmat staff
     protected function pass_to_format_staff(){
        return DB::select('select * from users');
    }
     //getall months
     protected function all_months(){
         return DB::select('select Month from totalAmount where Amount >?', [100000000]);
         
     }

    public function index(){
        $diff_money = $this->cal_payments((int)$this->getMonth(),(int)100000000 );
        if($diff_money >0){
            
            $remaining_amount = $this->cal_payments($diff_money, 5000000);
            $director_money_national_referal = 5000000;
            $superintendent_money = $director_money_national_referal/2;
            $remaining_after_superintendent = $this->cal_payments($remaining_amount, $superintendent_money);
            $administrator_money = $superintendent_money*(3/4);
            $remaining_after_admin = $this->cal_payments($remaining_after_superintendent, $administrator_money);

            //calcutte total officers in general hospitals
            $total_officers_general = $this->count_officers('officer');
            //echo 'We are general'.$total_officers_general;
            
    
            //officers general hospital salary
            $general_officer_salary = $administrator_money*(8/5);
            $total_officer_salary = $general_officer_salary;
            if($total_officers_general){
               $total_officer_salary = $total_officers_general*$total_officer_salary;
            }
            
            //$general_officer_salary*$total_officers_general
            $remaining_after_general_officer_salary = $this->cal_payments($remaining_after_admin, $total_officer_salary);
    
            //echo $remaining_after_general_officer_salary;
    
            //total senior officers
            $senior_officer_salary = $general_officer_salary + $general_officer_salary*(6/100);
            $total_senior_officers = $this->count_officers('senior officer');
            //echo $total_senior_officers;
            if($total_senior_officers){
                $total_senior_officer_salary = $total_senior_officers*$senior_officer_salary;
            }        
            $remaining_amount_after_senior_officers = $this->
            cal_payments($remaining_after_general_officer_salary, $total_senior_officers);
    
            //calcu head officer
            $head_officer_salary = $general_officer_salary + $general_officer_salary*(3.5/100);
    


    
            $remaining_after_head_officer_bonus = $this->
            cal_payments($remaining_amount_after_senior_officers, $head_officer_salary);
    

    
            $director_money_national_referal+=($remaining_after_head_officer_bonus*(5/100));
            $superintendent_total_salary = $director_money_national_referal/2;
            $admin_total_salary  = $superintendent_total_salary*(3/4);
            $officer_total_salary = $admin_total_salary*(8/5);
            $senior_total_salary = $officer_total_salary + $officer_total_salary*(6/100);
            $head_officer_total = $officer_total_salary + $officer_total_salary*(3.5/100);
    
            

            $this->update_payments($director_money_national_referal, 'director');
            $this->update_payments($superintendent_total_salary, 'superintendent');
            $this->update_payments($senior_total_salary, 'senior officer');
            $this->update_payments($officer_total_salary, 'officer');
            $this->update_payments($head_officer_salary, 'head');

            //update staff members
        
            $this->update_payments_staff($admin_total_salary);
            


              $officers_at_general_hospitals = $this->format_currency($this->pass_to_format('general'));
               $officers_at_referal_hospitals = $this->format_currency($this->pass_to_format('regional'));
               $officers_at_national_hospitals = $this->format_currency($this->pass_to_format('national'));
               //staff members
               $Admin = $this->format_currency_staff($this->pass_to_format_staff('Admin'));

               return view('payment',
               [
               'officers_general'=>$officers_at_general_hospitals,
               'officers_regional'=>$officers_at_referal_hospitals,
               'officers_national'=>$officers_at_national_hospitals,
               'months'=>$this->all_months(),
               'default'=>$this->default_month,
               'staff'=>$Admin
               ]
            );
              
    
          }
          else {
              $staff_money = array();
              $officers_at_general_hospitals = array();
              $officers_at_referal_hospitals = array();
              $officers_at_national_hospitals = array();
              $months = array();
              $Admin = array();
            return view('payment',
            ['staff_payments'=>$staff_money,
            'officers_general'=>$officers_at_general_hospitals,
            'officers_regional'=>$officers_at_referal_hospitals,
            'officers_national'=>$officers_at_national_hospitals,
            'months'=>$this->all_months(),
            'staff'=>$Admin
            
            ]);
          }
        
    }

    //store
    public function store(Request $request){
        //dd($request);
        $this->validate($request,
        ['month'=>'required']);
        $this->set_month = $request->month;
        
        $this->set = True;
        
       //
       $diff_money = 
       $this->cal_payments((int)$this->getMonth(),(int)100000000);
    

       
       if($diff_money >0){
           $checkOfficers = DB::table('officers')->get();
           if(count($checkOfficers)==0){
               return back()->with('status', 'No officers yet please regiser');
           }
        $remaining_amount = $this->cal_payments($diff_money, 5000000);
        $director_money_national_referal = 5000000;
        $superintendent_money = $director_money_national_referal/2;
        $remaining_after_superintendent = $this->cal_payments($remaining_amount, $superintendent_money);
        $administrator_money = $superintendent_money*(3/4);
        $remaining_after_admin = $this->cal_payments($remaining_after_superintendent, $administrator_money);


        $total_officers_general = $this->count_officers('officer');
        
        

        
        $general_officer_salary = $administrator_money*(8/5);
        $total_officer_salary = $general_officer_salary;
        if($total_officers_general){
           $total_officer_salary = $total_officers_general*$total_officer_salary;
        }
        
        //$general_officer_salary*$total_officers_general
        $remaining_after_general_officer_salary = $this->cal_payments($remaining_after_admin, $total_officer_salary);

        //echo $remaining_after_general_officer_salary;

        //total senior officers
        $senior_officer_salary = $general_officer_salary + $general_officer_salary*(6/100);
        $total_senior_officers = $this->count_officers('senior officer');
        //echo $total_senior_officers;
        if($total_senior_officers){
            $total_senior_officer_salary = $total_senior_officers*$senior_officer_salary;
        }        
        $remaining_amount_after_senior_officers = $this->
        cal_payments($remaining_after_general_officer_salary, $total_senior_officers);

        //calcu head officer
        $head_officer_salary = $general_officer_salary + $general_officer_salary*(3.5/100);

        //$general_officer_salary+=$all_officer_salary;
        //echo $general_officer_salary;


        $remaining_after_head_officer_bonus = $this->
        cal_payments($remaining_amount_after_senior_officers, $head_officer_salary);

        //echo $remaining_after_general_officer_bonus;

        //total money plus the bonus money

        $director_money_national_referal+=($remaining_after_head_officer_bonus*(5/100));
        $superintendent_total_salary = $director_money_national_referal/2;
        $admin_total_salary  = $superintendent_total_salary*(3/4);
        $officer_total_salary = $admin_total_salary*(8/5);
        $senior_total_salary = $officer_total_salary + $officer_total_salary*(6/100);
        $head_officer_total = $officer_total_salary + $officer_total_salary*(3.5/100);

        //dd($senior_officer_salary);
        //updating records
        $this->update_payments($director_money_national_referal, 'director');
        $this->update_payments($superintendent_total_salary, 'superintendent');
       //dd($this->update_payments($senior_total_salary, 'senior officer'));
    //    $update = DB::update('update officers set Payments = ? where OfficerRole=?',
    //     [$senior_officer_salary, 'senior officer']);
    //    if($update) dd($update);
    //    else echo 'not';
    //    dd("Yes");
        $this->update_payments($officer_total_salary, 'officer');
        $this->update_payments($head_officer_salary, 'head');
        $this->update_payments_staff($director_money_national_referal, 'Director');
        $this->update_payments_staff($admin_total_salary, 'Admin');
        

          //return a view
          //$staff_money = $this->format_currency(DB::select("select role, name, monthly_allowane from users"));
          //formating the money
          $officers_at_general_hospitals = $this->format_currency($this->pass_to_format('general'));
         // dd($this->pass_to_format('regional'));
           $officers_at_referal_hospitals = $this->format_currency($this->pass_to_format('regional'));
           $officers_at_national_hospitals = $this->format_currency($this->pass_to_format('national'));

           //staff members
          // $Admin = $this->$this->pass_to_format_staff($this->pass_to_format_staff('Admin'));

          $result = $this->pass_to_format_staff('Admin');

          $Admin = $this->format_currency_staff($result);
          //print_r($Admin3);

    

           return view('payment',
           [
           'officers_general'=>$officers_at_general_hospitals,
           'officers_regional'=>$officers_at_referal_hospitals,
           'officers_national'=>$officers_at_national_hospitals,
           'months'=>$this->all_months(),
           'default'=>$this->default_month,
           'staff'=>$Admin
           ]
        );
          

      }
       
        

    }
}
