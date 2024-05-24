
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
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<?php include('navbar.php');?>
     </head>
     <body>
<br><br><br><br><br>
<center><h1>My Testimonails</h1></center>

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
 <center><h2>Hey, <?php echo htmlentities($result->FullName);; }}?> This is your Testimonials</h2></center>
 <?php 
$useremail=$_SESSION['login'];
$sql = "SELECT * from tbltestimonial where UserEmail=:useremail";
$query = $dbh -> prepare($sql);
$query -> bindParam(':useremail',$useremail, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
?>
<div style="display:flex; flex-wrap:wrap; justify-content:center;">
<?php
if($cnt=$query->rowCount() > 0)
{
foreach($results as $result)
{ ?>
<center>
    <div id="content-table" style="margin:20px;">
                 <p><?php echo htmlentities($result->Testimonial);?> </p>
                   <p>Posting Date:<?php echo htmlentities($result->PostingDate);?> </p>
                
                <?php if($result->status==1){ ?>
                 <a href="#">Active</a>

                  
                  <?php } else {?>
               <a href="#">Waiting for approval</a>
              
                  <?php } ?>
                  </div>
                  </center>

              
              <?php } } ?>
                  </div>
        
           
                  <?php include('includes/footer.php');?>
          </body>
</html>
<?php } ?>