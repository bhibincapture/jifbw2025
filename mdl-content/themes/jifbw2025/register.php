<?php
//
// Registration
//
if(!isset($_SESSION["login"]) && !isset($_SESSION["email"])){
  header ("location: ".DB_LOCAL.DB_LINK."/sign-up/");
} else {
  $email = $_SESSION["email"];
  $usersessionDB = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_email`='".$email."'") -> fetch_assoc();
  $companyDB = $db->conn -> query("SELECT * FROM `mdl_user_company` WHERE `user_id`='".$usersessionDB["user_id"]."'") -> fetch_assoc();
  
  if($usersessionDB["user_position"] == "member"){ $disc = "50%"; $percentage = "50";}
  if($usersessionDB["user_position"] == "subscriber"){ $disc = "30%"; $percentage = "30";}
  
  $iduser = $usersessionDB["user_id"];
  $registerQR = $db->conn -> query("SELECT * FROM `mdl_user_register` WHERE `user_id`='".$iduser."'");
  $registerNUM = $registerQR -> num_rows;
  $registerDB = $registerQR -> fetch_assoc();


  if($registerNUM == 0){
    if(isset($_POST["register"])){
      $select = $_POST["paketmember"];
    
      $usercatDB = $db->conn -> query("SELECT * FROM `mdl_user_category` WHERE `usercat_slug`='$select'") -> fetch_assoc();
      $member = $usercatDB["usercat_id"];
      $venue = $_POST["paketvenue"];
    
      $query = "INSERT INTO `mdl_user_register`(`register_id`, `user_id`, `register_agree`, `register_package`, `register_vanue`, `register_ktp`, `register_npwp`, `register_document`, `register_payment`, `register_datetime`, `register_activated`, `register_status`) VALUES ('', '$iduser', 'yes', '$member', '$venue', '', '', '', '', '$DBdatetime', '','pending')";
      $insert = $db->conn -> query($query);
    
      if($insert === true){
        header ("location: ".DB_LOCAL.DB_LINK."/register/?next=f8dd2d40529d8e929d93a77596f0636e");
      }
    }
  }

  if($registerNUM == 1){
    if(isset($_POST["register"])){
      $select = $_POST["paketmember"];
    
      $usercatDB = $db->conn -> query("SELECT * FROM `mdl_user_category` WHERE `usercat_slug`='$select'") -> fetch_assoc();
      $member = $usercatDB["usercat_id"];
      $venue = $_POST["paketvenue"];
      
      $query = "UPDATE `mdl_user_register` SET `register_package`='$member', `register_vanue`='$venue' WHERE `user_id`='$iduser'";
      $insert = $db->conn -> query($query);
    
      if($insert === true){
        header ("location: ".DB_LOCAL.DB_LINK."/register/?next=f8dd2d40529d8e929d93a77596f0636e");
      }
    }
    
    if(isset($_POST["company-register"])){
      $thumb = $_POST["thumb"];
      $companyname = LEGALTEXT($_POST["companyname"]);
      $useraddress = LEGALTEXT($_POST["useraddress"]);
      $userwebsite = $_POST["userwebsite"];
      $userphone = $_POST["userphone"];
      $userwhatsapp = $_POST["userwhatsapp"];
      $content = LEGALTEXT($_POST["content"]);
      $userlocation = $_POST["userlocation"];
      $usermap = LEGALTEXT($_POST["usermap"]);
      $mondayopen = $_POST["mondayopen"];
      $mondayclose = $_POST["mondayclose"];
      $tuesdayopen = $_POST["tuesdayopen"];
      $tuesdayclose = $_POST["tuesdayclose"];
      $wednesdayopen = $_POST["wednesdayopen"];
      $wednesdayclose = $_POST["wednesdayclose"];
      $thursdayopen = $_POST["thursdayopen"];
      $thursdayclose = $_POST["thursdayclose"];
      $fridayopen = $_POST["fridayopen"];
      $fridayclose = $_POST["fridayclose"];
      $saturdayopen = $_POST["saturdayopen"];
      $saturdayclose = $_POST["saturdayclose"];
      $sundayopen = $_POST["sundayopen"];
      $sundayclose = $_POST["sundayclose"];
      $userinstagram = $_POST["userinstagram"];
      $userfacebook = $_POST["userfacebook"];
      $useryoutube = $_POST["useryoutube"];
      $userlinkedin = $_POST["userlinkedin"];
      $usertwitter = $_POST["usertwitter"];
      $usertiktok = $_POST["usertiktok"];
      $username = LEGALTEXT($_POST["username"]);
      
      //$usersessionDB = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_email`='".$_SESSION["email"]."'") -> fetch_assoc();
      //$iduser = $usersessionDB["user_id"];
      
      $update = "UPDATE `mdl_user_company` SET 
          `company_thumb`='$thumb', 
          `company_content`='$content', 
          `company_name`='$companyname', 
          `company_address`='$useraddress', 
          `company_location`='$userlocation', 
          `company_map`='$usermap', 
          `company_url`='$userwebsite', 
          `company_phone`='$userphone', 
          `company_wa`='$userwhatsapp', 
          `company_instagram`='$userinstagram', 
          `company_facebook`='$userfacebook', 
          `company_youtube`='$useryoutube', 
          `company_linkedin`='$userlinkedin', 
          `company_twitter`='$usertwitter', 
          `company_tiktok`='$usertiktok', 
          `company_sunday_open`='$sundayopen', 
          `company_sunday_close`='$sundayclose', 
          `company_monday_open`='$mondayopen', 
          `company_monday_close`='$mondayclose', 
          `company_tuesday_open`='$tuesdayopen', 
          `company_tuesday_close`='$tuesdayclose', 
          `company_wednesday_open`='$wednesdayopen',
          `company_wednesday_close`='$wednesdayclose', 
          `company_thursday_open`='$thursdayopen', 
          `company_thursday_close`='$thursdayclose',
          `company_friday_open`='$fridayopen', 
          `company_friday_close`='$fridayclose', 
          `company_saturday_open`='$saturdayopen', 
          `company_saturday_close`='$saturdayclose' 
      WHERE `user_id`='$iduser'";
        
      $result = $db->conn -> query($update);
        
      if($result === true){
        header ("location: ".DB_LOCAL.DB_LINK."/register/?next=c8410760e39ebfd8efa8b986aeb20121");
      }
    }
    
    if(isset($_POST["saveproduct"])){
      $iduser = $usersessionDB["user_id"];
      $thumb = $_POST["thumb"];
      $name = LEGALTEXT(ucwords(strtolower($_POST["nameproduct"])));
      
      $productQR = $db->conn -> query("SELECT * FROM `mdl_product` WHERE `product_title`='".$name."'");
      $productNUM = $productQR -> num_rows;
      
      if($productNUM > 0){
    	$slug = md5($name.$iduser.rand(111,999));
      } else {
    	$slug = md5($name);
      }
      
      $content = htmlspecialchars(LEGALTEXT($_POST["content"]));
      
      $product = "INSERT `mdl_product` (`product_id`, `product_title`, `product_slug`, `product_content`, `product_category`, `product_tags`, `product_template`, `product_short`, `product_thumb`, `product_author`, `product_comment`, `product_visibility`, `product_password`, `product_datetime`, `product_datemodify`, `product_status`) VALUES ('', '$name', '$slug', '$content', ',1,', '', '', '', '$thumb', '$iduser', 'no', 'public', '', '$DBdatetime', '$DBdatetime', 'published')";
      
      $insert = $db->conn -> query($product);
      
      if($insert === true){
    	$productQR2 = $db->conn -> query("SELECT * FROM `mdl_product` WHERE `product_slug`='".$slug."'");
        $productDB = $productQR2 -> num_rows;
    	$idproduct = $productDB["product_id"];
    	
    	$media = "UPDATE `mdl_media` SET `media_page_name`='product' && `media_page_id`='product' WHERE `media_id`='$idproduct'";
        $mediaupdate = $db->conn -> query($media);
    	
        header ("location: ".DB_LOCAL.DB_LINK."/register/?next=c8410760e39ebfd8efa8b986aeb20121");
      }
    }
    
    if(isset($_POST["updateproduct"])){
      $iduser = $usersessionDB["user_id"];
      $slugproduct = $_POST["id"];
      $thumb = $_POST["thumb"];
      $status = strtolower($_POST["statusproduct"]);
      $name = LEGALTEXT(ucwords(strtolower($_POST["nameproduct"])));
      
      $productQR = $db->conn -> query("SELECT * FROM `mdl_product` WHERE `product_slug`!='$slugproduct' && `product_title`='".$name."'");
      $productNUM = $productQR -> num_rows;
      
      if($productNUM > 0){
    	$slug = md5($name.$iduser.rand(111,999));
      } else {
    	$slug = md5($name);
      }
      
      $content = htmlspecialchars(LEGALTEXT($_POST["content"]));
      
      $product = "UPDATE `mdl_product` SET `product_title`='$name', `product_slug`='$slug', `product_thumb`='$thumb', `product_content`='$content', `product_status`='$status', `product_datemodify`='$DBdatetime' WHERE `product_slug`='$slugproduct'";
      
      $insert = $db->conn -> query($product);
      
      if($insert === true){
    	
        header ("location: ".DB_LOCAL.DB_LINK."/register/?next=c8410760e39ebfd8efa8b986aeb20121");
      }
    }
  }
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

    <section class="inner-page">
      <div class="container">
					
	    <div class="row">
		<?php
        if(!isset($_GET["next"])) {
		  ?>
			
	      <div class="col-12 col-lg-3">
		    <div class="card mb-2">
              <div class="card-header p-2">
                <h4 class="card-title m-0" style="font-size: 18px;"><i class="fas fa-bars"></i> <b>Menu</b></h4>
              </div>
              <div class="card-body p-2">
                <div class="row">
				  
                  <div class="col-12 mb-2">
					<button type="button" class="btn btn-outline-danger col-12" style="text-align: left;" disabled><i class="fas fa-file-contract"></i> Syarat & Ketentuan</button>
                  </div>
				  
                  <div class="col-12 mb-2">
					<button type="button" class="btn btn-outline-danger col-12 active" style="text-align: left;"><i class="fas fa-pen-square"></i> Form Registration</button>
                  </div>
				  
                  <div class="col-12 mb-2">
					<button type="button" class="btn btn-outline-danger col-12" style="text-align: left;" disabled><i class="fas fa-hotel"></i> Form Company Profile</button>
                  </div>
				  
                  <div class="col-12 mb-2">
					<button type="button" class="btn btn-outline-danger col-12" style="text-align: left;" disabled><i class="fas fa-images"></i> Product</button>
                  </div>
				  
                  <div class="col-12 mb-2">
					<button type="button" class="btn btn-outline-danger col-12" style="text-align: left;" disabled><i class="far fa-folder-open"></i> Data Document</button>
                  </div>
				  
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
			
	      <div class="col-12 col-lg-9">
	        <div class="row">
	          <div class="col-12 mb-2">
	            <?php include "mdl-includes/register/form-registration.php";?>
	          </div>
	        </div>
		  </div>
		<?php }
		if(isset($_GET["next"])){
		  if($_GET["next"] == "f8dd2d40529d8e929d93a77596f0636e"){?>
	        <div class="col-12 col-lg-3">
		      <div class="card mb-2">
                <div class="card-header p-2">
                  <h4 class="card-title m-0" style="font-size: 18px;"><i class="fas fa-bars"></i> <b>Menu</b></h4>
                </div>
                <div class="card-body p-2">
                  <div class="row">
				  
                    <div class="col-12 mb-2">
					  <button type="button" class="btn btn-outline-danger col-12" style="text-align: left;" disabled><i class="fas fa-file-contract"></i> Syarat & Ketentuan</button>
                    </div>
				  
                    <div class="col-12 mb-2">
				      <button type="button" class="btn btn-outline-danger col-12" style="text-align: left;" disabled><i class="fas fa-pen-square"></i> Form Registration</button>
                    </div>
				  
                    <div class="col-12 mb-2">
					  <button type="button" class="btn btn-outline-danger col-12 active" style="text-align: left;"><i class="fas fa-hotel"></i> Form Company Profile</button>
                    </div>
				  
                    <div class="col-12 mb-2">
					  <button type="button" class="btn btn-outline-danger col-12" style="text-align: left;" disabled><i class="fas fa-images"></i> Product</button>
                    </div>
				  
                    <div class="col-12 mb-2">
					  <button type="button" class="btn btn-outline-danger col-12" style="text-align: left;" disabled><i class="far fa-folder-open"></i> Data Document</button>
                    </div>
				  
                  </div>
                </div>
              </div>
            </div>
			
	        <div class="col-12 col-lg-9">
	          <div class="row">
	            <div class="col-12 mb-2">
	              <?php 
	              $usercat = $registerDB["register_package"];
    			  $usercatQR = $db->conn -> query("SELECT * FROM `mdl_user_category` WHERE `usercat_id`='$usercat'");
    			  $usercatDB = $usercatQR -> fetch_assoc();
    			  
    			  if($usercatDB["usercat_slug"] == "platinum"){
	                include "mdl-includes/register/form-company-profile-platinum.php";
    			  }
    			  if($usercatDB["usercat_slug"] == "gold"){
	                //include "mdl-includes/register/form-company-profile-gold.php";
	                include "mdl-includes/register/form-company-profile-platinum.php";
    			  }
    			  if($usercatDB["usercat_slug"] == "silver"){
	                //include "mdl-includes/register/form-company-profile-silver.php";
	                include "mdl-includes/register/form-company-profile-platinum.php";
    			  }
    			  if($usercatDB["usercat_slug"] == "bronze"){
	                include "mdl-includes/register/form-company-profile-bronze.php";
    			  }
	              ?>
	            </div>
	          </div>
		    </div>
		  <?php }
		  if($_GET["next"] == "c8410760e39ebfd8efa8b986aeb20121"){?>
	        <div class="col-12 col-lg-3">
		      <div class="card mb-2">
                <div class="card-header p-2">
                  <h4 class="card-title m-0" style="font-size: 18px;"><i class="fas fa-bars"></i> <b>Menu</b></h4>
                </div>
                <div class="card-body p-2">
                  <div class="row">
				  
                    <div class="col-12 mb-2">
					  <button type="button" class="btn btn-outline-danger col-12" style="text-align: left;" disabled><i class="fas fa-file-contract"></i> Syarat & Ketentuan</button>
                    </div>
				  
                    <div class="col-12 mb-2">
				      <button type="button" class="btn btn-outline-danger col-12" style="text-align: left;" disabled><i class="fas fa-pen-square"></i> Form Registration</button>
                    </div>
				  
                    <div class="col-12 mb-2">
					  <button type="button" class="btn btn-outline-danger col-12" style="text-align: left;" disabled><i class="fas fa-hotel"></i> Form Company Profile</button>
                    </div>
				  
                    <div class="col-12 mb-2">
					  <button type="button" class="btn btn-outline-danger col-12 active" style="text-align: left;"><i class="fas fa-images"></i> Product</button>
                    </div>
				  
                    <div class="col-12 mb-2">
					  <button type="button" class="btn btn-outline-danger col-12" style="text-align: left;" disabled><i class="far fa-folder-open"></i> Data Document</button>
                    </div>
				  
                  </div>
                </div>
              </div>
            </div>
            
	        <div class="col-12 col-lg-9">
	          <div class="row">
	            <div class="col-12 mb-2">
	              <?php
	              include "mdl-includes/register/product.php";
	              ?>
	            </div>
	          </div>
		    </div>
		  <?php }
		  if($_GET["next"] == "e0958b5e4e52d0a58eb5b08e94e0322d"){?>
	        <div class="col-12 col-lg-3">
		      <div class="card mb-2">
                <div class="card-header p-2">
                  <h4 class="card-title m-0" style="font-size: 18px;"><i class="fas fa-bars"></i> <b>Menu</b></h4>
                </div>
                <div class="card-body p-2">
                  <div class="row">
				  
                    <div class="col-12 mb-2">
					  <button type="button" class="btn btn-outline-danger col-12" style="text-align: left;" disabled><i class="fas fa-file-contract"></i> Syarat & Ketentuan</button>
                    </div>
				  
                    <div class="col-12 mb-2">
				      <button type="button" class="btn btn-outline-danger col-12" style="text-align: left;" disabled><i class="fas fa-pen-square"></i> Form Registration</button>
                    </div>
				  
                    <div class="col-12 mb-2">
					  <button type="button" class="btn btn-outline-danger col-12" style="text-align: left;" disabled><i class="fas fa-hotel"></i> Form Company Profile</button>
                    </div>
				  
                    <div class="col-12 mb-2">
					  <button type="button" class="btn btn-outline-danger col-12" style="text-align: left;" disabled><i class="fas fa-images"></i> Product</button>
                    </div>
				  
                    <div class="col-12 mb-2">
					  <button type="button" class="btn btn-outline-danger col-12 active" style="text-align: left;"><i class="far fa-folder-open"></i> Data Document</button>
                    </div>
				  
                  </div>
                </div>
              </div>
            </div>
			
	        <div class="col-12 col-lg-9">
	          <div class="row">
	            <?php
        		if($registerNUM > 0){
        		  if($registerDB["register_status"] == "pending"){
        		    if($registerDB["register_ktp"] == "" OR $registerDB["register_npwp"] == "" OR $registerDB["register_document"] == "" OR $registerDB["register_payment"] == "") {
        		?>
        		  <div class="col-12 col-lg-12 mb-2" style="margin: 0 auto;">
        			<div class="card border-0">
        			  <div class="card-body register-card-body p-0">
        				<div class="alert alert-danger alert-dismissible" style="font-size:16px;">
        				  <h2 style="font-size: 25px;"><i class="fas fa-info-circle"></i> Status Pending, Your registration has been entered into the database</h2>
        				  <h3 style="font-size: 18px;">Silahkan Lengkapi Data Diabawah Ini :</h3>
        				  <?php if($registerDB["register_ktp"] == ""){?>
        					<p class="mb-0"><i class="fas fa-times-circle"></i> Data KTP Kosong</p>
        				  <?php } else { ?>
        				    <p class="text-success mb-0"><b><i class="fas fa-check-circle"></i> Data KTP Uploaded</b></p>
        				  <?php } ?>
        				  
        				  <?php if($registerDB["register_npwp"] == ""){?>
        					<p class="mb-0"><i class="fas fa-times-circle"></i> Data NPWP Kosong</p>
        				  <?php } else { ?>
        					<p class="text-success mb-0"><b><i class="fas fa-check-circle"></i> Data NPWP Uploaded</b></p>
        				  <?php } ?>
        				  
        				  <?php if($registerDB["register_document"] == ""){?>
        					<p class="mb-0"><i class="fas fa-times-circle"></i> Data Izin Usaha Kosong</p>
        				  <?php } else { ?>
        					<p class="text-success mb-0"><b><i class="fas fa-check-circle"></i> Data Izin Usaha Uploaded</b></p>
        				  <?php } ?>
        				  
        				  <?php if($registerDB["register_payment"] == ""){?>
        					<p class="mb-0"><i class="fas fa-times-circle"></i> Data Bukti Pembayaran Kosong</p>
        				  <?php } else { ?>
        					<p class="text-success mb-0"><b><i class="fas fa-check-circle"></i> Data Bukti Pembayaran Uploaded</b></p>
        				  <?php } ?>
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
        				  <a href="https://wa.me/6281392346101?text=Halo,%20saya%20konfirmasi%20email%20<?php echo $usersessionDB["user_email"];?>%20sudah%20melengkapi%20registrasi,%20mohon%20segera%20dicek%20terimakasih"><h3 class="btn" style="font-size: 18px;background: #35a321;color: #fff;"><i class="fab fa-whatsapp"></i> Chat WA +6281392346101</h3></a>
        				</div>
        			  </div>
        			</div>
        		  </div>
        		    <?php
        		    }
        		  } if($registerDB["register_status"] == "published") { ?>
        		  <div class="col-12 col-lg-12" style="margin: 0 auto;">
        			<div class="card border-0">
        			  <div class="card-body register-card-body p-0">
        				<div class="alert alert-success alert-dismissible" style="font-size:16px;">
        				  <h2 class="mb-3" style="font-size: 23px;"><i class="fas fa-check-circle"></i> Congratulations, your registration is successful. We have activated your Exhibitor account.</h2>
        				  <h3 style="font-size: 20px;">Please visit the user page: <a href="<?php echo DB_LOCAL.DB_LINK."/user/".$usersessionDB["user_name"]."/";?>" class="btn" style="font-size: 18px;background: #35a321;color: #fff;"><span>Visit User Page</span></a></h3>
        				</div>
        			  </div>
        			</div>
        		  </div>
        		  <?php
        		  } else {}
        		}?>
        		
	            <div class="col-12 mb-2">
	              <?php
	              include "mdl-includes/register/input-document.php";
	              ?>
	            </div>
	          </div>
		    </div>
		  <?php }
		} ?>
        </div>
      </div>
    </section>

  </main>
  
<?php include "footer.php";?>