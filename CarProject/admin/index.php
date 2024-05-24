<?php
session_start();
include('includes/config.php');
if(isset($_POST['login']))
{
$email=$_POST['username'];
$password="admin";
$sql ="SELECT UserName,Password FROM admin WHERE UserName=:email and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['alogin']=$_POST['username'];
echo "<script type='text/javascript'> document.location = 'Bookings-details.php'; </script>";
} else{
  
  echo "<script>alert('Invalid Details');</script>";

}

}

?>
<html>
<head>  
<link rel="stylesheet" href="css/Style9.css">
</head>
<body>
  <center>
  <div id="login-form">

		
 <center> <h2>Admin Login</h2><center>
	<form method="post">		
									
           
		   <input type="text"  name="username" placeholder=" UserName*">
						<input type="password"  name="password" placeholder=" Password*">

	  
		   <input type="submit" name="login" value="Login" id="button">
	  <br>
		   <a id="button" href="../index.php">Back to Home</a>	
	   </form>
				
  </div>
</center>
      </body>
</html>
