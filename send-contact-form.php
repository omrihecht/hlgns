<?php

require_once('../../../wp-load.php');
$to = 'info@hooligans.co.il';
$subject = 'אתר חוליגנס';
$name    = $_POST['name'];
$email   = $_POST['email'];
$msg     = $_POST['msg'];

$message = "שם:
".$name."

מייל:
".$email."

תוכן ההודעה:
".$msg;


$headers = "From: hooligans <no-reply@hooligans.co.il>\r\n','MIME-Version: 1.0\r\n','Content-Type: text/plain; charset=UTF-8";

$wpdb->insert( $wpdb->prefix.'contact', array( 'name' => $name, 'email' => $email, 'msg' => $msg ) );


if (!wp_mail($to, $subject, $message, $headers)){
	echo "Error";
} else {
	echo "Success";
}



?>
