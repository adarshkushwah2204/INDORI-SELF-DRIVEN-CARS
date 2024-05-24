<?php 
include('includes/config.php');
?>
<centre>
<div style="display:flex; flex-wrap:wrap;">
    <nav style="background-color:#7b7a87;">
        <table>
            <tr>
                <td>
        <img src="logo.jpg" style="  margin-bottom:-3px;margin-left:10px; height:60px; width:60px;">
                </td>
                <td>
        <a href="index.php">Home</a>
                </td>
                <td>
        <a href="carlist.php">Car List</a>
                </td>
               
                <td>        
        <a href="aboutus.php">About us</a>
                </td>
                
                
                
           <?php if($_SESSION['login']){?>
        <td>
            <a href="logout.php">Sign Out</a>
        </td>
        <td><div class="dropdown">
      <button class="dropbtn">Profile</button>
      <div class="dropdown-content">
        <a href="Add-testimonials.php">Add Testimonials</a>
        <a href="My-testimonials.php">My Testimonials</a>
        <a href="bookings.php">My Bookings</a>
      </div>  </div></td> 
            <?php } else { ?>
                <td>
                <a href="login.php">Sign in</a>
            </td>
            <?php } ?>
          
         </td>
                <td> 
           <form action="search.php" method="post" >
            
            <input type="text" placeholder="Search-here..." name="searchdata" id="search-value" 
             style =" width:250px;" required="true">
                </td> 
                 <td>
            <button type="submit" style=" padding: 12px 12px 10px 10px ;   margin-left:2px; margin-bottom:15px; border-radius:5px;">
            <i class="fa fa-search" aria-hidden="true"  ></i> Search</button>
  
          </form>
    </td>
    </table>
    </nav>
    </div>
         </centre>