<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{ 

if(isset($_POST['submit']))
  {
$vehicletitle=$_POST['vehicletitle'];
$brand=$_POST['brandname'];
$vehicleoverview=$_POST['vehicalorcview'];
$priceperday=$_POST['priceperday'];
$fueltype=$_POST['fueltype'];
$modelyear=$_POST['modelyear'];
$seatingcapacity=$_POST['seatingcapacity'];
$vimage1=$_FILES["img1"]["name"];
$vimage2=$_FILES["img2"]["name"];
$vimage3=$_FILES["img3"]["name"];
$vimage4=$_FILES["img4"]["name"];
$vimage5=$_FILES["img5"]["name"];
$airconditioner=$_POST['airconditioner'];
$powerdoorlocks=$_POST['powerdoorlocks'];
$antilockbrakingsys=$_POST['antilockbrakingsys'];
$brakeassist=$_POST['brakeassist'];
$powersteering=$_POST['powersteering'];
$driverairbag=$_POST['driverairbag'];
$passengerairbag=$_POST['passengerairbag'];
$powerwindow=$_POST['powerwindow'];
$cdplayer=$_POST['cdplayer'];
$centrallocking=$_POST['centrallocking'];
$crashcensor=$_POST['crashcensor'];
$leatherseats=$_POST['leatherseats'];
move_uploaded_file($_FILES["img1"]["tmp_name"],"img/vehicleimages/".$_FILES["img1"]["name"]);
move_uploaded_file($_FILES["img2"]["tmp_name"],"img/vehicleimages/".$_FILES["img2"]["name"]);
move_uploaded_file($_FILES["img3"]["tmp_name"],"img/vehicleimages/".$_FILES["img3"]["name"]);
move_uploaded_file($_FILES["img4"]["tmp_name"],"img/vehicleimages/".$_FILES["img4"]["name"]);
move_uploaded_file($_FILES["img5"]["tmp_name"],"img/vehicleimages/".$_FILES["img5"]["name"]);

$sql="INSERT INTO tblvehicles(VehiclesTitle,VehiclesBrand,VehiclesOverview,PricePerDay,FuelType,ModelYear,SeatingCapacity,Vimage1,Vimage2,Vimage3,Vimage4,Vimage5,AirConditioner,PowerDoorLocks,AntiLockBrakingSystem,BrakeAssist,PowerSteering,DriverAirbag,PassengerAirbag,PowerWindows,CDPlayer,CentralLocking,CrashSensor,LeatherSeats) VALUES(:vehicletitle,:brand,:vehicleoverview,:priceperday,:fueltype,:modelyear,:seatingcapacity,:vimage1,:vimage2,:vimage3,:vimage4,:vimage5,:airconditioner,:powerdoorlocks,:antilockbrakingsys,:brakeassist,:powersteering,:driverairbag,:passengerairbag,:powerwindow,:cdplayer,:centrallocking,:crashcensor,:leatherseats)";
$query = $dbh->prepare($sql);
$query->bindParam(':vehicletitle',$vehicletitle,PDO::PARAM_STR);
$query->bindParam(':brand',$brand,PDO::PARAM_STR);
$query->bindParam(':vehicleoverview',$vehicleoverview,PDO::PARAM_STR);
$query->bindParam(':priceperday',$priceperday,PDO::PARAM_STR);
$query->bindParam(':fueltype',$fueltype,PDO::PARAM_STR);
$query->bindParam(':modelyear',$modelyear,PDO::PARAM_STR);
$query->bindParam(':seatingcapacity',$seatingcapacity,PDO::PARAM_STR);
$query->bindParam(':vimage1',$vimage1,PDO::PARAM_STR);
$query->bindParam(':vimage2',$vimage2,PDO::PARAM_STR);
$query->bindParam(':vimage3',$vimage3,PDO::PARAM_STR);
$query->bindParam(':vimage4',$vimage4,PDO::PARAM_STR);
$query->bindParam(':vimage5',$vimage5,PDO::PARAM_STR);
$query->bindParam(':airconditioner',$airconditioner,PDO::PARAM_STR);
$query->bindParam(':powerdoorlocks',$powerdoorlocks,PDO::PARAM_STR);
$query->bindParam(':antilockbrakingsys',$antilockbrakingsys,PDO::PARAM_STR);
$query->bindParam(':brakeassist',$brakeassist,PDO::PARAM_STR);
$query->bindParam(':powersteering',$powersteering,PDO::PARAM_STR);
$query->bindParam(':driverairbag',$driverairbag,PDO::PARAM_STR);
$query->bindParam(':passengerairbag',$passengerairbag,PDO::PARAM_STR);
$query->bindParam(':powerwindow',$powerwindow,PDO::PARAM_STR);
$query->bindParam(':cdplayer',$cdplayer,PDO::PARAM_STR);
$query->bindParam(':centrallocking',$centrallocking,PDO::PARAM_STR);
$query->bindParam(':crashcensor',$crashcensor,PDO::PARAM_STR);
$query->bindParam(':leatherseats',$leatherseats,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Vehicle posted successfully";
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
<body>
    
<br><br><br><br>
<center><h1>Add Vehicles</h1></center>
<?php if($error){?><center><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </center><?php } 
				else if($msg){?><center><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </center><?php }?>
                <form method="post" enctype="multipart/form-data">
<center>
                <table id="content-table">
<tr>
    <td>Vehicle Title<span style="color:red">*</span></td>
    <td><input type="text" name="vehicletitle"  required></td>
    <td>Select Brand<span style="color:red">*</span></td>
    <td><select name="brandname" required>
    <option value=""> Select </option>
    <?php $ret="select id,BrandName from tblbrands";
    $query= $dbh -> prepare($ret);
    //$query->bindParam(':id',$id, PDO::PARAM_STR);
    $query-> execute();
    $results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
foreach($results as $result)
{
?>
    <option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->BrandName);?></option>
<?php }} ?>

</select>
<td>
</tr>
<tr>										
<td>Vehicle Overview<span style="color:red">*</span></td>
<td>
<textarea class="form-control" name="vehicalorcview" rows="3" required></textarea>
</td>
</tr>
<tr>
<td>Price Per Day(in INR)<span style="color:red">*</span></td>
<td><input type="text" name="priceperday" class="form-control" required></td>

<td>Select Fuel Type<span style="color:red">*</span></td>
<td><select class="selectpicker" name="fueltype" required>
<option value=""> Select </option>

<option value="Petrol">Petrol</option>
<option value="Diesel">Diesel</option>
<option value="CNG">CNG</option>
</select>
</td>
</tr>
<tr>
<td>Model Year<span style="color:red">*</span></td>
<td><input type="text" name="modelyear" required></td>
<td>Seating Capacity<span style="color:red">*</span></td>
<td><input type="text" name="seatingcapacity" required></td>
</tr>
<tr>
    <td>Upload Images</td>
</tr>


<tr>
    <td>Image 1 <span style="color:red;">*</span><input type="file" name="img1" required></td>
    <td>Image 2 <span style="color:red;">*</span><input type="file" name="img2" required></td>
    <td>Image 3 <span style="color:red;">*</span><input type="file" name="img3" required></td>
    <td>Image 4 <span style="color:red;">*</span><input type="file" name="img4" required></td>
    <td>Image 5 <span style="color:red;">*</span><input type="file" name="img5" required></td>
</tr>

<tr>									
<td>Accessories</td>
</tr>
<tr>
<td>
<input type="checkbox"  name="airconditioner" value="1">
<label for="airconditioner"> Air Conditioner </label>
</td>
<td>
<input type="checkbox" id="powerdoorlocks" name="powerdoorlocks" value="1">
<label for="powerdoorlocks"> Power Door Locks </label>
</td>
<td>
<input type="checkbox"  name="antilockbrakingsys" value="1">
<label for="antilockbrakingsys"> AntiLock Braking System </label>
</td>

    <td>
<input type="checkbox" name="brakeassist" value="1">
<label for="brakeassist"> Brake Assist </label>
   </td>

    <td>
<input type="checkbox" name="powersteering" value="1">
<label for="inlineCheckbox5"> Power Steering </label>
</td>
</tr>
<tr>
<td>
<input type="checkbox"  name="driverairbag" value="1">
<label for="driverairbag">Driver Airbag</label>
</td>
    <td>
<input type="checkbox" name="passengerairbag" value="1">
<label for="passengerairbag"> Passenger Airbag </label>
    </td>
    <td>
<input type="checkbox" name="powerwindow" value="1">
<label for="powerwindow"> Power Windows </label>
</td>
<td>
<input type="checkbox" name="cdplayer" value="1">
<label for="cdplayer"> CD Player </label>
</td>

<td>
<input type="checkbox" name="centrallocking" value="1">
<label for="centrallocking">Central Locking</label>
</td>
</tr>
<tr>
<td>
<input type="checkbox" name="crashcensor" value="1">
<label for="crashcensor"> Crash Sensor </label>
</td>
<td>
<input type="checkbox" id="leatherseats" name="leatherseats" value="1">
<label for="leatherseats"> Leather Seats </label>
</td>
</tr>
<tr>
<td>	<button id="button" type="reset">Cancel</button>
	<button  id="button" name="submit" type="submit">Save changes</button></td>
</tr>
<table>
</center>
</form>
</body>
</html>
<?php } ?>