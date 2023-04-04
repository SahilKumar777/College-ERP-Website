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
	  printform(1,"");
  }	

  
function handleform()
 { 
   GLOBAL $msg;
   $sem=$_POST['sem'];
   $sname=$_POST['sname'];
   $sid;
   if(($_POST['_handle2_']==1) or (empty($sname)))
	 {
		 if($_POST['_handle2_']==0)
            {
                $msg="! Name field cannot be empty *";
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
         {   $n=1;
             $dept=$_SESSION['dept'];
             $tname="subtech";
             $qry="SELECT sid FROM $tname WHERE dept='$dept' AND sem='$sem' ORDER BY sid";
            
		     if($result=mysqli_query($db,$qry))
		      { 
                
	             while($data=mysqli_fetch_array($result))
		           {
                       echo $data['sid'];
			           if($data['sid']==$n)
			            {   
				          $n++;
			            }
			           else
			            {
				          break;
			            }
			   
		            }
		       }
		      else
		       {
                   echo"Not executed";
			      $msg="Unable to connect to database subtech";
		       }

               //  $qry1="SELECT max_n FROM max_s";
		         if(1)//$result1=mysqli_query($db,$qry1))
		          {  
	                 $sid="$n";
	                 $qry2="INSERT INTO $tname(sid,sname,dept,sem) VALUES ('$sid','$sname','$dept','$sem')" ;
				     if($result2=mysqli_query($db,$qry2))
		              {
				      	 $msg="Subject Added Successfully";
                         $tsub="s$n";	
			             $qry3="CREATE TABLE `$dname`.`$tsub` ( `email` VARCHAR(40) NOT NULL ,
						                                       `sess1` VARCHAR(3) NOT NULL,
															   `sess2` VARCHAR(3) NOT NULL,
															   `sess3` VARCHAR(3) NOT NULL,
                                  						       `d1` ENUM('PP','AB') NULL DEFAULT NULL ,
															   `d2` ENUM('PP','AB') NULL DEFAULT NULL , 
															   `d3` ENUM('PP','AB') NULL DEFAULT NULL ,
															   `d4` ENUM('PP','AB') NULL DEFAULT NULL ,
															   `d5` ENUM('PP','AB') NULL DEFAULT NULL ,
															   `d6` ENUM('PP','AB') NULL DEFAULT NULL ,
															   `d7` ENUM('PP','AB') NULL DEFAULT NULL , 
															   `d8` ENUM('PP','AB') NULL DEFAULT NULL ,
															   `d9` ENUM('PP','AB') NULL DEFAULT NULL ,
															   `d10` ENUM('PP','AB') NULL DEFAULT NULL , 
															   `d11` ENUM('PP','AB') NULL DEFAULT NULL ,
															   `d12` ENUM('PP','AB') NULL DEFAULT NULL ,
															   `d13` ENUM('PP','AB') NULL DEFAULT NULL , 
															   `d14` ENUM('PP','AB') NULL DEFAULT NULL , 
															   `d15` ENUM('PP','AB') NULL DEFAULT NULL , 
															   `d16` ENUM('PP','AB') NULL DEFAULT NULL ,
															   `d17` ENUM('PP','AB') NULL DEFAULT NULL ,
															   `d18` ENUM('PP','AB') NULL DEFAULT NULL , 
															   `d19` ENUM('PP','AB') NULL DEFAULT NULL ,
															   `d20` ENUM('PP','AB') NULL DEFAULT NULL ,
															   `d21` ENUM('PP','AB') NULL DEFAULT NULL ,
															   `d22` ENUM('PP','AB') NULL DEFAULT NULL , 
															   `d23` ENUM('PP','AB') NULL DEFAULT NULL ,
															   `d24` ENUM('PP','AB') NULL DEFAULT NULL ,
															   `d25` ENUM('PP','AB') NULL DEFAULT NULL , 
															   `d26` ENUM('PP','AB') NULL DEFAULT NULL ,
															   `d27` ENUM('PP','AB') NULL DEFAULT NULL ,
															   `d28` ENUM('PP','AB') NULL DEFAULT NULL ,
															   `d29` ENUM('PP','AB') NULL DEFAULT NULL ,
															   `d30` ENUM('PP','AB') NULL DEFAULT NULL , 
															   `d31` ENUM('PP','AB') NULL DEFAULT NULL ,
															   PRIMARY KEY (`email`(40)))";
                         $result3=mysqli_query($db,$qry3);	
                         $qry4="SELECT email FROM student WHERE email NOT IN(SELECT email from $tsub) ORDER BY dept";
			             $result4=mysqli_query($db,$qry4);
			             while($data4=mysqli_fetch_array($result4))
			               {
				               $qry5="INSERT INTO $tsub(email) VALUES ('{$data4['email']}')"; 
				               $result5=mysqli_query($db,$qry5);
			               }
                         //$qry6="UPDATE max_s SET max_n='$n' WHERE col='single'";				
		                 //$result6=mysqli_query($db,$qry6);
				      }
				     else
		              {
			             $msg="Unable to connect to database";
		              }
			         $data1=mysqli_fetch_array($result1);
			        //  if($n>$data1['max-n'])
			        //   {
			             
			        //   }
			 
		          }
		         else
		          {
		        	 $msg="Unable to connect to database";
		          }		
		 
	    }
        
	}
    printform($sem,$sname);
 }	
		
 	 
function printform($sem,$sname)
 { 
    GLOBAL $msg;	 
    include 'Theader.php';

echo<<<_DONE

		<div class="w3-container w3-maincontent" align="center" width="100%">
        <table align="left" border="" style="background-color:#36edf4;font-size:22px;">
            <tr style="color:#0056ff;background-color:#111111;font-size:24px;">
                <th style='padding:8px;text-align:center;'>SUBJECT LIST</th>
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
            $qry="SELECT sname FROM subtech WHERE dept='{$_SESSION['dept']}' AND sem='$sem'  ORDER BY sname";
            if($result=mysqli_query($db,$qry))
            {
                while($data=mysqli_fetch_array($result))
                {
                    $subName=$data['sname'];
                    echo"<tr>
                            <td style='padding:8px;text-align:center;'>$subName</td>
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
                <caption class="w3-caption">ADD Subject for {$_SESSION['dept']} Department<br /><h3 class="w3-msg"> $msg</h3></caption>
                <tbody class="w3-mytable-form">
                    <tr>
                        <td>Semester :</td>
                        <td><select name="sem"  onchange="Schanged(this.form)">
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
<tr><td>Subject Name :    </td>   <td>   <input type="text" name="sname" maxlength="40" value="$sname" /><br />
</td></tr>                                               
    <tr><td>                             <input type='hidden' name='_handle_' value='1' /><input type='hidden' name='_handle2_' value='0' />
                            </td>   <td>  <input type='submit' name='Submit' value='submit' style='background-color:#00ff00;' />         </td></tr>
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
function Schanged(form)
{
	form._handle2_.value=1; 
    form.submit();	
}
</script>
</body>
</html>

