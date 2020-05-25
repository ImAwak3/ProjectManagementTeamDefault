<!-- include the header and the menu section -->
<?php include "includes/header.php";
      include "includes/navigation.php";


    //Breadcrumb Section Begin --
    include "includes/breadcrumb.php"; ?>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart-table">
                        <table>
                            <thead>
                                <tr>
                                    <th><i class="ti-close"></i></th>
                                    <th>Image</th>
                                    <th class="p-name">Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="close-td first-row"><i class="ti-close"></i></td>

                                    <td class="cart-pic first-row"><img src="img/cart-page/product-1.jpg" alt="shopping cart picture" class = "img-fluid"></td>
                                    <td class="cart-title first-row">
                                        <h5>Pure Pineapple</h5>
                                    </td>
                                    <td class="p-price first-row">$60.00</td>
                                    <td class="qua-col first-row">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="1">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="total-price first-row">$60.00</td>
                                </tr>
                                <tr>
                                    <td class="close-td"><i class="ti-close"></i></td>
                                    <td class="cart-pic"><img src="img/cart-page/product-2.jpg" alt="shopping cart picture" class = "img-fluid"></td>
                                    <td class="cart-title">
                                        <h5>American lobster</h5>
                                    </td>
                                    <td class="p-price">$60.00</td>
                                    <td class="qua-col">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="1">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="total-price">$60.00</td>
                                    
                                </tr>
                                <tr>
                                    <td class="close-td"><i class="ti-close"></i></td>
                                    <td class="cart-pic"><img src="img/cart-page/product-3.jpg" alt="shopping cart picture" class = "img-fluid"></td>
                                    <td class="cart-title">
                                        <h5>Guangzhou sweater</h5>
                                    </td>
                                    <td class="p-price">$60.00</td>
                                    <td class="qua-col">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="1">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="total-price">$60.00</td>
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 offset-lg-4">
                            <div class="proceed-checkout">
                                <ul>
                                    <li class="subtotal">Subtotal <span>$240.00</span></li>
                                    <li class="discount">Discount <span>$1.00</span></li>
                                    <li class="cart-total">Total <span>$239.00</span></li>
                                </ul>
                                <a href="check-out.php" class="proceed-btn">PROCEED TO CHECK OUT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->


<!-- include the footer section -->
<?php include "includes/footer.php";?>