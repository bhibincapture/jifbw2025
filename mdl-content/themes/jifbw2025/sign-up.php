<?php
// Sign In
if(!isset($_SESSION["login"]) && !isset($_SESSION["email"])){
include "header.php";
?>

  <main id="main">
				
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="<?php echo DB_LOCAL.DB_LINK."/";?>">Home</a></li>
          <li>Sign Up</li>
        </ol>
        <h1>Sign Up</h1>
      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container">
	    <div class="row">
		  <div class="col-12 col-lg-4" style="margin: 0 auto;">
			<div class="register-box">
			
			  <div class="card">
				<?php
				$massage = "";
				$email = "";
				if (isset($_GET["msg"]) && isset($_GET["register"])) {
				  $msg = $_GET["msg"];
				  $email = $_GET["register"];
				  if($msg == "011c5ebdc2fa8cc9f743b52107701f4f"){
				      $massage = "Your email have already account, please login";
				  }
				}
				?>
				<div class="card-body register-card-body">
				  <p class="login-box-msg"><b>Register New Account</b></p>
				  <p class="text-danger" style="font-size:14px;"><i><?php echo $massage;?></i></p>
				  
				  <form method="post" action="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/smtpmail/sendmail-register.php">
					<div class="input-group mb-3">
					  <input type="text" class="form-control" placeholder="* First name" name="firstname" minlength="3" required>
					  <div class="input-group-append">
						<div class="input-group-text">
						  <span class="fas fa-user"></span>
						</div>
					  </div>
					</div>
					
					<div class="input-group mb-3">
					  <input type="text" class="form-control" placeholder="* Last name" name="lastname" required>
					  <div class="input-group-append">
						<div class="input-group-text">
						  <span class="fas fa-user"></span>
						</div>
					  </div>
					</div>
					
					<div class="input-group mb-3">
					  <input type="email" class="form-control" placeholder="* Exp : someone@gmail.com" name="email" pattern="[^ @]*@[^ @]*" value="<?php echo $email;?>" required>
					  <div class="input-group-append">
						<div class="input-group-text">
						  <span class="fas fa-envelope"></span>
						</div>
					  </div>
					</div>
					
					<div class="input-group mb-3">
					  <input type="tel" class="form-control" name="whatsapp" id="iphone" placeholder="Exp : 6281xxxxxxxxx" title="Please enter valid phone number">
					  <div class="input-group-append">
						<div class="input-group-text">
						  <span class="fab fa-whatsapp"></span>
						</div>
					  </div>
					</div>
					
					<div class="input-group mb-3">
					  <input type="password" class="form-control" placeholder="* Password" minlength="8" id="password" name="password" required>
					  <div class="input-group-append">
						<div class="input-group-text">
						  <span class="fas fa-lock"></span>
						</div>
					  </div>
					</div>
					
					<div class="input-group mb-3">
					  <input type="password" class="form-control" placeholder="* Retype password" minlength="8" id="confirm_password" name="repassword" required>
					  <div class="input-group-append">
						<div class="input-group-text">
						  <span class="fas fa-lock"></span>
						</div>
					  </div>
					</div>
					<div class="row">
					  <!-- /.col -->
					  <div class="col-12">
						<button type="submit" class="btn btn-primary btn-block btn-global" name="register">Register</button>
					  </div>
					  <!-- /.col -->
					</div>
				  </form>

				  <div class="social-auth-links text-center">
					<p>- OR -</p>
					
					  <div class="col-12">
					    You have account ? <a href="<?php echo DB_LOCAL.DB_LINK."/login/";?>" title="Login"><b>Login</b></a>
					  </div>
				  </div>
				  
				</div>
				<!-- /.form-box -->
			  </div><!-- /.card -->
			</div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->
<?php
} else {
  $email = $_SESSION["email"];
  $usersessionDB = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_email`='".$email."'") -> fetch_assoc();
  
  if($_SESSION["email"] != $userDB["user_email"]) {
	header ("location: ".DB_LOCAL.DB_LINK."/user/".$usersessionDB["user_name"]."/");
  }
  else {
	 
  }
}
?>

<script>
var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script>
<?php include "footer.php";?>