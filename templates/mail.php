<?php
include "../lib.php";


require( '../telegram/PHPMailer/PHPMailerAutoload.php' );
//if(isset($_POST['email'])){
	//$email = $_POST['email'];
  $mail = new PHPMailer;

echo $email;
  //Creating the email body to be sent

  $mail->IsSMTP();
  $mail->SMTPAuth = true;
  $mail->Host = "smtp.gmail.com";
  $mail->Port = 587;
  $mail->Username = "find.uwe@gmail.com";
  $mail->Password = "classroomlocator";
  //Sending the actual email
  $mail->setFrom('find.uwe@gmail.com');
  $mail->addAddress($email);     // Add a recipient
  $mail->isHTML(false);                                  // Set email format to HTML
  $mail->Subject = 'Password Recovery';
  $mail->Body = 'To reset your password, click on the link below';

  if(!$mail->send()) {
    echo 'Message could not be sent. ';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    exit;
  }

?>