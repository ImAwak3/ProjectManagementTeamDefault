<?php

include 'includes/header.php';
include 'includes/footer.php';
?>

<div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Trader</h3>
                <strong>T</strong>
            </div>

            <ul class="list-unstyled components">
                <li class="active"> 
                    <a href="#"><i class="fa fa-dashboard"></i>Dashboard</a>
                    
                </li>

                <li>
                    <a href="#productSubMenu" data-toggle = "collapse" aria-expanded="false" class="dropdown-toggle">  <i class="fa fa-folder-open"></i>Product</a>
                  
                    <ul class="collapse list-unstyled" id="productSubMenu">
                        <li>
                             <a href="#"><i class="fa fa-eye"></i> View All Products</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-cart-plus"></i>Add Product</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-plus-square"></i>Update Product</a>
                        </li>
                    
                    </ul>
                </li>
                <li>
                    <a href="#reportSubMenu" data-toggle = "collapse" aria-expanded="false" class="dropdown-toggle">  <i class="fa fa-folder-open"></i>Reports</a>
                  
                    <ul class="collapse list-unstyled" id="reportSubMenu">
                        <li>
                             <a href="#"><i class="fa fa-file-photo-o"></i> Report on Order</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-file-photo-o"></i>Report on Stock</a>
                        </li>                   
                    </ul>
                </li>
                
            </ul>
            
        </nav>

        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fa fa-navicon"></i>
                        <span>Sidebar</span>
                    </button>

                    <!-- top-header -->
                    <div class="header-top">
                        <ul class="nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Home</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user"> Trader</i></a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Profile</a>
                                        <a class="dropdown-item" href="#">Logout</a>
                                    </div>
                                
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>