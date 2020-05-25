<?php

$fName = "";
$lName = "";
$email = "";
$errors = array();
$fNameError = $lNameError = $emailError = $passError = $confirm_passError = $termsError = "";

if(isset($_POST['registerBtn'])){
    
    // $fName = e($_POST['fName']);
    // $lName = e($_POST['lName']);
    // $email = e($_POST['email']);
    // $age = e($_POST['age']); 
    // $password= e($_POST['password']);
    // $password = e($_POST['confirm_password']);
    // $address = e($_POST['address']);
    // $phone = e($_POST['phone']);
    // $gender = e($_POST['gender']);
    // if(isset($_POST['terms_checkbox']))
    // $terms_condition_checkbox = e($_POST['terms_checkbox']);

    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $email = $_POST['email'];
    $age = $_POST['age']; 
    $password= $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];

    if(isset($_POST['terms_checkbox']))  $terms_condition_checkbox = $_POST['terms_checkbox'];
  
    // form validation

    if(empty($fName)){
        $fNameError = "First Name is reuqired";
    }

    if(empty($fName)){
        $lNameError = "Last Name is required";
    }

    if(is_numeric($fName) || is_numeric($lName)){
        array_push($errors, "Only alphabets are allowed in username");
    }

    if(empty($email)){
        $emailError = "Email is required";
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($errors, "Enter the email in a correct format. Eg. abc@gmail.com");
    }


    if(empty($terms_condition_checkbox)){
        $termsError = "Please indicate that you have read and agree to the Terms and Conditions and Privacy Policy";
        
    }

    if (empty($password)) { 
        $passError = "Password is required";
    }

    if (!(preg_match_all('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,16}$/', $password))){
        array_push($errors, "Password should be at 8 characters at minimum and contain at least one Uppercase letter, one number and one symbol");
    }
    
	if ($password != $confirm_password) {
        array_push($errors, "The two passwords do not match");
    }

    header("location:register.php");
    if(count($errors) == 0)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);

       
        // if(isset($_POST['user_type'])){
        //     $user_type = e($_POST['user_type']);
        //     $query = "INSERT INTO users (username, user_email, password, user_type, age)";
        //     $query.= "VALUES('$username', '$user_email', '$password', '$user_type', '$age')";
    
        //     $register_query = mysqli_query($connection, $query);
        //     if(!$register_query){
        //         die( "error!".mysqli_error($connection));
        //     }
        //     $_SESSION['success'] = "New user successfully created";
        //     header("location:register.php?ok=1");
        // }
        // else{
        //     $query = "INSERT INTO users (username, user_email, password, user_type, age) 
        //               VALUES('$username', '$email','$password', 'user', '$age')";
                      
        //     $register_login_query = mysqli_query($connection, $query);
        //     if(!$register_login_query){
        //         die( "error!".mysqli_error($connection));
        //     }
        //     // id of created user
        //     $logged_in_user_id = mysqli_insert_id($connection);
        //     $_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
          
		// 	header("location: index.php");				
        // }
       
    }
}

// return user array of the id
// function getUserById($id){
// 	global $connection;
// 	$query = "SELECT * FROM users WHERE user_id=" . $id;
// 	$result = mysqli_query($connection, $query);

// 	$user = mysqli_fetch_assoc($result);
// 	return $user;
// }

// escape string
// function e($val){
// 	global $connection;
// 	return mysqli_real_escape_string($connection, trim($val));
// }

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
    }
    
 
}	

