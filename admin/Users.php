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
    <br><br><br><br>
         <center><h1>Registered Users</h1></center>
         <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
								<center>
                                <table id="content-table">
									<thead >
										<tr>
										<th>#</th>
											<th> Name</th>
											<th>Email </th>
											<th>Contact no</th>
										<th>Reg Date</th>
										
										</tr>
                                      </thead>
									<tbody>

									<?php $sql = "SELECT * from  tblusers ";
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
											<td><?php echo htmlentities($result->EmailId);?></td>
											<td><?php echo htmlentities($result->ContactNo);?></td>
	                                 		<td><?php echo htmlentities($result->RegDate);?></td>
										</tr>
										<?php $cnt=$cnt+1; }} ?>
										
									</tbody>
								</table>
</table>
                                </body>
</html>
<?php } ?>