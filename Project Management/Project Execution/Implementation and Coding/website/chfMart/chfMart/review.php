<?php
session_start();
include 'includes/connection.php';

$errors = array();


if(isset($_SESSION['user'])){
    $member_id = $_SESSION['user']['USER_ID'];   
}

if(isset($_POST["pro_id"])){
    if(!empty($_POST["pro_id"])){
        $pro_ID =$_POST["pro_id"];
    }
}

if(isset($_POST['submitMessage'])){
    $name = e($_POST['name']);   
    $message = e($_POST['message']);
    $rating = e($_POST['hdnRateNumber']);
    if (empty($name)) {
		array_push($errors, "Name is required");
	}
   
    if (empty($message)) {
		array_push($errors, "Message is required");
    }

    if(count($errors)==0){
    
            $insert_query = "insert into product_review (PRODUCT_ID, USER_ID, COMMENTS, RATING, REVIEW_DATE) VALUES ($pro_ID, $member_id, '$message', $rating, CURRENT_TIMESTAMP)";
            $parse = oci_parse($conn, $insert_query);
            $execute = oci_execute($parse);
            
            if(!$parse){
                echo "no";
            }
            else{
                $_SESSION['rate_success'] = "Your review has been posted!";
                header("location:product.php?pId=$pro_ID");
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


?>
                               
                              