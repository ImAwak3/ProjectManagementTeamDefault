<?php
session_start();
include "../includes/connection.php";
include_once "config.php";
if(isset($_SESSION['cart_id'])){
    $cart_id = $_SESSION['cart_id'];
}

if(isset($_SESSION['user'])){
    $member_id = $_SESSION['user']['USER_ID'];
}



// If transaction data is available in the URL 
if(!empty($_GET['item_number']) && !empty($_GET['tx']) && !empty($_GET['amt']) && !empty($_GET['cc']) && !empty($_GET['st'])){ 
    // Get transaction iinformation from URL 
    $item_number = $_GET['item_number'];  
    $txn_id = $_GET['tx']; 
    $payment_gross = $_GET['amt']; 
    $currency_code = $_GET['cc']; 
    $payment_status = $_GET['st']; 


     // Check if transaction data exists with the same TXN ID. 
    $prevPaymentResult ="SELECT * FROM invoice WHERE TXN_ID = '".$txn_id."'"; 
    $parse = oci_parse($conn, $prevPaymentResult);
    $execute = oci_execute($parse);
    $result = array();
    $num_rows = oci_fetch_all($parse, $result, null, null, OCI_FETCHSTATEMENT_BY_ROW);
    if($num_rows>0){
        foreach($result as $row){
            $payment_id = $row['INVOICE_ID']; 
            $payment_gross = $row['TOTAL_AMOUNT']; 
            $payment_status = $row['DELIVERY_STATUS']; 


        }
    }
    else{ 

        $discount_query = "select MAX(DISCOUNT_ID) from discount";
        $parse = oci_parse($conn, $discount_query);
        $execute = oci_execute($parse);

        while (($row = oci_fetch_row($parse)) != false) {                                                                               
            $dis_id = $row[0];                    
            // Insert tansaction data into the database

            $insert ="INSERT INTO invoice(DISCOUNT_ID,TXN_ID,TOTAL_AMOUNT,INVOICE_DATE, DELIVERY_STATUS) VALUES('".$dis_id."','".$txn_id."','".$payment_gross."',CURRENT_TIMESTAMP,'".$payment_status."')
            ";

            $parse = oci_parse($conn, $insert);
           
            $execute = oci_execute($parse); 
                
             
        }

        $payment_id = "select INVOICE_ID from invoice WHERE TXN_ID = '".$txn_id."'";
        $payment_parse = oci_parse($conn, $payment_id);
        $execute = oci_execute($payment_parse); 
        $results = array();
        $num_rows = oci_fetch_all($payment_parse, $results, null, null, OCI_FETCHSTATEMENT_BY_ROW);
        if($num_rows>0){
            foreach($results as $row){     
                    $invoice_id = $row['INVOICE_ID'];
                    $slot_query = "select MAX(COLLECTIONSLOT_ID) FROM COLLECTION_SLOT WHERE ADDED_BY = $member_id";
                    $parse = oci_parse($conn, $slot_query);
                    oci_define_by_name($parse, 'MAX(COLLECTIONSLOT_ID)', $slot_id);
                    $execute = oci_execute($parse);
                    while (($row = oci_fetch_row($parse)) != false) {
                        $slot_id = $row[0];

                        $cart_query = "select MAX(CART_ID) FROM CART";
                        
                        $parse = oci_parse($conn, $cart_query);
                        $execute = oci_execute($parse);
                        while (($row = oci_fetch_row($parse))!=false) {

                                $cur_cart_id = $row[0];

                                $payment_detail = "insert into payment_detail(INVOICE_ID, COLLECTIONSLOT_ID, PRODUCTCART_ID, PAYMENT_METHOD) values ($invoice_id, $slot_id,  $cur_cart_id, 'paypal')";
                                $parse = oci_parse($conn, $payment_detail);
                                $execute = oci_execute($parse);
                                if(!$parse){
                                    echo oci_error();
                                }
                            
                        }
                        
                    }
                
                    
                   
            }
        }
    }
}
?>
            <div class="container">
                <div class="status">
                   
                    <?php if(!empty($payment_parse)){ ?>
                            <h1 class="success">Your Payment has been Successful</h1>
                            
                            <h4>Payment Information</h4>
                            <p><b>Transaction ID:</b> <?php echo $txn_id; ?></p>
                            <p><b>Paid Amount:</b> <?php echo $payment_gross; ?></p>
                            <p><b>Payment Status:</b> <?php echo $payment_status; ?></p>

                            <h4>Product Information</h4>
                            <p>Please check your mail for your invoice for further details about products.</p>
                            <?php             
                            require '../invoice/customer.php';
                    }
                    else{ ?>
                        <h1 class="error">Your Payment has Failed</h1>
                    <?php } ?>
            
                </div>
                <a href="../index.php" class="btn-link">Back to Products</a>
            </div>
            <?php

        