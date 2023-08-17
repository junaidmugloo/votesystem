<?php
  	
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition login-page">
<div class="login-box">
  	<div class="login-logo">
  		<b>Voting System</b>
  	</div>
  
  	<div class="login-box-body" style="">
    	<p class="login-box-msg">Sign in to start your session</p>

    	<form action="" method="POST">

      <div class="form-group has-feedback">
        		<input type="text" class="form-control" name="voter" placeholder="First Name" id="fname" required>
        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
      		</div>
          <div class="form-group has-feedback">
        		<input type="text" class="form-control" name="voter" placeholder="Last Name" id="lname" required>
        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
      		</div>




      		<div class="form-group has-feedback">
        		<input type="number" class="form-control" onKeyup="check_number()" name="voter" placeholder="Mobile Number" id="phoneNumber" required>
        		<span class="glyphicon glyphicon-phone form-control-feedback"></span>
      		</div>
			  <div class="form-group has-feedback">
        		<input type="number" class="form-control" name="voter" id="email" onKeyup="check_aadhaar()" placeholder="Aadhaar Number" minlength="12" maxlength="12" required>
        		<span class="glyphicon glyphicon-lock form-control-feedback"></span>
      		</div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
		  <div class="form-group has-feedback">
           <div id="recaptcha-container"></div>
            <span class="glyphicon glyphicon-ok-sign form-control-feedback"></span>
          </div>

		  </form>
      		<div class="row">
    			<div class="col-xs-4">
          			<button type="submit"  id="sign-in-button"  onclick="submitPhoneNumberAuth()" class="btn btn-primary btn-block btn-flat" name="login"><i class="fa fa-sign-in"></i>Send Otp</button>
        		</div>
      		</div>


           <br><br>
             <h4 style="color:green;" id="oo"></h4>
			<div class="form-group has-feedback">
            <input type="text" id="code" class="form-control" name="password" placeholder="Enter OTP" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
		  <div class="row">
    			<div class="col-xs-5">
          			<button type="submit"  id="sign-in-button"  onclick="submitPhoneNumberAuthCode()" class="btn btn-success btn-block btn-flat" name="login"><i class="fa fa-sign-in"></i> Submit OTP</button>
        		
                 <br>
            <a href="login.php">Have an account Login</a>  			
           </div>
      		</div>
  	</div>

   


	<div id="err">  
	
	  </div>
</div>
	
<?php include 'includes/scripts.php' ?>










<script>
document.getElementsByClassName("callout")[0].style.display="none"

  function check_number(){
    var butt = document.getElementById("sign-in-button");
  var err=document.getElementById("err");
  var phoneNumber = document.getElementById("phoneNumber").value;
  const formData = new FormData()
        formData.append('number',phoneNumber)
$.ajax({
          url: 'signup_check.php',
          data: formData,
          type: 'POST',
          processData: false,
          contentType: false,
          success: function (data) {
            console.log(data)
           if(data=="Number Already Exist"){
           butt.disabled=true;
           err.innerHTML="<div class='callout callout-danger text-center mt20'><p>Number Already Exist</p></div>"
           }
           else{
            butt.disabled=false;
            err.innerHTML="<div style='display:none;' class='callout callout-danger text-center mt20'><p>Number Already Exist</p></div>"
            
           }
         
         },
        })
      }

      function check_aadhaar(){
    var butt = document.getElementById("sign-in-button");
  var err=document.getElementById("err");
  var aadhaar = document.getElementById("email").value;
  const formData = new FormData()
        formData.append('aadhaar',aadhaar)
$.ajax({
          url: 'signup_check.php',
          data: formData,
          type: 'POST',
          processData: false,
          contentType: false,
          success: function (data) {
            console.log(data)
           if(data=="Aadhaar Already Exist"){
           butt.disabled=true;
           err.innerHTML="<div class='callout callout-danger text-center mt20'><p>Aadhaar Number Already Exist</p></div>"
           }
           else{
            butt.disabled=false;
            err.innerHTML="<div style='display:none;' class='callout callout-danger text-center mt20'><p>Number Already Exist</p></div>"
            
           }
         
         },
        })
      }
















</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://www.gstatic.com/firebasejs/6.3.3/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.3.3/firebase-auth.js"></script>

    <script>
      // Paste the config your copied earlier
	  const firebaseConfig = {
  apiKey: "AIzaSyDRyDG6C2-SWm-Q-iZ1obKFuFrjy1xt2dU",
  authDomain: "voingsystem.firebaseapp.com",
  databaseURL: "https://voingsystem-default-rtdb.firebaseio.com",
  projectId: "voingsystem",
  storageBucket: "voingsystem.appspot.com",
  messagingSenderId: "799163952668",
  appId: "1:799163952668:web:e0652e774a46499a2279d9",
  measurementId: "G-ZNTZ06Y41Y"
};

      firebase.initializeApp(firebaseConfig);

      // Create a Recaptcha verifier instance globally
      // Calls submitPhoneNumberAuth() when the captcha is verified
      var butt = document.getElementById("sign-in-button");
	  var tx = document.getElementById("oo");
	  window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier(
        "recaptcha-container",
        {
          size: "normal",
          callback: function(response) {
            submitPhoneNumberAuth();
			butt.disabled=true;
			tx.innerHTML="Otp has sended on your mobile number"
			
          }
        }
      );

      // This function runs when the 'sign-in-button' is clicked
      // Takes the value from the 'phoneNumber' input and sends SMS to that phone number
      function submitPhoneNumberAuth() {
      var phoneNumber = document.getElementById("phoneNumber").value;
		  var email = document.getElementById("email").value;
		  var password = document.getElementById("password").value;
      var fname = document.getElementById("fname").value;
      var lname = document.getElementById("lname").value;
		  var err=document.getElementById("err");
		
    if(fname=="")
		{
			err.innerHTML="<div class='callout callout-danger text-center mt20'><p>Enter First Name</p></div>"
		}
    else if(lname=="")
		{
			err.innerHTML="<div class='callout callout-danger text-center mt20'><p>Enter Last Name</p></div>"
		}
    
    
      else if(phoneNumber=="")
		{
			err.innerHTML="<div class='callout callout-danger text-center mt20'><p>Enter Valid Mobile Number</p></div>"
		}
    else if(phoneNumber.length!=10)
		{
			err.innerHTML="<div class='callout callout-danger text-center mt20'><p>Enter 10 Digit Mobile Number</p></div>"
		}
		else if(email=="")
		{
			err.innerHTML="<div class='callout callout-danger text-center mt20'><p>Enter Valid Aadhaar</p></div>"
			
		}
    else if(email.length!=12)
		{
			err.innerHTML="<div class='callout callout-danger text-center mt20'><p>Enter 12 Digit Aadhaar</p></div>"
			
		}
		else if(password=="")
		{
			err.innerHTML="<div class='callout callout-danger text-center mt20'><p>Enter Strong Password</p></div>"
		}
		else{
      err.innerHTML="<div class='callout callout-danger text-center mt20'></div>";
			
		
        var appVerifier = window.recaptchaVerifier;
        firebase
          .auth()
          .signInWithPhoneNumber("+91"+phoneNumber, appVerifier)
          .then(function(confirmationResult) {
            window.confirmationResult = confirmationResult;
          })
          .catch(function(error) {
            console.log(error);
          });
		}
      }

      // This function runs when the 'confirm-code' button is clicked
      // Takes the value from the 'code' input and submits the code to verify the phone number
      // Return a user object if the authentication was successful, and auth is complete
      function submitPhoneNumberAuthCode() {
        var code = document.getElementById("code").value;
        confirmationResult
          .confirm(code)
          .then(function(result) {
            var user = result.user;
            console.log(user);
          })
          .catch(function(error) {
            console.log(error);
          });
      }

      //This function runs everytime the auth state changes. Use to verify if the user is logged in
      firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
         
            submit();
        } 
      });




      function submit()
      {
      var phoneNumber = document.getElementById("phoneNumber").value;
		  var email = document.getElementById("email").value;
		var password = document.getElementById("password").value;
    var firstname = document.getElementById("fname").value;
    var lastname = document.getElementById("lname").value;
		var err=document.getElementById("err");
     
        const formData = new FormData()
        formData.append('number',phoneNumber)
        formData.append('email', email)
        formData.append('password',password)
        formData.append('fname',firstname)
        formData.append('lname',lastname)
        // AJAX
        $.ajax({
          url: 'signup-api.php',
          data: formData,
          type: 'POST',
          processData: false,
          contentType: false,
          success: function (data) {
            console.log(data)
            if(data=="success")
            window.location="login.php";
            else if(data=="fail")
            err.innerHTML="<div class='callout callout-danger text-center mt20'><p>Number Already Exist</p></div>"
          },
          error: function (err) {
            err.innerHTML="<div style='display:none;' class='callout callout-danger text-center mt20'><p>"+err+"</p></div>"
          },
        });
      }
      
    </script>
</body>
</html>