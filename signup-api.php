<?php
session_start();
if($_POST['number']!="" )
{
    include 'includes/conn.php';
$q=$conn->query("INSERT INTO `voters`(`voters_id`,`password`,`aadhaar`,`firstname`,`lastname`,`photo`)
VALUES('$_POST[number]','$_POST[password]','$_POST[email]','$_POST[fname]','$_POST[lname]','abc.png')");

if($q){
echo"success";
$_SESSION['error']="Signup Successful";
}
else
echo"Failed to signup";


}




?>