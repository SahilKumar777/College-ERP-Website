<?php
 session_start();
 $type='adm';
 $Ptype='SUB';
 include '../session.php';
?>

<!DOCTYPE html>
<html>
<title>Update Student Details</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../Css/proerp.css">
<body>
<?php

$msg="";
if($_POST['Delete']!="delete")
{$_POST['Delete']="no";}

if((!empty($_POST['_handle_']))&&($_POST['Delete']!="delete"))
  {
    handleform();
  }

  
  
if($_POST['Delete']=="delete")
  {
	   include '../dbDetails.php';

       $db=mysqli_connect($host,$duser,$dpaswd,$dname);
       if(!$db)
        {
           $msg="Unable to connect to database:";
        }
       else
	    {   
	        $email=$_POST['email'];
			$qry="DELETE FROM student WHERE email='$email' ";
		    if($result=mysqli_query($db,$qry))
			 { 
		      printform("","","","","","","","","","");
		      echo"<script>window.alert('Student Record Deleted Sucessfully');
			               window.location.href='adminP.php';
				  </script>";
		      }
			else
             {
    	       $msg="! Unable to Delete Record";
		     }
	    }
  }

  
  
  
  function handleform()
 { GLOBAL $msg;
   if($_POST['_handle_']!="1")
     {
		include '../dbDetails.php';

        $db=mysqli_connect($host,$duser,$dpaswd,$dname);
         if(!$db)
          {
            $msg="Unable to connect to database:";
          }
         else
          { $email=$_POST['_handle_']; 
			$qry="SELECT  * FROM student WHERE email='$email' ";
		    if($result=mysqli_query($db,$qry))
			 { 
			  $data=mysqli_fetch_array($result);
	          $name=$data['name'];
              $fname=$data['fname'];
              $dob=$data['dob'];
              $gender=$data['gender'];
              $pno=$data['pno'];
              $email=$data['email'];
              $dept=$data['dept'];
              $sem=$data['sem'];
              $qual=$data['qual'];
              $addr=$data['addr'];   

             }
		    else
             {
    	       $msg="! Unable to connect to database";
		     }}
            

      }
   else
   {
   $name=$_POST['name'];
   $fname=$_POST['fname'];
   $dob=$_POST['dob'];
   $gender=$_POST['gender'];
   $pno=$_POST['pno'];
   $dept=$_POST['dept'];
   $sem=$_POST['sem'];
   $qual=$_POST['qual'];
   $addr=$_POST['addr'];
   $email=$_POST['email'];
 	if(empty($name)||empty($fname)||empty($dob)||empty($gender)||empty($pno)||empty($qual)||empty($addr))
 	 {
 	 	if(empty($name))
 	     {
		 $msg="! Name  field cannot be empty *";}
 	     	else
 	     	 {
		if(empty($fname))
 	     {
		 $msg="! Fathers Name  field cannot be empty *";}
 	     	else
 	     	 {
 	 	if(empty($dob))
 	     {
		 $msg="! Date of birth field cannot be empty *";}
 	     	else
 	     	 {
 	 	if(empty($gender))
 	     {
		 $msg="! Gender  field cannot be empty *";}
 	     	else
 	     	 {
 	 	if(empty($pno))
 	     {
		 $msg="! Phone no field cannot be empty *";}
 	     	else
 	     	 {
	    if(empty($qual))
 	     {
		 $msg="! Qualification field cannot be empty *";}
 	     	else
 	     	 {
 	 	if(empty($addr))
 	     {
		 $msg="! Address field cannot be empty *";}
 	     	
			 }}}}}}	


 	 }
    else
     {

 	include '../dbDetails.php';
     
    $db=mysqli_connect($host,$duser,$dpaswd,$dname);
    if(!$db)
    {
    	$msg="Unable to connect to database:";
    }
    else
    {
 	 $qry1="UPDATE student SET name='$name',fname='$fname',dob='$dob',gender='$gender',pno='$pno',dept='$dept',sem='$sem',qual='$qual',addr='$addr' WHERE email='$email'";
	 
    if($result1=mysqli_query($db,$qry1))
     {  
		$msg="Student Record updated successfully"; 
	}
    else
    {
    	$msg="! Unable to update record";
    }
   }
   }
   }
  printform($name,$fname,$dob,$gender,$pno,$qual,$addr,$dept,$sem,$email);
  }  
 
function printform($name,$fname,$dob,$gender,$pno,$qual,$addr,$dept,$sem,$email)
{GLOBAL $msg;
	include 'Header.php';
echo<<<_DONE

<img class=" w3-image " src="../Images/3.jpg" >
<div class="w3-container w3-maincontent" align="center" width="100%">
<form method="post" action="$_SERVER[PHP_SELF]">
  <table class="w3-back-table">
   <caption class="w3-caption">UPDATE DETAILS<br /><h3 class="w3-msg"> $msg</h3></caption>
   <tbody class="w3-mytable-form">
    <tr><td>Student Name :    </td>   <td> <input type="text" name="name" maxlength="40" value="$name" /><br />
_DONE;

             if((!empty($_POST['_handle_']))&&($_POST['Delete']!="delete")&&empty($name))
               {echo"<h3 class='w3-msg'>".$msg."</h3>";}
             else
			 {
				 echo"<br />";
			 }
                       
echo<<<_DONE
 </td></tr>   <tr><td>Father Name :    </td>   <td> <input type="text" name="fname" maxlength="40" value="$fname" /><br />
_DONE;

             if((!empty($_POST['_handle_']))&&($_POST['Delete']!="delete")&&(!empty($name))&&empty($fname))
               {echo"<h3 class='w3-msg'>".$msg."</h3>";}
             else
			 {
				 echo"<br />";
			 }
                       
echo<<<_DONE
 </td></tr>   <tr><td>DOB(yyyy-mm-dd) :  </td>
                            <td><input type="text" name="dob" value="$dob" /><br />
_DONE;


             if((!empty($_POST['_handle_']))&&($_POST['Delete']!="delete")&&(!empty($name))&&(!empty($fname))&&empty($dob))
               {echo"<h3 class='w3-msg'>".$msg."</h3>";}
             else
			 {
				 echo"<br />";
			 }		   
echo"</td></tr><tr><td> Gender :          </td><td>Male";

   
  if($gender=="F")
  { 
    echo" <input type='radio' name='gender' value='M' /> 
  Female<input type='radio' name='gender' value='F' checked /></br>";
  }
  else
  {
   echo"<input type='radio' name='gender' value='M' checked /> 
  Female<input type='radio' name='gender' value='F' /></br>";
  }
             if((!empty($_POST['_handle_']))&&($_POST['Delete']!="delete")&&(!empty($name))&&(!empty($fname))&&(!empty($dob))&&empty($gender))
               {echo"<h3 class='w3-msg'>".$msg."</h3>";} 
             else
			 {
				 echo"<br />";
			 }
echo<<<_DONE
   </td></tr><tr><td> Mobile No :     </td>   <td>
<input type="text" name="pno" maxlength="10" value="$pno" /><br />
_DONE;

   
            
			if((!empty($_POST['_handle_']))&&($_POST['Delete']!="delete")&&(!empty($name))&&(!empty($fname))&&(!empty($dob))&&(!empty($gender))&&empty($pno))
	           {echo"<h3 class='w3-msg'>".$msg."</h3>";}  
            else
			 {
				 echo"<br />";
			 }			 	   
echo<<<_DONE
</td></tr>      <tr><td> Department :     </td>   <td>

                                        <select name="dept">
_DONE;







										 if($dept=="ece")
										 {
									echo"<option value='cse'>Btech(CSE)</option>
                                         <option value='ece'selected>Btech(ECE)</option>
                                         <option value='me'>Btech(ME)</option>
                                         <option value='cve'>Btech(CIVIL)</option>
                                         <option value='mba'>MBA</option>
                                         <option value='bba'>BBA</option>";
										 }
										 else
										 {if($dept=="me")
										 {
									echo"<option value='cse' >Btech(CSE)</option>
                                         <option value='ece'>Btech(ECE)</option>
                                         <option value='me' selected>Btech(ME)</option>
                                         <option value='cve'>Btech(CIVIL)</option>
                                         <option value='mba'>MBA</option>
                                         <option value='bba'>BBA</option>";
										 }
										 else
										 {if($dept=="cve")
										 {
									echo"<option value='cse' >Btech(CSE)</option>
                                         <option value='ece'>Btech(ECE)</option>
                                         <option value='me'>Btech(ME)</option>
                                         <option value='cve' selected>Btech(CIVIL)</option>
                                         <option value='mba'>MBA</option>
                                         <option value='bba'>BBA</option>";
										 }
										 else
										 {if($dept=="mba")
										 {
									echo"<option value='cse' >Btech(CSE)</option>
                                         <option value='ece'>Btech(ECE)</option>
                                         <option value='me'>Btech(ME)</option>
                                         <option value='cve'>Btech(CIVIL)</option>
                                         <option value='mba' selected>MBA</option>
                                         <option value='bba'>BBA</option>";
										 }
										 else
										 {if($dept=="bba")
										 {
									echo"<option value='cse' >Btech(CSE)</option>
                                         <option value='ece'>Btech(ECE)</option>
                                         <option value='me'>tech(ME)</option>
                                         <option value='cve'>Btech(CIVIL)</option>
                                         <option value='mba'>MBA</option>
                                         <option value='bba' selected>BBA</option>";
										 }
										 else
										 {
									echo"<option value='cse' selected>Btech(CSE)</option>
                                         <option value='ece'>Btech(ECE)</option>
                                         <option value='me'>Btech(ME)</option>
                                         <option value='cve'>Btech(CIVIL)</option>
                                         <option value='mba'>MBA</option>
                                         <option value='bba'>BBA</option>";
										 }
										 
}}}}


                                










							
echo<<<_DONE

</select><br/><br /></td></tr> 
<tr><td>Semester :</td>

<td><select name="sem">
_DONE;
                                              if($sem=="2")
                                                {echo"
                                                 <option value='1' >First</option>
                                                 <option value='2' selected>Second</option>
                                                 <option value='3'>Third</option>
												<option value='4'>Fourth</option>";}
												 else
												 {
													 if($sem=="3")
                                                {echo"
                                                 <option value='1'>First</option>
                                                 <option value='2'>Second</option>
                                                 <option value='3' selected >Third</option>
												<option value='4'>Fourth</option>";}
												 else
												 {
													 if($sem=="4")
                                                {echo"
                                                 <option value='1'>First</option>
                                                 <option value='2'>Second</option>
                                                 <option value='3'>Third</option>
												<option value='4' selected>Fourth</option>";}
												 else
												 {
								                  echo"
                                                 <option value='1' selected>First</option>
                                                 <option value='2'>Second</option>
                                                 <option value='3'>Third</option>
												 <option value='4'>Fourth</option>";}}}
												 
											

echo<<<_DONE
</select> <br /><br /></td></tr>                                                                      

	<tr><td> Qualification :    </td>   <td>

	<input type="text" name="qual" maxlength="40" value="$qual" /><br />
_DONE;
	
	
	                 if((!empty($_POST['_handle_']))&&($_POST['Delete']!="delete")&&(!empty($name))&&(!empty($fname))&&(!empty($dob))&&(!empty($gender))&&(!empty($pno))&&empty($qual))
	                   {echo"<h3 class='w3-msg'>".$msg."</h3>";}
                     else
			         {
                       echo"<br />";
			         }				   
echo<<<_DONE
   </td></tr>                                                  
    <tr><td> Address :    </td>   <td>
	<input type="text" name="addr" maxlength="50" value="$addr" /> <br />
_DONE;
  

                      if((!empty($_POST['_handle_']))&&($_POST['Delete']!="delete")&&(!empty($name))&&(!empty($fname))&&(!empty($dob))&&(!empty($gender))&&(!empty($pno))&&(!empty($qual))&&empty($addr))
                      {echo"<h3 class='w3-msg'>".$msg."</h3>";}
				      else
			          {
				       echo"<br />";
					  }
echo<<<_DONE
					  </td></tr>                                               
    <tr><td>                             <input type='hidden' name='_handle_' value='1' />
	                                     <input type='hidden' name='email' value="$email" />
                                         <input type='submit' name='Delete' value='delete' style='background-color:#ff0000;' />                                               
						   </td>   <td>  <input type='submit' name='Submit' value='Update' style='background-color:#00ff00;' />         </td></tr>
</tbody>
</table>   
</form>
</div>
</div>
_DONE;

}
include '../footer.php';
    if(!empty($msg))
    {
        echo"<div id='snackbar'>$msg</div>
            <script type='text/javascript'>showSnackbar();</script>";
    }
?>

</body>
</html>
