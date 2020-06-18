<!-- include the header and the menu section -->
<?php 
    session_start();
include "includes/connection.php"; 
      include "includes/header.php";
      include "includes/navigation.php";
      require 'shopping_process.php';
        include_once 'paypal/config.php';
    //Breadcrumb Section Begin --
    include "includes/breadcrumb.php"; 
    //Breadcrumb Section End 

    if(isset($_GET['pId'])){
        $product_id = $_GET['pId'];
    }
  
 
        if(isset($_SESSION['rate_success'])){
    echo '<p class = "alert alert-success alert-dismissible">'.$_SESSION['rate_success'].'</p>';
    unset ($_SESSION['rate_success']);


}
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
                            $pId = $row['PRODUCT_ID'];
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
                      
                            <form action="shopping-cart.php?proID=<?php echo $pId;?>&action=add" method = "post">
                                <div class="product-details mt-5"> 
                                
                                    <div class="pd-title">
                                        <span><?php echo $pCat;?></span>
                                        <h3><?php echo $pName;?></h3>
                                        <?php if(isset($_SESSION['user'])){?>
                                            <a href="#" class="heart-icon"><i class="icon_heart_alt"></i></a>
                                            <?php
                                                            }   ?>

                                    </div>

                                    <div class="pd-rating">
                                        <?php
                                            function average_rating(){
                                                global $pId, $conn;
                                                $averageRating = "select AVG(rating) AS AVERAGE from product_review where PRODUCT_ID = $pId GROUP BY $pId";
                                                $parse = oci_parse($conn, $averageRating);
                                                $execute = oci_execute($parse);
                                                while($row = oci_fetch_array($parse, OCI_ASSOC+OCI_RETURN_NULLS!=false)){
                                            
                                                    $stars = $row['AVERAGE'];
                                                    for($i = 0; $i<$stars; $i++){
                                                        echo '<i class="fa fa-star fa-2x checked"> </i>';
                                                    }?>
                                                    
                                                    <span>(<?php echo $stars; ?>)</span>
                                                    <?php
                                                }
                                            }
                                            average_rating();                                   
                                        ?>
                                    
                                        
                                    </div>

                                    <div class="pd-desc">
                                        <p><?php echo $pDescription;?></p>
                                        <h4><?php echo $pPrice;?></h4>
                                    </div>
                                                                
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" value = "1" name = "pro-quantity" >
                                        </div>
                                        <input type="hidden" value = "<?php echo $pId; ?>" name = "pro_id">

                                        <?php
                                            if(isset($_SESSION['user'])){?>
                                                <input type="submit" class="primary-btn pd-cart" value="Add to cart"/>
                                                <?php
                                            }
                                    
                                        ?>
                                                                        
                                    </div>
                                
                                    <ul class="pd-tags">
                                        <li><span>CATEGORIES: </span><?php echo $pCat; ?></li>
                                    
                                    </ul>
                                    
                                </div>
                            
                            </form>

                           
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
                                    <a data-toggle="tab" href="#tab-3" role="tab">Customer Reviews</a>
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
                                                <?php if($pAllery!=null){
                                                    ?>
                                                     <h5>Contains</h5>
                                                <p>The product may contain the following ingredients: 
                                                <br><br>
                                                <?php echo $pAllery;?>
                                                </p>
                                                    <?php
                                                    }?>
                                               
                                            </div>
                                            <div class="col-lg-5">
                                            <img class="product-big-img" src="img/products/<?php echo $pImage; ?>" alt="">
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
                                                    <?php average_rating();?>
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
                                        <?php
                                    $query = "select * from product_review, users where product_review.USER_ID = users.USER_ID AND PRODUCT_ID = $pId";
                                                    $parse = oci_parse($conn, $query);
                                                    $execute = oci_execute($parse);

                                                    while($row = oci_fetch_array($parse,OCI_ASSOC+OCI_RETURN_NULLS!=false)){
                                                        $date = $row['REVIEW_DATE'];
                                                        $convert = date('d/m/Y', time());
                                                ?>

                                        <h4>Comments:</h4>
                                        <div class="comment-option">
                                           
                                            
                                                   
                                                <div class="co-item">
                                                <div class="avatar-pic">
                                                    <img src="img/profile.png" alt="">
                                                </div>
                                                <div class="avatar-text">
                                                    <div class="at-rating">
                                                        <?php $stars =  $row['RATING'];
                                                        
                                                            
                                                            for($i = 0; $i<$stars; $i++){
                                                                echo '<i class="fa fa-star fa-2x checked"> </i>';
                                                            }
                                                           
                                                        ?>

                                                        
                                                       
                                                    </div>
                                                    <h5>
                                                        <?php echo $row['FIRST_NAME'];?>
                                                        <?php echo $row['LAST_NAME'];?>
                                                        <span><?php echo $convert;?></span>
                                                    </h5>
                                                    <div class="at-reply"><?php echo $row['COMMENTS'];?></div>
                                                </div>
                                            </div>
                                                    <?php
                                                    }
                                            ?>
                                            
                                            
                                        </div>

                                       
                                   <?php if(isset($_SESSION['user'])){?>


                                
                                        <div class="personal-rating">
                                           
                                            <h5 class = "mt-4 mb-2" >Rate the Product</h5>
                                            <div class="rating">
                                                <i class="fa fa-star fa-2x"></i>
                                                <i class="fa fa-star fa-2x"></i>
                                                <i class="fa fa-star fa-2x"></i>
                                                <i class="fa fa-star fa-2x"></i>
                                                <i class="fa fa-star fa-2x"></i>
                                            </div>
                                                
                                        </div>
                                        <form action = "review.php" class="comment-form" method = "post" id = "ratingForm">  
                                            <div class="leave-comment">
                                                <h5 class = "mb-4">Leave A Comment</h5>
                                                        
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <input class = "form-control" type="text" placeholder="Name" name = "name">
                                                        <input type="hidden" name="hdnRateNumber" id="hdnRateNumber">
                                                        <input type="hidden" value = "<?php echo $pId; ?>" name = "pro_id">
                                                    </div>
                                                    
                                                    <div class="col-lg-12">
                                                        <textarea class = "form-control" placeholder="Messages" name = "message"></textarea>
                                                    </div>
                                                    
                                                    <div class="col-lg-12">
                                                        <input type="submit" class="site-btn" name = "submitMessage" value = "Submit">
                                                    </div>
                                                   
                                                </div>
                                    
                                            </div>
                                        </form>
                                        <?php
                                   }
                                   else{
                                       ?>
                                            <p class="alert alert-warning">Please login before leaving a review!</p>
                                       <?php
                                   }
                                   ?>
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