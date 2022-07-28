<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Twilio\Rest\Client;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/chat-bot', 'ChatBotController@listenToReplies');


Route::post('/chat-bot', function(Request $request)
{
    $body = $request->input('Body');
    $recipient = $request->input('From');   

    $message = '';
    $menu = "Voici notre menu : \n\nA. Consultez votre balance \n\nB. Retirer de l'argent";

    $zones = "Voici nos zones: \n\nK. Kampemba \n\nL. Lubumbashi \n\nM. Kenya";

    //===message processing===
    if(strpos(strtolower($body),"bonjour") !== false
    || strpos(strtolower($body),"bonsoir") !== false
    || strpos(strtolower($body),"salut") !== false
    || strpos(strtolower($body),'bonne après-midi') !== false
    )
    {
        $hour = date('H',time());
        $greet = '';

        if($hour <= 12)
        {
            $greet =  "Bonjour";            
        }else if ($hour > 12 && $hour <= 17){
            $greet = "Bonne après-midi";
        }else{
            $greet = "Bonsoir";
        }

        $message = $greet.'! Bienvenu chez Hope ChatBanking, comment pouvons-nous vous aider? Veuillez choisir une option sur notre menu:';
        
        //envoi du message d'acceuil
        sendWhatsAppMessage($message,$recipient);

        //envoi du menu
        sendWhatsAppMessage($menu,$recipient);

    }else if(strtolower($body) == 'a'){

        $message = "Envoyez le message 'Mon solde' pour verifier votre solde";
        
        //envoi du message
        sendWhatsAppMessage($message,$recipient);

    }else if(strtolower($body) == 'mon solde'){

        $message = 'Votre solde est de : 258$';

        //envoi du menu
        sendWhatsAppMessage($message,$recipient);

        //envoi du menu
        sendWhatsAppMessage($menu,$recipient);

    }else if(strtolower($body) == 'b')
    {
        $message = "Envoyez le message 'Retrait' pour retirer de l'argent";

        //envoi du menu
        sendWhatsAppMessage($message,$recipient);

    }else if(strtolower($body) == 'retrait')
    {
        $message = "Combien d'argent souhaitez-vous retirer? Voici nos options de retrait: \n\n1. De 10 à 100$ \n\n2. De 110 à 300$ \n\n3. De 310 à 500$ \n\n4. De 510 à 1000$";

        //envoi du menu
        sendWhatsAppMessage($message,$recipient);

    }else if(strtolower($body) == '1')
    {
        $message = 'Vous avez choisis 1 pour un retrai de 10 à 100$. Veuillez choisir votre zone, '.$zones;

        //envoi du menu
        sendWhatsAppMessage($message,$recipient);

    }else if(strtolower($body) == '2')
    {
        $message = 'Vous avez choisis 2 pour un retrai de 110 à 300$. Veuillez choisir votre zone, '.$zones;

        //envoi du menu
        sendWhatsAppMessage($message,$recipient);
        
    }else if(strtolower($body) == '3')
    {
        $message = 'Vous avez choisis 3 pour un retrai de 310 à 500$. Veuillez choisir votre zone, '.$zones;

        //envoi du menu
        sendWhatsAppMessage($message,$recipient);
        
    }else if(strtolower($body) == '4')
    {
        $message = 'Vous avez choisis 4 pour un retrai de 510 à 1000$. Veuillez choisir votre zone, '.$zones;

        //envoi du menu
        sendWhatsAppMessage($message,$recipient);
        
    }else if(strtolower($body) == 'l')
    {
        $message = "Envoyez le message 'Lubumbashi', pour voir les distributeurs le plus proche de vous";

        //envoi du menu
        sendWhatsAppMessage($message,$recipient);
        
    }else if(strtolower($body) == 'm')
    {
        $message = "Envoyez le message 'Kenya', pour voir les distributeurs le plus proche de vous";

        //envoi du menu
        sendWhatsAppMessage($message,$recipient);
        
    }else if(strtolower($body) == 'k')
    {
        $message = "Envoyez le message 'Kampemba', pour voir les distributeurs le plus proche de vous";

        //envoi du menu
        sendWhatsAppMessage($message,$recipient);
        
    }else if(strtolower($body) == 'l')
    {
        $message = "Envoyez le message 'Lubumbashi', pour voir les distributeurs le plus proche de vous";

        //envoi du menu
        sendWhatsAppMessage($message,$recipient);
        
    }else if(strtolower($body) == 'lubumbashi')
    {
        //requet vers la BDD recuperation des atm de cette zone
        $message = "Voici les distributeurs les plus proches de vous: \n\nL1. ATM KITEMBO [Avenu mwero] \n\nL2. ATM CHAUSSEE LAURANT DESIRE KABILA \n\nL3. ATM ISP [Avenu De la revolution] \n\nL4. ATM Complexe plage \n\nL5. ATM KARAVIA PETROSIL [GOLF]";

        //envoi du menu
        sendWhatsAppMessage($message,$recipient);
        
    }else if(strtolower($body) == 'kenya')
    {
        //requet vers la BDD recuperation des atm de cette zone
        $message = "Voici le(s) distributeur(s) le(s) plu(s) proche(s) de vous: \n\nM1. ATM KENYA [Pret de la morgue]";

        //envoi du menu
        sendWhatsAppMessage($message,$recipient);
        
    }else if(strtolower($body) == 'kampemba')
    {
        //requet vers la BDD recuperation des atm de cette zone
        $message = "Voici le(s) distributeur(s) le(s) plu(s) proche(s) de vous: \n\nK1. ATM CARREFOUR PSARO";

        //envoi du menu
        sendWhatsAppMessage($message,$recipient);
        
    }else if(strtolower($body) == 'l1')
    {
        //requet vers la BDD recuperation des atm de cette zone
        $message = "Envoyez le message 'KITEMBO' pour verifier la disponibilité d'argent dans le distributeur";

        //envoi du menu
        sendWhatsAppMessage($message,$recipient);
        
    }else if(strtolower($body) == 'kitembo')
    {
        //requet vers la BDD recuperation des atm de cette zone
        $message = "Argent non disponible!! \n\nProposition : Veuillez aller vers l'ATM CHAUSSEE LAURANT DESIRE KABILA";

        //envoi du message
        sendWhatsAppMessage($message,$recipient);

        //envoi du menu
        sendWhatsAppMessage($menu,$recipient);
        
    }else if(strtolower($body) == 'l2')
    {
        //requet vers la BDD recuperation des atm de cette zone
        $message = "Envoyez le message 'LDK' pour verifier la disponibilité d'argent dans le distributeur";

        //envoi du message
        sendWhatsAppMessage($message,$recipient);
        
    }else if(strtolower($body) == 'ldk')
    {
        //requet vers la BDD recuperation des atm de cette zone
        $message = "Argent disponible!!";

        //envoi du message
        sendWhatsAppMessage($message,$recipient);

        //envoi du menu
        sendWhatsAppMessage($menu,$recipient);
        
    }else if(strtolower($body) == 'm1'){
        //requet vers la BDD recuperation des atm de cette zone
        $message = "Envoyez le message 'KENYA' pour verifier la disponibilité d'argent dans le distributeur";

        //envoi du menu
        sendWhatsAppMessage($message,$recipient);
    }else if(strtolower($body) == 'kenya'){
         //requet vers la BDD recuperation des atm de cette zone
         $message = "Argent non disponible!! \n\nProposition : Veuillez aller vers l'ATM CHAUSSEE LAURANT DESIRE KABILA";

         //envoi du message
         sendWhatsAppMessage($message,$recipient);
 
         //envoi du menu
         sendWhatsAppMessage($menu,$recipient);
    }else if(strtolower($body) == 'k1'){
        //requet vers la BDD recuperation des atm de cette zone
        $message = "Envoyez le message 'CARREFOUR' pour verifier la disponibilité d'argent dans le distributeur";

        //envoi du menu
        sendWhatsAppMessage($message,$recipient);
    }else if(strtolower($body) == 'carrefour'){
        //requet vers la BDD recuperation des atm de cette zone
        $message = "Argent disponible!!";

        //envoi du message
        sendWhatsAppMessage($message,$recipient);

        //envoi du menu
        sendWhatsAppMessage($menu,$recipient);
    }
    else{
        //envoi du menu
        $message = "Option invalide! Veuillez chosir une option sur notre menu";

        //envoi du message
        sendWhatsAppMessage($message,$recipient);

        //envoi du menu
        sendWhatsAppMessage($menu,$recipient);
    }
});


function sendWhatsAppMessage(string $message, string $recipient)
{
    $twilio_whatsapp_number = getenv('TWILIO_WHATSAPP_NUMBER');
    $account_sid = getenv("TWILIO_SID");
    $auth_token = getenv("TWILIO_AUTH_TOKEN");

    $client = new Client($account_sid, $auth_token);
    return $client->messages->create($recipient, array('from' => "whatsapp:$twilio_whatsapp_number", 'body' => $message));
}

function welcome ()
{
    return 0;
}

