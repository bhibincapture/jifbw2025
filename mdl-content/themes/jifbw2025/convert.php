<?php
// Keperluan Convert
include "header.php";

/*$userQR = $db->conn -> query("SELECT * FROM `mdl_user`");
while($userDB = $userQR -> fetch_assoc()){
	$email = $userDB["user_email"];
	$email2 = md5($email);
	
	$update = "UPDATE `mdl_user` SET `user_name_id`='$email2' WHERE `user_email`='$email'";
	$insert = $db->conn -> query($update);
}

$userQR = $db->conn -> query("SELECT * FROM `mdl_user`");
while($userDB = $userQR -> fetch_assoc()){
	$email = $userDB["user_email"];
	$email2 = md5($email);
	
	$update = "UPDATE `mdl_user` SET `user_status`='expired' WHERE `user_email`='$email' && `user_status`='draft'";
	$insert = $db->conn -> query($update);
}
$userQR = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_verify`=''");
while($userDB = $userQR -> fetch_assoc()){
    $firstname = $userDB["user_first_name"];
    $lastname = $userDB["user_last_name"];
	$email = $userDB["user_email"];
	$email2 = md5($email);
	$datetime = $userDB["user_registered"];
	
	$verify = md5($firstname.$lastname.$email)."-".md5($datetime);
	
	$update = "UPDATE `mdl_user` SET `user_verify`='$verify' WHERE `user_email`='$email' && `user_verify`=''";
	$insert = $db->conn -> query($update);
}
$userQR = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_name_id`='0'");
while($userDB = $userQR -> fetch_assoc()){
	$email = $userDB["user_email"];
	$email2 = md5($email);
	
	$update = "UPDATE `mdl_user` SET `user_name_id`='$email2', `user_name`='$email2' WHERE `user_email`='$email'";
	$insert = $db->conn -> query($update);
}*/
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
      <div class="container" data-aos="fade-up">
					
	    <div class="row">
		
        </div>
      </div>
    </section>

  </main><!-- End #main -->

<?php include "footer.php";?>