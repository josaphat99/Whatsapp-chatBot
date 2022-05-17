<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class ChatBotController extends Controller
{
    public function listenToReplies(Request $request)
    {
        $from = $request->input('From');
        $body = $request->input('Body');

        $message = "Bonjour! et bienvenu à vous, Je m'appel Leo. Comment puis-je vous aider?\n\n";
        $message .= "A : Ouvrir un compte\n";
        $message .= "B: Localiser l'ATM le plus proche\n";
        $message .= "C : Consulter votre solde\n";

        $this->sendWhatsAppMessage($message);        
    }

   
    // public function sendWhatsAppMessage(string $message, string $recipient)
    // {
    //     $twilio_whatsapp_number = getenv('TWILIO_WHATSAPP_NUMBER');
    //     $account_sid = getenv("TWILIO_SID");
    //     $auth_token = getenv("TWILIO_AUTH_TOKEN");

    //     $client = new Client($account_sid, $auth_token);
    //     return $client->messages->create($recipient, array('from' => "whatsapp:$twilio_whatsapp_number", 'body' => $message));
    // }

    public function sendWhatsAppMessage(string $message)
    {
        $twilio_whatsapp_number = getenv('TWILIO_WHATSAPP_NUMBER');
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");

        $client = new Client($account_sid, $auth_token);
        return $client->messages->create('whatsapp:+260965032149', array('from' => "whatsapp:$twilio_whatsapp_number", 'body' => $message));
    }
}
