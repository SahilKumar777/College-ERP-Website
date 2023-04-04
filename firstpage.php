<!DOCTYPE html> 
<html>
<head>
<title>ERP System</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="/Css/style1.css">
</head>
<body style="text-align: -webkit-center;">
<?php
$msg="";
if($_POST['_handle_'])
  {
    session_start();
	handleform();
  }
else
  {   
	session_start();
    session_destroy();
	printform("","");
  }
function handleform()
{   
    GLOBAL $msg;
    $id=$_POST['id'];
    $passwd=$_POST['password'];

    if(($id=="")||($passwd==""))
    {
        if(($id!="")||($passwd!=""))
        {
            if($id=="")
            {$msg="! Email Id field cannot be empty";}
            else
            {$msg="! Password field cannot be empty";} 	

        }
        else
        {
            $msg="! Please fill both fields";
        }
    }
    else
    {
        include 'dbDetails.php';
        
        $db=mysqli_connect($host,$duser,$dpaswd,$dname);
        if(!$db)
        {
            $msg="Unable to connect to database:";
        }
        else
        {
            $qry="SELECT * FROM logs WHERE id='$id' AND pass='$passwd'";
            if(($result=mysqli_query($db,$qry)))
            {   
                $_SESSION['s-id']="$id";
                $data=mysqli_fetch_array($result);
                $type=$data['type'];
                if($type=='adm')
                {
                    header("Location:Admin/adminP.php");
                    exit();
                }
                if($type=='tech')
                {
                    header("Location:Teacher/techP.php");
                    exit();
                }
                if($type=='stud')
                {
                    header("Location:Student/studP.php");
                    exit();
                }
                
                $msg="! Wrong Username or Password";
                session_destroy();
            }
            else
            {
                $msg="! Unable To Connect To Database";
            }
        }
    }
    printform($id,$passwd);
}  
    
 
function printform($id,$passwd)
{ 
    GLOBAL $msg;
    echo<<<_DONE
    <div style="width: fit-content;">
        <div class="heading">
            <div class="title1">COLLEGE ERP</div>
        </div>
        <div style="">    
            <form id="form" style="width:auto;" method="post" action="firstpage.php">
                <div>
                    <h2 style="color:#ff0000">Aravali college Of Engineeering And Management</h2>
                </div>

                <br/>
                <table >
                    <caption><h3 style="color:#ff0000;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$msg</h3></caption>
                    <tr>
                        <td style=""><b>EMAIL ID </b></td>
                        <td style="">
                            <input ctype="text"  name="id" value="$id" style="
                                
                                height:53px;
                                background: transparent;
                                color:black;
                                border-radius: 12px;
                                font-size:27px;
                                font-family: sans-serif;
                            "/>
                        </td>
                    </tr>
            
                    <tr>
                        <td style=""><b>PASSWORD </b></td>
                        <td style="">
                            <input type="password"  name="password" value="$passwd" style="
                                
                                height:53px;
                                background: transparent;
                                color:black;
                                border-radius: 12px;
                                font-size:27px;
                                font-family: sans-serif;
                            "/>
                        </td>
                    </tr>
                
                    <tr>
                        <td>
                            <input type="hidden" name="_handle_" value="1" />
                        </td>
                        <td>
                            <input type="submit" class="register" value="LOGIN" /> 
                        </td>
                    </tr>
                </table>

            </form>
        </div>
    </div>  
_DONE;

 }
?>
</body>
</html> 