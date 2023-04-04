<?php
 session_start();
 $type='stud';
 $Ptype="SUB";
 include '../session.php';
 
 if(!isset($_SESSION['dept']))
 {
    	include '../dbDetails.php';

        $db=mysqli_connect($host,$duser,$dpaswd,$dname);
        if(!$db)
         {
    	     $msg="Unable to connect to database:";
         }
        else
         {
			 $qry="SELECT dept,sem,name FROM student WHERE email='{$_SESSION['s-id']}' ";
		     if($result=mysqli_query($db,$qry))
		      { 
	             while($data=mysqli_fetch_array($result))
		           {  
             			   $_SESSION['sem']="{$data['sem']}";
                           $_SESSION['dept']="{$data['dept']}";
						   $_SESSION['name']="{$data['name']}";
                           break;						   
					   
				   }
			  }
			  else
			  {
				 $msg="Unable to connect to database:"; 
			  }
		 }
 }
?>

<!DOCTYPE html>
<html>
<title>STUDENT PAGE</title>
<style type="text/css"> </style>
<body >
<?php

    $msg="";

    if(!empty($_POST['_handle_']))
    {
        handleform();
    }
    else
    {
        printform("");
    }	

  
    function handleform()
    { 
        if(empty($_POST['note']))
        {
            $msg="Empty Message";
        }
        else
        {
            //$sendby="{$_SESSION['name']}"." {$_SESSION['dept']}"."({$_SESSION['sem']})";
            $sendby="{$_SESSION['s-id']}";
            $sendto=$_POST['sendto'];
            $note=$_POST['note'];
            $date=date("Y-m-d H:i:s",time());
            
            include '../dbDetails.php';

            $db=mysqli_connect($host,$duser,$dpaswd,$dname);
            if(!$db)
            {
                $msg="Unable to connect to database:";
            }
            else
            {
                $qry="INSERT INTO blog(note,date,sendby,sendto) VALUES('$note','$date','$sendby','$sendto') ";
                if($result=mysqli_query($db,$qry))
                { 
                    $msg="Message posted Successfully";
                }
                else
                {
                    $msg="! Unable to connect to database";
                }
            }
        }
        printform($msg);
    }


 function printform($msg)
 { 
    include 'Sheader.php';
    echo<<<_DONE
    
        <div style="position:fixed;right:20px;" width="33%" >
            <table style='background-color:#d4d2d0e8;border-style:outset;border-width:2px;padding:10px;' >
                <tbody class='w3-mytable-form'>
                    <form method='post' action='studP.php'>
                        <tr>
                            <th align='left'># Post Message</th>
                        </tr>   
                        <tr>
                            <td align='left' height='120px' style='background-color:#eeeeee;font-size:16px;border:1px;padding:10px;' >
                                <input type='textarea' name='note'  value='Write Here to post' style='height:100px;' />
                            </td>
                        </tr> 
                        <tr>
                            <td align='left'  height='20px' style='background-color:#eeeeee;font-size:16px;padding-left:10px;'>
                                Admin<input type='radio' name='sendto' value='admin' checked/>
                                Faculty<input type='radio' name='sendto' value='tech' />
                            </td>
                        </tr>
                        <tr>
                            <td align='right' height='20px' style='background-color:#;font-size:18px;padding:10px;padding-bottom:0px'>
                                <input type='hidden' name='_handle_' value='1' />
                                <input type="submit"  value="Submit"  />
                            </td>
                        </tr>
                    </form>
                </tbody>
            </table>
        </div>
		 
_DONE;
	   
       include '../dbDetails.php';
       
       $db=mysqli_connect($host,$duser,$dpaswd,$dname);
       if(!$db)
        {
           $msg="Unable to connect to database:";
        }
       else
	    {
            $email="{$_SESSION['s-id']}";
			$qry="SELECT * FROM blog WHERE sendby='$email'OR sendto='$email' OR sendto='stud' OR sendto='both' Order BY date DESC";
		    if($result=mysqli_query($db,$qry))
			 { $n=1;
		         
                echo"<table width='65%' style='background-color:#d8d8d8e8;border-style:outset;border-width:2px;padding:10px;'>";
        
                while(($data=mysqli_fetch_array($result))&&($n<10))
                {   
                $D_array=date_parse($data['date']);
                $date="{$D_array['day']}/{$D_array['month']}/{$D_array['year']}";
                $time="{$D_array['hour']}:{$D_array['minute']}:{$D_array['second']}";
                
                echo" <tr>
                        <td style='background-color:#fcfdfd52;padding:10px;'>
                            <table width='100%' style='background-color:#d4d2d0e8;border-style:outset;border-width:1px;padding:10px;border-radius: 10px;border-right-width: initial;border-bottom-width: thick;' >
                                <tbody class='w3-mytable-form'>
                                    <tr>
                                        <th align='left'>#From-{$data['sendby']}</th>
                                        <th align='right'>#To-{$data['sendto']}</th> 
                                    </tr>   
                                    <tr>
                                        <td align='left' height='60px' style='background-color:#eeeeee;font-size:16px;border:1px;padding:10px;border-radius: 10px;' colspan='2'>{$data['note']}</td>
                                    </tr> 
                                    <tr>
                                        <td align='left' height='20px' style='background-color:#;font-size:16px;padding:10px;padding-bottom:0px'>Time:$time</td>
                                        <td align='right' height='20px' style='background-color:#;font-size:18px;padding:10px;padding-bottom:0px'>   date:-$date</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>";
                $n++;
                }
				 
			    echo"</table>";
             }
			else
             {
    	       $msg="! Unable to connect to database";
		     }
		}
		
        echo"$msg

        </div>
		
      </section>
    </div>
</div>";
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
