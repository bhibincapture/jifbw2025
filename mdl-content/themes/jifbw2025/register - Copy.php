<?php
//
// Registration
//
if(!isset($_SESSION["login"]) && !isset($_SESSION["email"])){
  header ("location: ".DB_LOCAL.DB_LINK."/login/");
} else {
  $email = $_SESSION["email"];
  $usersessionDB = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_email`='".$email."'") -> fetch_assoc();
  $companyDB = $db->conn -> query("SELECT * FROM `mdl_user_company` WHERE `user_id`='".$usersessionDB["user_id"]."'") -> fetch_assoc();
  
  if($usersessionDB["user_position"] == "member"){ $disc = "50%"; $percentage = "50";}
  if($usersessionDB["user_position"] == "subscriber"){ $disc = "25%"; $percentage = "25";}
  
$iduser = $usersessionDB["user_id"];
$registerQR = $db->conn -> query("SELECT * FROM `mdl_user_register` WHERE `user_id`='".$iduser."'");
$registerNUM = $registerQR -> num_rows;
$registerDB = $registerQR -> fetch_assoc();

}

include "header.php";?>
  <main id="main">
				
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="<?php echo DB_LOCAL.DB_LINK."/";?>">Home</a></li>
          <li>Exhibitor Registration</li>
        </ol>
        <h1>Exhibitor Registration</h1>
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
		  if($registerNUM > 0){
			if($registerDB["register_ktp"] = "" OR $registerDB["register_npwp"] = "" OR $registerDB["register_document"] = "" OR $registerDB["register_payment"] = "") {
			?>
		  <div class="col-12 col-lg-12" style="margin: 0 auto;">
			<div class="card border-0">
			  <div class="card-body register-card-body p-0">
				<div class="alert alert-danger alert-dismissible" style="font-size:16px;">
				  <h2 style="font-size: 25px;"><i class="fas fa-info-circle"></i> Status Pending, Your registration has been entered into the database</h2>
				  <h3 style="font-size: 18px;">Silahkan Lengkapi Data Diabawah Ini :</h3>
					<p class="mb-0"><i class="fas fa-times-circle"></i> Data KTP Kosong</p>
					<p class="mb-0"><i class="fas fa-times-circle"></i> Data NPWP Kosong</p>
					<p class="mb-0"><i class="fas fa-times-circle"></i> Data Izin Usaha Kosong</p>
					<p class="mb-0"><i class="fas fa-times-circle"></i> Data Bukti Pembayaran Kosong</p>
				</div>
			  </div>
			</div>
		  </div>
		  <?php 
			} else { ?>
		  <div class="col-12 col-lg-12" style="margin: 0 auto;">
			<div class="card border-0">
			  <div class="card-body register-card-body p-0">
				<div class="alert alert-success alert-dismissible" style="font-size:16px;">
				  <h2 class="mb-3" style="font-size: 23px;"><i class="fas fa-check-circle"></i> Your data is complete, we will confirm activate the Exhibitor.</h2>
				  <h3 class="btn" style="font-size: 18px;background: #35a321;color: #fff;"><i class="fab fa-whatsapp"></i> Chat WA +6281392346101</h3>
				</div>
			  </div>
			</div>
		  </div>
		  <?php
			}
		  } 
		  
if(isset($_POST["register"])){
	$company = $_POST["companyname"];
	$member = $_POST["paketmember"];
	$venue = $_POST["paketvenue"];
				
	$ktp = $_FILES["dataktp"]["name"];
	$npwp = $_FILES["datanpwp"]["name"];
	$document = $_FILES["datadocument"]["name"];
	$payment = $_FILES["datapayment"]["name"];
	
	//rename file
	$exp    = explode(".", $nama);
	$exsten = end($exp);
	$xname 	= str_replace(".$exsten", "", $nama);
	$rename = str_replace(" ", "-", $xname);
	$rename = $rename."-".$user."-".$imgdate;
	$size   = $_FILES['file']['size']; 
	$asal   = $_FILES['file']['tmp_name'];
	$format = pathinfo($nama, PATHINFO_EXTENSION);

	// Membuat Folder Direktori
	$thn 	= date('Y');
	$bln 	= date('m');
	$dir = "../../../mdl-content/uploads/".$thn."/".$bln;
	$url 	= "/mdl-content/uploads/".$thn."/".$bln;
	if (!file_exists($dir)){ mkdir($dir, 0755, true); }

	// Set-Up Ukuran Rezise
	$small_size		= 250;
	$medium_size	= 600;
	$large_size		= 1280;
	$super_size		= 1920;
		
	$target_file = $target_dir . basename($nama);
	
	echo $company."<br/>";
	echo $member."<br/>";
	echo $venue."<br/>";
	echo "<img src='".$ktp."'><br/>";
	echo "<img src='".$npwp."'><br/>";
	echo "<img src='".$document."'><br/>";
	echo "<img src='".$paymen."'><br/>";
}
		  ?>
			
	      <div class="col-12 col-lg-3">
		    <div class="card card-danger mb-3" style="font-size:14px;">
              <div class="card-header">
                <h4 class="card-title m-0"><i class="fas fa-bars"></i> <b>Menu</b></h4>
              </div>
              <div class="card-body">
                <div class="row">
				  
                  <div class="col-12 mb-3">
					<button type="button" class="btn btn-outline-danger col-12" id="formCompany" style="text-align: left;"disabled><i class="fas fa-file-contract"></i> Syarat & Ketentuan</button>
                  </div>
				  
                  <div class="col-12 mb-3">
					<button type="button" class="btn btn-outline-danger col-12 active" id="userSetting" style="text-align: left;"><i class="fas fa-pen-square"></i> Form Registration</button>
                  </div>
				  
                  <div class="col-12 mb-3">
					<button type="button" class="btn btn-outline-danger col-12" id="formCompany" style="text-align: left;"disabled><i class="fas fa-home"></i> Form Company Profile</button>
                  </div>
				  
                </div>
              </div>
              <!-- /.card-body -->
            </div>
			
		    <div class="card card-danger mb-3" id="menuMemberFees" style="font-size:14px;">
              <div class="card-header">
                <h4 class="card-title m-0" style="font-size:20px;"><i class="fas fa-shopping-basket"></i> <b>Membership Fees</b></h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 mb-3">
				    <p class="mb-1"><span id="memberSelect">
					  Hybrid Exhibition : <b><?php echo RP("3000000");?></b>
					</span></p>
					<p class="mb-1">Venue Exhibition : <b><span id="joinSelect">No Join</span></b></p>
					<p class="mb-1">Discount Membership : <b><?php echo $disc;?></b></p>
                  </div>
                </div>
              </div>
			  <div class="card-footer">
				<div class="row">
				  <div class="col-12">
					<b>Total : <span class="text-danger" id="payTotal"><?php echo RP(3000000 - (($percentage/100) * 3000000));?></span></b>
				  </div>
				</div>
              </div>
              <!-- /.card-body -->
            </div>
			
		    <div class="card card-danger mb-3" style="font-size:14px;">
              <div class="card-header">
                <h4 class="card-title m-0" style="font-size:20px;">
				<i class="far fa-share-square"></i> <b>BANK TRANFER</b></h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 mb-3">
				    <p class="mb-1">Bank BRI Cab.Jepara</p>
					<p class="mb-1">No. Rek : 0022 0134 5678 568</p>
					<p class="mb-1">an. PT Jepara Gerak Production</p>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
			
	      <div class="col-12 col-lg-9">
		    <?php 
			include "mdl-includes/register/form-registration.php";
			?>
		  </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->
<?php include "footer.php";?>