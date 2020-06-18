<?php
session_start();
include "includes/connection.php";
include "includes/header.php";
include "includes/navigation.php";
include "update_profile.php";

if(isset($_SESSION['user'])){
    $id = $_SESSION['user']['USER_ID'];
    
}

if(isset($_SESSION['message'])){
    echo '<p class = "alert alert-success alert-dismissible">'.$_SESSION['message'].'</p>';
    unset ($_SESSION['message']);
}
?>
<section id="profile">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#personal_info">Personal Information</a>
        </li>
        <li class="nav-item">
            <a class="nav-link edit_info" data-toggle="tab" href="#edit_profile">Edit profile</a>
        </li>
    </ul>


    <div class="tab-content">
        <div class="tab-pane container active mt-4" id="personal_info">   
            <?php
            
                $get_info = "select * from users where USER_ID = $id";
                $parse = oci_parse($conn, $get_info);
                $execute = oci_execute($parse);
                while($row = oci_fetch_array($parse, OCI_ASSOC+OCI_RETURN_NULLS!=false)){?>
        
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    Username :
                                </td>
                                <td>
                                <?php echo $row['USERNAME'];?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    First Name :
                                </td>
                                <td>
                                <?php echo $row['FIRST_NAME'];?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Last Name :
                                </td>
                                <td>
                                <?php echo $row['LAST_NAME'];?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Email :
                                </td>
                                <td>
                                <?php echo $row['EMAIL'];?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Address :
                                </td>
                                <td>
                                <?php echo $row['ADDRESS'];?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                Phone Number:
                                </td>
                                <td>
                                <?php echo $row['PHONE_NUMBER'];?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            
                    <?php
                }
                    ?>
        </div>
  
  
        <div class="tab-pane container fade mt-4" id="edit_profile"> 
            <?php
            $get_info = "select * from users where USER_ID = $id";
            $parse = oci_parse($conn, $get_info);
            $execute = oci_execute($parse);
            while($row = oci_fetch_array($parse, OCI_ASSOC+OCI_RETURN_NULLS!=false)){?>

           
                <form method="post" action="account.php"> 
                    <?php display_error();?>           
                    <div class="row">
                        <div class="col-lg-6">
                            
                            <div class="form-group">
                                <label for="fir">First Name<span>*</span></label>
                                <input class ="form-control" type="text" id="fir" name = "fName" value = "<?php echo $row['FIRST_NAME']?>">
                                
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="last">Last Name<span>*</span></label>
                                <input class = "form-control" type="text" id="last" name = "lName" value = "<?php echo $row['LAST_NAME']?>">
                                
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                    <label for="fir">Username<span>*</span></label>
                                    <input class ="form-control" type="text" id="username" name = "username" value = "<?php echo $row['USERNAME']?>">
                                
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="email">Email Address<span>*</span></label>
                                <input  class ="form-control" type="text" id="email" name="email" value = "<?php echo $row['EMAIL']?>">
                            </div>
                        </div>                                    

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input  class ="form-control" type="password" id="password" name = "password">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="password">Confirm Password</label>
                                <input  class ="form-control" type="password" id="password" name = "confirm_password">
                            </div>
                        </div>
                                                    
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input  class ="form-control" type="text" id="address" name = "address" value = "<?php echo $row['ADDRESS']?>">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input  class ="form-control" type="text" id="phone" name = "phone" value = "<?php echo $row['PHONE_NUMBER']?>">
                            </div>
                        </div>  

                        <div class="col-lg-8 offset-lg-2">
                            <button type="submit" value="submit" class="btn btn-block submit_btn btn-warning" name = "updateBtn">Update Profile</button><br/>
                           
                        </div>
                        
                    </div>
                </form>    
            <?php
            }
            ?>
        </div>
  
    </div> 
  
</section>

<?php

include "includes/footer.php";