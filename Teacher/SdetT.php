<?php
 session_start();
 $type='tech';
 $Ptype='SUB';
 include '../session.php';
?>

<!DOCTYPE html>
<html>
<title>TEACHER PAGE</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../Css/proerp.css">
<style>
span{color:#1c4bfc;}

</style>
<body>



<?php
include 'Theader.php';
?>
        <div class="w3-container w3-maincontent" align="center" width="100%" ">
		  <form method="post" action="">
            <table class="w3-back-table">
             
			 <caption class="w3-caption">Student details</caption>
              <tbody class="w3-mytable-form">  
              
<?php			 
                  
                 include '../dbDetails.php';
                 
                 $db=mysqli_connect($host,$duser,$dpaswd,$dname);
                 if(!$db)
                   {
                   	$msg="Unable to connect to database:";
                   }
                 else
                 { $email=$_POST['email']; 
			      $qry="SELECT  * FROM student WHERE email='$email' ";
				   if($result=mysqli_query($db,$qry))
				   {
					   $data=mysqli_fetch_array($result);
				        echo<<<_DONE
				        <tr><td>Student Name     </td><td>: <span id='text_det'>{$data['name']}    </span></td></tr>
				        <tr><td>Father Name      </td><td>: <span id='text_det'>{$data['fname']}   </span></td></tr>
				        <tr><td>Date of birth    </td><td>: <span id='text_det'>{$data['dob']}     </span></td></tr>
				        <tr><td>Gender           </td><td>: <span id='text_det'>{$data['gender']}  </span></td></tr>
				        <tr><td>Phone no         </td><td>: <span id='text_det'>{$data['pno']}     </span></td></tr>
				        <tr><td>Email id         </td><td>: <span id='text_det'>{$data['email']}   </span></td></tr>
				        <tr><td>Branch           </td><td>: <span id='text_det'>{$data['dept']}    </span></td></tr>
				        <tr><td>Qualification    </td><td>: <span id='text_det'>{$data['qual']}    </span></td></tr>
						<tr><td>Address          </td><td>: <span id='text_det'>{$data['addr']}    </span></td></tr>
						
						
_DONE;
			           }
					else
                    {
    	             $msg="! Unable to connect to database";
				 }}
					
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
