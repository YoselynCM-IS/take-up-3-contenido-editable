<?php

/***librerias phpmailer**/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* Exception class. */
require 'PHPMailer/src/Exception.php';

/* The main PHPMailer class. */
require 'PHPMailer/src/PHPMailer.php';

/* SMTP class, needed if you want to use SMTP. */
require 'PHPMailer/src/SMTP.php';
/**********/

$imagen = $_POST["imagen"];
$tup3_regGP = $_POST["tup3_regGP"];
$tup3_regCA = $_POST["tup3_regCA"];
$tup3_regND = $_POST["tup3_regND"];
$tup3_regCD = $_POST["tup3_regCD"];
$tup3_regNA = $_POST["tup3_regNA"];
/*
echo $imagen;
echo "<br>";
echo $tup3_regGP;
echo "<br>";
echo $tup3_regCA;
echo "<br>";
echo $tup3_regND;
echo "<br>";
echo $tup3_regCD;
echo "<br>";
echo $tup3_regNA;
echo "<br>";
//die("fin");
**/
$imagen = preg_replace('#^data:image/[^;]+;base64,#', '', $imagen); 
$mensaje = '<b>Take Up 3</b><br><b>Student name: </b>'.$tup3_regNA.'<br><b>Group: </b> '.$tup3_regGP.'<br><b>Teacher: </b>'.$tup3_regND;

$para = $tup3_regCD;
$para2 = $tup3_regCA;
$asunto = 'Take Up 3: Activity';				
//Create a new PHPMailer instance
$mail = new PHPMailer();
$mail->IsSMTP();
//Agregar la imagen
$decode = base64_decode($imagen);
$mail->addStringAttachment($decode, "Activity.png", "base64", "image/png");
$mensaje .= '<br><img src="https://majesticeducacion.com.mx/nuevo/wp-content/uploads/2018/08/logo-header-majesticeducacion.png">';
 
//Configuracion servidor mail

$mail->From = "ebook@majesticeducationdigital.com"; //remitente
$mail->FromName = "Majestic Education";//nombre remitente
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl'; //seguridad
$mail->Host = "mail.majesticeducationdigital.com"; // servidor smtp
$mail->Port = 465; //puerto
$mail->Username ='ebook@majesticeducationdigital.com'; //nombre usuario
$mail->Password = '[;$&0?H_zuq#'; //contraseña

 
//Agregar destinatario
$mail->AddAddress($para);
$mail->AddAddress($para2);
$mail->Subject = $asunto;
$mail->IsHTML(true);
$mail->Body = $mensaje;


 
//Avisar si fue enviado o no y dirigir al index
if ($mail->Send()) {
    echo'<script type="text/javascript">
           alert("Sent correctly");
		   window.history.back();
        </script>';
} else {
    echo'<script type="text/javascript">
           alert("Not sent, try again");
        </script>';
}
?>