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
          <li>Reset Password</li>
        </ol>
        <h1>Reset Password</h1>
      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container">
					
	    <div class="row">
		
		  <?php
		  $msg = "";
		  if (isset($_POST["resetnow"])) {
			$newpassword = md5(LEGALTEXT($_POST["newpassword"]));
			$renewpassword = md5(LEGALTEXT($_POST["renewpassword"]));
			$email = $resetDB["user_email"];
			
			$userQR = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_email`='".$email."'");
			$userNUM = $userQR -> num_rows;
			
			if($userNUM == 1){
			  $userQR2 = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_email`='".$email."' && `user_password`!='".$newpassword."'");
			  $userDB2 = $userQR2 -> fetch_assoc();
			  $userNUM2 = $userQR2 -> num_rows;
			  $username = $resetDB["user_name"];
			  $user_status = $resetDB["user_status"];
			  
			  if($userNUM2 == 1){
				if($user_status != "draft"){
				  if($newpassword == $renewpassword){
				    $updateuser = $db->conn -> query("UPDATE `mdl_user` SET `user_password`='$newpassword' WHERE `user_email`='$email'");
				    
				    if($updateuser === TRUE){
				      $_SESSION['email'] = "$email";
				      $_SESSION['login'] = "loginactive";
				      header ("location: ".DB_LOCAL.DB_LINK."/user/".$username."/");
				    }
				  }
				} else {
				  $msg = "<p class='text-danger' style='font-size:14px;'><i>Your account has not been verified, please check your email.</i></p>";
				}
			  } else {
				$msg = "<p class='text-danger' style='font-size:14px;'><i>Don't fill in the old password, please create a new password.</i></p>";
			  }
			} else {
			  $msg = "<p class='text-danger' style='font-size:14px;'><i>Your email is not registered yet</i></p>";
			}
		  }?>
		  
		  <div class="col-12 col-lg-4" style="margin: 0 auto;">
			<div class="register-box">
			
			  <div class="card">
				<div class="card-body register-card-body">
				  <p class="login-box-msg"><b>New Passwords</b></p>
				  
					<div class="row">
					  <div class="col-12">
					    <?php echo $msg;?>
					  </div>
					</div>
					
				  <form method="post" action="<?php echo DB_LOCAL.DB_LINK."/reset/".$reset."/";?>">
					<div class="row">
					  <div class="col-12">
    					<div class="input-group mb-3">
    					  <input type="password" class="form-control" placeholder="* New Password" minlength="8" id="password" name="newpassword" required>
    					  <div class="input-group-append">
    						<div class="input-group-text">
    						  <span class="fas fa-lock"></span>
    						</div>
    					  </div>
    					</div>
    					
    					<div class="input-group mb-3">
    					  <input type="password" class="form-control" placeholder="* Retype New Password" minlength="8" id="confirm_password" name="renewpassword" required>
    					  <div class="input-group-append">
    						<div class="input-group-text">
    						  <span class="fas fa-lock"></span>
    						</div>
    					  </div>
    					</div>
					  </div>
					  
					  <div class="col-12">
						<button type="submit" class="btn btn-primary btn-block btn-global" name="resetnow">Reset Password</button>
					  </div>
					</div>
				  </form>
				  
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