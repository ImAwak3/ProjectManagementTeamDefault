<?php
include 'includes/connection.php';

if(isset($_POST["action"])){

    $query = "Select * from product, product_type, shop where product.productType_ID = product_type.productType_ID
    AND product_type.shop_ID = shop.shop_ID";

    if(isset($_POST["min_price"], $_POST["max_price"])){

        $minimum_price = $_POST["min_price"];
        $maximum_price = $_POST["max_price"];
       
        $query.= " 
        AND PRODUCT_PRICE BETWEEN $minimum_price AND $maximum_price       
        ";
    }

    if(isset($_POST["categories"])){
        $cat_filter = implode("','", $_POST["categories"]);
        $query.= "
        AND PRODUCTTYPE_NAME IN 
        ('".$cat_filter."')
        ";
       
    }


    if(isset($_POST["shop"])){
        $shop_filter = implode("', '",$_POST['shop']);
        $query.= "
        AND SHOP_NAME IN ('".html_entity_decode($shop_filter, ENT_QUOTES)."')
        ";
    }

    if(isset($_POST["sort"])){
        $value = $_POST['sort'];
        if($value == 'asc'){
            $query.="ORDER BY PRODUCT_NAME ASC";
          
        }
        elseif($value == 'desc'){
            $query.="ORDER BY PRODUCT_NAME DESC";
            
        }
        
        
    }
    
    $parse = oci_parse($conn, $query);
    $execute = oci_execute($parse);

    $result = array();
    $numRows = oci_fetch_all($parse, $result, null, null, OCI_FETCHSTATEMENT_BY_ROW);
    $output = '';
    if($numRows>0){
        foreach($result as $row){
            $output .= '
            
            
                
                    <div class="col-lg-4 col-sm-6">
                        <div class="product-item">
                            <div class="pi-pic">
                                <img src="img/products/'.$row['PRODUCTIMAGE_CODE'].'" alt="">
                                
                                <ul>
                                  
                                <li class="quick-view"><a href="product.php?pId='. $row['PRODUCT_ID'].'">+ View</a></li>
                                
                                </ul>
                            </div>
                            <div class="pi-text">
                                <div class="catagory-name">'.$row['PRODUCTTYPE_NAME'].'</div>
                                <a href="#">
                                    <h5>'.$row['PRODUCT_NAME'].'</h5>
                                </a>
                                <div class="product-price">'.$row['PRODUCT_PRICE'].'</div>
                            </div>
                        </div>
                    </div>

           
            ';
        }
    }
    else{
       $output = '<h3>No data found</h3>';
    }
    echo $output;
}