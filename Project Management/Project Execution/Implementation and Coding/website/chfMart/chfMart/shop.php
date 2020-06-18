<!-- include the header and the menu section -->
<?php include "includes/connection.php";
     include "includes/header.php";
      include "includes/navigation.php";
      include_once "Pagination.class.php";


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
                            <input type="hidden" id="hidden_minimum_price" value="0" />
                            <input type="hidden" id="hidden_maximum_price" value="5000" />
                            <p id="price_show">5-500</p>
                            <div id="price_range"></div>
                        </div>
                       
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
                                              shop" value = "<?php echo htmlentities($row['SHOP_NAME'], ENT_QUOTES); ?>"><?php echo $row['SHOP_NAME']; ?>
                                        </label>
                                        </div>
                                    <?php
                                }
                            ?>
                        
                    </div>
                    
                </div>


                <div class="col-lg-9 order-lg-2 order-md-1 col-md-12 order-sm-1 col-sm-12 order-xs-1 col-xs-12">
                    <div class="product-show-option">
                        <div class="row">
                            <div class="col-lg-7 col-md-7">
                                <div class="select-option">
                                   
                                   
                                        <select class = "sorting" id="sortBy">                                 
                                            <option value="">Sort by Title</option>
                                            <option value="asc">Ascending</option>
                                            <option value="desc">Descending</option>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->

   
<!-- include the footer section -->
<?php include "includes/footer.php";?>