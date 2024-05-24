<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
// Code for change password	
if(isset($_POST['submit']))
{
$brand=$_POST['brand'];
$sql="INSERT INTO  tblbrands(BrandName) VALUES(:brand)";
$query = $dbh->prepare($sql);
$query->bindParam(':brand',$brand,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Brand Created successfully";
}
else 
{
$error="Something went wrong. Please try again";
}

}
?>
 <html>
     <head>
       <?php include('Navbar.php');?>  
</head>
<body><br><br><br><br>
<center><h1>Add Brand</h1></center>
<center>
<table id="box">

<form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">
										
											
         <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
          else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
      <tr>
         <td>
          <h2> Brand Name</h2>
              <input type="text" class="form-control" name="brand" id="brand" required>
         </td>
     </tr>
     <tr>
         <td>
         <button id="button" name="submit" type="submit">Submit</button>
     </td>
          </form>
          </table></center>
          </body>

</html>
<?php } ?>                    