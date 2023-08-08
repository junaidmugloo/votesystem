<?php

if($_POST['number']!="" )
{
include 'includes/conn.php';
$q=$conn->query("INSERT INTO `voters`(`voters_id`,`password`,`aadhaar`,`firstname`,`lastname`,`photo`)
VALUES('$_POST[number]','$_POST[password]','$_POST[email]','$_POST[fname]','$_POST[lname]','abc.png')");

if($q)
echo"success";
else
echo"Failed to signup";
}






?>