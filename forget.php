<?php
  
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition login-page">
<div class="login-box">
  	<div class="login-logo">
  		<b>Voting System</b>
  	</div>
  
  	<div class="login-box-body">
    	<p class="login-box-msg">Forget Password</p>


      		<div class="form-group has-feedback">
        		<input type="number" class="form-control" name="voter" placeholder="Enter Number" id="number" required>
        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
      		</div>
			  <div class="form-group has-feedback">
           <div id="recaptcha-container"></div>
            <span class="glyphicon glyphicon-ok-sign form-control-feedback"></span>
          </div>
              <div class="row">
    			<div class="col-xs-4">
          			<button type="submit" onclick="submit()" id="sign-in-button" class="btn btn-primary btn-block btn-flat" name="login"><i class="fa fa-sign-in"></i>Send Otp</button>
        		</div>
      		</div>
          <br>
            <div class="form-group has-feedback">
            <input type="number" class="form-control" id="code" name="otp" placeholder="Enter Otp" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
      		<div class="row">
    			<div class="col-xs-5">
          			<button type="submit" class="btn btn-success btn-block btn-flat"  onclick="submitPhoneNumberAuthCode()" name="login"><i class="fa fa-sign-in"></i>Submit Otp</button>
        		</div>
      		</div>
    	
		<br>
		<div id="err">

		</div>
  	</div>
  	












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
	  window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier(
        "recaptcha-container",
        {
          size: "normal",
          callback: function(response) {
            submitPhoneNumberAuth();
			butt.disabled=true; 
			
          }
        }
      );

      // This function runs when the 'sign-in-button' is clicked
      // Takes the value from the 'phoneNumber' input and sends SMS to that phone number
      function submitPhoneNumberAuth() {
     	  var phoneNumber = document.getElementById("number").value;
		  
		  var err=document.getElementById("err");
		
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
      

      // This function runs when the 'confirm-code' button is clicked
      // Takes the value from the 'code' input and submits the code to verify the phone number
      // Return a user object if the authentication was successful, and auth is complete
      function submitPhoneNumberAuthCode() {
        var code = document.getElementById("code").value;
        confirmationResult
          .confirm(code)
          .then(submitcode())
          .catch(function(error) {
			var err=document.getElementById("err");
			err.innerHTML="<div class='callout callout-danger text-center mt20'><p>"+err+"</p></div>"
		  

          });
      }

      //This function runs everytime the auth state changes. Use to verify if the user is logged in
      

		
function submit()
      {
    var phoneNumber = document.getElementById("number").value;
		
		var err=document.getElementById("err");
     
        const formData = new FormData()
        formData.append('number',phoneNumber)

        // AJAX
        $.ajax({
          url: 'forget-api.php',
          data: formData,
          type: 'POST',
          processData: false,
          contentType: false,
          success: function (data) {
           if(data=="OTP SENDED")
		   {
			submitPhoneNumberAuth();
			err.innerHTML="<div class='callout callout-success text-center mt20'><p>Verifiy and check otp</p></div>";
		   }
		   else{
			err.innerHTML="<div class='callout callout-danger text-center mt20'><p>"+data+"</p></div>"
		   }
			
			
			// err.innerHTML="<div class='callout callout-danger text-center mt20'><p>"+data+"</p></div>"
          },
          error: function (err) {
            err.innerHTML="<div class='callout callout-danger text-center mt20'><p>"+err+"</p></div>"
          },
        })
      }


	  function submitcode()
      {
    var phoneNumber = document.getElementById("number").value;
		
		var err=document.getElementById("err");
     
        const formData = new FormData()
        formData.append('number2',phoneNumber)

        // AJAX
        $.ajax({
          url: 'veri.php',
          data: formData,
          type: 'POST',
          processData: false,
          contentType: false,
          success: function (data) {
           if(data=="verified")
		   {
			window.location.href="newpassword.php";
		   }
		   
			
			
			// err.innerHTML="<div class='callout callout-danger text-center mt20'><p>"+data+"</p></div>"
          },
          error: function (err) {
            err.innerHTML="<div class='callout callout-danger text-center mt20'><p>"+err+"</p></div>"
          },
        })
      }


	</script>
</body>
</html>