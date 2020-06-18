<?php
    include '../includes/connection.php';
    include 'includes/header.php';
?>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Admin</h3>
                <strong>A</strong>
            </div>

            <ul class="list-unstyled components">
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-home"></i>
                        Home
                    </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="#"><i class="fa fa-dashboard"></i>Dashboard</a>
                        </li>
                        
                    </ul>
                </li>

                <li>
                    <a href="#"><i class="fa fa-group"></i> Trader</a>
                </li>
                <li><a href="#"><i class="fa fa-user-circle"></i>Customer</a></li>
                
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
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user"> Admin</i></a>
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
        
<?php   
    include 'includes/footer.php';
?>