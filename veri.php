<?php
if($_POST['number2']!="")
{
   session_start();
   $_SESSION['forget']=$_POST['number2'];
   //header("location:newpassword.php")
   echo"verified";
}


?>