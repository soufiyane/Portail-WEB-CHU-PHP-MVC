<?php
//LOCAL
//$mail->IsSMTP(); // En local
//$mail->SMTPAuth   = true;                  // enable SMTP authentication
//$mail->Host       = "smtp.chu-toulouse.fr";      // sets GMAIL as the SMTP server
//$mail->Username   = "01863024@chu-toulouse.fr";  // GMAIL username
//$mail->Password   = "raphaelp281290";            // GMAIL password

//INTERNET
$mail->IsSMTP();
$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';
$mail->IsHTML(true);
$mail->Host='smtp.chu-toulouse.fr';  //aussi essayé smtp.mondomaine.com ssl0.ovh.net
$mail->Port = 25;    //  587 ou 465 ou 25
//$mail->Username = 'contact@cfm-hop-tlse.fr';      // SMTP login
//$mail->Password = 'LEELOO2411';        // SMTP password
$mail->SMTPAuth = false;      // Active l'authentification par smtp
//$mail->SMTPSecure = 'ssl';  // tls ou ssl
$mail->Priority = 3;   // Priorité : 1 Urgent, 3 Normal, 6 Lent

$mail->CharSet = 'utf-8';

//ADRESSE DES TECHS
$domaine=".ecoles-instituts@chu-toulouse.fr";
$mailtech="bourzig.s@chu-toulouse.fr";
//$mailtech="plancade.r@chu-toulouse.fr";
$crdpss="infotheque@chu-toulouse.fr";
$headmess='<html>
            <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            </head>
        <body style="font-family:Calibri;">
                <fieldset style="width:600px;border:0px;margin:0px;padding:0px;">
            <img src="http://cfm-hop-tlse.fr/support/img/bandeau%20-%20support.jpg" style="width:600px;height:100px;">
        <div style="margin-top:-5px;background-color: #87CEFA;height: 18px;text-align: center;width: 600px;"><h1 style="color:#FFFFFF;font-size:16px;"><b>'.$titre.'</b></h1></div>
        <div style="margin:10px;">';
$footmess='</div>
        </div>
        <div style="background-color: #87CEFA;height: 18px;text-align: center;width: 600px;"><h1 style="color:#FFFFFF;font-size:15px;"><b>2012 Centre de Formation Multimedia - CHU Purpan - Toulouse</b></h1></div>
                </fieldset>
        </body>
        </html>';
?>
