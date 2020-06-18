<?php
include 'includes/connection.php';
 if(isset($_SESSION['user'])){

    $totalPrice = 0;
    $subTotal = 0;
    $discount = 0;
    $member_id = $_SESSION['user']['USER_ID'];   

         $select_items = "select * from product, product_cart, cart, customer, users where   product.PRODUCT_ID = product_cart.PRODUCT_ID
            AND product_cart.CART_ID = cart.CART_ID
            And cart.CUSTOMER_ID = customer.CUSTOMER_ID
            AND customer.USER_ID = users.USER_ID
            ANd users.USER_ID = $member_id 
            AND product_cart.CART_ID = (select MAX(CART_ID) FROM cart, customer where cart.CUSTOMER_ID = customer.CUSTOMER_ID)";
          
              $parse = oci_parse($conn, $select_items);
              $execute = oci_execute($parse);
            $result = array();
            $numRows = oci_fetch_all($parse, $result, null, null, OCI_FETCHSTATEMENT_BY_ROW);
            if($numRows>0){
                foreach($result as $row){
                
                    $pName = $row['PRODUCT_NAME'];
                    $total_item= $row['PRODUCT_PRICE'] * $row['PRODUCT_QUANTITY'];   
                    $totalPrice+= $total_item;?>
                    <ul class="order-table">
                    <li class = "subtotal">Product: <span><?php echo $pName;?></span></li>
                    <?php
                }
                $subTotal= $subTotal+ $totalPrice;
                if($subTotal> 1000){
                    $discount = 10.00;
                    if(isset($discount)){
                        $discount_query = "insert into discount (DISCOUNT_AMOUNT) values ($discount)";
                        $parse = oci_parse($conn, $discount_query);
                        $execute = oci_execute($parse);
        
                    }
                   
                } 
                else{
                    $discount = 0;
                }
               
    
                ?>
                
                
                <?php
              
            }
              $total_amt = $subTotal+$discount;
              ?>
               

            <li class="subtotal">Subtotal <span>$<?php echo $subTotal;?></span></li>
            <li class="discount">Discount <span>$<?php if(isset($discount))echo $discount;?></span></li>
            <li class="cart-total">Total <span>$<?php echo $total_amt;?></span></li>
    
        </ul>
                <?php
               
      
        }