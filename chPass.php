<?php
 session_start();
    include 'dbDetails.php';

	GLOBAL $type;
	GLOBAL $Ptype;
    $db=mysqli_connect($host,$duser,$dpaswd,$dname);
    if(!$db)
    {
    	$msg="Unable to connect to database:";
    }
    else
    {
		$qry="SELECT type FROM logs WHERE id='{$_SESSION['s-id']}'";
				if($result=mysqli_query($db,$qry))
				{
					$data=mysqli_fetch_array($result);
				    $type=$data['type'];
				}
				else
				{
					session_destroy();
				}
	}
	$Ptype="SUP";
 include 'session.php';
        
echo"

<!DOCTYPE html>
<html>
<title>";
if($type=="adm")
{
	echo"ADMIN PAGE";
}
if($type=="tech")
{
	echo"TEACHER PAGE";
}
if($type=="stud")
{
	echo"STUDENT PAGE";
}
echo"
</title>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<link rel='stylesheet' href='Css/proerp.css'>
<body>";
GLOBAL $msg;


if(isset($_POST['_handle_']))
  {
    handleform($type,$Ptype);
  }
  else
  {
	  $status="disabled";
	  printform("","","","",$type,$Ptype,$status);
  }
function handleform($type,$Ptype)
{
 GLOBAL $msg;
 
   $Opass=$_POST['Opass'];
   $status=$_POST['status'];
   $Npass="";
   $Cpass="";
   if($status!="disabled")
   {
   $Npass=$_POST['Npass'];
   $Cpass=$_POST['Cpass'];
   }
   
    include 'dbDetails.php';
    $db=mysqli_connect($host,$duser,$dpaswd,$dname);
    if(!$db)
    {
    	$msg="Unable to connect to database:";
    }
    else
    {
		if(empty($Opass))
         {
	        $msg="! Please First Enter Old Password";
         }
        else
         {
	        if($status=="disabled")
             {
			    $qry="SELECT pass FROM logs WHERE id='{$_SESSION['s-id']}'";
				if($result=mysqli_query($db,$qry))
				{
					$data=mysqli_fetch_array($result);
					if($Opass==$data['pass'])
				     {
						 $status="";
	                     $msg=" Confirmed  Password";
                     }
                    else
                     {
						 $msg="! Incorrect Old Password";
					 }
						
				}
				else
				{
	              $msg="! Unable to connect to database";
				}
			 }
			 else
			 {
				  if(empty($Npass))
				  {
					  $msg="! Enter New Password First";
				  }
				  else
				  {
				     if(empty($Cpass))
				      {
	                     $msg="! Enter Confirmation Password first";
				      }
					  else
					  {
						  if($Cpass!=$Npass)
						  {
							  $msg="!Unmatched Confirmation Password ";
						  }
						  else
						  {
							  $qry="UPDATE logs SET pass='$Npass' WHERE id='{$_SESSION['s-id']}'";
				              if($result=mysqli_query($db,$qry))
				                {
									$msg="Password Changed Successfuly";
								}
							  else
				                {
	                               $msg="! Unable to Change database";
				                }
						  }
					  }
				  }
				  
             
			 }
		 }
	}
	   
   
   
printform($msg,$Opass,$Npass,$Cpass,$type,$Ptype,$status);
}




function printform($msg,$Opass,$Npass,$Cpass,$type,$Ptype,$status)
{
if($type=="adm")
{
	include 'Admin/Header.php';
	echo"<img class=' w3-image ' src='Images/3.jpg' >";
}	
if($type=="tech")
{
	include 'Teacher/Theader.php';
}
if($type=="stud")
{
	include 'Student/Sheader.php';
}

echo<<<_DONE
</div>
<div class="w3-container w3-maincontent" style='left:50px;' width="100%">
<form method="post" action="$_SERVER[PHP_SELF]">
  <table class="w3-back-table" align="center">
   <caption class="w3-caption">CHANGE PASSWORD<br /><h3 class="w3-msg"> $msg</h3></caption>
   <tbody class="w3-mytable-form">
    <tr><td>Old Password    </td><td>: <input  type="password"  name="Opass" value="$Opass"/><br />
_DONE;

             if((!empty($_POST['_handle_']))&&(empty($Opass)||(empty($Npass)&&empty($Cpass))))
               {echo"<h3 class='w3-msg'>".$msg."</h3>";}
             else
			 {
				 echo"<br />";
			 }
                       
echo<<<_DONE
</td></tr>
    <tr><td>New Password    </td><td>: <input  type="password"  name="Npass" 
_DONE;
if($status!="disabled"){echo" value='$Npass'";} 
	echo<<<_DONE
	$status/><br />
_DONE;

             if((!empty($_POST['_handle_']))&&(!empty($Opass))&&(!(empty($Npass)&&empty($Cpass)))&&empty($Npass))
               {echo"<h3 class='w3-msg'>".$msg."</h3>";}
             else
			 {
				 echo"<br />";
			 }
                       
echo<<<_DONE
</td></tr>
    <tr><td>Confirm New Password</td><td>: <input  type="password"  name="Cpass" 
_DONE;
if($status!="disabled"){echo" value='$Cpass'";} 
	echo<<<_DONE
	$status /><br />
_DONE;

             if((!empty($_POST['_handle_']))&&(!empty($Opass))&&(!(empty($Npass)&&empty($Cpass)))&&(!empty($Npass)))
               {echo"<h3 class='w3-msg'>".$msg."</h3>";}
             else
			 {
				 echo"<br />";
			 }
                       
echo<<<_DONE
</td></tr>
    <tr><td> <input  type="hidden" name="_handle_" value="1" />
	         <input  type="hidden" name="status" value="$status" />
   </td><td> <input  type="submit" name="submit" value="Submit" /></td></tr>
	</tbody>
	</table>
	</form>
	</div>
	</section>
	</div>
	</div>
_DONE;
	}

    include 'footer.php';
    if(!empty($msg))
    {
        echo"<div id='snackbar'>$msg</div>
            <script type='text/javascript'>showSnackbar();</script>";
    }
	?>
	


</body>
</html>

	
	
	