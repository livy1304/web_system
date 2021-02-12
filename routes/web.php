<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OfficersController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegisterOfficer;
use App\Http\Controllers\GraphController;
use App\Http\Controllers\HierachicalController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Patients;
use App\Http\Controllers\PromotedController;
use App\Http\Controllers\WaitingList;

Route::get('/', function () {
    return view("auth.login");
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');



//controllers
Route::get("/officers", [OfficersController::class , "index"])->name("officers")->name("officers");
Route::post("/officers", [OfficersController::class , "store"])->name("officers");

//create officers
Route::get("/registerofficer",[RegisterOfficer::class, "index"])->name("registerofficer");
Route::post("/registerofficer", [RegisterOfficer::class, "store"]);
//payments
Route::get("/funds", [DonorController::class , "index"])->name("funds");
Route::post("/funds", [DonorController::class , "store"]);

//funds
Route::get("/payments", [PaymentController::class , "index"])->name("payments");
Route::post("/payments", [PaymentController::class , "store"]);


//donorlist
Route::get('donorlist', function () {
	//dd("HERE");
	$donors = DB::table('donors')->get();
	if(count($donors)){
		//dd("AM HERE IS");
		return view("donorlist", ['donors'=>$donors]);
	}
	else{
		$donors = array();
		return view("donorlist", ['donors'=>$donors]);     
	}

});

//graphs
Route::get("/graphs", [GraphController::class, "index"])->name("graphs");

//hierarchicalcontroller
Route::get("/hierarchical", [Hierachicalcontroller::class , "index"])->name("hierarchical");


//patientscontroller
Route::get('patients', [Patients::class , "index"])->name("patients");

//promted list
Route::get("/promoted", [PromotedController::class , "index"])->name("promoted");

//waitinglist
Route::get("/waiting", [WaitingList::class , "index"])->name("waiting");