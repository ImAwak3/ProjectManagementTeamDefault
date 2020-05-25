<!-- include the header and the menu section -->
<?php include "includes/header.php";
      include "includes/navigation.php";

    //Breadcrumb Section Begin --
    include "includes/breadcrumb.php"; ?>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="checkout-section spad">
        <div class="container">
            <form action="#" class="checkout-form">
                <div class="row">
                    <!-- billing details -->
                    <div class="col-lg-8 offset-lg-2">
                        
                        <h4>Biiling Details</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="fir">First Name<span>*</span></label>
                                <input type="text" id="fir">
                            </div>
                            <div class="col-lg-6">
                                <label for="last">Last Name<span>*</span></label>
                                <input type="text" id="last">
                            </div>
                           
                            <div class="col-lg-12">
                                <label for="street">Street Address<span>*</span></label>
                                <input type="text" id="street" class="street-first">
                                <input type="text">
                            </div>
                            
                            <div class="col-lg-6">
                                 <label for="email">Email Address<span>*</span></label>
                                <input type="text" id="email">
                            </div>
                           
                                                       
                            <div class="col-lg-6">
                                <label for="phone">Phone<span>*</span></label>
                                <input type="text" id="phone">
                            </div>
                           
                        </div>
                    </div>

                    <!-- collection slot -->
                    <div class="col-lg-6 offset-lg-3 d-flex">
                        <div class="collection-slot">
                                                    
                            <h4 class = "text-center">Collection Slot</h4>
                            <p>Choose your collection slot</p>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                    <h5>Wednesday</h5>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="wed_defaultCheck1">
                                        <label class="form-check-label" for="wed_defaultCheck1">10-13</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="wed_defaultCheck2">
                                        <label class="form-check-label" for="wed_defaultCheck2">13-16</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="wed_defaultCheck3">
                                        <label class="form-check-label" for="wed_defaultCheck3">16-19</label>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                    <h5>Thursday</h5>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="thurs_defaultCheck1">
                                        <label class="form-check-label" for="thurs_defaultCheck1">10-13</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="thurs_defaultCheck2">
                                        <label class="form-check-label" for="thurs_defaultCheck2">13-16</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="thurs_defaultCheck3">
                                        <label class="form-check-label" for="thurs_defaultCheck3">16-19</label>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                    <h5>Friday</h5>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="fri_defaultCheck1">
                                        <label class="form-check-label" for="fri_defaultCheck1">10-13</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="fri_defaultCheck2">
                                        <label class="form-check-label" for="fri_defaultCheck2">13-16</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="fri_defaultCheck3">
                                        <label class="form-check-label" for="fri_defaultCheck3">16-19</label>
                                    </div>
                                </div>
                            </div><!--row-->
                            <p class="collectionslot_note"><span class = "font-weight-bold">Note: </span>The slot must be choose at least 24 hours after the placement of the order</p>
                        </div><!--collection-slot-->
                    </div>

                    <div class="col-lg-6 offset-lg-3">
                        
                        <div class="place-order">
                            <h4 class = "text-center">Your Order</h4>
                            <div class="order-total">
                                <ul class="order-table">
                                    <li>Product <span>Total</span></li>
                                    <li class="fw-normal">Product 1 <span>$60.00</span></li>
                                    <li class="fw-normal">Product 2 <span>$60.00</span></li>
                                    <li class="fw-normal">Product 3 <span>$120.00</span></li>
                                    <li class="fw-normal">Subtotal <span>$240.00</span></li>
                                    <li class="fw-normal">Discount <span>$1.00</span></li>
                                    <li class="total-price">Total <span>$230.00</span></li>
                                </ul>
                                
                                <div class="order-btn">
                                    <button type="submit" class="site-btn place-btn">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Shopping Cart Section End -->


<?php include "includes/footer.php";?>