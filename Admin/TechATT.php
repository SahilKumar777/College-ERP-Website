<?php
 session_start();
 $type='adm';
 $Ptype='SUB';
 include '../session.php';
?>

<!DOCTYPE html>
<html>
<title>ADMIN PAGE</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../Css/proerp.css">
<body>


<?php
include 'Header.php';
?>
      <section>
        <!--<img class="mySlides" src="../Images/2.jpg" height="400" width="100%">
        <img class="mySlides" src="../Images/5.jpg"  height="400" width="100%">-->
        <img class=" w3-image " src="../Images/3.jpg" >
        <div class="w3-container w3-maincontent" align="center" width="100%">
           <form method="post" action="AaddATT.php">
            <table class="w3-back-table">
             <caption class="w3-caption"">ADD DETAILS</caption>
              <tbody class="w3-mytable-form">
               <tr><td>Department :     </td>   <td><select name="dept"> 
                                         <option value='cse' selected>Btech(CSE)</option>
                                         <option value='ece'>Btech(ECE)</option>
                                         <option value='me'>Btech(ME)</option>
                                         <option value='cve'>Btech(CIVIL)</option>
                                         <option value='mba'>MBA</option>
                                         <option value='bba'>BBA</option>
											  </select>                   <br/>Day must between (1 and 31)*</td></tr>
				<tr><td>Day  :  </td>   <td><input type="number" name="day" maxlength="10" />	</td></tr>						  
			    <tr><td> <input type='hidden' name='_handle_' value='2' />   </td> 
			        <td> <input type='submit' name='Submit' value='submit' style='background-color:#00ff00;' /></td></tr>
			  </tbody>
             </table>
            </form>			 
		</div>
		
      </section>
    </div>
</div>

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
