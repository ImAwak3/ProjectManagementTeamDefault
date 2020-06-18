<?php

include 'includes/connection.php';
include 'includes/header.php';
include 'add_product_process.php';

?>
    <div class="wrapper">
       <?php require 'includes/sidebar.php';?>

        <div id="content">
            <?php require 'includes/top-navbar.php';?>

                <form action="" method = "post" enctype = "multipart/form-data">
                    <?php display_error();?>
                    <div class="form-group">
                        <label for="product_title">Product Name</label>
                        <input type="text" class = "form-control" name = "product_title" >
                    </div>


                    <div class="form-group">
                        <label for="pro_desc">Description</label>
                        <textarea name="pro_desc" id="" class = "form-control" cols="30" rows="10"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" step = "0.01" min="0" class = "form-control" name = "price" >
                    </div>

                    <div class="form-group">
                        <label for="product_image">Product Thumbnail</label>
                        <input type="file" name = "image" >
                    </div>
                        
                    <div class="form-group">
                        <label for="min_order">Min Order</label>
                        <input type="number" class = "form-control" name = "min_order" >
                    </div>

                    <div class="form-group">
                        <label for="max_order">Max Order</label>
                        <input type="number" class = "form-control" name = "max_order" >
                    </div>

                    <div class="form-group">
                        <label for="item_quantity">Quantity per item</label>
                        <input type="text" class = "form-control" name = "item_quantity" >
                    </div>

                    <div class="form-group">
                        <label for="stock_avb">Stock available</label>
                        <input type="number" class = "form-control" name = "stock_avb" >
                    </div>
                    
                    <div class="form-group">
                        <label for="alleg_info">Allergy information</label>
                        <input type="text" class = "form-control" name = "alleg_info" >
                    </div>

                    <div class="col-lg-6 form-group">
                        <label for="shop_type">Shop Name<span>*</span></label>
                        <select name="shop_name" id="shop_name" class = "form-control">
                            <?php
                            $get_shop_name = "select SHOP_NAME from trader";
                            $parse = oci_parse($conn, $get_shop_name);
                            $execute = oci_execute($parse);
                            while($row = oci_fetch_array($parse, OCI_ASSOC+OCI_RETURN_NULLS!=false)){
                                $shop_name = $row['SHOP_NAME'];?>
                            
                            <option value="<?php echo $shop_name;?>"><?php echo $shop_name;?></option>                      
                                <?php
                                }
                                ?>
                        </select>
                    
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="product_type">Product Type<span>*</span></label>
                        <select name="product_type" id="product_type" class = "form-control">
                            <?php
                                $get_product_cat = "select PRODUCTTYPE_NAME from product_type, shop, trader, trader_type where
                                    product_type.SHOP_ID = shop.SHOP_ID
                                    AND shop.TRADERTYPE_ID = trader_type.TRADERTYPE_ID
                                    AND trader_type.TRADER_ID = trader.TRADER_ID";
                                    $parse = oci_parse($conn, $get_product_cat );
                                    $execute = oci_execute($parse);
                                        while($row = oci_fetch_array($parse, OCI_ASSOC+OCI_RETURN_NULLS!=false)){
                                            $product_cat = $row['PRODUCTTYPE_NAME'];
                                        ?>                                    
                                    
                                        <option value="<?php echo $product_cat;?>"><?php echo $product_cat;?></option>                                                    
                            
                                        <?php
                                        }
                                        ?>
                        </select>  
                    </div>
                    <div class="form-group">
                        <input type="submit" class = "btn btn-primary" name = "add_product" value = "Add New Product" >
                    </div>

                </form>
        </div>

    </div>

<?php
include 'includes/footer.php';