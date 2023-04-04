<?php
 session_start();
 $type='tech';
 $Ptype='SUB';
 include '../session.php';
 if($_SESSION['hod']=='no')
 {
	 header("Location:techP.php");
          exit();
 }
?>

<!DOCTYPE html>
<html>
<title>TEACHER PAGE</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../Css/proerp.css">
<style type="text/css">
 span{color:#1c4bfc;}
</style>
<body>

<?php

$msg="";
if(!empty($_POST['_handle_']))
  {
    handleform();
  }
  else
  {
	   printform("",1,"cse","none","sess1");
  }	
  
function handleform()
 {
     GLOBAL $msg;
	 $sem="{$_POST['sem']}";
	 $dept="{$_POST['dept']}";
	 $sname="{$_POST['sname']}";
	 $sess="{$_POST['sess']}";
	 if($_POST['_handle_']=='2')
     {
		    include '../dbDetails.php';

            $db=mysqli_connect($host,$duser,$dpaswd,$dname);
            if(!$db)
             {
              	$msg="Unable to connect to database:";
             }
            else
             {
				 $qry="SELECT email FROM student WHERE dept='$dept' AND sem='$sem'";
	             if($result=mysqli_query($db,$qry))
	              { $n=1;
		            while($data=mysqli_fetch_array($result))
		             {
	                    $qry1="UPDATE s$sname SET $sess='{$_POST['R'.$n]}' WHERE email='{$data['email']}'";
		           	    if($result1=mysqli_query($db,$qry1))
	                     {
		                   $msg="Result Updated";
	                     }
	                    else
	                     {
		                    $msg="Unable to UPDATE Result";
							break;
	                     }
						 $n++;
					 }
				  }
				  else
				  {
					  $msg="Unable to UPDATE Result";
				  }
	
	         }
	 }
	 printform($msg,$sem,$dept,$sname,$sess);
 }



 function printform($msg,$sem,$dept,$sname,$sess)
 { 
   GLOBAL $msg;	 
 	    	
include 'Theader.php';
echo<<<_DONE
		<div class="w3-container w3-maincontent" align="center" width="100%">
		
		
		

<div class="" align="center" width="800%" >
     <table width="80%" align="center">
	 $msg
      <form method="post" action="$_SERVER[PHP_SELF]">
       <tr>
          <td style="align:center;font-size:20px;font-weight: bold;">DEPARTMENT</td>
          <td style="align:center;font-size:20px;font-weight: bold;">SEMESTER</td>
          <td style="align:center;font-size:20px;font-weight: bold;">SUBJECT</td>
          <td style="align:center;font-size:20px;font-weight: bold;">SESSIONAL</td>
       </tr>
       <tr>
          <td>
		      <select name="dept" onchange="Dchanged(this.form)">
										
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
										 {if($dept=="cse")
											 {
									echo"<option value='cse' selected>Btech(CSE)</option>
                                         <option value='ece'>Btech(ECE)</option>
                                         <option value='me'>Btech(ME)</option>
                                         <option value='cve'>Btech(CIVIL)</option>
                                         <option value='mba'>MBA</option>
                                         <option value='bba'>BBA</option>";
										 }
										 }
}}}}
echo<<<_DONE
               </select>
           </td>
          <td>
		      <select name="sem" onchange="Schanged(this.form)">
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
													 if($sem=="1")
                                                {
								                  echo"
                                                 <option value='1' selected>First</option>
                                                 <option value='2'>Second</option>
                                                 <option value='3'>Third</option>
												<option value='4'>Fourth</option>";}}}}
												 
											

echo<<<_DONE
</select> </td>
          <td>
		       <select id="subSelect" name="sname" onchange="this.form.submit()" >
	<option value="none" >SELECT SUBJECT</option>
_DONE;
   
    include '../dbDetails.php';
    
    $db=mysqli_connect($host,$duser,$dpaswd,$dname);
    if(!$db)
    {
    	$msg="Unable to connect to database:";
    }
    else
    {
 	 $qry="SELECT sid,sname FROM subtech WHERE email='{$_SESSION['s-id']}'AND dept='$dept' AND sem='$sem' ORDER BY sname";
	 if($result=mysqli_query($db,$qry))
	  {
		while($data=mysqli_fetch_array($result))
		{
			if($data['sid']==$sname)
			{
				echo"<option value='{$data['sid']}' selected>{$data['sname']}</option>";
			}
			else
			{
				echo"<option value='{$data['sid']}'>{$data['sname']}</option>";
			}
				 
		}
	  }
	 else
	  {
		$msg="Unable to connect to database";
	  }
	}
	
echo<<<_DONE
           </select></td>
          <td><select name="sess" onchange="this.form.submit()" >
_DONE;
		                            if($sess=="sess1")
                                      {
									    echo"<option value='sess1' selected>sessional1</option>
			                                 <option value='sess2'>sessional2</option>
			                                 <option value='sess3'>sessional3</option>
                                                 ";
									  }
									else
									  {
		                                  if($sess=="sess2")
                                           {
									         echo"<option value='sess1'>sessional1</option>
			                                      <option value='sess2' selected>sessional2</option>
			                                      <option value='sess3'>sessional3</option>
                                                 ";
									       }
									      else
									       {
											   if($sess=="sess3")
                                                {
									               echo"<option value='sess1'>sessional1</option>
			                                           <option value='sess2'>sessional2</option>
			                                           <option value='sess3' selected>sessional3</option>
                                                 ";
									             }
                                            }
									  }
	echo<<<_DONE
		</select>
		  </td><input type='hidden' name='_handle_' value='1' />
       </tr>
	  </form>
     </table>
 </div>
 </br></br>
_DONE;
 
if($sname!='none')
{
  
 echo<<<_DONE
<div>
 <table class="w3-back-table" width="80%" style="background-color: #ffe6dad9;">
 <form method="post" action="$_SERVER[PHP_SELF]">
 <tr><th>Rollno</th><th align='left'>Student Name</th><th>Max Marks</th><th>Marks Obt.</th></tr>
_DONE;


$qry="SELECT name,email FROM student WHERE dept='$dept' AND sem='$sem'";
	 if($result=mysqli_query($db,$qry))
	  { $n=1;
		while($data=mysqli_fetch_array($result))
		{
		   $qry1="SELECT $sess FROM s$sname WHERE  email='{$data['email']}' ";
	        if($result1=mysqli_query($db,$qry1))
	         {
				 $data1=mysqli_fetch_array($result1);
				 $Res=$data1[$sess];
			 }
        echo"<tr>
		       <td align='center' style='color:#4bb2e3;'>$n</td>
			   <td style='color:#bb22d7;'>{$data['name']}</td>
			   <td align='center' style='color:#f11616'>100</td>
			   <td align='center' style='color:#bb22d7'><select name='R$n' >
			       <option value='AB'>AB</option>";
				   for($i=0;$i<101;$i++)
				   {
					   if($i==$Res)
					   {
				          echo"<option value='$i' selected>$i</option>";
				       }
					   else
					   {
						   echo"<option value='$i'>$i</option>";
					   }
				   }
				   echo"</select></td></tr>";
				   $n++;
        }
      }
	
	echo<<<_DONE
	<tr>
	 <td><input type='hidden' name='dept' value='$dept' /><input type='hidden' name='sess' value='$sess' /></td>
	 <td><input type='hidden' name='sem' value='$sem' /><input type='hidden' name='sname' value='$sname' /></td>
	 <td><input type='hidden' name='_handle_' value='2' /></td>
	 <td><input type='submit' name='Submit' value='submit' style='background-color:#;' /></td>
	 </tr>
  </form>
 </table>	 
</div>
_DONE;

}
echo<<<_DONE
</div>
</section>
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


<script>
function Dchanged(form)
{
	form.subSelect.selectedIndex=0;
	form.submit();
}
function Schanged(form)
{
	form.subSelect.selectedIndex=0;
	form.submit();
}

</script>


</body>
</html>

