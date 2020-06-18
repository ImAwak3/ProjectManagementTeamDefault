<!-- include the header and the menu section -->
<?php
session_start();

include "includes/connection.php";
include "includes/header.php";
include "includes/navigation.php";
require 'shopping_process.php';
require 'funtions.php';

//Breadcrumb Section Begin --
include "includes/breadcrumb.php"; ?>
<!-- Breadcrumb Section Begin -->
 
    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                
                   <?php if(isset($_SESSION['user'])&& isset($_SESSION['cart_id'])){
                      
                       ?>
                        
                  
                    <div class="cart-table">
                        <div class="empty-shoppingCart">
                            <a href="shopping-cart.php?action=empty">Empty Shopping Cart</a>
                        </div>
                        <table>
                            <thead>
                                
                                <tr>
                                    <th><i class="ti-close"></i></th>
                                    <th>Image</th>
                                    <th class="p-name">Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                               
                                
                                <?php  getShoppingCart();?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 offset-lg-4">
                            <div class="proceed-checkout">
                            <?php require 'calculate_total.php';?>
                                <!--  -->
                                <a href="check-out.php" class="proceed-btn">PROCEED TO CHECK OUT</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                else{
                    echo "NO products are added yet!";
                }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->


<!-- include the footer section -->
<?php include "includes/footer.php";?>