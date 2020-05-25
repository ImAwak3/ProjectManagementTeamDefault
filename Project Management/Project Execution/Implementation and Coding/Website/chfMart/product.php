<!-- include the header and the menu section -->
<?php include "includes/connection.php"; 
      include "includes/header.php";
      include "includes/navigation.php";
      
    
    //Breadcrumb Section Begin --
    include "includes/breadcrumb.php"; 
    //Breadcrumb Section End 


    $product_id = $_GET['pId'];
    ?>

    <!-- Product Shop Section Begin -->
    <section class="single-product page-details">
        <div class="container">
            <div class="row mb-5">
               <?php
               $product_query = oci_parse($conn, "Select * from product, product_type where product.productType_ID = product_type.productType_ID AND product.PRODUCT_ID=$product_id");
               $execute = oci_execute($product_query);
               
               ?>
                <div class="col-lg-10">
                    <div class="row">
                        <?php
                        
                        while($row = oci_fetch_array($product_query, OCI_ASSOC+OCI_RETURN_NULLS)){
                            $pName = $row['PRODUCT_NAME'];
                            $pDescription = $row['DESCRIPTION'];
                            $pPrice = $row['PRODUCT_PRICE'];
                            $availability = $row['STOCK_AVAILABLE'];
                            $pImage = $row['PRODUCTIMAGE_CODE'];
                            $pCat = $row['PRODUCTTYPE_NAME'];
                            $pAllery = $row['ALLERGY_INFORMATION'];
                            ?>
                            <div class="col-lg-6">
                                <div class="product-pic">
                                    <img class="product-big-img" src="img/products/<?php echo $pImage; ?>" alt="">
                                </div>
                                
                            </div>

                        <div class="col-lg-6">
                            <div class="product-details mt-5">
                                <div class="pd-title">
                                    <span><?php echo $pCat;?></span>
                                    <h3><?php echo $pName;?></h3>
                                    <a href="#" class="heart-icon"><i class="icon_heart_alt"></i></a>
                                </div>
                                <div class="pd-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <span>(5)</span>
                                </div>
                                <div class="pd-desc">
                                    <p><?php echo $pDescription;?></p>
                                    <h4><?php echo $pPrice;?></h4>
                                </div>
                               
                                
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" value = "1" name = "pro-quantity" >
                                    </div>
                                    <a href="shopping-cart.php" class="primary-btn pd-cart">Add To Cart</a>
                                </div>
                                <ul class="pd-tags">
                                    <li><span>CATEGORIES: </span><?php echo $pCat; ?></li>
                                   
                                </ul>
                                
                            </div>
                        </div>
                            
                        
                    </div>
                </div>
            </div>
            <div class = "row mt-5">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="product-tab">
                        <div class="tab-item">
                            <ul class="nav" role="tablist">
                                <li>
                                    <a class="active" data-toggle="tab" href="#tab-1" role="tab">DESCRIPTION</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab-2" role="tab">SPECIFICATIONS</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab-3" role="tab">Customer Reviews (02)</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-item-content">
                            <div class="tab-content">
                                <div class="tab-pane fade-in active" id="tab-1" role="tabpanel">
                                    <div class="product-content">
                                        <div class="row">
                                            <div class="col-lg-7">
                                                <h5>Introduction</h5>
                                                <p><?php echo $pDescription;?> </p>
                                                <h5>Contains</h5>
                                                <p>The product may contain the following ingredients: 
                                                <br><br>
                                                <?php echo $pAllery;?>
                                                </p>
                                            </div>
                                            <div class="col-lg-5">
                                                <img src="img/product-single/tab-desc.jpg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-2" role="tabpanel">
                                    <div class="specification-table">
                                        <table>
                                            <tr>
                                                <td class="p-catagory">Customer Rating</td>
                                                <td>
                                                    <div class="pd-rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <span>(5)</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Price</td>
                                                <td>
                                                    <div class="p-price"><?php echo $pPrice;?></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Add To Cart</td>
                                                <td>
                                                    <div class="cart-add">+ add to cart</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Availability</td>
                                                <td>
                                                    <div class="p-stock"><?php echo $availability;?> in stock</div>
                                                </td>
                                            </tr>
                                                                                                                                       </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-3" role="tabpanel">
                                    <div class="customer-review-option">
                                        <h4>2 Comments</h4>
                                        <div class="comment-option">
                                            <div class="co-item">
                                                <div class="avatar-pic">
                                                    <img src="img/product-single/avatar-1.png" alt="">
                                                </div>
                                                <div class="avatar-text">
                                                    <div class="at-rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <h5>Brandon Kelley <span>27 Aug 2019</span></h5>
                                                    <div class="at-reply">Nice !</div>
                                                </div>
                                            </div>
                                            <div class="co-item">
                                                <div class="avatar-pic">
                                                    <img src="img/product-single/avatar-2.png" alt="">
                                                </div>
                                                <div class="avatar-text">
                                                    <div class="at-rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <h5>Roy Banks <span>27 Aug 2019</span></h5>
                                                    <div class="at-reply">Nice !</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="personal-rating">
                                            <h6>Your Ratind</h6>
                                            <div class="rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                        </div>
                                        <div class="leave-comment">
                                            <h4>Leave A Comment</h4>
                                            <form action="#" class="comment-form">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <input type="text" placeholder="Name">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <input type="text" placeholder="Email">
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <textarea placeholder="Messages"></textarea>
                                                        <button type="submit" class="site-btn">Send message</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                        }
                        
                        ?>
        </div>
    </section>
    <!-- Product Shop Section End -->



<!-- include the footer section -->
<?php include "includes/footer.php";?>