<?php
ob_start();
session_start();

include "../includes/connection.php";
require '../Phpmailer/PHPMailerAutoload.php';

 if(isset($_SESSION['user'])){
    $member_id = $_SESSION['user']['USER_ID'];
}

 
    
 // require 'Phpmailer/credentials.php';
 $mail = new PHPMailer;
 $mail->SMTPDebug = 4;                               // Enable verbose debug output

 $mail->isSMTP();                                      // Set mailer to use SMTP
 $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
 $mail->SMTPAuth = true;                               // Enable SMTP authentication
 $mail->Username = 'koirala.kritika09@gmail.com';                 // SMTP username
 $mail->Password = 'gmailAccount';                           // SMTP password
 $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
 $mail->Port = 587;                                    // TCP port to connect to
 $mail->setFrom('koirala.kritika09@gmail.com', 'Cleckhuddersfax Online Mart');


 $customer_email = "select EMAIL from users where USER_ID = $member_id";
 $parse = oci_parse($conn, $customer_email);
 $execute = oci_execute($parse);
 while($row = oci_fetch_array($parse, OCI_ASSOC+OCI_RETURN_NULLS!=false)){
     $recipient_email = $row['EMAIL'];
$mail->addAddress($recipient_email);     // Add a recipient


 $mail->addReplyTo('koirala.kritika09@gmail.com');
 $mail->isHTML(true);                                  // Set email format to HTML
 $mail->Subject = 'Invoice';
 include 'invoice_contents.php';
 $mail->Body = ob_get_contents();
 ob_end_clean();

 $mail->AltBody = 'Products invoice';

 if($mail->send()) {
    echo "Mail is sent to your invoice";
 } 
        
}

