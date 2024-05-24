<?php 
session_start();
include('includes/config.php');
error_reporting(0);
?>

<html>
    <head>
<link rel="stylesheet" href="assets/CSSFILE/Style14.css">
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<?php include('navbar.php');?>
     </head>
     <body><br><Br><br><br><br>
     <center><h1>Select Car from Wide Range</h1><center>
         
         <div id="filter" style="background-color: grey; position:fixed    ;">
     <h3 style="color:white;"><i class="fa fa-filter" aria-hidden="true" ></i> FILTER </h3>
        
            <form action="search-result.php" method="post">
              
                <select class="form-control" name="brand">
                  <option>Select Brand</option>

                  <?php $sql = "SELECT * from  tblbrands ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{       ?>  
<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->BrandName);?></option>
<?php }} ?>
                 
                </select>
                            
                <select  name="fueltype">
                  <option>Select Fuel Type</option>
<option value="Petrol">Petrol</option>
<option value="Diesel">Diesel</option>
<option value="CNG">CNG</option>
                </select>
              <button id="button" type="submit" style="border:none; color:white; width:80%; font-size:15px; text-align:center; padding:10px;"><i class="fa fa-search" aria-hidden="true"></i> Search Car</button>
                      </form>
</div>

<div id="category-listpage">
  
  <?php $sql = "SELECT tblvehicles.VehiclesTitle,tblbrands.BrandName,tblvehicles.PricePerDay,tblvehicles.FuelType,tblvehicles.ModelYear,tblvehicles.id,tblvehicles.SeatingCapacity,tblvehicles.VehiclesOverview,tblvehicles.Vimage1 from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand limit 9";
  $query = $dbh -> prepare($sql);
  $query->execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);
  $cnt=0;
  if($query->rowCount() > 0)
  {
  foreach($results as $result)
  {  
  ?>  
    <div id="innerbox-2">
        
   <a href="vehical-detail.php?vhid=<?php echo htmlentities($result->id);?>"><img src="admin/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="img-responsive" alt="image"></a>
  <table id="background">
      <tr>
  <td><i class="fa fa-car" aria-hidden="true"></i>  <?php echo htmlentities($result->FuelType);?></td>
  <td><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo htmlentities($result->ModelYear);?> Model</td>
  <td><i class="fa fa-user" aria-hidden="true"></i> <?php echo htmlentities($result->SeatingCapacity);?> seats</td>
  </tr>
  </table>
  

  <h3><a href="vehical-detail.php?vhid=<?php echo htmlentities($result->id);?>"> <?php echo htmlentities($result->VehiclesTitle);?></a></h3>
  <span class="price">Rs. <?php echo htmlentities($result->PricePerDay);?> /Day</span> 

  </div>
  
  <?php }}?>
  
  </div>
  <?php include('includes/footer.php');?>
  </body>
  </html>