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
if(isset($_POST['update']))
{
$vimage=$_FILES["img4"]["name"];
$id=intval($_GET['imgid']);
move_uploaded_file($_FILES["img4"]["tmp_name"],"img/vehicleimages/".$_FILES["img4"]["name"]);
$sql="update tblvehicles set Vimage4=:vimage where id=:id";
$query = $dbh->prepare($sql);
$query->bindParam(':vimage',$vimage,PDO::PARAM_STR);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();

$msg="Image updated successfully";



}
?>

<html>
	<head>
	  <?php include('Navbar.php');?>  
	  <style>
		 
		  </style>
</head>
<body>
   <center>
   <div id="box">
					   <h2 class="page-title">Vehicle Image 3 </h2>
					   <form method="post" class="form-horizontal" enctype="multipart/form-data">
												
					   <?php if($error){?><center><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </center><?php } 
				else if($msg){?><center><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </center><?php }?>
												<label class="col-sm-4 control-label">Current Image2</label>
<br><br>
<?php
$id=intval($_GET['imgid']);
$sql ="SELECT Vimage4 from tblvehicles where tblvehicles.id=:id";
$query = $dbh -> prepare($sql);
$query-> bindParam(':id', $id, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>


<img src="vehicleimages/<?php echo htmlentities($result->Vimage4);?>" width="300" height="200" style="border:solid 1px #000">
<br><br>
<?php }}?>


											
												<label>Upload New Image 1<span style="color:red">*</span></label>
								<br><br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	<input id="button" type="file" name="img4" required>
											<br>			<br>										
													<button id="button" name="update" type="submit">Update</button>
										</form>
							</div>
</center>
</body>

</html>
<?php } ?>