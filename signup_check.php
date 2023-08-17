<?php
include 'includes/conn.php';
if(isset($_POST['number']))
{

$q=$conn->query("SELECT * FROM `voters` WHERE `voters_id`='$_POST[number]'");


if($q->num_rows==1)
{
    echo"Number Already Exist";
}
}
if(isset($_POST['aadhaar'])){
    $qt=$conn->query("SELECT * FROM `voters` WHERE `aadhaar`='$_POST[aadhaar]'");
    if($qt->num_rows==1)
    {
        echo"Aadhaar Already Exist";
    }
}




?>