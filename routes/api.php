<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Address;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::get('autofill', function(Request $request){
    $response = Address::search($request->q)->raw();

    if(!isset($request->l))
    {
        return response(json_encode($response['hits']))
                    ->header('Content-Type', 'application/json');
    }

    $resultSet = json_encode(array_slice($response['hits'], 0, $request->l));
    
    return response($resultSet)
                ->header('Content-Type', 'application/json'); 
});

Route::post('create', function(Request $request){

    // Assumes validation has already been run

    $address = New Address();
    $address->line1 = $request->line1;

    if(isset($request->line2)){
        $address->line2 = $request->line2;
    }

    $address->city = $request->city;
    $address->state = $request->state;
    $address->zip = $request->zip;

    $address->save();

    // Return response

    return response('Success', 200)
                ->header('Content-Type', 'application/json'); 
});


Route::delete('delete', function(Request $request){

    // Assumes validation has already been run

    $address = Address::where('id', '=', $request->id)->first();

    if(isset($address->id)){
        $address->delete();

        return response(200)
            ->header('Content-Type', 'application/json'); 
    }

    return response('Address not found', 404)
        ->header('Content-Type', 'application/json'); 
    
});
