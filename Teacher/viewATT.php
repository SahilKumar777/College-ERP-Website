<?php
 session_start();
 $type='tech';
 $Ptype='SUB';
 include '../session.php';
?>

<!DOCTYPE html>
<html>
<title>TEACHER PAGE</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="../Css/proerp.css" />
<body>


<?php
include 'Theader.php';
?>
        <div class="w3-container w3-maincontent" style="text-align:center; width:100%; color:rebeccapurple;">
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
			       echo"<tr><th>Name</th>";
					  
					  for($j=1;$j<32;$j++)
					   {
						 echo"<th>".$j."</th>";
					   }
					  
					  echo"</tr>";
					 
					 
					 for($i=1;$i<2;$i++)
                      {
						$qry1="SELECT  * FROM tm$i WHERE email='$email'";
					    if($result1=mysqli_query($db,$qry1))
                         {  
					      echo"<tr><th>{$_SESSION['name']}</th>";
						  
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
