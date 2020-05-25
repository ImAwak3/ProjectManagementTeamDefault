<!-- include the header and the menu section -->
<?php include "includes/connection.php";
     include "includes/header.php";
      include "includes/navigation.php";


//Breadcrumb Section Begin --
    include "includes/breadcrumb.php"; ?>
    <!-- Breadcrumb Section End-->



    <!-- Product Shop Section Begin -->
    <section class="product-shop">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-3 order-lg-1 order-md-2 col-md-6 order-sm-2 col-sm-6 col-xs-6 order-xs-2 produts-sidebar-filter">
                  
                     <div class="filter-widget">
                        <h4 class="fw-title">Categories</h4>
                        
                            
                                <?php
                                    $cat_shop_query = oci_parse($conn, "select PRODUCTTYPE_NAME from product_type");
                                    $execute = oci_execute($cat_shop_query);
                                    while($row=oci_fetch_array($cat_shop_query, OCI_ASSOC+OCI_RETURN_NULLS)){
                                ?>    
                                 <div class="catagories-menu checkbox">                         
                                        <!-- Single Item -->
                                        <label for="">
                                            <input type="checkbox" class = "common_selector categories" value = "<?php echo $row['PRODUCTTYPE_NAME'];?>"><?php echo $row['PRODUCTTYPE_NAME'];?>
                                        </label>
                                        
                                </div>           
                                    <?php
                                        }                                
                                    ?>
                           
                        
                    </div>
                                                                             
                    <div class="filter-widget">
                        <h4 class="fw-title">Price</h4>
                        <div class="filter-range-wrap p-filter">
                            <div class="range-slider">
                                <div class="price-input">
                                    <input type="text" id="minamount">
                                    <input type="text" id="maxamount">
                                </div>
                            </div>
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                data-min="5" data-max="100">
                                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                            </div>
                        </div>
                        <a href="shop.php" class="filter-btn">Filter</a>
                    </div>
                    
                    <div class="filter-widget">
                        <h4 class="fw-title">Shop Type</h4>
                        
                            <?php
                                $shop_query = oci_parse($conn, "select SHOP_NAME from shop");
                                $execute = oci_execute($shop_query);
                            
                                while($row = oci_fetch_array($shop_query, OCI_ASSOC+OCI_RETURN_NULLS)){
                                    ?>
                                <div class="fw-tags checkbox">
                                        <label for="">
                                            <input type="checkbox" class = "common_selector
                                              shop" value = "<?php echo $row['SHOP_NAME']; ?>"><?php echo $row['SHOP_NAME']; ?>
                                        </label>
                                        </div>
                                    <?php
                                }
                            ?>
                        
                    </div>
                    
                </div>


                <div class="col-lg-9 order-lg-2 order-md-1 col-md-12 order-sm-1 col-sm-12 order-xs-1 col-xs-12">
                    <div class="product-show-option">
                        <div class="row filter_data">
                            <div class="col-lg-7 col-md-7">
                                <div class="select-option">
                                    <select class="sorting">
                                        <option value="">Default Sorting</option>
                                    </select>
                                    <select class="p-show">
                                        <option value="">Show:</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 text-right">
                                <p>Show 01- 09 Of 36 Product</p>
                            </div>
                        </div>
                    </div>
                    <div class="product-list">
                        <div class="row filter_data">
                        <!-- </div>
                    </div>
                </div> -->
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->

   
<!-- include the footer section -->
<?php include "includes/footer.php";?>