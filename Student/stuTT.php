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
 span{color:#1c4bfc;}
</style>
<body >
<?php
include 'Sheader.php';

        STATIC $n;
		$msg="";
        
        include '../dbDetails.php';
        
        $db=mysqli_connect($host,$duser,$dpaswd,$dname);
        if(!$db)
        {
            $msg="Unable to connect to database:";
        }
        else
        {
            $dept=$_SESSION['dept'];
            $sem=$_SESSION['sem'];
            $qry="SELECT lec_n,mon,tue,wed,thur,fri,sat,sun FROM TTF WHERE dept='$dept' AND sem='$sem' ";
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
                $nLec=$data['lec_n']; //Number of lectures in a day
            
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
                    <h3 class="w3-msg"> $msg</h3>
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
                            echo"<table border='0'>
                                <tr><td>";
                            
                            
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
                            echo"</span></td></tr></table>";
                        
                        }
                    
                        echo"</td>"; 
                    }
                
                }echo"</tr>";
            
            }
            
                        
            echo"</tbody></table>";
                
        }
    

    echo<<<_DONE
    
                </div>
            </section>
        </div>
    </div>
_DONE;

include '../footer.php';
    if(!empty($msg))
    {
        echo"<div id='snackbar'>$msg</div>
            <script type='text/javascript'>showSnackbar();</script>";
    }
    
?>



</body>
</html>





