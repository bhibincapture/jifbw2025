<?php
// Sign In
include "header-user.php";

//include "mdl-includes/smtpmail/test.php";
if (isset($_GET["email"])) {
  $email = LEGALTEXT($_GET["email"]);
  
  if($verifyNUM != 0){
	
?>
  <main id="main">
				
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container">
					
	    <div class="row">

			  <div class="col-12 col-lg-12" style="margin: 0 auto;">
				<div class="card">
				  <div class="card-body register-card-body">
					<div class="alert alert-success alert-dismissible">
					  <h2><i class="icon fas fa-check"></i> Success</h2>
					  <p>Please check your email for verify, we have sent you a verification email to <b><?php echo $email;?></b></p>
					  <p>Didn't receive the email? <a href="">Resend</a></p>
					  <p>Or chat WhatsApp admin of JIF-BW <a href="https://wa.me/+6281392346101">(+62) 813 9234 6101</a></p>
					</div>
				  </div>
				</div>
			  </div>
        </div>
      </div>
    </section>
  </main>
  <?php 
  } else {?>

  <div class="d-flex align-items-center justify-content-center vh-100 bg-danger" style="height: 60vh!important;">
    <h1 class="display-1 fw-bold text-white">404 Error</h1>
  </div>
  
  <?php
  }
}
	
else {
  if($permalink[$i+2] == $verifyDB["user_verify"]){
	//if($verifyDB["user_status"] == "active" OR $verifyDB["user_status"] == "published" OR $verifyDB["user_status"] == "expired");
	if($verifyDB["user_status"] == "draft"){
	  $iduser = $verifyDB["user_id"];
	  $update = "UPDATE `mdl_user` SET `user_status`='active', `user_activated`='$DBdatetime' WHERE `user_id`='$iduser'";
	  $insert = $db->conn -> query($update);
	}
?>
  <main id="main">
				
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container" data-aos="fade-up">
					
	    <div class="row">

			  <div class="col-12 col-lg-12" style="margin: 0 auto;">
				<div class="card">
				  <div class="card-body register-card-body">
					<div class="alert alert-success alert-dismissible">
					  <h2><i class="icon fas fa-check"></i>  Verify Success</h2>
					  <p>Hello <?php echo $verifyDB["user_first_name"]." ".$verifyDB["user_last_name"];?> Selamat account anda sudah aktif. Silahkan <a href="<?php echo DB_LOCAL.DB_LINK."/login/";?>" title="Login JIF-BW"><b>LOGIN</b></a>.</p>
					</div>
				  </div>
				</div>
			  </div>
        </div>
      </div>
    </section>
  </main>
<?php } else { ?>

  <div class="d-flex align-items-center justify-content-center vh-100 bg-danger" style="height: 60vh!important;">
    <h1 class="display-1 fw-bold text-white">404 Error</h1>
  </div>
  
<?php } 

}?>

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
<?php include "footer-user.php";?>