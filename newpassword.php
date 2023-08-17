<?php
 session_start();
 if(isset($_SESSION['forget']))
 {
    
    if(isset($_POST['submit']))
    {
    include 'includes/conn.php';
$q=$conn->query("UPDATE `voters` SET `password`='$_POST[voter]' WHERE `voters_id`='$_POST[vid]'");
$_SESSION['error']="password changed sccessfully";
header("location:index.php");
}


 include 'includes/header.php'; ?>
<body class="hold-transition login-page">
<div class="login-box">
  	<div class="login-logo">
  		<b>Voting System</b>
  	</div>
  
  	<div class="login-box-body">
    	<p class="login-box-msg">Set new password</p>

    	<form action="" method="POST">
        <div class="form-group has-feedback">
        		<input type="text" class="form-control" name="vid" value="<?php echo $_SESSION['forget']; ?>" readonly>
        		<span class="glyphicon glyphicon-phone form-control-feedback"></span>
      		</div>
			  
      		<div class="form-group has-feedback">
        		<input type="text" class="form-control" name="voter" placeholder="New Password" id="phoneNumber" required>
        		<span class="glyphicon glyphicon-phone form-control-feedback"></span>
      		</div>
			  

		 
      		<div class="row">
    			<div class="col-xs-4">
          			<button type="submit" name="submit"  id="sign-in-button" class="btn btn-primary btn-block btn-flat" name="submit"><i class="fa fa-sign-in"></i>Save</button>
        		</div>
      		</div>

              </form>
          

	<div id="err">  
	       
	  </div>
</div>
<?php
 }
else{
    header("location:index.php");
}
?>