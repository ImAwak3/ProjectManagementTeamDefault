<!-- include the header and the menu section -->
<?php
session_start();
 include 'includes/connection.php';
     include "includes/header.php";
    include "includes/navigation.php"; 
    require 'shopping_process.php';
   
?>

    <!-- Hero Section Begin -->
    <section class="hero-section">      
            <?php
             if(isset($_SESSION['payment_status'])){
                echo $_SESSION['payment_status'];
            }
            $query = oci_parse($conn, "Select * from product, product_type where product.productType_ID = product_type.productType_ID AND ROWNUM<=3");
            $execute = oci_execute($query);
            while($row = oci_fetch_array($query, OCI_ASSOC+OCI_RETURN_NULLS)){
                $pCat = $row['PRODUCTTYPE_NAME'];
                $pName = $row['PRODUCT_NAME'];
                $pDescription = $row['DESCRIPTION'];
                $pImage = $row['PRODUCTIMAGE_CODE'];
                ?>
                 <div class="hero-items owl-carousel">
                    <div class="single-hero-items set-bg">
                    
                        <div class="container">
                            <div class="row">
                           
                                <div class="col-lg-5">
                                    
                                  
                                    <span><?php echo $pCat?></span>
                                    <h1><?php echo $pName;?></h1>
                                    <p><?php echo $pDescription;?></p>
                                    <a href="shop.php" class="primary-btn">Shop Now</a>
                                    
                                    
                                </div>
                            </div>                          
                        </div>
                    </div>

                <?php
                }
                ?>
            
          
        </div>
    </section>
    <!-- Hero Section End -->

 
    <!--All Product Section -->
    <section class="product-section all-product"> 
        <div class="container container-md container-sm">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6 order-md-last align-items-stretch d-flex">
                            <div class="product-item-2 img align-self-stretch d-flex"
                             style="background-image: url(img/shop-product.jpg);">
                                <div class="text text-center">
                                    <h2>Products</h2>
                                    <p>Shop our Products</p>
                                    <p><a href="shop.php" class="btn btn-primary">Shop now</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="product-item img mb-4 d-flex align-items-end" style="background-image: url(img/vegetable-shop.jpg);">
                                <div class="text px-3 py-1">
                                    <h2 class="mb-0"><a href="#">Vegetables</a></h2>
                                </div>
                            </div>
                            <div class="product-item img d-flex align-items-end" style="background-image: url(img/bakery-shop.jpg);">
                                <div class="text px-3 py-1">
                                    <h2 class="mb-0"><a href="#">Bakery</a></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="product-item img mb-4 d-flex align-items-end" style="background-image: url(img/butcher-shop.jpg);">
                        <div class="text px-3 py-1">
                            <h2 class="mb-0"><a href="#">Meat</a></h2>
                        </div>      
                    </div>
                    <div class="product-item img d-flex align-items-end" style="background-image: url(img/deli-shop.jpg);">
                        <div class="text px-3 py-1">
                            <h2 class="mb-0"><a href="#">Delicatessen</a></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->


    <!-- Featured Product Section Begin -->
    <section class="featured-product">
        <div class="container-fluid">
            <div class="row">
                
                <div class="col-lg-12">

                    <div class="product-heading">
                      <h2>Featured Products</h2>
                    </div>
                    <div class="product-slider owl-carousel">
                        <?php
                        $parse = oci_parse($conn, "Select * from product, product_type where product.productType_ID = product_type.productType_ID");
                        $execute = oci_execute($parse);
                        while($row = oci_fetch_array($parse, OCI_ASSOC+OCI_RETURN_NULLS)){
                                $pCat = $row['PRODUCTTYPE_NAME'];
                                $pName = $row['PRODUCT_NAME'];
                                $pPrice = $row['PRODUCT_PRICE'];
                                $pImage = $row['PRODUCTIMAGE_CODE'];
                            ?>
                                <div class="product-item">
                                    <div class="pi-pic">
                                        <img src="img/products/<?php echo $pImage;?>" alt="">
                                        
                                       
                                       
                                        <ul>
                                            
                                            <li class="w-icon active"><i class="icon_bag_alt"><a href="shopping-cart.php?action=add&pID=<?php echo $pId;?>"></a></i></li>

                                            <li class="quick-view"><a href="product.php?pId=<?php echo $row['PRODUCT_ID'];?>">+ View</a></li>
                                            
                                        </ul>
                                    </div>
                                    <div class="pi-text">
                                        <div class="catagory-name"><?php echo $pCat;?></div>
                                        <a href="product.php?pId=<?php echo $row['PRODUCT_ID'];?>">
                                            <h5><?php echo $pName;?></h5>
                                        </a>
                                        <div class="product-price">
                                            <?php echo $pPrice; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }

                        ?>                 
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Featured Product Section end -->


     <!-- Latest Product Section Begin -->
    <section class="latest-product">
        <div class="container-fluid">
            <div class="row">
                
                <div class="col-lg-12">

                    <div class="product-heading">
                      <h2>Latest Products</h2>
                    </div>
                    <div class="product-slider owl-carousel">
                        <?php
                       $parse = oci_parse($conn, "Select * from product, product_type where product.productType_ID = product_type.productType_ID");
                        $execute = oci_execute($parse);
                        while($row = oci_fetch_array($parse, OCI_ASSOC+OCI_RETURN_NULLS)){
                            
                            $pCat = $row['PRODUCTTYPE_NAME'];
                            $pName = $row['PRODUCT_NAME'];
                            $pPrice = $row['PRODUCT_PRICE'];
                            $pImage = $row['PRODUCTIMAGE_CODE'];
                            
                            ?>
                                <div class="product-item">
                                    <div class="pi-pic">
                                    <img src="img/products/<?php echo $pImage;?>" alt="">
                                        
                                        <div class="icon">
                                            <i class="icon_heart_alt"></i>
                                        </div>
                                        <ul>
                                            <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                            <li class="quick-view"><a href="product.php?pId=<?php echo $row['PRODUCT_ID'];?>">+ View</a></li>
                                            
                                        </ul>
                                    </div>
                                    <div class="pi-text">
                                        <div class="catagory-name"><?php echo $pCat; ?></div>
                                        <a href="product.php?pId = <?php echo $row['PRODUCT_ID'];?>">
                                            <h5><?php echo $pName;?></h5>
                                        </a>
                                        <div class="product-price">
                                            <?php echo $pPrice; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }

                        ?>                 
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- LatestFeatured Product Section end -->

<!-- include the footer section -->
<?php include "includes/footer.php";?>