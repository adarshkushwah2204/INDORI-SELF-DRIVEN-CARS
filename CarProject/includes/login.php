<?php 
session_start();
include('config.php');
error_reporting(0);
?>
 <html>
<head>  
<link rel="stylesheet" href="CarProject/assets/CSSFile/Style12.css">
</head>
<body>
<?php
if(isset($_POST['login']))
{
$email=$_POST['email'];
$password=md5($_POST['password']);
$sql ="SELECT EmailId,Password,FullName FROM tblusers WHERE EmailId=:email and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['login']=$_POST['email'];
$_SESSION['fname']=$results->FullName;
$page='index.php';

// Redirect browser
header("Location: http://localhost/CarProject/");



} else{
  
  echo "<script>alert('Invalid Details');</script>";

}

}

?>

<center> <h2>Login</h2><center>

<form method="post">

    <input type="email" class="form-control" name="email" placeholder="Email address*">
                 <input type="password" class="form-control" name="password" placeholder="Password*">


    <input type="submit" name="login" value="Login" id="button">

</form>
         

<p>Don't have an account? <a href="registration.php" data-toggle="modal" data-dismiss="modal">Signup Here</a></p>
<p><a href="#forgotpassword" data-toggle="modal" data-dismiss="modal">Forgot Password ?</a></p>
</div>
</center>
</body>
</html>

