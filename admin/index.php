<!DOCTYPE html>
<html lang="en" style="overflow-x: hidden; overflow-y: hidden;">


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
<style>
@import url("https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Roboto", sans-serif;
}

body, html {
  height: 100%;
  width: 100%;
}

.admin-login-page {
  background: url("https://img001.prntscr.com/file/img001/7SRj4vbxSZCdXYDstgd_cA.jpg") no-repeat center center;
  background-size: cover;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 50px;
  height: 100vh;
}

.login-box {
  width: 400px;
  padding: 40px;
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(10px);
  border: 2px solid rgba(0, 255, 255, 0.2);
  border-radius: 15px;
  box-shadow: 0 0 20px rgba(0, 255, 255, 0.2);
}

.login-content h3 {
  text-align: center;
  color: white;
  margin-bottom: 20px;
}

.logo-img {
  display: block;
  margin: 0 auto 20px;
  width: 80px;
  height: 80px;
  border-radius: 50%;
}

.form-group {
  margin-bottom: 20px;
  color: white;
}

.input-wrapper {
  position: relative;
}

.input-wrapper i {
  position: absolute;
  left: 10px;
  top: 50%;
  transform: translateY(-50%);
  color: white;
}

.input-wrapper input {
  width: 100%;
  padding: 10px 10px 10px 35px;
  background: rgba(255, 255, 255, 0.2);
  border: 1px solid rgba(255, 255, 255, 0.3);
  border-radius: 8px;
  color: white;
  outline: none;
}

.input-wrapper input::placeholder {
  color: rgba(255, 255, 255, 0.8);
}

.login-btn {
  width: 100%;
  padding: 12px;
  border: none;
  background: linear-gradient(45deg, #00bcd4, #009688);
  color: white;
  font-size: 16px;
  border-radius: 8px;
  cursor: pointer;
  transition: 0.3s ease;
}

.login-btn:hover {
  background: linear-gradient(45deg, #009688, #00796b);
}

.links {
  margin-top: 15px;
  display: flex;
  justify-content: space-between;
}

.links a {
  color: #fff;
  text-decoration: none;
  font-size: 0.9em;
}

.links a:hover {
  color: #ddd;
}

@media (max-width: 768px) {
  .admin-login-page {
    justify-content: center;
    padding: 20px;
  }
}



</style>
<?php
session_start();
include('includes/connection.php');
if(isset($_REQUEST['login']))
{
    $username = mysqli_real_escape_string($connection,$_REQUEST['username']);
    $pwd = mysqli_real_escape_string($connection,$_REQUEST['pwd']);
    
    $fetch_query = mysqli_query($connection, "select * from tbl_employee where username ='$username' and password = '$pwd' and role=1");
    $res = mysqli_num_rows($fetch_query);
    if($res>0)
    {
        $data = mysqli_fetch_array($fetch_query);
        $name = $data['first_name'].' '.$data['last_name'];
        $role = $data['role'];
        $_SESSION['name'] = $name;
        $_SESSION['role'] = $role;
        header('location:dashboard.php');
    }
    else
    {
        $msg = "Incorrect login details.";
    }
}
?>
<body >
<div class="admin-login-page">
  <div class="login-box">
    <div class="login-content">
      <h3>Admin Login</h3>
      <img src="./assets/img/admin logo.jpg" alt="Admin Icon" class="logo-img" />

      <form method="post" class="form-signin">
        <div class="form-group">
          <label>Username</label>
          <div class="input-wrapper">
            <i class="fa fa-user"></i>
            <input type="text" name="username" placeholder="Username" required  />
          </div>
        </div>

        <div class="form-group">
          <label>Password</label>
          <div class="input-wrapper">
            <i class="fa fa-lock"></i>
            <input type="password" name="pwd" placeholder="Password" required  />
          </div>
        </div>

        <span style="color:red;"><?php if(!empty($msg)){ echo $msg; } ?></span>

        <button type="submit" name="login" class="login-btn">Login</button>

        
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