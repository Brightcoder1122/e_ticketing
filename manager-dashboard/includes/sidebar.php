<?php require_once('../includes/config.php') ?>
<?php require_once('../includes/mustlogin.php') ?>
<?php  
    $user_detail = "SELECT * FROM tbl_user WHERE id = :user_id"; 
    $user_detail_q = $dbconnect->prepare($user_detail);
    $user_detail_q->execute(['user_id'=>$_SESSION['UserID']]);
    $user_profile = $user_detail_q->fetch(); 

    if($user_profile['type'] != "admin" && $user_profile['type'] != "manager") {
        echo "<script> window.location='../logout.php' </script>";
    }
?>
<?php include('manager_admin_access.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Komba Vehicle management system">
    <meta name="author" content="Komba Vehicle management system">
    <link rel="icon" href="../assets/img/tz_logo.png" type="image/png">
    <title>E-TICKETING | <?PHP echo $title ?></title>

    <!-- Custom fonts for this template-->
    <link href="../app_assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../app_assets/css/brt.css" rel="stylesheet">

    <link href="../app_assets/css/style.css" rel="stylesheet">

     <!-- Custom styles for this page -->
    <link href="../app_assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- selectpicker css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <style type="text/css">
        .info {
            background-color: white;
            padding: 15px;
            margin-bottom: 9px;
            border-left: 3px solid red;
        }
        a:hover {
            text-decoration: none;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav kvm-bg sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-bus"></i>
                </div>
                <div class="sidebar-brand-text mx-3">E-TICKETING</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#user"
                    aria-expanded="true" aria-controls="user">
                    <i class="fas fa-fw fa-users"></i>
                    <span> Users </span>
                </a>
                <div id="user" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">User Management:</h6>
                        <?php if($user_profile['type'] == "admin"): ?>
                        <a class="collapse-item" href="managers.php"> 
                            <i class="fa fa-users text-info"></i> Manager
                        </a>
                        <?php endif ?>
                        <a class="collapse-item" href="passenger.php"> 
                            <i class="fa fa-users text-info"></i> passenger
                        </a>
                        <a class="collapse-item" href="driver.php"> 
                            <i class="fa fa-user-circle text-info"></i> Driver
                        </a>
                        <a class="collapse-item" href="deleted-driver.php"> 
                            <i class="fa fa-user-circle text-info"></i> Inactive Driver
                        </a>
                    </div>
                </div>
            </li>
            
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#routeBus"
                    aria-expanded="true" aria-controls="routeBus">
                    <i class="fa fa-fw fa-exchange"></i>
                    <span> Route and Bus </span>
                </a>
                <div id="routeBus" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Route and Bus Management:</h6>
                        <a class="collapse-item" href="route.php"> 
                            <i class="fa fa-exchange text-info"></i> Route
                        </a>
                        <a class="collapse-item" href="buses.php"> 
                            <i class="fa fa-bus text-info"></i> Buses
                        </a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ticket"
                    aria-expanded="true" aria-controls="ticket">
                    <i class="fas fa-fw fa-id-card"></i>
                    <span> Tickets </span>
                </a>
                <div id="ticket" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ticket Management:</h6>
                        <a class="collapse-item" href="ticket-manager.php"> 
                            <i class="fa fa-id-card text-info"></i> Today Ticket
                        </a>
                     
                    </div>
                </div>
            </li>
        
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link" href="comment.php">
                    <i class="fas fa-fw fa-comments"></i>
                    <span> Comments </span>
                </a>
            </li>

            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link" href="../logout.php">
                    <i class="fas fa-fw fa-sign-out-alt "></i>
                    <span> Signout </span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php echo $user_profile['type'] ?>
                                </span>
                                <img class="img-profile rounded-circle"
                                    src="../assets/img/tz_logo.png">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="profile.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="logs.php">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a> -->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    