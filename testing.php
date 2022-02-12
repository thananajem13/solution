<?php
require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer();

$mail->isSMTP();

$mail->Host = "smtp.gmail.com";

$mail->SMTPAuth = "true";

$mail->SMTPSecure = "tls";

$mail->Port="587";

$mail->Username = "youremail";

$mail->Password = "yourpassword";

$mail->Subject = 'Order desc. mail';

$mail->setFrom("youremail");



// $to_email = 'hosam.johar111@gmail.com';
// $subject = 'Order desc. mail'; 
$productDetails = "";
if( !empty($POST['fullname']) && !empty($POST['telephone']) && !empty($POST['notes'] && !empty($POST['productLink'])) && !empty($POST['productDesc'])){

    $fullName = "FullName: ".$POST['fullname'].".<br>";
    $telephone = "Telephone: ".$POST['telephone'].".<br>";  
    $notes = "Notes: ".$POST['notes'].".<br>";   
    foreach(array_combine($POST['productLink'], $POST['productDesc']) as $productLink => $productDesc){
        $productDetails .=  
        "
        <dl>
            <dt>".$productLink."</dt>
            <dd>".$productDesc."</dd>
        </dl>
        "; 
    } 

    $message =$fullName.$telephone.$notes.$productDetails; 

    $mail->Body = $message;

    $mail->addAddress("other email to send email to it");

    
    if($mail->Send()){ 
        echo 'Email sent...';
    }
    else{
        echo 'Error...'; 
    }
    $mail->smtpClose();
    
}
?>