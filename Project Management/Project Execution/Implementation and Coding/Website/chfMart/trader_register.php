<!-- include the header and the menu section -->
<?php include "includes/header.php";
      include "includes/navigation.php";

      
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
                        
                            <form action="#">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="fir">First Name<span>*</span></label>
                                        <input type="text" id="fir">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="last">Last Name<span>*</span></label>
                                        <input type="text" id="last">
                                    </div>
                                   
                                    <div class="col-lg-6">
                                         <label for="email">Email Address<span>*</span></label>
                                        <input type="text" id="email">
                                    </div>

                                     <div class="col-lg-6">
                                        <label for="phone">Phone<span>*</span></label>
                                        <input type="text" id="phone">
                                    </div>
                                                                                        
                                    <div class="col-lg-6">
                                        <label for="password">Password<span>*</span></label>
                                        <input type="password" id="password">
                                    </div>

                                    <div class="col-lg-6">
                                         <label for="password">Confirm Password<span>*</span></label>
                                        <input type="password" id="password">
                                    </div>
                                   
                                                               
                                   
                                    

                                     <div class="col-lg-6">
                                        <label for="address">Shop Address<span>*</span></label>
                                        <input type="text" id="address">
                                    </div>

                                     <div class="col-lg-6">
                                        <label for="pan_no">PAN No<span>*</span></label>
                                        <input type="text" id="pan_no">
                                    </div>

                                    <div class="col-lg-6">
                                        <label for="shop_name">Shop Name<span>*</span></label>
                                        <input type="text" id="shop_name">
                                    </div>

                                     <div class="col-lg-6">
                                        <label for="shop_no">Shop No<span>*</span></label>
                                        <input type="text" id="shop_no">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="shop_type">Shop Type<span>*</span></label>
                                        <select name="age" id="shop_type">
                                            <option value="butchers">Butchers</option>
                                            <option value="Bakery">Bakery</option>
                                        </select>
                                        
                                    </div>
                               
                                   <div class="col-lg-8">
                                        <div class="terms_agreements">
                                            <div class="checkbox">
                                                <label class = "checkbox-inline"><input type="checkbox" value=""> I have read the terms and conditions. <a href="#">Terms and Condition</a></label>  
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div class="col-lg-8 offset-lg-4">
                                        <button type="submit" value="submit" class="btn submit_btn">Register</button><br/>
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