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
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="../Css/proerp.css"/>
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
                    printform("1","none","");
                }	
            
            function handleform()
            { 
                GLOBAL $msg,$string;
                $dept=$_SESSION['dept'];
                $handle=$_POST['_handle_'];
                $sem=$_POST['sem'];
                $action=$_POST['action1'];
                $string;

                include '../dbDetails.php';

                $db=mysqli_connect($host,$duser,$dpaswd,$dname);
                
                if(!$db)
                {
                    $msg="Unable to connect to database:";
                }
                else
                { 

                    if($handle=='1')
                    {
                        if($action=='delete')
                        {
                            $qry1="UPDATE  tt SET L1=0 ,L2=0 ,L3=0,L4=0,L5=0,L6=0,L7=0,L8=0  WHERE dept='$dept' AND sem='$sem' "; 
                            if($result1=mysqli_query($db,$qry1))
                            {
                                $msg="Time Table Successfully Deleted";
                            }
                            else 
                            {
                                $msg="Unable To Delete Time table";  
                            }
                        }
                        
                    }
                    else
                    {
                        $qry="SELECT lec_n,mon,tue,wed,thur,fri,sat,sun FROM TTF WHERE dept='$dept' AND sem='$sem'";
                        if($result=mysqli_query($db,$qry))
                        {
                            $data=mysqli_fetch_array($result);
                            $nday[1]=$data['mon'];
                            $nday[2]=$data['tue'];
                            $nday[3]=$data['wed'];
                            $nday[4]=$data['thur'];
                            $nday[5]=$data['fri'];
                            $nday[6]=$data['sat'];
                            $nday[7]=$data['sun'];
                            $nLec=$data['lec_n'];

                            
                            for($lecs=1;$lecs<=$nLec;$lecs++)
                            { 
                                if($lecs==$nLec)
                                {
                                    $qlec .="L$lecs";
                                }
                                else
                                {
                                    $qlec .="L$lecs,"; 
                                }
                            }
                    
                        }

                        $qry="SELECT $qlec FROM tt WHERE dept='$dept' AND sem='$sem' ";
                    
                        if($result=mysqli_query($db,$qry))
                        {
                            if($data=mysqli_fetch_array($result))
                            {
                                $detExist=true; //details of dept and sem exist
                            }
                            else
                            {
                                $detExist=false; //details of dept and sem don't exist
                            }
                        }
                
                        for($i=1;$i<=7;$i++)
                        { 
                            if($nday[$i]==0)
                            {
                                continue;
                            }
                            
                            $string="";

                            for($j=1;$j<=$nLec;$j++)
                            {
                                $TT['a'.$i.$j]=$_POST['TT'.$i.$j];
                                if($j==$nLec)
                                {
                                    if($detExist)
                                    {
                                        $string .="L$j='{$TT['a'.$i.$j]}'";
                                    }
                                    else
                                    {
                                        $string .="'{$TT['a'.$i.$j]}'";
                                    }
                                }
                                else
                                {
                                    if($detExist)
                                    {
                                        $string .=" L$j='{$TT['a'.$i.$j]}' ,";
                                    }
                                    else
                                    {
                                        $string .="'{$TT['a'.$i.$j]}',";
                                    }
                                }
                            }

                            
                            
                            if($detExist)
                            {
                                $qry="UPDATE tt SET $string WHERE dept='$dept' AND sem='$sem' AND dno='d$i'";
                                if($result=mysqli_query($db,$qry))
                                {
                                    $msg=" Updated TT details sucessfully";
                                }
                                else
                                {
                                    $msg="Unable to Update TT details";
                                }
                            }
                            else
                            {
                                $qry="INSERT INTO tt(`dept`, `sem`, `dno`, `L1`, `L2`, `L3`, `L4`, `L5`, `L6`, `L7`, `L8`) 
                                            VALUES ('$dept', '$sem', 'd$i', $string)";
                                if($result=mysqli_query($db,$qry))
                                {
                                    $msg=" Updated TT details sucessfully";
                                }
                                else
                                {
                                    $msg="Unable to Update TT details";
                                }
                                
                            }
    
                        }
                    }
                    
       
                }
                printform($sem,$action,$msg);  
            } 
            

            function printform($sem,$action,$msg)
            { 
                GLOBAL $msg;	 
                $dept=$_SESSION['dept'];  // Department name  	
                include 'Theader.php';
                echo<<<_DONE
                    <div class="w3-container w3-maincontent" align="center" width="100%">
                	    <div class="" align="center" width="80%" style="margin-bottom:20px">
                            <form method="post" action="$_SERVER[PHP_SELF]">
                                <table width="80%" align="center"> 
                                <caption>$msg</caption>
                                    <tr>
                                        <td style="align:center;font-size:20px;">SEMESTER</td>
                                        <td style="align:center;font-size:20px;">Action</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select name="sem" onchange="Schanged(this.form)">
_DONE;
                                                echo"
                                                <option value='1' "; if($sem=='1'){echo"selected";} echo">First</option>
                                                <option value='2' "; if($sem=='2'){echo"selected";} echo">Second</option>
                                                <option value='3' "; if($sem=='3'){echo"selected";} echo">Third</option>
                                                <option value='4' "; if($sem=='4'){echo"selected";} echo">Fourth</option>";
                                     

                                        echo"
                                            </select>
                                        </td>
                                        <td>
                                            <select id='actSelect' name='action1' onchange='this.form.submit()' >
                                                <option value='none' ";   if($action=='none'){echo"selected";} echo">Select</option>
                                                <option value='view' ";   if($action=='view'){echo"selected";} echo">View</option>
                                                <option value='edit' ";   if($action=='edit'){echo"selected";} echo">Edit</option>
                                                <option value='delete' "; if($action=='delete'){echo"selected";} echo">Delete</option>
                                            </select>
		                                </td>
                                        <input type='hidden' name='_handle_' value='1' />
                                    </tr>
                                </table>    
                            </form>
                            
                        </div>";

                


                STATIC $n;
                
                include '../dbDetails.php'; // database Details
                
                $db=mysqli_connect($host,$duser,$dpaswd,$dname);
                if(!$db)
                {
                    $msg="Unable to connect to database:";
                }
                else
                {

                    if($action=='delete' or $action=="none")
                    {
                        echo<<<_DONE
         
                        <table align="left" border="" style="background-color:#36edf4;font-size:22px;">
                        
                        <tr style="color:#0056ff;background-color:#111111;font-size:24px;">
                        <th>SUBJECT</th>
                        <th>TEACHER</th>
                        </tr>
                        _DONE;

                        $qry="SELECT sid,sname,subtech.email,name FROM subtech,teacher 
                            WHERE subtech.email=teacher.email AND subtech.dept='$dept' AND sem='$sem'  ORDER BY sname";
                        if($result=mysqli_query($db,$qry))
                        {
                            while($data=mysqli_fetch_array($result))
                            {
                                $sname=$data['sname'];
                                $tname=$data['name'];
                                
                                echo"<tr>
                                        <td>$sname</td>
                                        <td>$tname</td>
                                    </tr>";
                            }
                            echo"</table>";
                        }
                        else
                        {
                            $msg="Unable to get Subject details";
                        }

                        if($action=='delete')
                        {
                            echo"<table class='w3-back-table'>
                                    <caption class='w3-caption'> $dept Department Sem-$d Time Table <br/></caption>
                                        <tr><td>$msg</td></tr>
                                </table>"; 
                        }       		 
                    }
                    else
                    {
                        $qry="SELECT lec_n,mon,tue,wed,thur,fri,sat,sun FROM TTF WHERE dept='$dept' AND sem='$sem' ";
                        if($result=mysqli_query($db,$qry))
                        {
                            
                            if($data=mysqli_fetch_array($result))
                            {
                                $nday[1]=$data['mon']; 
                                $nday[2]=$data['tue'];
                                $nday[3]=$data['wed'];
                                $nday[4]=$data['thur'];
                                $nday[5]=$data['fri'];
                                $nday[6]=$data['sat'];
                                $nday[7]=$data['sun'];
                                $nLec=$data['lec_n']; //Number of lectures in a day
                            }
                            else
                            {
                                $qry="INSERT INTO `TTF` (`lec_n`, `mon`, `tue`, `wed`, `thur`, `fri`, `sat`, `sun`, `dept`, `sem`)
                                                         VALUES ('8', '1', '1', '1', '1', '1', '1', '0', '$dept', '$sem')";
                                if($result=mysqli_query($db,$qry))
                                {
                                    $nday[1]=1;
                                    $nday[2]=1;
                                    $nday[3]=1;
                                    $nday[4]=1;
                                    $nday[5]=1;
                                    $nday[6]=1;
                                    $nday[7]=0;
                                    $nLec=8;
                                }
                            }
                    
                        }
                        else
                        {
                            $msg="Unable to get TimeTable details";
                        }
                
                
                        $qry="SELECT sid,sname,subtech.email,name FROM subtech,teacher 
                            WHERE subtech.email=teacher.email AND subtech.dept='$dept' AND sem='$sem'  ORDER BY sname";
                        if($result=mysqli_query($db,$qry))
                        {
                            $n=1;
                            while($data=mysqli_fetch_array($result))
                            {
                                $sid[$n]=$data['sid'];
                                $sname[$n]=$data['sname'];
                                $tname[$n]=$data['name'];
                                $temail[$n]=$data['email'];
                                $n++;
                            }
                        }
                        else
                        {
                            $msg="Unable to get Subject details";
                        } 
                
                
                
                        GLOBAL $qlec;
                        for($lecs=1;$lecs<=$nLec;$lecs++)
                        { 
                            if($lecs==$nLec)
                            {
                                $qlec .="L$lecs";
                            }
                            else
                            {
                                $qlec .="L$lecs,"; 
                            }
                        }
            
                        if($action=='edit')
                        {
                            echo"<form method='post' action='$_SERVER[PHP_SELF]'>";
                        }
                        
                        echo<<<_DONE
         
                        <table align="left" border="" style="background-color:#36edf4;font-size:22px;">
                        
                        <tr style="color:#0056ff;background-color:#111111;font-size:24px;">
                        <th>SUBJECT</th>
                        <th>TEACHER</th>
                        </tr>
                        _DONE;
                        for($k=1;$k<$n;$k++)
                        {
                            echo"<tr>
                                <td>$sname[$k]</td>
                                <td>$tname[$k]</td>
                                </tr>";
                        }	
		               
                        echo<<<_DONE
                        </table>
                        <table class="w3-back-table">
                            <caption style="background-color:#00ff00;font-size:27px;"> TimeTable for $dept Department sem-$sem <br />
                            </caption>
                            <tbody class="w3-mytable-form">
                        _DONE;



                        $nday[0] = 1;
                        for($i=0;$i<=7;$i++)
                        { 
                            if($nday[$i]==0)
                            {
                                continue;
                            }
                            
                            if($i!=0)
                            {
                                
                                $qry="SELECT $qlec FROM tt WHERE dept='$dept' AND sem='$sem' AND dno='d$i' ";
                                if($result=mysqli_query($db,$qry))
                                { 
                                    $data=mysqli_fetch_array($result);
                                    for($m=1;$m<=$nLec;$m++)
                                    {
                                        $l[$m]=$data['L'.$m];
                                    }
                                    
                                }
                                else 
                                {
                                    echo"<tr><td>Time-Table Doesn't Exist</td></tr></table>";
                                    break;			
                                }
                            }

                            echo"<tr>";
                            for($j=0;$j<=$nLec;$j++)
                            { 
                                if($i==0)
                                {
                                    echo"<th>";
                                    if($j==0)
                                    {
                                        echo"DAY";
                                    }
                                    else
                                    {
                                        echo"L$j";
                                    }
                                    
                                    echo"</th>";
                                }
                                else
                                {
                                    echo"<td>";
                                    if($j==0)
                                    {
                                        switch($i)
                                        {
                                            case 1:echo"Monday";
                                            break;
                                            case 2:echo"Tueday";
                                            break;
                                            case 3:echo"Wednesday";
                                            break;
                                            case 4:echo"Thursday";
                                            break;
                                            case 5:echo"Friday";
                                            break;
                                            case 6:echo"Saturday";
                                            break;
                                            case 7:echo"Sunday";
                                            break;
                                        }
                                    }
                                    else
                                    {
                                        
                                        if($action=='edit')
                                        {
                                            echo"<select name='TT$i$j' >";
                                            for($k=1;$k<$n;$k++)
                                                {
                                                    echo"<option value='{$sid[$k]}' ";
                                                    if($l[$j]==$sid[$k])
                                                    echo"selected";
                                                    echo">{$sname[$k]}</option>";
                                                } 						
                                        }
                                        else
                                        { 
                                            echo"<span id='text_det'>";
                            
                                            for($k=1;$k<$n;$k++)
                                            {
                                                if($l[$j]==$sid[$k])
                                                {
                                                    echo"$sname[$k]";
                                                    break;
                                                }
                                                if($k==$n-1)
                                                {
                                                    echo"none";
                                                }
                                            }
                                            echo"</span>";
                                        }
                                    
                                    }
                                
                                    echo"</td>"; 
                                }
                            
                            }echo"</tr>";
                        
                        }
                        
                        if($action=='edit')
                        {
                            echo"<tr>
                                    <td><input type='hidden' name='sem' value='$sem' /></td>
                                    <td><input type='hidden' name='action1' value='edit' /></td>
                                    <td><input type='hidden' name='_handle_' value='2' /></td>   
                                    <td>
                                        <input type='submit' name='Submit' value='submit' style='background-color:#00ff00;'  />                                                              </td>
                                </tr>";
                        }
                        echo"</tbody></table>";
                        if($action=='edit')
                        {
                            echo"</form>";
                        }
                    }
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
            function Schanged(form)
                {
                    form.actSelect.selectedIndex='none';
                    form.submit();
                }
        </script>
    </body>
</html>





