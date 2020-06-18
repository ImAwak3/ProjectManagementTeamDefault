
<?php

include "includes/connection.php";      
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="CleckHuddersfax Website">
    <meta name="keywords" content="CleckHudddersfax, shopping, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CleckHuddersfax Online Mart</title>

    
<style>


body{
    background-color:rgba(0, 0, 0, 0.07);
}
.verification-success{
  background-color: rgba(0,0,0,0.08);
    margin:150px;
  padding:120px 30px;
  border:1px solid rgba(0, 0, 0, 0.07);
  border-radius: 20px;
  box-shadow: 10px 10px 20px rgba(0,0,0,0.6);
  width:auto;
  height:auto;
  text-align: center;
}


.verification-success a:hover{
  color:#000;
}

.verification-error{
  border:1px solid rgba(0, 0, 0, 0.07);
  border-radius:20px;
}

</style>

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
<?php
if(isset($_GET['vKey'])){
    $vKey = $_GET['vKey'];   

    $result = "select VERIFICATION_CODE, IS_VERIFIED from users where IS_VERIFIED = 'N' AND VERIFICATION_CODE = '$vKey' AND ROWNUM <=1";

    $parse = oci_parse($conn, $result);
    $execute = oci_execute(($parse));

    $result = array();
    $numRows = oci_fetch_all($parse, $result, null, null, OCI_FETCHSTATEMENT_BY_ROW );
    if($numRows>0){
        foreach($result as $row){

            if($row['IS_VERIFIED']=='N'){
                $update_query = "UPDATE users SET IS_VERIFIED = 'Y' where VERIFICATION_CODE = '$vKey'";
                $parse = oci_parse($conn, $update_query);
                $execute = oci_execute($parse);
                if($parse){
                    ?>
                        <section id="verification">
                            <div class="verification-success">
                                <p>Your Email was successfully verified. Please Proceed to Login to enter the website.</p>
                                <a href="login.php">Login</a>
                            </div>
                        </section>
                       
                    <?php
                }
                else{
                    echo oci_error($conn);
                }
            }
            else{
                ?>
                <div class="verification-error">
                   <p>Your Email is already verified.</p>
                </div>
            <?php
            }
        }
    }

    else{
    echo oci_error($conn);
    }
}
else{
    echo "Invalid login";
}
?>

</body>
</html>