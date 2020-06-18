<?php

include "includes/connection.php";


$username = "";
$email = "";
$errors = array();

if(isset($_POST['trader_register'])){


    $fName = e($_POST['fName']);
    $lName = e($_POST['lName']);
    $username = e($_POST['username']);
    $email = e($_POST['email']);
    $password = e($_POST['password']);
    $confirm_password = e($_POST['confirm_password']);
    $number = e($_POST['phone']);
    $address = e($_POST['address']);
    $shop_name = e($_POST['shop_name']);
    $shop_type = e($_POST['shop_type']);
  
    if(isset($_POST['terms_checkbox'])){
        $terms_checkbox = e($_POST['terms_checkbox']);
    }
    
    if(empty($fName)){
        array_push($errors, "First Name required");
    }

    if(empty($lName)){
        array_push($errors, "Last Name required");
    }

    if(empty($username)){
        array_push($errors, "Username is required");
    }
    if(is_numeric($username)){
        array_push($errors, "The name cannot be numeric");
    }

    if(empty($email)){
        array_push($errors, "Email address required");
    }

    if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($errors, "Enter the email in a correct format. Eg. abc@gmail.com");
    }

    if(empty($password)){
        array_push($errors, "Password required");
    }

    if (!(preg_match_all('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,16}$/', $password))){
        array_push($errors, "Password should be at 8 characters at minimum and contain at least one Uppercase letter, one number and one symbol");
    }

    if (isset($password) && $password !== $confirm_password) {
        array_push($errors, 'The two passwords do not match');
    }

    if(empty($shop_name)){
        array_push($errors, "Your shop name is required");
    }

    if(empty($shop_type)){
        array_push($errors, "Please select your shop type");
    }

    if(empty($terms_checkbox)){
        array_push($errors,  "Please indicate that you have read and agree to the Terms and Conditions and Privacy Policy");
    }

     // Check if email already exists
     $query = "SELECT * FROM users WHERE EMAIL='$email' AND ROWNUM=1";
     $parse = oci_parse($conn, $query);
     $execute = oci_execute($parse);
     while($row = oci_fetch_array(($parse), OCI_ASSOC+OCI_RETURN_NULLS!=false)){
        array_push($errors, "Email already exists");
     }
    
     if(count($errors)==0){
        $password = password_hash($password, PASSWORD_DEFAULT); //encrypt the password

        $user_activation_code = md5(time().$username);
        if(!isset($_POST['USER_TYPE'])){

            $insert_query = "INSERT INTO users (USER_ID, USERNAME, FIRST_NAME, LAST_NAME, EMAIL, PASSWORD, user_type, ADDRESS, PHONE_NUMBER, VERIFICATION_CODE, IS_VERIFIED ) 
            VALUES(1001, '$username', '$fName', '$lName', '$email','$password', 'trader', '$address', '$number', '$user_activation_code', 'N')";

            $parse = oci_parse($conn, $insert_query);
            oci_define_by_name($parse, 'USER_ID', $logged_in_user_id);
            $execute = oci_execute($parse);

            $insert_trader_query = "Insert into trader (TRADER_ID, SHOP_NAME, TRADERTYPE) 
                                    Values(2001,'$shop_name', '$shop_type')";
            $insert_parse = oci_parse($conn, $insert_trader_query);
            oci_define_by_name($insert_parse, 'USER_ID', $id);
            $insert_execute = oci_execute($insert_parse);

            while($row = oci_fetch_array(($parse), OCI_ASSOC+OCI_RETURN_NULLS!=false)){
                $logged_in_user_id = $row['USER_ID'];
                $_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in 
                //sessio,
                
            }
            if($parse){

                require 'Phpmailer/PHPMailerAutoload.php';
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
                $mail->addAddress($email);     // Add a recipient
                $mail->addReplyTo('koirala.kritika09@gmail.com');
                $mail->isHTML(true);                                  // Set email format to HTML
    
                $mail->Subject = 'Email verification';
                $get_pass = password_verify($password, $row['password']);
                $mail->Body    = "
                <p>Thanks for signing up!
                <br>
                Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
                
                ------------------------
                Username: '.$username.'
                Password: '.$get_pass.'
                ------------------------
                
                Please click this link to activate your account:
                <a href = 'http://localhost/chfMart/verify.php?vKey=$user_activation_code'>Activation Link</a>
                </p>
                ";
                $mail->AltBody = 'Email verification';
    
                if(!$mail->send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } 
                else {
                    echo "message was sent";           
                }          
            }
        }
     }
}

// return user array of the id
function getUserById($id){
    global $conn;
     $query = "select * from users where USER_ID=$id";
     $parse = oci_parse($conn, $query);
 
     $execute = oci_execute($parse);
   
     while($row = oci_fetch_array(($parse), OCI_ASSOC+OCI_RETURN_NULLS!=false)){
         $user = $row['USER_TYPE'];
         $user = $row['USERNAME'];
         return $user;
     }
     
     
 }

function e($val){
    return htmlEntities(trim($val), ENT_QUOTES);
}


function display_error() {
    global $errors;

    if (count($errors) > 0){
        echo '<div class="error">';
            foreach ($errors as $error){
                echo '<ul>';
                echo '<li>'.$error .'</li>';
                echo '</ul>';
            }
        echo '</div>';
    }
}	
