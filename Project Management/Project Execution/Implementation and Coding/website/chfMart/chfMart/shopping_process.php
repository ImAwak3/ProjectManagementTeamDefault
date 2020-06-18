<?php

    if(isset($_POST["pro_id"])){
        if(!empty($_POST["pro_id"])){
            $pro_ID = $_POST["pro_id"];
        }
    }

    if(isset($_SESSION['cart_id'])){
        $cur_cart_id = $_SESSION['cart_id'];
    }

            
    if(!empty($_GET['action'])){
        if(isset($_SESSION['user'])){
            $member_id = $_SESSION['user']['USER_ID'];   
        }
       
        switch($_GET['action']){
            case "add":          
                if(!empty($_POST['pro-quantity'])){
                
                    $product_quantity = $_POST['pro-quantity'];                  
                    $select_query = "select * from product, product_cart, cart, customer, users where product.PRODUCT_ID = product_cart.PRODUCT_ID
                    AND product_cart.CART_ID = cart.CART_ID
                    And cart.CUSTOMER_ID = customer.CUSTOMER_ID
                    AND customer.USER_ID = users.USER_ID
                    AND product.PRODUCT_ID = $pro_ID
                    ANd users.USER_ID = $member_id
                    AND product_cart.CART_ID = $cur_cart_id";

                    $select_parse = oci_parse($conn, $select_query);
                    $select_execute = oci_execute($select_parse);
                    $row = oci_fetch_array($select_parse, OCI_ASSOC+OCI_RETURN_NULLS);
                
                    if($row==false){    

                            $last_row_id = "select MAX(CART_ID) FROM cart, customer where cart.CUSTOMER_ID = customer.CUSTOMER_ID";   
                            $parse = oci_parse($conn, $last_row_id);
                            $execute = oci_execute($parse);
                            
                            while (($row = oci_fetch_row($parse)) != false) {
                                                              
                                $current_cart_id = $row[0];
                                $_SESSION['cart_id'] = $current_cart_id;
                                $insert_query = "insert into product_cart (CART_ID, PRODUCT_ID, PRODUCT_QUANTITY, ADDED_DATE) VALUES ($current_cart_id, $pro_ID,$product_quantity, TO_DATE(SYSDATE, 'DD/MM/YYYY'))";
                                $insert_query_parse = oci_parse($conn, $insert_query);
                            
                                $insert_query_execute = oci_execute($insert_query_parse);
                                if(!$insert_query_parse){
                                    oci_error($conn);
                                }
                            }
                    }
                
                
                }
            break;
            case "remove":
                if(isset($_GET['rId'])){
                    if(!empty($_GET["rId"])){
                        $remove_id = $_GET['rId'];
                    }
                }
                    $delete_query = "delete from product_cart where PRODUCT_ID=$remove_id";
                    $delete_parse = oci_parse($conn,$delete_query);
                    $delete_execute = oci_execute($delete_parse);
                
            break;
            case "empty":
                $empty_cart_query = "delete from product_cart";
                $empty_cart_parse = oci_parse($conn, $empty_cart_query);
                $empty_cart_execute = oci_execute($empty_cart_parse);
            break;
        }
       
    }
  

  
    
   

?>
 
