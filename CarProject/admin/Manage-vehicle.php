<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

if(isset($_REQUEST['del']))
	{
$delid=intval($_GET['del']);
$sql = "delete from tblvehicles  WHERE  id=:delid";
$query = $dbh->prepare($sql);
$query -> bindParam(':delid',$delid, PDO::PARAM_STR);
$query -> execute();
$msg="Vehicle  record deleted successfully";
}


 ?>

<html>
    <head>
<link rel="stylesheet" href="assets/CSSFILE/Style9.css">
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<?php include('navbar.php');?>
     </head>
     <body><br><Br><br><br><br>
     <center><h1>Manage Vehicle</h1></center>
     <?php if($error){?><center><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </center><?php } 
				else if($msg){?><center><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </center><?php }?>
								<center>
                                <table id="Content-table" width="100%">
									<thead>
										<tr>
										<th width="10%">#</th>
											<th width="10%">Vehicle Title</th>
											<th width="10%">Brand </th>
											<th width="10%">Price Per day</th>
											<th width="10%">Fuel Type</th>
											<th width="10%">Model Year</th>
											<th width="50%">Action</th>
										</tr>
									</thead>
									
									<tbody>

<?php $sql = "SELECT tblvehicles.VehiclesTitle,tblbrands.BrandName,tblvehicles.PricePerDay,tblvehicles.FuelType,tblvehicles.ModelYear,tblvehicles.id from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand";
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
											<td><?php echo htmlentities($result->VehiclesTitle);?></td>
											<td><?php echo htmlentities($result->BrandName);?></td>
											<td><?php echo htmlentities($result->PricePerDay);?></td>
											<td><?php echo htmlentities($result->FuelType);?></td>
												<td><?php echo htmlentities($result->ModelYear);?></td>
		<td><a href="vehicle-edit.php?id=<?php echo $result->id;?>">Edit</a>&nbsp;&nbsp;
<a href="Manage-vehicle.php?del=<?php echo $result->id;?>" onclick="return confirm('Do you want to delete');">Delete</a></td>
										</tr>
										<?php $cnt=$cnt+1; }} ?>
										
									</tbody>
								</table>
</center>
						
                                </body>
</html>
<?php } ?>
