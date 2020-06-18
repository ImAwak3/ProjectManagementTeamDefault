<?php


include "includes/connection.php";



function getShoppingCart(){
    if(isset($_SESSION['user'])){
        $member_id = $_SESSION['user']['USER_ID'];   
    }
    global $conn;
    $last_row_id = "select MAX(CART_ID) FROM cart, customer where cart.CUSTOMER_ID = customer.CUSTOMER_ID";     
    $parse = oci_parse($conn, $last_row_id);
    $execute = oci_execute($parse);
    
    while (($row = oci_fetch_row($parse)) != false) {
        
      
        $current_cart_id = $row[0];
        if(isset($_SESSION['user'])){
            
            $select_items = "select * from product, product_cart, cart, customer, users where product.PRODUCT_ID = product_cart.PRODUCT_ID
            AND product_cart.CART_ID = cart.CART_ID
            And cart.CUSTOMER_ID = customer.CUSTOMER_ID
            AND customer.USER_ID = users.USER_ID
            ANd users.USER_ID = $member_id
            AND cart.CART_ID = $current_cart_id";
            
                
                $parse = oci_parse($conn, $select_items);
                $execute = oci_execute($parse);
                    while($row = oci_fetch_array($parse, OCI_ASSOC+OCI_RETURN_NULLS!=false)){?>
                        
                        <tr>
                            <td class="close-td">
            
                                <a href="shopping-cart.php?action=remove&rId=<?php echo $row['PRODUCT_ID'];?>"><i class="ti-close"></i></a>
                            </td>
            
                            <td class="cart-pic"><img src = "img/products/<?php echo $row['PRODUCTIMAGE_CODE'];?>"></td>
            
                            <td class="cart-title">
                                <h5><?php echo $row['PRODUCT_NAME'];?></h5>
                            </td>
            
                            <td class="p-price"><?php echo $row['PRODUCT_PRICE'];?></td>
            
                            <td class="qua-col">
                                <?php echo $row['PRODUCT_QUANTITY']; ?> 
                                <!-- <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="<?php echo $row['PRODUCT_QUANTITY'];?>">
                                    </div>
                                </div> -->
                            </td>
            
                            <td class="total-price"><?php echo $total_item = $row['PRODUCT_PRICE'] * $row['PRODUCT_QUANTITY'];?></td>
                        
                        </tr>
            
                <?php
                    }
         }
    }
}

function show(){
    
}