<?php
if($_POST['number']!="")
{
include 'includes/conn.php';
$q=$conn->query("SELECT * FROM `voters` WHERE `voters_id`='$_POST[number]'");


if($q->num_rows==1)
{
    echo"OTP SENDED";
}
else{
    echo"USER NOT FOUND";
}
}
else{
    echo"Enter valid number";
}



?>