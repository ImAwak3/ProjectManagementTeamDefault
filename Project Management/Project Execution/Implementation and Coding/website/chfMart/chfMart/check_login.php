<?php
?>

    <ul class="nav-cart">                           
        <li class="cart-icon">
            <?php if(isset($_SESSION['user'])){
            ?>
                <a href="shopping-cart.php">
                    <i class="icon_cart_alt"></i>
                    <span class = "item-count">
                        <?php 
                          if(isset($_SESSION['user'])){
                            echo $total_items; 
                        } ?>
                    </span>
                </a>

            <?php
            }
            else{
            ?>

                <button data-target = "#popModal" data-toggle = "modal" class = "fShoppingCart">
                    <i class="icon_cart_alt"></i></button>
                    <div class="modal" id="popModal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h5 class="modal-title">Login Please!</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <p class = "mt-3 mb-4">Please login before you place items in the shopping cart.</p>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                
                                <p>Already have an account?  <a href="./login.php">Login</a></p>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>

                            </div>
                        </div>
                    </div>
               
            <?php
            }
            ?>
        </li>
    </ul>
