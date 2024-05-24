<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_REQUEST['eid']))
	{
$eid=intval($_GET['eid']);
$status="0";
$sql = "UPDATE tbltestimonial SET status=:status WHERE  id=:eid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':eid',$eid, PDO::PARAM_STR);
$query -> execute();

$msg="Testimonial Successfully Inactive";

}


if(isset($_REQUEST['aeid']))
	{
$aeid=intval($_GET['aeid']);
$status=1;

$sql = "UPDATE tbltestimonial SET status=:status WHERE  id=:aeid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
$query -> execute();
$msg="Testimonial Successfully Active";

}
 ?>
 <html>
     <head>
       <?php include('Navbar.php');?>  
</head>
<body>
    <br><br><br><br>
         <center><h1>Manage Testimonial</h1></center>
     <?php if($error){?><center><div><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div></center><?php } 
				else if($msg){?><center><div><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div></center><?php }?>
								<center>
                                <table id="content-table">
									<thead >
										<tr>
										<th>#</th>
											<th>Name</th>
											<th>Email</th>
											<th>Testimonials</th>
											<th>Posting date</th>
											<th>Action</th>
										</tr>
									</thead>
						
									<tbody>

									<?php $sql = "SELECT tblusers.FullName,tbltestimonial.UserEmail,tbltestimonial.Testimonial,tbltestimonial.PostingDate,tbltestimonial.status,tbltestimonial.id from tbltestimonial join tblusers on tblusers.Emailid=tbltestimonial.UserEmail";
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
											<td><?php echo htmlentities($result->FullName);?></td>
											<td><?php echo htmlentities($result->UserEmail);?></td>
											<td><?php echo htmlentities($result->Testimonial);?></td>
											<td><?php echo htmlentities($result->PostingDate);?></td>
										<td><?php if($result->status=="" || $result->status==0)
{
	?><a href="testimonials-page.php?aeid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to Active')"> Inactive</a>
<?php } else {?>

<a href="testimonials-page.php?eid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to Inactive')"> Active</a>
</td>
<?php } ?></td>
										</tr>
										<?php $cnt=$cnt+1; }} ?>
										
									</tbody>
								</table>
</center>
						

							
     </body>
 </html>
 <?php } ?>