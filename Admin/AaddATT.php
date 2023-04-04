<?php
 session_start();
 $type='adm';
 $Ptype='SUB';
 include '../session.php';
?>

<!DOCTYPE html>
<html>
    <title>ADMIN PAGE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="../Css/proerp.css"/>
    <body>
        <?php
            $msg="";
            $H=$_POST['_handle_'];
            if(($_POST['day']>32||$_POST['day']<1)&&$H!='1')
                {
                    header("Location:TechATT.php");
                        exit();
                }

            if($H=='1')
                {
                    handleform($H);
                }
                else
                {
                    printform($H);
                }

            function handleform($H)
                {
                    GLOBAL $msg;
                    
                                include '../dbDetails.php';

                                $db1=mysqli_connect($host,$duser,$dpaswd,$dname);
                                if(!$db1)
                                {
                                    $msg="Unable to connect to database:";
                                }
                                else
                                { $DEPT=$_POST['dept'];
                                $DAY=$_POST['day'];
                                
                                $qry1="SELECT email FROM teacher WHERE dept='$DEPT' "; 
                                    if($result1=mysqli_query($db1,$qry1))
                                {  
                                    $s2=1;
                                    while($data1=mysqli_fetch_array($result1))
                                    {  $n='a'.$s2;
                                        $S1=$_POST[$n];
                                        $email1=$data1['email'];
                                        $qry2="UPDATE tm1 SET $DAY='$S1' WHERE email='$email1' ";
                                        $s2++;
                                    
                                    if($result2=mysqli_query($db1,$qry2))
                                    {  
                                    $msg=" Attendance updated successfully ";
                                    }
                                    else
                                    {
                                        $msg="Unable to UPDATE";
                                        break;
                                    }  
                                }
                                }
                                else
                                    {
                                    $msg="! Unable to connect to database";
                                    }
                                }
                    
                printform($H);	
                }


            function printform($H)
                { 
                    GLOBAL $msg;
                    include 'Header.php';
                    echo<<<_DONE
                        <section>
                            <!--<img class="mySlides" src="../Images/2.jpg" height="400" width="100%">
                            <img class="mySlides" src="../Images/5.jpg"  height="400" width="100%">-->
                            <img class=" w3-image " src="../Images/3.jpg" >
                            
                            <div class="w3-container w3-maincontent" align="center" width="100%" ">
                            <form method="post" action="AaddATT.php">
                                <table class="w3-back-table">
                                
                                <caption class="w3-caption">
                    _DONE;
                            
                                    
                                    echo" ".$_POST['dept']." DAY( ".$_POST['day'].")<br/>".$msg."</caption>
                                <tbody class='w3-mytable-form'>";
                                    $DEPT1=$_POST['dept'];
                                    
                                    if($H!=1)
                                    {$DAY1='d'.$_POST['day'];}
                                    else
                                    {$DAY1=$_POST['day'];}

                                    include '../dbDetails.php';

                                    $db=mysqli_connect($host,$duser,$dpaswd,$dname);
                                    if(!$db)
                                    {
                                        $msg="Unable to connect to database:";
                                    }
                                    else
                                    {  
                                    $qry="SELECT name,email FROM teacher WHERE dept='$DEPT1' ";
                                    if(($result2=mysqli_query($db,$qry)))
                                    {  
                                        echo"<tr><th>S no.</th><th>Teacher NAME</th><th> Present </th><th> Absent </th></tr>";
                                        $s=1;
                                        while($data=mysqli_fetch_array($result2))
                                        {
                                            echo<<<_DONE
                                            <tr style="color:#993411;">
                                            <td> $s </td>
                                            <td> {$data['name']}</td> 
                    _DONE;
                                            $email=$data['email'];
                                            $qry1="SELECT $DAY1 FROM tm1 WHERE email='$email' ";
                                            if(($result=mysqli_query($db,$qry1)))
                                            {  
                                                $data1=mysqli_fetch_array($result);
                                                
                                                if($data1['0']=='PP')
                                                {
                                                echo<<<_DONE
                                                <td> PP <input type="radio" name="a$s" value='PP' checked /> </td>
                                                <td> AB <input type="radio" name="a$s" value='AB' /> </td></tr>
                                        
                    _DONE;
                                                }
                                                else
                                                { 
                                                echo<<<_DONE
                                                <td> PP <input type="radio" name="a$s" value='PP'  /> </td>
                                                <td> AB <input type="radio" name="a$s" value='AB' checked/> </td></tr>
                    _DONE;
                        
                                                }
                                                
                                            }
                                                $s++;
                                        }
                                        
                                        
                                        }
                                    else
                                        {
                                        $msg="! Unable to connect to database";
                                        }
                                    }
                                    echo<<<_DONE
                                    <tr>
                                    <td><input type='hidden' name='dept' value='$DEPT1' /></td><input type='hidden' name='day' value='$DAY1' />
                                    <td><input type='hidden' name='_handle_' value='1' /></td>
                                    <td><input type='submit' name='Submit' value='submit' style='background-color:#00ff00;' /></td><tr>
                                
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

    </body>
</html>

