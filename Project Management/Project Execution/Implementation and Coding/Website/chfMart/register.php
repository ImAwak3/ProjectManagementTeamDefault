<!-- include the header and the menu section -->
<?php include "includes/header.php";
      include "includes/navigation.php";
      include "form_validation.php";


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
                        
                            <form action="form_validation.php" method="post">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="fir">First Name<span>*</span></label>
                                            <input class ="form-control" type="text" id="fir" name = "fName">
                                            <span class="error"><?php echo $fNameError; ?></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="last">Last Name<span>*</span></label>
                                            <input type="text" id="last" name = "lName">
                                            <span class="error"><?php echo $lNameError; ?></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="email">Email Address<span>*</span></label>
                                            <input type="text" id="email" name="email">
                                        </div>
                                    </div>

                                     <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" id="phone" name = "phone">
                                        </div>
                                    </div>  

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" id="password" name = "password">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="password">Confirm Password</label>
                                            <input type="password" id="password" name = "confirm_password">
                                        </div>
                                    </div>
                                                               
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="address">Address<span>*</span></label>
                                            <input type="text" id="address" name = "address">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="age">Age</label>
                                            <select name="age" id="age">
                                                <option value="below 17">Below 16</option>
                                                <option value="18-29">18-29</option>
                                                <option value="30-49">30-49</option>
                                                <option value="above 50">Above 50</option>
                                            </select>
                                        </div>
                                    </div>   

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="radio-inline"><input type="radio" name="gender" checked>Male</label>

                                            <label class="radio-inline"><input type="radio" name="gender">Female</label>                 
                                        </div>
                                    </div>

                                   <div class="col-lg-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type = "checkbox" value = "" id="Checkbox" name = "terms_checkbox">
                                            <label for="Checkbox" class = "form-check-label">Agree to <a href = "#"> terms and conditions</a></label>
                                        </div>
                            
                                    </div>
                                                       
                                    <div class="col-lg-8 offset-lg-4">
                                        <button type="submit" value="submit" class="btn submit_btn" name = "registerBtn">Register</button><br/>
                                        <p>Already have an account? <a href="./login.php">Login</a></p>
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