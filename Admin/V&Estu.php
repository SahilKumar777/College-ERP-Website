<?php
 session_start();
 $type='adm';
 $Ptype='SUB';
 include '../session.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>ADMIN PAGE</title>
<style type="text/css">
 
</style>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../Css/proerp.css">
</head>
<body>
 
 <?php
 include 'Header.php';
?>
      <section>
        <img class=" w3-image " src="../Images/3.jpg" >
		<div class="w3-container w3-maincontent" align="center" width="100%">
           <form method="post" action="VstuA.php">
            <table class="w3-back-table">
             <caption class="w3-caption">VIEW STUDENT DETAILS</caption>
              <tbody class="w3-mytable-form">
               <tr><td>Department :     </td>   <td><select name="dept"> 
                                         <option value='cse' selected>Btech(CSE)</option>
                                         <option value='ece'>Btech(ECE)</option>
                                         <option value='me'>Btech(ME)</option>
                                         <option value='cve'>Btech(CIVIL)</option>
                                         <option value='mba'>MBA</option>
                                         <option value='bba'>BBA</option>
										 </select>                   <br/><br /></td></tr>                                                                        
	           <tr><td>Semester :    </td>   <td><select name="sem">
                                                 <option value="1" selected>First</option>
                                                 <option value="2">Second</option>
                                                 <option value="3">Third</option>
                                                 <option value="4">Fourth</option>
                                                 </select>                   <br/><br /></td></tr>
               <tr><td>Name  :  </td>   <td><input type="text" name="name" maxlength="20" /><sup>*</sup>	</td></tr>						  
			   <tr><td>    </td>   <td> <input type='submit' name='Submit' value='submit' style='background-color:#00ff00;' /></td></tr>
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
