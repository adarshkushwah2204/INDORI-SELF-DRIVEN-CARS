<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_GET['del']))
{
$id=$_GET['del'];
$sql = "delete from tblbrands  WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();
$msg="Page data updated  successfully";

}
 ?>
  <html>
     <head>
       <?php include('Navbar.php');?>  

</head>
<body>
    
<br><br><br><br><br>
<center><h1>Manage Brands</h1></center>
<?php if($error){?><div ><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
								<center>
                                <table id="content-table">
									<thead>
										<tr>
										<th>#</th>
												<th>Brand Name</th>
											<th>Creation Date</th>
											<th>Updation date</th>
										
											<th>Action</th>
										</tr>
									</thead>
								
									<tbody>

									<?php $sql = "SELECT * from  tblbrands ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>	
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($result->BrandName);?></td>
											<td><?php echo htmlentities($result->CreationDate);?></td>
											<td><?php echo htmlentities($result->UpdationDate);?></td>
<td><a href="Brand-edit.php?id=<?php echo $result->id;?>">Edit</a>&nbsp;&nbsp;
<a href="Manage-brand.php?del=<?php echo $result->id;?>" onclick="return confirm('Do you want to delete');">Delete</a></td>
										</tr>
										<?php $cnt=$cnt+1; }} ?>
										
									</tbody>
								</table>
</center>
                                </body>
</html>
<?php } ?>