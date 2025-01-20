<?php
// Sign In
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
        <h1>Sign In</h1>
      </div>
    </section><!-- End Breadcrumbs -->
  
    <div class="container-fluid bg-3" id="preloader">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="loader20">Loading...</div>
                </div>
            </div>
        </div>
    </div>

    <section class="inner-page">
      <div class="container" data-aos="fade-up">
					
	    <div class="row">

		  <?php
		  
		  //include "mdl-includes/smtpmail/test.php";
		  
		  if (isset($_POST["register"])) {
			
			$firstname = LEGALTEXT($_POST["firstname"]);
			$lastname = LEGALTEXT($_POST["lastname"]);
			$email = LEGALTEXT($_POST["email"]);
			$whatsapp = LEGALTEXT($_POST["whatsapp"]);
			$password = LEGALTEXT(md5($_POST["password"]));
			$repassword = LEGALTEXT($_POST["repassword"]);
				  
			$verify = md5($firstname.$lastname.$email.$password)."-".md5($DBdatetime);
			
			$userQR2 = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_name`='".strtolower($firstname.$lastname)."'");
			$userNUM2 = $userQR2 -> num_rows;
			if($userNUM2 > 0){
				$username = strtolower($firstname.$lastname).rand(111,999);
			} else {
				$username = strtolower($firstname.$lastname);
			}
				  
			$userQR = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_email`='".$email."'");
			$userNUM = $userQR -> num_rows;
			
			if($userNUM == 0){
			  $insert = "INSERT INTO `mdl_user`(`user_id`, `user_name`, `user_password`, `user_category`, `user_first_name`, `user_last_name`, `user_content`, `user_thumb`, `user_company`, `user_address`, `user_location`, `user_map`, `user_email`, `user_url`, `user_phone`, `user_wa`, `user_ktp`, `user_npwp`, `user_document`, `user_payment`, `user_instagram`, `user_facebook`, `user_youtube`, `user_linkedin`, `user_twitter`, `user_tiktok`, `user_registered`, `user_activated`, `user_position`, `user_verify`, `user_status`) VALUES ('', '$username', '$password', '', '$firstname', '$lastname', '', '', '', '', '', '', '$email', '', '', '$whatsapp', '', '', '', '', '', '', '', '', '', '', '$DBdatetime', '','subscriber', '$verify', 'draft')";
			  
			  //$result = $db->conn -> query($insert);
			?>

<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
//$email = "bhibin.jepara@gmail.com";

//Load Composer's autoloader
require 'mdl-includes/smtpmail/librarysmtp/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
?>
<div style="display: none">
<?php
//Server settings
		$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
		$mail->isSMTP();                                            //Send using SMTP
		$mail->Host       = 'jifbw.com';                     //hostname/domain yang dipergunakan untuk setting smtp
		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		$mail->Username   = 'admin@jifbw.com';                     //SMTP username
		$mail->Password   = 'Anakjepara***321_';                               //SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
		$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

		//Recipients
		$mail->setFrom('admin@jifbw.com', 'Account Verify');
		$mail->addAddress($email, 'Bhibin');     //email tujuan
		#$mail->addReplyTo('emailtujuan@domainaddreply.com', 'Information'); //email tujuan add reply (bila tidak dibutuhkan bisa diberi pagar)
		#$mail->addCC('emailtujuan@domaincc.com'); // email cc (bila tidak dibutuhkan bisa diberi pagar)
		#$mail->addBCC('emailtujuan@domainbcc.com'); // email bcc (bila tidak dibutuhkan bisa diberi pagar)

		//Attachments
		#$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
		#$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

		//Content
		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->Subject = 'Account Register Varify JIFBW.com';
		$mail->Body    = "Terimakasih sudah begabung, Silahkan veryfikasi akun anda dengan cara klik link ini dibawah ini: <br> <a href='https://www.jifbw.com/verify/".$verify."' style='color:blue;'><b>Verify Account JIF-BW</b></a>";
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		$mail->send();
    echo 'Message has been sent';

?>
</div>

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
		  <?php 
			} else {?>
			
		  <div class="col-12 col-lg-4" style="margin: 0 auto;">
			<div class="register-box">
			
			  <div class="card">
				<div class="card-body register-card-body">
				  <p class="login-box-msg"><b>Register New Account</b></p>
				<?php
				  if($userNUM > 0){
					echo "<p class='text-danger'>Email sudah terdaftar</p>";
				  }
				?>
				  <form method="post" action="<?php echo DB_LOCAL.DB_LINK;?>/sign-up/">
				  <form method="post" action="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/smtpmail/sendmail.php">
					<div class="input-group mb-3">
					  <input type="text" class="form-control" placeholder="First name" name="firstname" required>
					  <div class="input-group-append">
						<div class="input-group-text">
						  <span class="fas fa-user"></span>
						</div>
					  </div>
					</div>
					
					<div class="input-group mb-3">
					  <input type="text" class="form-control" placeholder="Last name" name="lastname" required>
					  <div class="input-group-append">
						<div class="input-group-text">
						  <span class="fas fa-user"></span>
						</div>
					  </div>
					</div>
					
					<div class="input-group mb-3">
					  <input type="email" class="form-control" placeholder="Email" name="email" required>
					  <div class="input-group-append">
						<div class="input-group-text">
						  <span class="fas fa-envelope"></span>
						</div>
					  </div>
					</div>
					
					<div class="input-group mb-3">
					  <input type="text" class="form-control" placeholder="WhatsApp" name="whatsapp" required>
					  <div class="input-group-append">
						<div class="input-group-text">
						  <span class="fab fa-whatsapp"></span>
						</div>
					  </div>
					</div>
					
					<div class="input-group mb-3">
					  <input type="password" class="form-control" placeholder="Password" minlength="8" id="password" name="password" required>
					  <div class="input-group-append">
						<div class="input-group-text">
						  <span class="fas fa-lock"></span>
						</div>
					  </div>
					</div>
					
					<div class="input-group mb-3">
					  <input type="password" class="form-control" placeholder="Retype password" minlength="8" id="confirm_password" name="repassword" required>
					  <div class="input-group-append">
						<div class="input-group-text">
						  <span class="fas fa-lock"></span>
						</div>
					  </div>
					</div>
					<div class="row">
					  <!-- /.col -->
					  <div class="col-12">
						<button type="submit" class="btn btn-primary btn-block" style="margin: 0 auto;" name="register">Register</button>
					  </div>
					  <!-- /.col -->
					</div>
				  </form>

				  <div class="social-auth-links text-center">
					<p>- OR -</p>
					
					  <div class="col-12">
					    You have account ? <a href="<?php echo DB_LOCAL.DB_LINK."/login/";?>" title="Login">Login</a>
					  </div>
				  </div>
				  
				</div>
				<!-- /.form-box -->
			  </div><!-- /.card -->
			</div>
          </div>
		  
			<?php 
			}
		  }
		  
		  if (!isset($_POST["register"])) {
		  ?>
		  
		  <div class="col-12 col-lg-4" style="margin: 0 auto;">
			<div class="register-box">
			
			  <div class="card">
				<div class="card-body register-card-body">
				  <p class="login-box-msg"><b>Register New Account</b></p>
				<?php
				if (isset($_POST["register"])) {
				  $userQR = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_email`='".$email."'");
				  $userNUM = $userQR -> num_rows;
				  if($userNUM > 0){
					echo "<p class='text-danger'>Email sudah terdaftar</p>";
				  }
				}
				?>
				  <form method="post" action="<?php echo DB_LOCAL.DB_LINK;?>/sign-up/">
					<div class="input-group mb-3">
					  <input type="text" class="form-control" placeholder="First name" name="firstname" minlength="3" required>
					  <div class="input-group-append">
						<div class="input-group-text">
						  <span class="fas fa-user"></span>
						</div>
					  </div>
					</div>
					
					<div class="input-group mb-3">
					  <input type="text" class="form-control" placeholder="Last name" name="lastname" required>
					  <div class="input-group-append">
						<div class="input-group-text">
						  <span class="fas fa-user"></span>
						</div>
					  </div>
					</div>
					
					<div class="input-group mb-3">
					  <input type="email" class="form-control" placeholder="Exp : someone@gmail.com" name="email" pattern="[^ @]*@[^ @]*" required>
					  <div class="input-group-append">
						<div class="input-group-text">
						  <span class="fas fa-envelope"></span>
						</div>
					  </div>
					</div>
					
					<div class="input-group mb-3">
					  <input type="text" class="form-control" placeholder="Exp : 6281xxxxxxxxx" name="whatsapp" pattern="([6][2][8][0-9]{10})|([6][2][8][0-9]{10})" title="Please enter valid phone number" required>
					  <div class="input-group-append">
						<div class="input-group-text">
						  <span class="fab fa-whatsapp"></span>
						</div>
					  </div>
					</div>
					
					<div class="input-group mb-3">
					  <input type="password" class="form-control" placeholder="Password" minlength="8" id="password" name="password" required>
					  <div class="input-group-append">
						<div class="input-group-text">
						  <span class="fas fa-lock"></span>
						</div>
					  </div>
					</div>
					
					<div class="input-group mb-3">
					  <input type="password" class="form-control" placeholder="Retype password" minlength="8" id="confirm_password" name="repassword" required>
					  <div class="input-group-append">
						<div class="input-group-text">
						  <span class="fas fa-lock"></span>
						</div>
					  </div>
					</div>
					<div class="row">
					  <!-- /.col -->
					  <div class="col-12">
						<button type="submit" class="btn btn-primary btn-block btn-global" style="margin: 0 auto;" name="register">Register</button>
					  </div>
					  <!-- /.col -->
					</div>
				  </form>

				  <div class="social-auth-links text-center">
					<p>- OR -</p>
					
					  <div class="col-12">
					    You have account ? <a href="<?php echo DB_LOCAL.DB_LINK."/login/";?>" title="Login">Login</a>
					  </div>
				  </div>
				  
				</div>
				<!-- /.form-box -->
			  </div><!-- /.card -->
			</div>
          </div>
		  <?php } ?>
		  
        </div>
      </div>
    </section>

  </main><!-- End #main -->

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