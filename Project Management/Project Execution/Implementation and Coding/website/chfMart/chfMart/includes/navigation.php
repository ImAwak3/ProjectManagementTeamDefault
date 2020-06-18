 <?php ob_start();
require 'shopping_process.php';
if(isset($_SESSION['user'])){
    $member_id = $_SESSION['user']['USER_ID'];   

$count_items = "select * from product, product_cart, cart, customer, users where product.PRODUCT_ID = product_cart.PRODUCT_ID
AND product_cart.CART_ID = cart.CART_ID
And cart.CUSTOMER_ID = customer.CUSTOMER_ID
AND customer.USER_ID = users.USER_ID
ANd users.USER_ID = $member_id
AND product_cart.CART_ID = (select MAX(CART_ID) FROM cart, customer where cart.CUSTOMER_ID = customer.CUSTOMER_ID)";
$parse = oci_parse($conn, $count_items);
$execute = oci_execute($parse);

$total_items = oci_fetch_all($parse, $res);
}
 ?>
    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="header-top">
            <div class="container">
                <!-- header top right -->
                <div class="ht-right">
                    <?php 
                    if(isset($_SESSION['user'])){
                        ?>
						<div class="logout">
                            <p class = "username"><?php echo $_SESSION['user']['USERNAME'];?> </p>
                            <span class = "usertype">(<?php echo $_SESSION['user']['USER_TYPE'];?>) </span>
                            <a href="account.php" class="account-panel"><i class="fa fa-user-circle"></i> Account</i> </a>
                            <a href="./logout.php" class = "logout-link">Logout</a>
                        </div>
                    <?php
                    }
                    else{
                        ?>
                    
                    <a href="./login.php" class="login-panel"><i class="fa fa-user"></i>Login</a>  
                    <button type = "button" data-toggle="modal" data-target="#registerModal" class="register-btn"><i class="fa fa-user"></i>    Register</button>    

                    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            
                        
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="registerModalLabel">Register your account</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="container">
                                        <div class="row">

                                        
                                            <div class="col-lg-6">
                                                <div class="modal-body mt-3 mb-4 trader-modal">
                                                   <h5 class = "mb-3">Want to start a business?</h5>
                                                   <p> Register with our website to start an online shop</p>
                                                   <a href="./trader_register.php">Register</a>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="modal-body mt-3 mb-4">
                                                  <h5 class = "mb-3">First time to our website?</h5> 
                                                   <p>Register with us to have easy shopping experience</p>
                                                    <a href="./register.php">Register</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        
                                        <p>Already have an account?  <a href="./login.php">Login</a></p>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      
                                    </div>
                                </div>
                           
                        </div>
                        </div>
                    <?php
                }?>                                 
                </div>
            </div>
        </div>
        <div class="container container-md">
            <div class="inner-header">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2">
                        <div class="logo">
                            <a href="./index.php">
                                <img src="img/websitelogo.png" alt="website logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8">
                    <form action="search.php" method="get">
                            <div class="advanced-search">
                            
                                <div class="input-group">
                                
                                    <input type="text" placeholder="What do you need?" name = "search_products">
                                    <button type="submit" name = "submit"><i class="ti-search"></i></button>
                                    
                                </div>
                               
                            </div>
                            </form>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2">
                        <?php
                            require 'check_login.php';
                      ?>
                       
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-item">
            <div class="container">
               
                <nav class="nav-menu mobile-menu">
                    <ul>
                        <li class="active"><a href="./index.php">Home</a></li>
                        <li><a href="./shop.php">Shop</a></li>
                        <li><a href="./shop.php">All Products</a></li>
                        <li><a href="./about.php">About</a></li>
                        <li><a href="./contact.php">Contact</a></li>
                       
                    </ul>
                </nav>
                <div id="mobile-menu-wrap"></div>
            </div>
        </div>
    </header> 
    <!-- Header End -->