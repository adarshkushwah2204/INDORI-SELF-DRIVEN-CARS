<?php 
session_start();
include('includes/config.php');
error_reporting(0);
?>

<html>
    <head>
<link rel="stylesheet" href="assets/CSSFILE/Style14.css">
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<style>
   
</style>
<?php include('navbar.php');?>
     </head>
     <body><br><Br><br><br><br>
     <?php 
//Query for Listing count
$brand=$_POST['brand'];
$fueltype=$_POST['fueltype'];
$sql = "SELECT id from tblvehicles where tblvehicles.VehiclesBrand=:brand and tblvehicles.FuelType=:fueltype";
$query = $dbh -> prepare($sql);
$query -> bindParam(':brand',$brand, PDO::PARAM_STR);
$query -> bindParam(':fueltype',$fueltype, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=$query->rowCount();
?>
<center>
<p><span><?php echo htmlentities($cnt);?> Listings</span></p>
</center>
</div>
</div>

<div id="category-searchpage">
<?php 

$sql = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid  from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblvehicles.VehiclesBrand=:brand and tblvehicles.FuelType=:fueltype";
$query = $dbh -> prepare($sql);
$query -> bindParam(':brand',$brand, PDO::PARAM_STR);
$query -> bindParam(':fueltype',$fueltype, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
  if($query->rowCount() > 0)
  {
  foreach($results as $result)
  {  
  ?>  
    <div id="innerbox-1">
        
   <a href="vehical-detail.php?vhid=<?php echo htmlentities($result->id);?>"><img src="admin/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="img-responsive" alt="image"></a>
  <table id="background">
      <tr>
  <td><i class="fa fa-car" aria-hidden="true"></i>  <?php echo htmlentities($result->FuelType);?></td>
  <td><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo htmlentities($result->ModelYear);?> Model</td>
  <td><i class="fa fa-user" aria-hidden="true"></i> <?php echo htmlentities($result->SeatingCapacity);?> seats</td>
  </tr>
  </table>
  
  <center>
  <h3><a href="vehical-detail.php?vhid=<?php echo htmlentities($result->id);?>"> <?php echo htmlentities($result->VehiclesTitle);?></a></h3>
  <span class="price">Rs. <?php echo htmlentities($result->PricePerDay);?> /Day</span> 
  </center>
  </div>
  
  <?php }}?>
  </div>
  <?php include('includes/footer.php');?>
</body>
</html>