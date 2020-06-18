<!-- include the header and the menu section -->
<?php include "includes/header.php";
      include "includes/navigation.php";
      include "trader_form_validation.php";

      
    //Breadcrumb Section Begin --
    include "includes/breadcrumb.php"; ?>
    <!-- Breadcrumb Section Begin -->

    <!-- Register Section Begin -->
    <div class="register-section">
        <div class="container">
            
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">

                        <div class="register-form">
                            <h4 class = "text-center my-5">Create an account</h4>
                        
                            <form action="trader_register.php" method = "post">
                                <?php echo display_error();?>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="fir">First Name<span>*</span></label>
                                        <input type="text" id="fir" name = "fName">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="last">Last Name<span>*</span></label>
                                        <input type="text" id="last" name = "lName">
                                    </div>
                                   
                                    <div class="col-lg-6">
                                         <label for="email">Email Address<span>*</span></label>
                                        <input type="text" id="email" name = "email">
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                                <label for="fir">Username<span>*</span></label>
                                                <input class ="form-control" type="text" id="username" name = "username" >
                                            
                                        </div>
                                    </div>

                                    
                                                                                        
                                    <div class="col-lg-6">
                                        <label for="password">Password<span>*</span></label>
                                        <input type="password" id="password" name = "password">
                                    </div>

                                    <div class="col-lg-6">
                                         <label for="password">Confirm Password<span>*</span></label>
                                        <input type="password" id="password" name = "confirm_password">
                                    </div>
                                   
                                                               
                                    <div class="col-lg-6">
                                        <label for="phone">Phone<span>*</span></label>
                                        <input type="text" id="phone" name = "phone">
                                    </div>
                                    

                                     <div class="col-lg-6">
                                        <label for="address">Shop Address<span>*</span></label>
                                        <input type="text" id="address" name = "address">
                                    </div>

                                    

                                    <div class="col-lg-6">
                                        <label for="shop_name">Shop Name<span>*</span></label>
                                        <input type="text" id="shop_name" name = "shop_name">
                                    </div>

                                    
                                    <div class="col-lg-6">
                                        <label for="shop_type">Shop Type<span>*</span></label>
                                        <select name="shop_type" id="shop_type">
                                            <option value="butchers">Butchers</option>
                                            <option value="Bakery">Bakery</option>
                                            <option value="butchers">Fishmongers</option>
                                            <option value="Bakery">Delicatessen</option>
                                            <option value="butchers">Greengrocer</option>
                                            
                                        </select>
                                        
                                    </div>
                               
                                    <div class="col-lg-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type = "checkbox" value = "check" id="Checkbox" name = "terms_checkbox">
                                            <label for="Checkbox" class = "form-check-label">Agree to <a href = "#"> terms and conditions</a></label>
                                        </div>
                            
                                    </div>
                            
                                    <div class="col-lg-8 offset-lg-4">
                                        <button type="submit" value="submit" class="btn submit_btn" name = "trader_register">Register</button><br/>
                                        <p>Already have an account? <a href="./login.html">Login</a></p>
                                    </div>
                                </div>
                              
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <!-- Register Form Section End -->
    
   
 <!-- include the footer section -->
<?php include "includes/footer.php";?>