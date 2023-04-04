<!DOCTYPE html>
<html>
<title>STUDENT PAGE</title>
<style type="text/css">
 
</style>
<body >

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../Css/proerp.css">
<body>
   <div class="w3-sidebar w3-bar-block w3-card-2 w3-animate-left" style="display:none" id="mySidebar">
  <button class="w3-bar-item w3-button w3-large" onclick="w3_close()" style='background-color:#ff0000;'>Close &times;</button>
  <a href="ATTview.php" class="w3-bar-item w3-button" style="">View Attendance</a>
   <a href="detview.php" class="w3-bar-item w3-button">View details</a>
    <a href="#" class="w3-bar-item w3-button">Time Table</a>
  <a href="logout.html" class="w3-bar-item w3-button">logout</a>
</div>

<div zclass="w3-main" id="main"> 
   <div class="w3-teal">
      <div class="w3-teal w3-header">
          <button class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
          <div class="w3-container">
		  
            <h1>STUDENT DETAILS</h1>
			
          </div>
		  <div style="position:fixed;right:50px;top:20px;">
		  <table>
		  <tr><td align="center"><img src="../Images/3.png" height="70px" width="70px" /></td></tr>
		  <tr><td align="center">$_SESSION['name']</td></tr>
		  </table>
		  </div>
      </div>
      <section>
        <!--<img class="mySlides" src="../Images/2.jpg" height="400" width="100%">
        <img class="mySlides" src="../Images/5.jpg"  height="400" width="100%"
		>-->
        <img class=" w3-image " src="../Images/stu.jpg" >
		
        <div class="w3-container w3-maincontent" style="background-color:#00000019;text-align:center; width:100%; color:rebeccapurple;">
         
		 <div style="position:fixed;top:200px;right:100px;" >
		 <table style='background-color:#d4d2d0e8;border-style:outset;border-width:2px;padding:10px;' >
             <tbody class='w3-mytable-form'>
			    <form method='post' action='php_self'>
                <tr><th align='left'># Post Message</th></tr>   
                <tr><td align='left' width='500px' height='120px' style='background-color:#eeeeee;font-size:16px;border:1px;padding:10px;' >
				        <input type='textarea' name='Note'  value='Write Here to post' style='width:480px;height:100px;' />
					</td></tr>
                    <tr><td>
					<?php
					require_once('classes/tc_calendar.php');
					$myClendar=new tc_calendar("date1",true);
					$myClendar->setIcon("");
					$myClendar->setDate(01,03,1960);
					$myClendar->setPath("");
					$myClendar->setYearInterval(1960,2015);
					$myClendar->dateAllow('1960-01-01','2015-03-01');
					$myClendar->setSpecificDate(array("2011-14-01","2011-01-13","2011-04-25"),0,'month');
					$myClendar->setOnChange("myChanged('test')");
					$myClendar->writeScript();
					?>
					</td></tr>					
				<tr><td align='right' width='500px' height='20px' style='background-color:#;font-size:18px;padding:10px;padding-bottom:0px'>
				<input type="submit"  value="Submit"  /></td></tr>
                </form>
			  </tbody>
			</table>
		 </div>
		 
		 
		 
		 <?php
		 echo"<table style='background-color:#d8d8d8e8;border-style:outset;position:relative;left:50px;border-width:2px;padding:10px;'>";
		 for($i=1;$i<7;$i++)
		 {
            echo"<tr ><td style='background-color:#fcfdfd52;padding:10px;'><table style='background-color:#d4d2d0e8;border-style:outset;border-width:1px;padding:10px;' >
             <tbody class='w3-mytable-form'>
			 
                <tr><th align='left'># Message-$i</th><td align='right' style='font-size:16px;'>Time:</td></tr>   
                <tr><td align='left' width='700px' height='100px' style='background-color:#eeeeee;font-size:16px;border:1px;padding:10px;' colspan='2'>Sankis kdsmkfe ,mdf.d dfk</td></tr> 
				<tr><td align='right' width='700px' height='20px' style='background-color:#;font-size:18px;padding:10px;padding-bottom:0px' colspan='2'>   date:-25/04/2018</td></tr>
              </tbody>
			</table></td></tr>";
		 }
           echo"</table>"; ?>
			</div>
		
      </section>
    </div>
</div>
<script>
function myChanged(v)
{
	alert("value changed");
}

</script>

<?php
include '../footer.php';
    if(!empty($msg))
    {
        echo"<div id='snackbar'>$msg</div>
            <script type='text/javascript'>showSnackbar();</script>";
    }
?>

</body>
</html>
