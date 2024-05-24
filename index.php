<!DOCTYPE>
<?php 
session_start();
include('includes/config.php');
error_reporting(0);
?>

<html>
<head>
    <link rel="stylesheet" href="assets/CSSFile/Style14.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        #quotes h2, #quotes p {
            font-size: 3em; /* Increase font size by three times */
        }
    </style>
    <?php include('navbar.php');?>
</head>
<body>
    <br><br><br><br>
    <section id="banner" class="banner-section">
        <div class="container">
            <h1>&nbsp;</h1>
            <p>&nbsp; </p>
        </div>
    </section>

    <div id="quotes">
        <h2>Self-Drive Car Rentals In Indore <span> </span></h2>
        <p>Book your drive now!</p>
    </div>

    <center> <h1 id="board">Scroll to see our cars</h2><center>

    <div id="category-indexpage">
        <?php 
        $sql = "SELECT tblvehicles.VehiclesTitle,tblbrands.BrandName,tblvehicles.PricePerDay,tblvehicles.FuelType,tblvehicles.ModelYear,tblvehicles.id,tblvehicles.SeatingCapacity,tblvehicles.VehiclesOverview,tblvehicles.Vimage1 from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand limit 9";
        $query = $dbh -> prepare($sql);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        $cnt=1;
        if($query->rowCount() > 0)
        {
            foreach($results as $result)
            {  
        ?>  
            <div id="innerbox-1">
                
                <a href="vehical-detail.php?vhid=<?php echo htmlentities($result->id);?>"><img  src="admin/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" alt="image"></a>
                <table id="background">
                    <tr>
                        <td><i class="fa fa-car" aria-hidden="true"></i>  <?php echo htmlentities($result->FuelType);?></td>
                        <td><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo htmlentities($result->ModelYear);?> Model</td>
                        <td><i class="fa fa-user" aria-hidden="true"></i> <?php echo htmlentities($result->SeatingCapacity);?> seats</td>
                    </tr>
                </table>
                <div class="">
                    <h3><a href="vehical-detail.php?vhid=<?php echo htmlentities($result->id);?>"> <?php echo htmlentities($result->VehiclesTitle);?></a></h3>
                    <span class="price">Rs. <?php echo htmlentities($result->PricePerDay);?> /Day</span> 
                </div>
            </div>
        <?php }}?>
    </div>
    <hr>
    <center><h1></h1></center>
    <div id="category-indexpage">
        <?php 
        $tid=1;
        $sql = "SELECT tbltestimonial.Testimonial,tblusers.FullName from tbltestimonial join tblusers on tbltestimonial.UserEmail=tblusers.EmailId where tbltestimonial.status=:tid limit 4";
        $query = $dbh -> prepare($sql);
        $query->bindParam(':tid',$tid, PDO::PARAM_STR);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        $cnt=1;
        if($query->rowCount() > 0)
        {
            foreach($results as $result)
            {  
        ?>
            <div style="padding:10px; width:40%; background-color:rgba(0,0,0,0.4); margin:50px; border-radius:20px;">
                <h2><?php echo htmlentities($result->FullName);?></h2>
                <hr>
                <p><?php echo htmlentities($result->Testimonial);?></p>
            </div>
        <?php }} ?>
    </div>
    <?php include('includes/footer.php');?>
</body>
</html>
