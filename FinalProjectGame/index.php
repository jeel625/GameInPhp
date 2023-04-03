<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Sign up / Login Form</title>
</head>
<body>
<!DOCTYPE html>
<html>
<head>
	<title>Slide Navbar</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">
			<div class="signup">
				<form action="./phpFiles/LoginFiles/RegistrationForm.php" method="post">
					<label for="chk" aria-hidden="true">Sign up</label>
					<input type="text" name="FirstName" placeholder="First Name...." required="">
					<input type="text" name="LastName" placeholder="Last Name..." required="">
					<input type="email" name="Email" placeholder="Email..." required="">
					<input type="text" name="UserName" placeholder="User Name..." required="">
					<input type="password" name="TempPassword" placeholder="Password" required="">
					<input type="password" name="ConfirmPassword" placeholder="Confirm Password" required="">
					<button>Sign up</button>
				</form>
			</div>

			<div class="login">
				<form action="./index.php" method="post">
					<label for="chk" aria-hidden="true">Login</label>
					<input type="text" name="UserName" placeholder="User Name" required="">
					<input type="password" name="TempPassword" placeholder="Password" required="">
					<a style="margin-left:30%" href="./forgetPassword/forgetPassword.html">Forget Password??</a>
					<input type="submit" name="send" value="SEND IT" style="color:white;background-color: crimson;width:200px;height:40px;font-size:20px" required="required"/>
				</form>
			</div>
	</div>
</body>
</html>  
</body>
</html>
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['send']))
{
	require("./classDatabase/Database.php");
	$user=new Database($_POST['UserName'],$_POST['TempPassword']);
	echo "<script>window.location.href='./phpFiles/LoginFiles/authentication.php';</script>";
}
?>
