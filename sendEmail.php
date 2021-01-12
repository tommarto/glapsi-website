<?php

require_once('vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function limpiarDatos($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$errores = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    
    if (!$errores) {

	   try {
		$mail = new PHPMailer(true);
	    	$mail->SMTPDebug = 0;
    		$mail->isSMTP();
    		$mail->Host = 'smtp.gmail.com';
    		$mail->Port = 465;
    		$mail->SMTPSecure = 'ssl';
    		$mail->SMTPAuth = true;
    		$mail->Username = 'testing.3mdigital@gmail.com';
    		$mail->Password = 'teniente123';
    		$mail->setFrom('testing.3mdigital@gmail.com', 'ATUPI');
        	$mail->addAddress('enriquegia@yahoo.com.ar');
        	$mail->addReplyTo('enriquegia@yahoo.com.ar', 'CONTACTO DESDE LA WEB');
	   	$mail->addCC('utepymes@yahoo.com.ar');
	   	$mail->addBCC('daniuf@gmail.com');
        	$subject = "CONTACTO DESDE LA WEB";
        	$textbody = "<b>Nombre</b>: $name <br/> <b>Email:</b> $email <br/> <b>TELEFONO</b>: $phone<br/> <br/>".PHP_EOL."<b>Consulta:</b> ".$message;
        	$mail->Body = $textbody;
        	$mail->Subject = $subject;
        	$mail->AltBody = $textbody;
        	$mail->send();
		echo "success";
	   } catch (Exception $e) {
		//$e->getMessage();
		echo "Ha ocurrido un error. Intente nuevamente en unos minutos";
	   }
    }
}

