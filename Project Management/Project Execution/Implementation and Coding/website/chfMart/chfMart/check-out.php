<!-- include the header and the menu section -->
<?php
session_start();
    include 'includes/connection.php';
    include "includes/header.php";
    include "includes/navigation.php";
    include_once "paypal/config.php";
    //Breadcrumb Section Begin --
    include "includes/breadcrumb.php"; 
    //  Breadcrumb Section Begin 

    if(isset($_SESSION['cart_id'])){
        $cart_id = $_SESSION['cart_id'];
    }
    

    ?>
    <!-- Shopping Cart Section Begin -->
    <section class="checkout-section spad">
        <div class="container">
            <div class="checkout-form">
                <div class="row">
                    <!-- billing details -->
                    <div class="col-lg-8 offset-lg-2">
                        
                        <h4>Biiling Details</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="fir">First Name<span>*</span></label>
                                <input type="text" id="fir">
                            </div>
                            <div class="col-lg-6">
                                <label for="last">Last Name<span>*</span></label>
                                <input type="text" id="last">
                            </div>
                           
                            <div class="col-lg-12">
                                <label for="street">Street Address<span>*</span></label>
                                <input type="text" id="street" class="street-first">
                                <input type="text">
                            </div>
                            
                            <div class="col-lg-6">
                                 <label for="email">Email Address<span>*</span></label>
                                <input type="text" id="email">
                            </div>
                           
                                                       
                            <div class="col-lg-6">
                                <label for="phone">Phone<span>*</span></label>
                                <input type="text" id="phone">
                            </div>
                           
                        </div>
                    </div>

                    <!-- collection slot -->
                    <div class="col-lg-6 offset-lg-3 d-flex">
                        <div class="collection-slot">
                                                    
                        <?php
                               
                            ?>
                            <h4 class = "text-center">Collection Slot</h4>
                            <p>Choose your collection slot</p>

                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                   
                                        <h5>Wednesday</h5>
                                        <select class="slot_day"id="wednesday" name = "wed_slot">                    
                                            <option value="10:00-13:00">10:00-13:00</option>
                                            <option value="13:00-16:00">13:00-16:00</option>
                                            <option value="16:00-19:00">16:00-19:00</option>
                                        </select>  

                                        <h5>Thursday</h5>
                                        <select class="slot_day" id="thursday" name = "thur_slot">                    
                                            <option value="10:00-13:00">10:00-13:00</option>
                                            <option value="13:00-16:00">13:00-16:00</option>
                                            <option value="16:00-19:00">16:00-19:00</option>
                                        </select> 
                                
                                        <h5>Friday</h5>             
                                        <select class = "slot_day" id="friday" name = "fri_slot">                    
                                            <option value="10:00-13:00">10:00-13:00</option>
                                            <option value="13:00-16:00">13:00-16:00</option>
                                            <option value="16:00-19:00">16:00-19:00</option>
                                        </select>      
                                    
                                </div>      
                                
                            </div><!--row-->

                            <p class="collectionslot_note"><span class = "font-weight-bold">Note: </span>The slot must be choose at least 24 hours after the placement of the order</p>
                        </div><!--collection-slot-->
                    </div>

                    <div class="col-lg-6 offset-lg-3">
                        <div class="place-order">
                                <h4 class = "text-center">Your Order</h4>
                                <div class="order-total">
                                    <?php
                                    require 'calculate_total.php';

                                    $select_items = "select * from product, product_cart, cart, customer, users where product.PRODUCT_ID = product_cart.PRODUCT_ID
                                    AND product_cart.CART_ID = cart.CART_ID
                                    And cart.CUSTOMER_ID = customer.CUSTOMER_ID
                                    AND customer.USER_ID = users.USER_ID
                                    ANd users.USER_ID = $member_id 
                                    AND product_cart.CART_ID = (select MAX(CART_ID) FROM cart, customer where cart.CUSTOMER_ID = customer.CUSTOMER_ID) AND ROWNUM<=1";
          
                                    $parse = oci_parse($conn, $select_items);
                                    $execute = oci_execute($parse);
                                    $result = array();
                                    $numRows = oci_fetch_all($parse, $result, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                                    if($numRows=1){
                                        foreach($result as $row){
                                            $item_name = $row['PRODUCT_NAME'];
                                            $item_number = $row['PRODUCT_ID'];
                                        ?>            
                                        
                                        
                                            <form name = "checkout-form" action="<?php echo PAYPAL_URL;?>" method="post">

                                                <input type="hidden" name="cmd" value="_xclick" />

                                                <!-- Identify your business so that you can collect the payments. -->

                                                <input type='hidden' name='business' value='<?php echo PAYPAL_ID;?>'>                                             

                                                <!-- Specify details about the item that buyers will purchase. -->
                                                <input type='hidden' name='item_name' value='<?php echo htmlentities($item_name);?>'> 

                                                <input type='hidden' name='item_number' value='<?php echo $item_number;?>'> 
                                                <input type='hidden' name='amount' value='<?php echo $total_amt;?>'>
                                                <input type='hidden' name='currency_code' value='<?php echo PAYPAL_CURRENCY;?>'>

                                                <!-- Specify URLs -->
                                                <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">
                                                <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">
                                                <!-- <input type="hidden" name="notify_url" value="<?php echo PAYPAL_NOTIFY_URL; ?>"> -->

                                                <!-- Specify a Buy Now button. -->
                                                <input type="submit" name="pay_now" id="pay_now" Value="Pay Now">
                                            </form>
                                            <?php
                                        }
                                              
                                    }
                                    ?>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->


<?php include "includes/footer.php";?>