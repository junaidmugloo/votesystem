<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; 
$data=$conn->query("SELECT * FROM `voters` WHERE `id`='$_SESSION[voter]'");
$row=$data->fetch_assoc();
if(isset($_POST['sb']))
{
    $data=$conn->query("UPDATE `voters` SET `firstname`='$_POST[fname]',`lastname`='$_POST[lname]',`password`='$_POST[pass]'  WHERE `id`='$_SESSION[voter]'");
  if($data)
  {
    echo'<script>alert("Profile Updated");</script>';
    header("refresh:1,home.php");
  }
}
?>
<style>
    .clo{
        padding-top:10px;
    }
</style>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>



<div class="content-wrapper">
	    <div class="container">
            <div class="row">
             <h3>Update Profile</h3>
             <form action="" method="post">
            <div class="col-md-6"> <label for="">First Name</label> <input type="text" name="fname" value="<?php echo $row['firstname']?>" class="form-control"></div>
            <div class="col-md-6"> <label for="">Last Name</label> <input type="text" name="lname" value="<?php echo $row['lastname']?>" class="form-control"></div>
            <div class="col-md-6"> <label for="">Password</label> <input type="text" name="pass" value="<?php echo $row['password']?>" class="form-control"></div>
            <div class="col-md-6"> <label for="">Number</label> <input readonly type="number" value="<?php echo $row['voters_id']?>" class="form-control"></div>
            <div class="col-md-6"> <label for="">Adhaar</label> <input readonly type="number" value="<?php echo $row['aadhaar']?>" class="form-control"></div>
            <div class="col-md-6">
            <label for=""></label>
            <input type="submit" name="sb" value="Save Change" class="btn btn-success form-control">
            </div>
            </form>  
        </div>
          
        </div>
       
</div>