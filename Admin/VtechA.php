<?php
 // Shows List of teachers with matching name, with edit button
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
		 <div class="w3-container w3-maincontent" align="center" width="100%" ">
		<form method="post" action="TdetA.php">
            <table class="w3-back-table">
             
			 <caption class="w3-caption">
		
<?php		
		  echo"".$_POST['dept']."dept Teacher<br/><span style='font-size:18px;color:#456329;text-align:right;'>(Selecct email id to view Teacher details)</span></caption>
              <tbody class='w3-mytable-form'>";
			       $DEPT=$_POST['dept'];
			       $NAME=$_POST['name'];

			     include '../dbDetails.php';
                 
                 $db=mysqli_connect($host,$duser,$dpaswd,$dname);
                 if(!$db)
                   {
                   	$msg="Unable to connect to database:";
                   }
                 else
                 {  if(empty($_POST['name']))
					 {
			           $qry="SELECT email,name,dob,pno FROM teacher WHERE dept='$DEPT'  order by name ";
					 }
					else 
					 {
					   $qry="SELECT email,name,dob,pno FROM teacher WHERE dept='$DEPT' AND name LIKE'%$NAME%' order by name ";
					 }	
				    if(($result=mysqli_query($db,$qry)))
                     {
						 echo"<tr><th>Sno.</th><th>Student name</th><th>Father name</th><th>Date of Birth</th><th>EMAIL Id</th></tr>";
			             $s=1;
						 while($data=mysqli_fetch_array($result))
				         {echo<<<_DONE
						  <tr style="color:#993411;">
						  <td> $s </td>
						  <td> {$data['name']}</td>
					      <td> {$data['dob']}</td>
						  <td> {$data['pno']}</td>
						  <td align="center"><input type="submit" name='email' value='{$data['email']}' style='background-color:#00ff00;width:300px;' /> </td></tr>
					  
_DONE;

  
					  $s++;
			          }
					
		             
	                 }
                  else
                    {
    	             $msg="! Unable to connect to database";
                    }
				 }
				 
				 echo"</tbody>";
			    if(!(empty($msg)))
				{
			     echo"<tfoot style='background-color:#ff0000;font-size:20px;'>".$msg."</tfoot>";
				}
?>
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
	  
	  