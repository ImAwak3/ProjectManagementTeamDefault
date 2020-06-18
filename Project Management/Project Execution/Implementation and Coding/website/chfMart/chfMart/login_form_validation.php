<?php

include 'includes/connection.php';

$errors = array();
if(isset($_POST['loginBtn'])){
    
    $email = e($_POST['email']);
    $password = e($_POST['password']);
    // $password = e($_POST['password']);

    if (empty($email)) {
		array_push($errors, "Email is required");
	}
   
	if (empty($password)) {
		array_push($errors, "Password is required");
    }

    if(count($errors)==0){
        $query = "SELECT * FROM users WHERE EMAIL = '$email' AND ROWNUM=1";
        $parse = oci_parse($conn, $query);
        $execute = oci_execute($parse);
        $result = array();
        $numRows = oci_fetch_all($parse, $result, null, null, OCI_FETCHSTATEMENT_BY_ROW );
        if($numRows==1){
       
            foreach($result as $row){
                if(password_verify($password, $row['PASSWORD'])){
                    
                    // check if user is admin or user
                     $logged_in_user = $row;
                     if ($logged_in_user['USER_TYPE'] == 'admin') {
     
                         $_SESSION['user'] = $logged_in_user;
                         $_SESSION['user_type'] = 'admin';
                         $_SESSION['success']  = "You are now logged in";
                         header('location: admin/index.php');		  
                     }
                     elseif($logged_in_user['USER_TYPE']=='trader'){
                         $_SESSION['user'] = $logged_in_user;
                         $_SESSION['user_type'] = 'trader';
                         $_SESSION['success'] = "You are now logged in";                       

                         header('location:trader/index.php');
                     }
                     else{
                         
                         $_SESSION['user'] = $logged_in_user;
                         $_SESSION['success']  = "You are now logged in";                        

                         $insert_q = "insert into cart (CUSTOMER_ID) select customer.CUSTOMER_ID from customer, cart where customer.CUSTOMER_ID = cart.CUSTOMER_ID AND ROWNUM<=1";
                         $parse = oci_parse($conn, $insert_q);
                         $execute = oci_execute($parse);
                         header('location: index.php');
                         
                     }
                }
                else{
                    array_push($errors, "Wrong username or password");
                }     
            }
        }
        else {
			array_push($errors, "The username entered is unregistered in our system. Please register before login");
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
// return user array of the id
function getUserById($id){
	global $conn;
	$query = "SELECT * FROM users WHERE USER_ID=" . $id;
	$result = oci_parse($conn, $query);
    $execute = oci_execute($result);

   
    while($row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS!=false)){
        $user = $row['USER_TYPE'];
        $user = $row['USERNAME'];
       
        return $user;
    }
	
	return $user;
}