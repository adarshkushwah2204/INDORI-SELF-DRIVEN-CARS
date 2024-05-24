<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(isset($_POST['submit']))
{
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate']; 
$message=$_POST['message'];
$useremail=$_SESSION['login'];
$status=0;
$vhid=$_GET['vhid'];
$sql="INSERT INTO  tblbooking(userEmail,VehicleId,FromDate,ToDate,message,Status) VALUES(:useremail,:vhid,:fromdate,:todate,:message,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':useremail',$useremail,PDO::PARAM_STR);
$query->bindParam(':vhid',$vhid,PDO::PARAM_STR);
$query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
$query->bindParam(':todate',$todate,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Booking successfull.');</script>";
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
}

}

?>


<html>
    <head>
        
<link rel="stylesheet" href="assets/CSSFILE/Style14.css">
<link rel="stylesheet" href="assets/CSSFILE/sty1e.css">
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
      #details-box{
            display: flex;
            flex-wrap:wrap;
            justify-content: center;
            background-color: white;
            width:80%;
            height:90%;
            margin-top:7%;
            border-radius: 2%;
            box-shadow: 2px 7px 10px rgba(247, 0, 124, 0.5);
        }
        #detail-inner{
           text-align: left;
           margin:20px;
           
           font-size:20px;
           border-style: solid;
           border:2px;
        }
        #detail-inner img{
           width:700px;
           height:400px;
           margin-bottom: 1%;
        }
        #below-img-1{
            width:100px;
            background-image: url("");
            background-size: cover;
        }
        #below-img-2{
            width:100px;
            background-image: url("");
        }
        #below{
            width:230px;
            height: 180px; 
            background-size:cover;
            background-image: url("");
            
        }
</style>

<?php include('navbar.php');?>
     </head>
     <body>
<br><br>

    <center>
        
<?php 
$vhid=intval($_GET['vhid']);
$sql = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid  from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblvehicles.id=:vhid";
$query = $dbh -> prepare($sql);
$query->bindParam(':vhid',$vhid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  
$_SESSION['brndid']=$result->bid;  
?>  

        <div id="details-box">
            <div id="detail-inner">
                
                <img src="admin/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" id="top-img">
                <br>
                <button id="below" onclick='change(1)'
                        style="   
                    
                        background-image: url('admin/vehicleimages/<?php echo htmlentities($result->Vimage1);?>');
                        ">
                </button>
            
                <button id="below" onclick='change(2)'
                        style="
                         
                        background-image: url('admin/vehicleimages/<?php echo htmlentities($result->Vimage2);?>');
                        ">
                </button>
                 
                <button id="below" onclick='change(3)'
                        style="
                    
                        background-image: url('admin/vehicleimages/<?php echo htmlentities($result->Vimage3);?>');
                        ">
                </button>
                
            </div>
            <div id="detail-inner" style="line-height:50px;">
        
              
        <h2><?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></h2>
        <table id="background">
      <tr>
  <td><i class="fa fa-car" aria-hidden="true"></i>  <?php echo htmlentities($result->FuelType);?></td>
  <td><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo htmlentities($result->ModelYear);?> Model</td>
  <td><i class="fa fa-user" aria-hidden="true"></i> <?php echo htmlentities($result->SeatingCapacity);?> seats</td>
  </tr>
  </table>
                <p><?php echo htmlentities($result->VehiclesOverview);?></p>
              
              
              
              
                <table>
                  <thead>
                    <tr>
                      <th colspan="2"><h2>Accessories and Functionalities<h2></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Air Conditioner</td>
<?php if($result->AirConditioner==1)
{
?>
                      <td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?> 
   <td><i class="fa fa-close" aria-hidden="true"></i></td>
   <?php } ?> </tr>

<tr>
<td>AntiLock Braking System</td>
<?php if($result->AntiLockBrakingSystem==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else {?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
                    </tr>

<tr>
<td>Power Steering</td>
<?php if($result->PowerSteering==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>
                   

<tr>

<td>Power Windows</td>

<?php if($result->PowerWindows==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>
                   
 <tr>
<td>CD Player</td>
<?php if($result->CDPlayer==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>

<tr>
<td>Leather Seats</td>
<?php if($result->LeatherSeats==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>

<tr>
<td>Central Locking</td>
<?php if($result->CentralLocking==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>

<tr>
<td>Power Door Locks</td>
<?php if($result->PowerDoorLocks==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
                    </tr>
                    <tr>
<td>Brake Assist</td>
<?php if($result->BrakeAssist==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php  } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>

<tr>
<td>Driver Airbag</td>
<?php if($result->DriverAirbag==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
 </tr>
 
 <tr>
 <td>Passenger Airbag</td>
 <?php if($result->PassengerAirbag==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else {?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>

<tr>
<td>Crash Sensor</td>
<?php if($result->CrashSensor==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>

                  </tbody>
                </table>
    
            <p>Rs.<?php echo htmlentities($result->PricePerDay);?>/Per Day</p>

        </div>
          
        </div>
<?php }} ?>


   
      

    </center>
    <center>
    <div id="side-by-side" >
 
    <div id="booking-form" >
         <div> <h2><i class="fa fa-envelope" aria-hidden="true"></i>Book Now</h2>  </div>
        
        <form method="post">
          
            <input type="date" name="fromdate" placeholder="From Date(dd/mm/yyyy)" required>
     
            <input type="date" name="todate" placeholder="To Date(dd/mm/yyyy)" required>
           
            <textarea rows="4" name="message" placeholder="Message" required></textarea>
          <br>
        <?php if($_SESSION['login'])
            {?>
         
              <input type="submit" id="button"  name="submit" value="Book Now">
            
            <?php } else { ?>
                
<a id="button"  href="login.php">Login First to Book</a>

            <?php } ?>
        </form>
            </div>
      

           
            </div>
</center>
<script>
        function change(No)
        {
           
            if(No==1)
            {
                document.getElementById('top-img').src="admin/vehicleimages/<?php echo htmlentities($result->Vimage1);?>";
            }
            if(No==2)
            {
                document.getElementById('top-img').src="admin/vehicleimages/<?php echo htmlentities($result->Vimage2);?>";
            }
            if(No==3)
            {
                document.getElementById('top-img').src="admin/vehicleimages/<?php echo htmlentities($result->Vimage3);?>";
            }
            }
    </script>
<?php include('includes/footer.php');?>
     </body>
</html>