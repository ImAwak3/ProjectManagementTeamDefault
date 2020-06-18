<!-- include the header and the menu section -->
<?php
    session_start();
include "includes/header.php";
      include "includes/navigation.php";
        include "login_form_validation.php";
      
    //Breadcrumb Section Begin --
    include "includes/breadcrumb.php"; ?>
    <!-- Breadcrumb Section Begin -->

    <section class="login_box_area">
          <h2>login</h2>
        <div class="container">

            <div class="row">
                <div class="col-lg-6 col-md-6">

                    <div class="login_box_img img-fluid">
                        
                        <div class="hover">
                            <h4>New to our website?</h4>
                            <p>There are advances being made in science and technology everyday, and a good example of this is the</p>
                            <a class="main_btn" href="./register.php">Create an Account</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="login_form_inner">
                        <h3>Log in to enter</h3>
                        <form class="row login_form" action="login.php" method="post" id="contactForm">
                            <?php echo display_error();?>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                            
                            <div class="col-md-12 form-group">
                                <button type="submit" value="submit" class="btn submit_btn" name = "loginBtn">Log In</button>
                                <a href="#">Forgot Password?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
   
<!-- include the footer section -->
<?php include "includes/footer.php";?>