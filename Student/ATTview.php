<?php
 session_start();
 $type='stud';
 $Ptype='SUB';
 include '../session.php';
?>


<!DOCTYPE html>
<html>
<title>STUDENT PAGE</title>
<style type="text/css">
  
</style>
<body >
<?php
include 'Sheader.php'; 
?>

          <form method="post" action="">
            <table class="w3-back-table" style="">
             <caption class="w3-caption">Attendence</caption>
             <tbody class="w3-mytable-form">  
              
<?php			 
                 
				 $email=$_SESSION['s-id']; 
                 
                 include '../dbDetails.php';
                 
                 $db=mysqli_connect($host,$duser,$dpaswd,$dname);
                 if(!$db)
                   {
                   	$msg="Unable to connect to database:";
                   }
                 else
                 {  
                    
			       echo"<tr><th>Subject</th>";
					  
					  for($j=1;$j<32;$j++)
					   {
						 echo"<th>".$j."</th>";
					   }
					  
					  echo"</tr>";
					  
					  
					$subT="subtech";
	                $qry="SELECT sname FROM $subT WHERE dept='{$_SESSION['dept']}' AND sem='{$_SESSION['sem']}' ORDER BY sid";
	                if($result=mysqli_query($db,$qry))
	                 {
		               $n=1;
		               while($data=mysqli_fetch_array($result))
		                {
			                $sname[$n]=$data['sname'];
			                $n++;
		                }
	                  }
	                else
	                  {
		                 $msg="Unable to get Subject details";
	                  }  
					 
					 
					 for($i=1;$i<$n;$i++)
                      {
						$qry1="SELECT  * FROM s$i WHERE email='$email'";
					    if($result1=mysqli_query($db,$qry1))
                         {  
					      echo"<tr><td>$sname[$i]</td>";
						  
						  $data1=mysqli_fetch_array($result1);
			               for($k=1;$k<32;$k++)
						   {
							$att=$data1['d'.$k];
							if($att=='PP')
					         { 
						      echo"<td style='color:#00ff00;'>$att</td>";
							 }
							else
							 { if($att=='AB')
								{echo"<td style='color:#ff0000;'>$att</td>";}
							   else
							    {echo"<td>$att</td>";}
							 }
						   }
						  echo"</tr>";
					     }
					    else
						 {
							echo"Unable to connect to database!!!";
					        break;
					     }
					  }
				   

				 }
			  
?>			  
			  
			  
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
