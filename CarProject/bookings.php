<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
  {
header('location:index.php');
}
else{
?>

<html>
    <head>
<link rel="stylesheet" href="assets/CSSFILE/Style14.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto Slab">
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<style>
   
</style><?php include('navbar.php');?>
     </head>
     <body>
         <br><br><br><br><br><br><br>   
<?php
$useremail=$_SESSION['login'];
$sql = "SELECT * from tblusers where EmailId=:useremail";
$query = $dbh -> prepare($sql);
$query -> bindParam(':useremail',$useremail, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>
  <center> <h2>Hello, <?php echo htmlentities($result->FullName);}}?> This is the list of your bookings</h2></center>
   

<div id="category-indexpage">
<?php
$useremail=$_SESSION['login'];
 $sql = "SELECT tblvehicles.Vimage1 as Vimage1,tblvehicles.VehiclesTitle,tblvehicles.id as vid,tblbrands.BrandName,tblbooking.FromDate,tblbooking.ToDate,tblbooking.message,tblbooking.Status  from tblbooking join tblvehicles on tblbooking.VehicleId=tblvehicles.id join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblbooking.userEmail=:useremail";
$query = $dbh -> prepare($sql);
$query-> bindParam(':useremail', $useremail, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>
<div id="innerbox-1">
<a href="vehical-detail.php?vhid=<?php echo htmlentities($result->vid);?>""><img src="admin/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" alt="image"></a> 
<center>
<h2><a href="vehical-detail.php?vhid=<?php echo htmlentities($result->vid);?>""> <?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></a></h2>
<p><b>From Date:</b> <?php echo htmlentities($result->FromDate);?><br /> <b>To Date:</b> <?php echo htmlentities($result->ToDate);?></p>
<?php if($result->Status==1)
                { ?>
            
                <h3 style="color:green;"> Confirmed</h3>
                 <?php } else if($result->Status==2) { ?>
                  <h3 style="color:red;">Cancelled</h3>
                  <?php } else { ?>
                    <h3 class="btn outline btn-xs">Not Confirm yet</h3>
                    <?php } ?>
                    <p><b>Message:</b> <?php echo htmlentities($result->message);?> </p>
                  
                  </div>
                    <?php }} ?>
</div>
<?php include('includes/footer.php');?>
</body>
</html>
<?php } ?>