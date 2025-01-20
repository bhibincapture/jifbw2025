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
		  <div class="col-12 col-lg-4" style="margin: 0 auto;">
			<div class="register-box">
			
			  <div class="card">
				<div class="card-body register-card-body">
				  <p class="login-box-msg"><b>Reset Passwords</b></p>

				  <form method="post" action="<?php echo DB_LOCAL.DB_LINK."/mdl-includes/smtpmail/sendmail-reset.php";?>">
					<div class="row">
					  <div class="col-12">
					    <?php 
					    if(isset($_GET["msg"])){
					      if($_GET["msg"]=="f99fc4625080d3cdc2317d59b1ebd8b0"){
					        echo "<p class='text-danger' style='font-size:14px;'><i>Please check your Email, and click reset button</i></p>";
					      }
					      if($_GET["msg"]=="68456d8b4378a72c5ecf0e7e297836ac"){
					        echo "<p class='text-danger' style='font-size:14px;'><i>Your email is not registered yet</i> <a href='".DB_LOCAL.DB_LINK."/sign-up/' title='Sign Up'><b>Register</b></a></p>";
					      }
					    }
					    ?>
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
					
					<div class="row">
					  <!-- /.col -->
					  <div class="col-12">
						<button type="submit" class="btn btn-primary btn-block btn-global" name="sendreset">Send Email</button>
					  </div>
					  <!-- /.col -->
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