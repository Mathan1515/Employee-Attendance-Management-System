<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Employee Attendance Management System</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <style>
        /* Custom styles for improved header */
        .header {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            height: 60px;
            position: fixed;
            width: 100%;
            z-index: 1000;
        }
        
        .logo span {
            color: #fff;
            font-weight: 600;
            font-size: 18px;
            margin-left: 8px;
        }
        
        .user-menu {
            display: flex;
            align-items: center;
            margin-right: 15px;
        }
        
        .nav.user-menu {
            height: 60px;
        }
        
        .nav.user-menu .dropdown {
            display: flex;
            align-items: center;
            height: 100%;
        }
        
        .nav-item.dropdown.has-arrow {
            height: 100%;
        }
        
        .dropdown-toggle.nav-link.user-link {
            display: flex;
            align-items: center;
            height: 100%;
            padding: 0 15px;
        }
        
        .user-img {
            position: relative;
            margin-right: 10px;
        }
        
        .user-img img {
            width: 36px;
            height: 36px;
            object-fit: cover;
            border: 2px solid #fff;
        }
        
        .user-info {
            display: flex;
            flex-direction: column;
        }
        
        .user-name {
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            margin: 0;
            padding: 0;
            line-height: 1.2;
        }
        
        .user-role {
            color: rgba(255, 255, 255, 0.8);
            font-size: 12px;
            margin: 0;
            padding: 0;
            line-height: 1.2;
        }
        
        .status.online {
            background-color: #55ce63;
            border: 2px solid #fff;
            bottom: 0px;
            height: 10px;
            position: absolute;
            right: 0px;
            width: 10px;
            border-radius: 50%;
        }
        
        .dropdown-menu {
            border-radius: 0.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-top: 0;
            right: 0 !important;
            left: auto !important;
            transform: none !important;
            top: 60px !important;
        }
        
        .dropdown-item {
            padding: 8px 15px;
        }
        
        .dropdown-item i {
            width: 20px;
            text-align: center;
            margin-right: 5px;
        }
        
        @media (max-width: 991px) {
            .header-left {
                position: absolute;
                width: 100%;
            }
            
            .header .header-left {
                padding: 0 15px;
            }
            
            .logo {
                display: flex;
                align-items: center;
                height: 60px;
            }
        }
        
        @media (max-width: 767px) {
            .logo span {
                display: none;
            }
            
            .user-info {
                display: none;
            }
            
            .mobile-user-menu {
                display: block;
                height: 60px;
                display: flex;
                align-items: center;
                margin-right: 15px;
            }
            
            .mobile-user-menu a.dropdown-toggle {
                padding: 0 5px;
                color: #fff;
            }
            
            .mobile-user-menu .dropdown-menu {
                min-width: 200px;
                padding: 10px 0;
            }
            
            .mobile-user-menu .dropdown-menu .user-header {
                padding: 15px;
                text-align: center;
                background-color: #f8f9fc;
                border-bottom: 1px solid #e3e6f0;
            }
            
            .mobile-user-menu .dropdown-menu .user-header img {
                width: 60px;
                height: 60px;
                margin-bottom: 10px;
                object-fit: cover;
            }
        }
        
        .sidebar {
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            top: 60px;
        }
        
        #sidebar-menu ul li a {
            padding: 12px 20px;
            transition: all 0.3s ease;
        }
        
        #sidebar-menu ul li a:hover {
            background-color: rgba(78, 115, 223, 0.1);
        }
        
        #sidebar-menu ul li.active a {
            background-color: #4e73df;
            color: #fff;
            border-left: 4px solid #224abe;
        }
        
        .page-wrapper {
            margin-left: 230px;
            padding-top: 60px;
        }
        
        @media (max-width: 767px) {
            .page-wrapper {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        <div class="header">
            <div class="header-left">
                <a href="#" class="logo">
                    <img class="rounded-circle" src="assets/img/eam-logo.png" width="40" alt="Logo">
                    <span>NewtonSky5 Technologys</span>
                </a>
            </div>
            <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <div class="user-img">
                            <?php
                            // Use employee profile image if available, otherwise default
                            $profile_image = isset($_SESSION['profile_image']) ? $_SESSION['profile_image'] : 'assets/img/user.jpg';
                            ?>
                            <img class="rounded-circle" src="<?php echo $profile_image; ?>" alt="User">
                            <span class="status online"></span>
                        </div>
                        <div class="user-info">
                            <?php if(!empty($_SESSION['name'])) { ?>
                                <p class="user-name"><?php echo $_SESSION['name']; ?></p>
                                <!-- <p class="user-role">Employee</p> -->
                            <?php } ?>
                        </div>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="profile.php">
                            <i class="fa fa-user"></i> My Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">
                            <i class="fa fa-power-off"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-ellipsis-v"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="user-header">
                        <?php 
                        // Use employee profile image if available, otherwise default
                        $profile_image = isset($_SESSION['profile_image']) ? $_SESSION['profile_image'] : 'assets/img/user.jpg';
                        $employee_name = !empty($_SESSION['name']) ? $_SESSION['name'] : 'Employee';
                        ?>
                        <img src="<?php echo $profile_image; ?>" class="rounded-circle" alt="User">
                        <p class="mb-0"><?php echo $employee_name; ?></p>
                    </div>
                    <a class="dropdown-item" href="profile.php"><i class="fa fa-user"></i> My Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
                </div>
            </div>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'profile.php') ? 'active' : ''; ?>">
                            <a href="profile.php"><i class="fa fa-id-card-o"></i> <span>My Profile</span></a>
                        </li>
                        <li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'attendance.php') ? 'active' : ''; ?>">
                            <a href="attendance.php"><i class="fa fa-file-o"></i> <span>Attendance Form</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>