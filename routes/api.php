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
        return json_encode($response['hits']);
    }

    return json_encode(array_slice($response['hits'], 0, $request->l));

    
});
