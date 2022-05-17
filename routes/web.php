<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', function() {

    $twilio_whatsapp_number = getenv('TWILIO_WHATSAPP_NUMBER');
    $account_sid = getenv("TWILIO_SID");
    $auth_token = getenv("TWILIO_AUTH_TOKEN");

    $client = new Client($account_sid, $auth_token);
    return $client->messages->create('whatsapp:+260965032149', array('from' => "whatsapp:$twilio_whatsapp_number", 'body' => 'Bonjour monsieur'));
});

Route::get('/message', function () {
    return test();
});

function test()
{   
    if(strpos(strtolower('BONsoir'),'bonjour') !== false)
    {
        return 'c pass';
    }
    else{
        return 'c pass pas' ;
    }
   
}