<!DOCTYPE html>
<html lang="en"  style="overflow-x: hidden; overflow-y: hidden;">


<!-- login23:11-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Employee Attendance Management System</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>
<?php
session_start();
include('includes/connection.php');
if(isset($_REQUEST['login']))
{
    $username = mysqli_real_escape_string($connection,$_REQUEST['username']);
    $pwd = mysqli_real_escape_string($connection,$_REQUEST['pwd']);
    
    $fetch_query = mysqli_query($connection, "select * from tbl_employee where username ='$username' and password = '$pwd' and role=0");
    $res = mysqli_num_rows($fetch_query);
    if($res>0)
    {
        $data = mysqli_fetch_array($fetch_query);
        $name = $data['first_name'].' '.$data['last_name'];
        $role = $data['role'];
        $id = $data['id'];
        
        // Set profile image in session
        $profile_image = 'assets/img/user.jpg'; // Default image
        if (!empty($data['profile_image'])) {
            $image_path = $data['profile_image'];
            // Convert admin path to employee path if needed
            if (strpos($image_path, '../uploads/') === 0) {
                $image_path = str_replace('../uploads/', 'uploads/', $image_path);
            }
            if (file_exists($image_path)) {
                $profile_image = $image_path;
            }
        }
        
        $_SESSION['name'] = $name;
        $_SESSION['role'] = $role;
        $_SESSION['id'] = $id;
        $_SESSION['profile_image'] = $profile_image;
        
        header('location:profile.php');
    }
    else
    {
        $msg = "Incorrect login details.";
    }
}
?>
<body>
<div class="login-container">
    <!-- Left: Image (Top on mobile) -->
    <div class="login-image">
      <img src="./assets/img/User Login img.jpeg" alt="Login Illustration" />
    </div>

    <!-- Right: Login Box (Bottom on mobile) -->
    <div class="login-box">
      <div class="login-content">
        <h3>Employee Login</h3>
        <img src="./assets/img/employee-login.png" alt="EMP" class="logo-img" />

        <form method="post">
          <div class="form-group">
            <label>Username</label>
            <div class="input-wrapper">
              <i class="fa fa-user"></i>
              <input type="text" name="username" placeholder="Username" required />
            </div>
          </div>

          <div class="form-group">
            <label>Password</label>
            <div class="input-wrapper">
              <i class="fa fa-lock"></i>
              <input type="password" name="pwd" placeholder="Password" required />
            </div>
          </div>

          <span style="color:red;"><?php if(!empty($msg)){ echo $msg; } ?></span>

          <button type="submit" name="login" class="login-btn">LOGIN</button>
        </form>
      </div>
    </div>
  </div>

    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- login23:12-->
</html>