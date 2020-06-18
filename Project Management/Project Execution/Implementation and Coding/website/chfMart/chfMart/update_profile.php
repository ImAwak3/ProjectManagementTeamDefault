<?php

include "includes/connection.php";


$errors = array();
if(isset($_POST['updateBtn'])){

   

    $fName = e($_POST['fName']);
    $lName = e($_POST['lName']);
    $username = e($_POST['username']);
    $email = e($_POST['email']);
    $password = e($_POST['password']);
    $confirm_password = e($_POST['confirm_password']);
    $number = e($_POST['phone']);
    $address = e($_POST['address']);


    if(empty($password)){
        array_push($errors, "Password required");
    }

    if (!(preg_match_all('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,16}$/', $password))){
        array_push($errors, "Password should be at 8 characters at minimum and contain at least one Uppercase letter, one number and one symbol");
    }

    if (isset($password) && $password !== $confirm_password) {
        array_push($errors, 'The two passwords do not match');
    }

  

      if(count($errors)==0){
        if(isset($_SESSION['user'])){
            $id = $_SESSION['user']['USER_ID'];
            
        }
        $password = password_hash($password, PASSWORD_DEFAULT); //encrypt the password

        $update_profile = "UPDATE users SET 
                            FIRST_NAME = '$fName',
                            LAST_NAME = '$lName',
                            USERNAME = '$username', 
                            ADDRESS = '$address',
                            EMAIL = '$email',
                            PHONE_NUMBER = '$number',
                            PASSWORD = '$password'
                            WHERE USER_ID = $id";

        $parse = oci_parse($conn, $update_profile);
        $execute = oci_execute($parse);
    
        if(!$parse){     
           echo oci_error();
        }
        else{
            $_SESSION['message'] = 'your account has been updated';
        }
   
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