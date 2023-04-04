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
			 $qry="SELECT sid,sname FROM subtech WHERE dept='$dept' AND sem='$sem' ";
			 if($result=mysqli_query($db,$qry))
	          {
			    echo"<table class='w3-back-table' align='center'>
				      <caption class='w3-caption'>  RESULT <br /><h3 class='w3-msg'> $msg</h3></caption>
                      <tbody class='w3-mytable-form'>
			          <tr><th>Subject&nbsp;</th><th> SESSIONAL-1 &nbsp;</th><th> SESSIONAL-2 &nbsp;</th><th> SESSIONAL-3 </th></tr>";
		        $n=0;
				    $res1=0;
					$res2=0;
					$res3=0;
		        while($data=mysqli_fetch_array($result))
		         {
			        
				 $qry1="SELECT sess1,sess2,sess3 FROM s{$data['sid']} WHERE email='{$_SESSION['s-id']}'";
					$result1=mysqli_query($db,$qry1);
					$data1=mysqli_fetch_array($result1);
			        echo"<tr><td>{$data['sname']}</td><td>{$data1['sess1']}</td><td>{$data1['sess2']}</td><td>{$data1['sess3']}</td></tr>";
			        $res1+=$data1['sess1'];
					$res2+=$data1['sess2'];
					$res3+=$data1['sess3'];
					$n++;
		         }
				 $per1=$res1/$n;
				 $per2=$res2/$n;
				 $per3=$res3/$n;
				 $total=($per1+$per2+$per3)/3;
				 echo"<tr><td>PERCENTAGE</td><td>$per1%</td><td>$per2%</td><td>$per3%</td></tr>
				      <tr><td></td><td></td><td>TOTAL&nbsp</td><td>$total %</td></tr></table>";
				 
	          }
	         else
	          {
		        $msg="Unable to get Subject details";
	          } 
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
