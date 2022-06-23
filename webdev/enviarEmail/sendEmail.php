<?php

$siteOwnersEmail = 'jmd25454@gmail.com';


if($_POST) {

   $name = trim(stripslashes($_POST['contactName']));
   $email = trim(stripslashes($_POST['contactEmail']));
   $subject = trim(stripslashes($_POST['contactSubject']));
   $contact_message = trim(stripslashes($_POST['contactMessage']));

	if (strlen($name) < 2) {
		$error['name'] = "Por favor, insira seu nome.";
	}
	if (!preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is', $email)) {
		$error['email'] = "Por favor, insira um e-mail válido.";
	}
	if (strlen($contact_message) < 15) {
		$error['message'] = "Por favor, insira sua mensagem. Ela deve conter no mínimo 15 caracteres.";
	}
	if ($subject == '') { $subject = "Formulário para contato"; }


   $message .= "Email de: " . $name . "<br />";
	 $message .= "Endereço Email: " . $email . "<br />";
   $message .= "Mensagem: <br />";
   $message .= $contact_message;
   $message .= "<br /> ----- <br /> Esse e-mail foi enviado do seu site portfolio. <br />";

   $from =  $name . " <" . $email . ">";

	$headers = "De: " . $from . "\r\n";
	$headers .= "Remetente: ". $email . "\r\n";
 	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Tipo de conteúdo: text/html; charset=ISO-8859-1\r\n";


   if (!$error) {

      ini_set("email_enviado_de_", $siteOwnersEmail); 
      $mail = mail($siteOwnersEmail, $subject, $message, $headers);

		if ($mail) { echo "OK"; }
      else { echo "Algo deu muito errado, tente novamente mais tarde."; }
		
	} 

	else {

		$response = (isset($error['name'])) ? $error['name'] . "<br /> \n" : null;
		$response .= (isset($error['email'])) ? $error['email'] . "<br /> \n" : null;
		$response .= (isset($error['message'])) ? $error['message'] . "<br />" : null;
		
		echo $response;

	} 

}

?>