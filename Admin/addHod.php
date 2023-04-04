<?php
 session_start();
 $type='adm';
 $Ptype='SUB';
 include '../session.php';
?>

<!DOCTYPE html>
<html>
<title>Add Teacher</title>
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
	  printform("cse","");
  }	

  
function handleform()
 { 
   GLOBAL $msg;
   $dept=$_POST['dept'];
   $name=$_POST['name'];
   if($name=='none')
   {
	  printform($dept,"");  
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
 	 $qry="UPDATE hod SET email='$name' WHERE dept='$dept' ";
	 if($result=mysqli_query($db,$qry))
	  {
		  $msg="Assigned HOD POST in $dept department";
	  }
	  else
	  {
		  $msg="Unable to SELECT HOD ";
	  }
	}
   
      printform($dept,$name);
   }
  }  
 
function printform($dept,$name)
{
    GLOBAL $msg;
	include 'Header.php';
    echo<<<_DONE

    <img class=" w3-image " src="../Images/3.jpg" >
    <div class="w3-container w3-maincontent" align="center" width="100%">
        <table align="right" border="" style="background-color:#36edf4;font-size:22px;border-width: 10px;border-style: solid;border-color: #009688;">
            <tr style="color:#0056ff;background-color:#111111;font-size:24px;">
                <th style='padding: 5px;text-align: center;'>Department</th>
                <th style='padding: 5px;'>HOD</th>
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
                $qry="SELECT hod.dept,teacher.name from hod LEFT JOIN teacher ON hod.email=teacher.email;";
                if($result=mysqli_query($db,$qry))
                    {
                        $n=1;
                        while($data=mysqli_fetch_array($result))
                        {
                            $deptName[$n]=$data['dept'];
                            $tname[$n]=$data['name'];
                            $n++;
                            
                        }
                    }
                    else
                    {
                        $msg="Unable to get Department HOD details";
                    }            
                for($k=1;$k<$n;$k++)
                {
                    echo"<tr>
                            <td style='padding: 5px;text-align: center;text-transform: capitalize;'>$deptName[$k]</td>
                            <td style='padding: 5px;'>$tname[$k]</td>
                        </tr>";
                }
            }
           
echo<<<_DONE
        </table>    

        <form  method="post" action="$_SERVER[PHP_SELF]">
            <table class="w3-back-table">
                <caption class="w3-caption">SELECT HOD DETAILS<br /><h3 class="w3-msg">$msg<h3 /></caption>
                <tbody class="w3-mytable-form">
                    <tr>
                        <td> Department :     </td>
                        <td>
                            <select name="dept" onchange="Echanged(this.form)">
                                            
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
                                        }
                                    }
                                }
                            }

echo<<<_DONE
                    </select><br/><br /></td></tr>                                                                        
                <tr>
                    <td> Teacher name :    </td>
                    <td>
                        <select id="techSelect" name="name">
                            <option value="none" >SELECT</option>
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
            if($data['email']==$name)
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
                            </select><br/><br />
                        </td>
                    </tr>                                               
                    <tr>
                        <td> <input type='hidden' name='_handle_' value='1' /> </td>   
                        <td> <input type='submit' name='Submit' value='submit' style='background-color:#00ff00;' />  </td>
                    </tr>
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
<script>
function Echanged(form)
{
	form.techSelect.selectedIndex=0;
	form.submit();
}
</script>
</body>
</html>
