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
<body>

<?php

$msg="";

if(!empty($_POST['_handle_']))
  {
    handleform();
  }
else
  {
	  printform("1","",$_SESSION['dept'],"");
  }	

  
function handleform()
 { 
   GLOBAL $msg;
   $sem=$_POST['sem'];
   $sname=$_POST['sname'];
   $dept=$_POST['dept'];
   $tname=$_POST['tname'];
   if($sname=='none'||$tname=='none')
   { 
      if($sname=='none')
	  {
	      printform($sem,"",$dept,$tname);
	  }
      else
	  {
		  printform($sem,$sname,$dept,"");
	  }
	
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
	  $qry="UPDATE subtech SET email='$tname' WHERE sid='$sname' AND dept='{$_SESSION['dept']}' AND sem='$sem' ";                                                 
	 if($result=mysqli_query($db,$qry))
	  {
		  $msg="Assigned Given Subject to Teacher";
	  }
	  else
	  {
		  $msg="Unable to assign Subject";
	  }
	}
   
      printform($sem,$sname,$dept,$tname);
   }
   
 }
function printform($sem,$sname,$dept,$tname)
 { 
   GLOBAL $msg;	 
 	$hoddept=$_SESSION['dept'];   	
include 'Theader.php';
echo<<<_DONE
		<div class="w3-container w3-maincontent" align="center" width="100%">
        <table align="left" border="" style="background-color:#36edf4;font-size:22px;">
            <tr style="color:#0056ff;background-color:#111111;font-size:24px;">
                <th style='padding:8px;text-align:center;'>SUBJECT LIST</th>
                <th style='padding:8px;text-align:center;'>Teacher Assigned</th>
                <th style='padding:8px;text-align:center;'>Teacher Dept.</th> 
            </tr>

_DONE;

        include '../dbDetails.php';

        $db=mysqli_connect($host,$duser,$dpaswd,$dname);
        if(!$db)
         {
    	     $msg="Unable to connect to database:";
         }
        else
         {
            
            $qry="SELECT sname, name, teacher.dept from `subtech` LEFT JOIN teacher on (subtech.email=teacher.email)
                    WHERE subtech.dept='{$_SESSION['dept']}' and subtech.sem='$sem'  ORDER BY sname";
            if($result=mysqli_query($db,$qry))
            {
                while($data=mysqli_fetch_array($result))
                {
                    $subName=$data['sname'];
                    $techName = $data['name'];
                    $techDept = $data['dept'];
                    echo"<tr>
                            <td style='padding:8px;text-align:center;text-transform: capitalize;'>$subName</td>
                            <td style='padding:8px;text-align:center;text-transform: capitalize;'>$techName</td>
                            <td style='padding:8px;text-align:center;text-transform: capitalize;'>$techDept</td>
                        </tr>";
                }
            }
            else
            {
                $msg="Unable to get Subject details";
            }
         }

echo<<<_DONE

        </table>

       
         <form method="post" action="$_SERVER[PHP_SELF]">
           <table class="w3-back-table">
             <caption class="w3-caption">Assign Subject for $hoddept Department sem-$sem <br /><h3 class="w3-msg"> $msg</h3></caption>
             <tbody class="w3-mytable-form">
             <tr><td>Semester :</td>
             <td><select name="sem" onchange="Schanged(this.form)">
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
</select> <br /><br /></td></tr>
<tr><td> Subject name :    </td>   <td>
	<select id="subSelect" name="sname">
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
 	 $qry="SELECT sid,sname FROM subtech WHERE dept='$hoddept' AND sem='$sem' ORDER BY sname";
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
           </select><br/><br /></td></tr>
		   <tr><td>Teacher Department :     </td>   <td>

                                        <select name="dept" onchange="TDchanged(this.form)">
										
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
</select><br/><br /></td></tr>                                                                        
<tr><td> Teacher name :    </td>   <td>
	<select id="techSelect" name="tname">
	<option value="none" >SELECT TEACHER</option>
_DONE;


    include '../dbDetails.php';
    
    $db=mysqli_connect($host,$duser,$dpaswd,$dname);
    if(!$db)
    {
    	$msg="Unable to connect to database:";
    }
    else
    {
 	 $qry="SELECT email,name FROM teacher WHERE dept='$dept' ORDER BY name";
	 if($result=mysqli_query($db,$qry))
	  {
		while($data=mysqli_fetch_array($result))
		{
			if($data['email']==$tname)
			{
				echo"<option value='{$data['email']}' selected>{$data['name']}</option>";
			}
			else
			{
				echo"<option value='{$data['email']}'>{$data['name']}</option>";
			}
				 
		}
	  }
	 else
	  {
		$msg="Unable to connect to database";
	  }
	}
	
echo<<<_DONE
           </select><br/><br /></td></tr>                                               
                     <tr><td>         <input type='hidden' name='_handle_' value='1' />                                              </td>   
					 <td>             <input type='submit' name='Submit' value='submit' style='background-color:#00ff00;' />         </td></tr>
</tbody>
</table>   
</form>
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
function TDchanged(form)
{
	form.techSelect.selectedIndex=0;
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

