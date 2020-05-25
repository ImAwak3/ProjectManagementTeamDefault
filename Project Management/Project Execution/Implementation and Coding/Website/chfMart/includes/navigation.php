    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="header-top">
            <div class="container">
                <!-- header top right -->
                <div class="ht-right">

                    <a href="#" class="account-panel"><i class="fa fa-user-circle"></i> Account</i> </a>
                    <a href="./login.php" class="login-panel"><i class="fa fa-user"></i>Login</a>                                       
                </div>
            </div>
        </div>
        <div class="container container-md">
            <div class="inner-header">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2">
                        <div class="logo">
                            <a href="./index.php">
                                <img src="img/websitelogo.png" alt="website logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8">
                        <form action="search.php" method="GET">
                            <div class="advanced-search">
                                
                                <div class="input-group">
                                    <input type="text" placeholder="What do you need?" name = "search_value" value = "<?php $_GET['search_value']; ?>">
                                    <button type="button" name = "search"><i class="ti-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2">
                        <ul class="nav-cart">                           
                            <li class="cart-icon">
                                <a href="shopping-cart.php">
                                    <i class="icon_cart_alt"></i>
                                 </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-item">
            <div class="container">
               
                <nav class="nav-menu mobile-menu">
                    <ul>
                        <li class="active"><a href="./index.php">Home</a></li>
                        <li><a href="./shop.php">Shop</a></li>
                        <li><a href="./shop.php">All Products</a></li>
                        <li><a href="./about.php">About</a></li>
                        <li><a href="./contact.php">Contact</a></li>
                       
                    </ul>
                </nav>
                <div id="mobile-menu-wrap"></div>
            </div>
        </div>
    </header> 
    <!-- Header End -->