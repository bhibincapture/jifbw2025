<?php
// Sign In
if(!isset($_SESSION["login"]) && !isset($_SESSION["email"])){
include "header.php";

$msg_email = "";
if(isset($_GET["msg"])){
  if($_GET["msg"] == "8649a6a255c9d704db5c55c39edf39f3cce0fcdb"){
    $msg_email = "<p class='text-danger' style='font-size:14px;'><i>Please enter your email & password correctly</i></p>";
  }
  if($_GET["msg"] == "3b17791fb15634bd876cca9a0302664611cf7e13"){
    $msg_email = "<p class='text-danger' style='font-size:14px;'><i>Your email is not registered yet</i></p>";
  }
}
if(isset($_POST["loginlightbox"])){
  $email = LEGALTEXT($_POST["email"]);
  $password = md5(LEGALTEXT($_POST["password"]));
  
  $userQR = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_email`='".$email."'");
  $userNUM = $userQR -> num_rows;
  if($userNUM > 0){
    $userQR2 = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_email`='".$email."' && `user_password`='".$password."'");
    $userDB2 = $userQR2 -> fetch_assoc();
    $userNUM2 = $userQR2 -> num_rows;
    if($userNUM2 > 0){
        
      $_SESSION['email'] = "$email";
      $_SESSION['login'] = "loginactive";
      
      header ("location: https://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]."");
      
	} else {
	  header ("location: https://".$_SERVER["HTTP_HOST"]."/login/?msg=8649a6a255c9d704db5c55c39edf39f3cce0fcdb");
	}
  } else {
	header ("location: https://".$_SERVER["HTTP_HOST"]."/login/?msg=3b17791fb15634bd876cca9a0302664611cf7e13");
  }
}
?>
<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="<?php echo DB_LOCAL.DB_LINK."/";?>">Home</a></li>
          <li>Login</li>
        </ol>
        <h1>Login</h1>
      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container">
	    <div class="row">
		<?php 
		  //$msg_email = "";
		  if (isset($_POST["login"])) {
			$email = LEGALTEXT($_POST["email"]);
			$password = md5(LEGALTEXT($_POST["password"]));
			
			$userQR = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_email`='".$email."'");
			$userNUM = $userQR -> num_rows;
			if($userNUM > 0){
			  $userQR2 = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_email`='".$email."' && `user_password`='".$password."'");
			  $userDB2 = $userQR2 -> fetch_assoc();
			  $userNUM2 = $userQR2 -> num_rows;
			  if($userNUM2 > 0){
				  echo "<p class='text-danger'>Session Disini</p>";
				  $username = $userDB2["user_name"];
				  
				  $_SESSION['email'] = "$email";
				  $_SESSION['login'] = "loginactive";
				  
				  header ("location: ".DB_LOCAL.DB_LINK."/user/".$username."/");
				  
				//if($user_status != "draft"){
				//} else {
				  //$msg_email = "<p class='text-danger' style='font-size:14px;'><i>Your account has not been verified, please check your email.</i></p>";
			    //}
			  } else {
				$msg_email = "<p class='text-danger' style='font-size:14px;'><i>Please enter your email & password correctly</i></p>";
			  }
			} else {
			  $msg_email = "<p class='text-danger' style='font-size:14px;'><i>Your email is not registered yet</i></p>";
			}
			
		  }?>
		  
		  <div class="col-12 col-lg-4" style="margin: 0 auto;">
			<div class="register-box">
			
			  <div class="card">
				<div class="card-body register-card-body">
				  <h2 style="font-size:30px;"><b>LogIn</b></h2>

				  <form method="post" action="<?php echo DB_LOCAL.DB_LINK."/login/";?>">
					
					<div class="row">
					  <div class="col-12">
					    <?php echo $msg_email;?>
					  </div>
					</div>
					
					<div class="input-group mb-3">
					  <input type="email" class="form-control" placeholder="Email" name="email" pattern="[^ @]*@[^ @]*" required>
					  <div class="input-group-append">
						<div class="input-group-text">
						  <span class="fas fa-envelope"></span>
						</div>
					  </div>
					</div>
					
					<div class="input-group mb-3">
					  <input type="password" class="form-control password" placeholder="Password" minlength="8" id="password" name="password" required>
					  <div class="input-group-append">
						<div class="input-group-text">
						  <span class="fas fa-lock"></span>
						</div>
					  </div>
					</div>
					
					<div class="row">
					  <!-- /.col -->
					  <div class="col-12">
						<button type="submit" class="btn btn-primary btn-block btn-global" name="login">Login</button>
					  </div>
					  <!-- /.col -->
					</div>
				  </form>

				  <div class="social-auth-links text-center">
					<p>- OR -</p>
					
					  <div class="col-12">
					    You don't have account ? <a href="<?php echo DB_LOCAL.DB_LINK."/sign-up/";?>" title="Sign Up"><b>Sign Up</b></a>
					  </div>
					  <div class="col-12">
					    Forgot the Passwords ? <a href="<?php echo DB_LOCAL.DB_LINK."/reset/";?>" title="Reset Password"><b>Reset Password</b></a>
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