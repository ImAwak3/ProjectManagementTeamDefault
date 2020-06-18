
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="CleckHuddersfax Website">
    <meta name="keywords" content="CleckHudddersfax, shopping, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CleckHuddersfax Online Mart</title>


<style>

body{
    background-color: #eeeeee;
}

.wrapper{
    border:1px solid #212529;
    height:820px;
    padding:0 30px;
}

.header-top{
    width:100%;
    background-color: teal;
    margin-top: -19px;
}


.header-top .logo{
    text-align: center;
    height:80px;
}

.header-top .logo h3{
    padding-top: 30px;
    text-transform: uppercase;
    font-style: italic;
    font-weight: 300;
}

.header-md{
    width:100%;  
}

.heading{
    font-size: 16px;
    margin-left:50px;
}
.cus_info{
    font-weight: 500;
    font-size:14px;
    margin-left:50px;
}

.pull-right{
    margin-top:-80px;
    text-align: right;
    padding-right:50px;
}

.pull-right p{
    font-weight: 500;
    font-size: 14px;
}

.invoice-content{
    margin-top:50px;
}

.invoice-total{
    float:right;
    margin-top:40px;
    margin-right:50px;
    width:180px;
    height:100px;
    border: 3px solid #dee2e6;
    padding-top:10px;
}

.invoice-total li{ 
    font-size: 16px;  
    padding-left:0; 
    padding-top:10px;
}
.invoice-total li:nth-child(2){
    padding-bottom:10px;
}

.table{
    border: 1px solid #dee2e6;
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;  
    border-collapse: collapse;
}

.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
}
.table td, .table th {
    padding: .75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}
</style>
</head>
<body>
 
<?php
session_start();


include "../includes/connection.php";
if(isset($_SESSION['user'])){
    $member_id = $_SESSION['user']['USER_ID'];
}
if(isset($_SESSION['txn_id'])){
    echo $_SESSION['txn_id'];
}


        ?>
        <div class="wrapper">
            <header class = "header-top">
                <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="logo">
                           <h3>Your Invoice</h3>
                        </div>
                </div>

            </header>
            <div class="header-md">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class = "heading">Invoice For: </h5>
                            <?php
                           $subTotal = 0;
                           $totalPrice = 0;
                           $total_amt = 0;
                                $customer = "select * from users where USER_ID = $member_id";
                                $parse = oci_parse($conn, $customer);
                                $execute = oci_execute($parse);
                                
                                while($row = oci_fetch_array($parse, OCI_ASSOC+OCI_RETURN_NULLS!=false)){
                                    $recipient_email = $row['EMAIL'];
                                    $recipient_fname = $row['FIRST_NAME'];
                                    $recipient_lname = $row['LAST_NAME'];
                                    ?>
                                    <p class = "cus_info"><?php echo $recipient_fname." ".$recipient_lname?></p>
                                    <p class = "cus_info"><?php echo $recipient_email;?></p>
                                    <?php
                                }
                                if(!$parse){
                                    oci_error();
                                }
                            ?>
                        </div>    
                        
                        <div class="col-lg-6 pull-right">
                            <h5 class = "heading">Invoice Id:</h5>
                            <?php
                                
                                $query = " select * from invoice where INVOICE_DATE = ( select max(INVOICE_DATE) from invoice, payment_detail,collection_slot where invoice.INVOICE_ID = payment_detail.INVOICE_ID
                                ANd payment_detail.COLLECTIONSLOT_ID = collection_slot.COLLECTIONSLOT_ID
                                AND collection_slot.ADDED_BY = $member_id)
                                AND rownum = 1";
                                $parse = oci_parse($conn, $query);
                                $execute = oci_execute($parse);
                                while($row = oci_fetch_array($parse, OCI_ASSOC+OCI_RETURN_NULLS !=false)){
                                  $max_invoice_id = $row['INVOICE_ID'];
                        


                            
                            ?>
                                    <p><?php echo $max_invoice_id;?></p>
                                    

                            <?php
                              
                            

                            ?>
                        </div>
                           
                    </div>
                </div>
            </div>

            <div class="invoice-content">
                <table class = "table">
                    <thead>
                        
                        <tr>
                            <th class="p-name">Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php       
                        $query = "select * from invoice, payment_detail, product_cart,product, discount,collection_slot where
                        invoice.INVOICE_ID = payment_detail.INVOICE_ID
                        AND discount.DISCOUNT_ID = invoice.DISCOUNT_ID
                        AND payment_detail.PRODUCTCART_ID = product_cart.CART_ID
                        AND product_cart.PRODUCT_ID = product.PRODUCT_ID
                        AND payment_detail.COLLECTIONSLOT_ID = collection_slot.COLLECTIONSLOT_ID
                        AND invoice.INVOICE_ID = $max_invoice_id";
                        $parse = oci_parse($conn, $query);
                        $execute = oci_execute($parse);
                        while($row = oci_fetch_array($parse, OCI_ASSOC+OCI_RETURN_NULLS!=false)){
                            $invoice_id = $row['INVOICE_ID'];
                            $invoice_date = $row['INVOICE_DATE'];
                            $product_name = $row['PRODUCT_NAME'];
                            $quantity = $row['PRODUCT_QUANTITY'];
                            $price = $row['PRODUCT_PRICE'];
                            $total_item= $price * $quantity;   
                            $totalPrice+= $total_item;?>
                            
                        <th><?php echo $product_name;?></th>
                        <th><?php echo $price;?></th>
                        <th><?php echo $quantity;?></th>
                        <th><?php echo $total_item;?></th>

                    </tbody>
                    <?php
    }
}
?>
                </table>
               
                    
            </div>
            <?php
            $subTotal = $subTotal+$totalPrice;
                    if(isset($discount)){
                        $discount = 10.00;                        
                    } 
                    else{
                        $discount = 0;
                    }
                    $total_amt = $discount+$subTotal;
                ?>
                <ul class="invoice-total">
                
                    <li class="subtotal">Subtotal: <span>$<?php echo $subTotal;?></span></li>
                    <li class="discount">Discount: <span>$<?php if(isset($discount))echo $discount;?></span></li>
                    <li class="cart-total">Total: <span>$<?php echo $total_amt;?></span></li>
                </ul>
        </div>
</body>