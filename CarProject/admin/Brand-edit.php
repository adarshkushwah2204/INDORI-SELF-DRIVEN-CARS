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
$id=$_GET['id'];
$sql="update  tblbrands set BrandName=:brand where id=:id";
$query = $dbh->prepare($sql);
$query->bindParam(':brand',$brand,PDO::PARAM_STR);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();

$msg="Brand Update successfully";

}
?>
 <html>
     <head>
       <?php include('Navbar.php');?>  
       
</head>
<body>
    <br><br><br><br>
    <center><h1>Edit Brand Name</h1></center>
    <form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">
	<center>						
    <table id="content-table" style="width:40%; font-size:30px;">		
											
  	        	  <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

<?php	
$id=$_GET['id'];
$ret="select * from tblbrands where id=:id";
$query= $dbh -> prepare($ret);
$query->bindParam(':id',$id, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
foreach($results as $result)
{
?>
<tr>
    <td>
   <label class="col-sm-4 control-label">Edit Name</label>

	<input type="text" class="form-control" value="<?php echo htmlentities($result->BrandName);?>" name="brand" id="brand" required>
</td>
</tr>
		<?php }} ?>
	<tr>
        <td>
		<button id="button" name="submit" type="submit">Submit</button>
</td>
</tr>
</table>
</center>
	</form>
                                        </body>

</html>
<?php } ?>