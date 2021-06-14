<?php
include('connect.php');
session_start();
//Email to the people who must finish the project 
$row_check_data=mysqli_fetch_assoc(mysqli_query($conn,"select data_send from send_check"));
$date=date('Y-m-d');
if($date!=$row_check_data['data_send']){
	include('date_send.php');
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<meta http-equiv="Cache-control" content="no-cache">
<title>Untitled Document</title>
<link href="loginc/login.css" rel="stylesheet" type="text/css">
<link href="loginc/SWP.css" rel="stylesheet" type="text/css">
<link href="loginc/header.css" rel="stylesheet" type="text/css">
<link href="loginc/menu.css" rel="stylesheet" type="text/css">
	<script language="javascript" type="text/javascript">
		window.history.forward();
	</script>
</head>
<body>
<header>
  <nav>
    <input type="checkbox" id="nav" class="hidden">
    <label for="nav" class="nav-btn"><i></i><i></i><i></i></label>
    <div class="header" >
      <ul class="menu">
          <li><a href="project.php">Browse projects</a></li>
		  <li><a href="index.html">Return to the home page</a></li>
      </ul>
    </div>
    <div class="text middle"> <span>S</span> <span class="hidden_logo">i</span> <span class="hidden_logo">m</span> <span class="hidden_logo">p</span> <span class="hidden_logo">l</span> <span class="hidden_logo">e</span> <span>W</span> <span class="hidden_logo">o</span> <span class="hidden_logo">r</span> <span class="hidden_logo">k</span> <span>P</span> <span class="hidden_logo">l</span> <span class="hidden_logo">a</span> <span class="hidden_logo">t</span> <span class="hidden_logo">f</span> <span class="hidden_logo">o</span> <span class="hidden_logo">r</span> <span class="hidden_logo">m</span> </div>
  </nav>
</header>
<br>
<br>
<br>
<div class="container" id="container">
  <div class="form-container sign-up-container">
    <form action="Add_Client.php" method="post" class="input" onSubmit="return ValidateFrom()" >
      <h1>Sign In</h1>
      <span>or use your email for registration</span>
      <input type="text" id="firstname" placeholder="Full Name" name="name" />
      <input type="text" id="lastname" placeholder="Date Berth: 2000-12-08" name="date_berth" />
      <input type="email" id="email" placeholder="Email" name="email" />
      <input type="password" id="password" placeholder="Password" name="password"/>
      <input type="password" id="confirm_password" placeholder="Confirm Password" name="Confirm_Password" />
		<textarea class="textarea" id="textarea" maxlength="100" placeholder="Note" name="note"></textarea>
      <button type="submit">Sign In</button>
    </form>
  </div>
	
  <div class="form-container sign-in-container">
    <form action="C_Login.php" method="post" class="input" >
      <h1>Log In Client</h1>
      <span>or use your account</span>
      <input type="email" id="email" placeholder="Email" name="email" />
      <input type="password" id="password" placeholder="Password" name="password" />
      <button type="submit">Log In</button>
    </form>
  </div>
	
  <div class="overlay-container">
    <div class="overlay">
      <div class="overlay-panel overlay-left">
        <h1>Welcome Back!</h1>
        <p>Already have account?</p>
        <button class="ghost" id="signIn">Log In</button>
      </div>
      <div class="overlay-panel overlay-right">
        <h1>Hello, Friend!</h1>
        <p>Don’t have account?</p>
        <button class="ghost" id="signUp">Sign In</button>
      </div>
    </div>
  </div>
</div>
<script src="loginC/login.js"></script>
</body>
</html>
