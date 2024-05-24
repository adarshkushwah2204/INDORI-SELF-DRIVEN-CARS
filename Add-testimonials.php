<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{
if(isset($_POST['submit']))
  {
$testimonoial=$_POST['testimonial'];
$email=$_SESSION['login'];
$sql="INSERT INTO  tbltestimonial(UserEmail,Testimonial) VALUES(:email,:testimonoial)";
$query = $dbh->prepare($sql);
$query->bindParam(':testimonoial',$testimonoial,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);

$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Testimonail submitted successfully";
}
else 
{
$error="Something went wrong. Please try again";
}

}
?>

<html>
    <head>
<link rel="stylesheet" href="assets/CSSFILE/Style14.css">
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<?php include('navbar.php');?>
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
          <?php echo htmlentities($result->City);?>&nbsp;<?php echo htmlentities($result->Country); }}?></p>
   <?php if($error){?><center><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </center><?php } 
        else if($msg){?><center><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </center><?php }?>
          <form  method="post">
          
          <center>
            <div class="form-group">
              <h1>Testimonail</h1>
              <br>
              <textarea style="width:60%; height:40%; font-size:20px; padding:20px;" name="testimonial" rows="6" required="" placeholder="Write your Testmonial here"></textarea>
              <br>
              <button type="submit" name="submit" id="button" style="width:150px; font-size:20px;">Post<span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></button>
            </div>
</center>
</form>
<?php include('includes/footer.php');?>
</body>
</html>
<?php } ?>