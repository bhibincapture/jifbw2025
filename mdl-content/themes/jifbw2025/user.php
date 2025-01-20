<?php
// User
if(!isset($_SESSION["login"]) && !isset($_SESSION["email"])){
  header ("location: ".DB_LOCAL.DB_LINK."/login/");
} else {
  $email = $_SESSION["email"];
  $usersessionDB = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_email`='".$email."'") -> fetch_assoc();
  
  if($_SESSION["email"] != $userDB["user_email"]) {
	header ("location: ".DB_LOCAL.DB_LINK."/user/".$usersessionDB["user_name"]."/");
  }
  else {
	 
  }
}

include "header-user.php";
$companyDB = $db->conn -> query("SELECT * FROM `mdl_user_company` WHERE `user_id`='".$userDB["user_id"]."'") -> fetch_assoc();

if(isset($_GET["menu"])){
  if($_GET["menu"] == "product"){
	$usersetting = "";
	$userproduct = "active";
	$uservideo = "";
	$chatbox = "";
		
	$displaysetting = "none";
	$displayproduct = "block";
	$displayvideo = "none";
	$displaychatbox = "none";
  }
  else if($_GET["menu"] == "video"){
	$usersetting = "";
	$userproduct = "";
	$uservideo = "active";
	$chatbox = "";
		
	$displaysetting = "none";
	$displayproduct = "none";
	$displayvideo = "block";
	$displaychatbox = "none";
  } 
  else if($_GET["menu"] == "chat-box"){
	$usersetting = "";
	$userproduct = "";
	$uservideo = "";
	$chatbox = "active";
		
	$displaysetting = "none";
	$displayproduct = "none";
	$displayvideo = "none";
	$displaychatbox = "block";
  } 
  else {
	$usersetting = "active";
	$userproduct = "";
	$uservideo = "";
	$chatbox = "";
		
	$displaysetting = "block";
	$displayproduct = "none";
	$displayvideo = "none";
	$displaychatbox = "none";
  }
} else {
	$usersetting = "active";
	$userproduct = "";
	$uservideo = "";
	$chatbox = "";
		
	$displaysetting = "block";
	$displayproduct = "none";
	$displayvideo = "none";
	$displaychatbox = "none";
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
	
    header ("location: ".DB_LOCAL.DB_LINK."/user/".$usersessionDB["user_name"]."/?menu=product");
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
	
    header ("location: ".DB_LOCAL.DB_LINK."/user/".$usersessionDB["user_name"]."/?menu=product");
  }
}

if(isset($_POST["savevideoyoutube"])){
  $type = $_POST["typevideo"];
  
  $exp = explode("https://www.youtube.com/watch?v=", $_POST["videoyoutube"]);
  $count = count($exp);
  if($count == 2){
    $extnd = end($exp);
	
	$video = "https://www.youtube.com/embed/".$extnd;
	
    $update = "UPDATE `mdl_user_company` SET `company_video_type`='$type', `company_video`='$video' WHERE `user_id`='".$userDB["user_id"]."'";
  
    $process = $db->conn -> query($update);
  
    if($process === true){
	  header ("location: ".DB_LOCAL.DB_LINK."/user/".$usersessionDB["user_name"]."/?menu=video&$type");
    }
  }
  if($count == 1){
	$exp2 = explode("https://youtu.be/", $_POST["videoyoutube"]);
	$count2 = count($exp2);
	if($count2 == 2){
      $extnd2 = end($exp2);
	
	  $video = "https://www.youtube.com/embed/".$extnd2;
	
      $update = "UPDATE `mdl_user_company` SET `company_video_type`='$type', `company_video`='$video' WHERE `user_id`='".$userDB["user_id"]."'";
  
      $process = $db->conn -> query($update);
  
      if($process === true){
	    header ("location: ".DB_LOCAL.DB_LINK."/user/".$usersessionDB["user_name"]."/?menu=video&$type");
      }
	}
	
	if($count2 == 1){
	  header ("location: ".DB_LOCAL.DB_LINK."/user/".$usersessionDB["user_name"]."/?menu=video&msg=masukkan-link-dengan-benar");
    }
  }
}

if(isset($_POST["savevideoupload"])){
  
  $upload = $_FILES["uploadvideo"]["name"];
  
  $format = pathinfo($upload, PATHINFO_EXTENSION);
  
  if($format == "mov" || $format == "mp4" || $format == "m4v" || $format == "asf" || $format == "avi" || $format == "wmv" || $format == "m2ts" || $format == "3g2") {
    $exp    = explode(".", $upload);
    $exsten = end($exp);
	
	$imgdate = DATETIME("d H i s");
	$imgdate = str_replace(" ", "", $imgdate);

    $xname  = str_replace(".$exsten", "", $upload);
    $rename = str_replace(" ", "-", $xname);
  
    $rename = $rename."-".$imgdate;
	
    $size   = $_FILES['uploadvideo']['size']; 
	
    $asal   = $_FILES['uploadvideo']['tmp_name'];
	
	if($size <= 40000000){
	  // Membuat Folder Direktori
	  $thn 	= date('Y');
	  $bln 	= date('m');
	  $dir	= "mdl-content/videos/".$thn."/".$bln;
	  $url 	= "/mdl-content/videos/".$thn."/".$bln;
	  
	  if (!file_exists($dir)){ mkdir($dir, 0755, true); }
	  
	  $namabaru = $rename.".".$exsten;
	  move_uploaded_file($asal, $dir."/". $namabaru);
	  
	  $video = $url . "/" . $namabaru;
	  
	  $update = "UPDATE `mdl_user_company` SET `company_video_type`='upload', `company_video`='$video' WHERE `user_id`='".$userDB["user_id"]."'";
  
      $process = $db->conn -> query($update);
  
      if($process === true){
	    header ("location: ".DB_LOCAL.DB_LINK."/user/".$usersessionDB["user_name"]."/?menu=video");
      }
	  
	} else {
		header ("location: ".DB_LOCAL.DB_LINK."/user/".$usersessionDB["user_name"]."/?menu=video&msg=file-anda-melebihi-ukuran-maksimal-".$size."");
	}
  } else {
	header ("location: ".DB_LOCAL.DB_LINK."/user/".$usersessionDB["user_name"]."/?menu=video&msg=tipe-file-anda-tidak-di-dukung");
  }
  
  // Membuat Folder Direktori
  //$thn 	= date('Y');
  //$bln 	= date('m');
  //$dir = "../../mdl-content/videos/".$thn."/".$bln;
  //$url 	= "/mdl-content/videos/".$thn."/".$bln;
  //if (!file_exists($dir)){ mkdir($dir, 0755, true); }
}

if(isset($_POST["deletevideo"])){
  $filevideo = $_POST["filevideo"];
  $filevideo = str_replace("/mdl-content", "mdl-content", $filevideo);
  
  if(file_exists($filevideo)){
	$update = "UPDATE `mdl_user_company` SET `company_video_type`='', `company_video`='' WHERE `user_id`='".$userDB["user_id"]."'";
  
    $process = $db->conn -> query($update);
	
	if($process === true){
		unlink($filevideo);
	}
  } else {
	echo "<h2>File Gak Ada</h2>";
  }
}

if(isset($_POST["changeusername"])){
  $username = $_POST["username"];
  
  if(isset($_SESSION["login"]) && isset($_SESSION["email"])){
	$update = "UPDATE `mdl_user` SET `user_name_id`='$username' WHERE `user_id`='".$usersessionDB["user_id"]."'";
  
    $process = $db->conn -> query($update);
    if($process === TRUE){
      header ("location: ".DB_LOCAL.DB_LINK."/user/".$usersessionDB["user_name"]."/");
    }
  }
}
?>

  <main id="main">
				
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
        <?php
		$idusercat = $userDB["user_category"];
		$usercatQR = $db->conn -> query("SELECT * FROM `mdl_user_category` WHERE `usercat_id`='$idusercat'");
		$usercatDB = $usercatQR -> fetch_assoc();
		$usercatNUM = $usercatQR -> num_rows;
		
		$userposition = $userDB["user_position"];
		$usercategory = $userDB["user_category"];
		$userstatus = $userDB["user_status"];
		
		if($usercategory == 2){
		    $company = $userDB["user_name_id"];
		} else {
		    $company = $userDB["user_name"];
		}
		?>
        <ol>
          <li><a href="<?php echo DB_LOCAL.DB_LINK."/";?>">Home</a></li>
          <li>User</li>
        </ol>
        <h2 style="font-size: 26px;">
          Hello, <?php echo $userDB["user_first_name"]." ".$userDB["user_last_name"];?>
          <?php
          if($userposition == "member" && $userstatus != 'expired' && $userstatus != 'active' && $userstatus != 'draft'){
		    echo " | <a href='".DB_LOCAL.DB_LINK."/company-profile/".$company."/' title='Lihat Halaman' target='_blank' class='text-white'><span style='font-size: 16px;'><i class='fas fa-external-link-alt'></i> Lihat Halaman</span></a>";
		  }?>
        </h2>
		<?php
		if($userposition == "member"){
		  echo "<p><b>".ucfirst($userDB["user_position"])." : ".ucwords($usercatDB["usercat_title"]).", Status : ".ucfirst($userstatus)."</b></p>";
		}
		if($userposition == "subscriber" || $userposition == "sponsor"){
		  echo "<p><b>Status : ".ucfirst($userstatus)."</b></p>";
		}
		?>
      </div>
    </section>

    <section class="inner-page">
      <div class="container">
					
	    <div class="row">
			
	      <div class="col-12 col-lg-3">
		    <div class="card mb-2">
              <div class="card-header p-2">
                <h4 class="card-title m-0" style="font-size: 18px;"><i class="fas fa-bars"></i> <b>Menu</b></h4>
              </div>
              <div class="card-body p-0">
                <div class="row">
				  <?php if($userposition == "member"){?>
                  <div class="col-12 m-0">
					<button type="button" class="btn btn-outline-danger col-12 rounded-0" id="userCompany" style="text-align: left;font-size: 14px;"><i class="fas fa-home"></i> Company Profile</button>
                  </div>
				  
                  <div class="col-12 m-0">
					<button type="button mb-3" class="btn btn-outline-danger col-12 rounded-0 <?php echo $uservideo;?>" id="userVideo" style="text-align: left;font-size: 14px;"><i class="fas fa-film"></i> Upload Video</button>
                  </div>
				  
                  <div class="col-12 m-0">
                    <?php
                    if(isset($_GET["menu"])){
                      if($_GET["menu"] != "product"){?>
					    <a href="<?php echo DB_LOCAL.DB_LINK."/user/".$userDB["user_name"]."/?menu=product";?>" title="Chat Box">
    					  <button type="button mb-3" class="btn btn-outline-danger col-12 rounded-0 <?php echo $userproduct;?>" id="userProduct" style="text-align: left;font-size: 14px;"><i class="fas fa-images"></i> Product</button>
                        </a>
                      <?php }
                      else {?>
                        <button type="button mb-3" class="btn btn-outline-danger col-12 rounded-0 <?php echo $userproduct;?>" id="userProduct" style="text-align: left;font-size: 14px;"><i class="fas fa-images"></i> Product</button>
                      <?php }
                    } else {?>
					    <a href="<?php echo DB_LOCAL.DB_LINK."/user/".$userDB["user_name"]."/?menu=product";?>" title="Chat Box">
    					  <button type="button mb-3" class="btn btn-outline-danger col-12 rounded-0 <?php echo $userproduct;?>" id="userProduct" style="text-align: left;font-size: 14px;"><i class="fas fa-images"></i> Product</button>
                        </a>
                    <?php } ?>
                  </div>
				  <?php } ?>
				  
				  <?php if($userposition == "sponsor"){?>
                  <div class="col-12 m-0">
					<button type="button" class="btn btn-outline-danger col-12 rounded-0" id="userProfile" style="text-align: left;font-size: 14px;"><i class="fas fa-home"></i> My Profile</button>
                  </div>
                  
                  <div class="col-12 m-0">
					<button type="button mb-3" class="btn btn-outline-danger col-12 rounded-0" id="userVisitors" style="text-align: left;font-size: 14px;"><i class="fas fa-chart-line"></i> Visitors Analityc</button>
                  </div>
				  <?php } ?>
				  
				  <?php if($userposition == "subscriber"){?>
                  <div class="col-12 m-0">
					<button type="button" class="btn btn-outline-danger col-12 rounded-0" id="userProfile" style="text-align: left;font-size: 14px;"><i class="fas fa-home"></i> My Profile</button>
                  </div>
				  
                  <div class="col-12 m-0">
					<button type="button" class="btn btn-outline-danger col-12 rounded-0" id="userBookmark" style="text-align: left;font-size: 14px;"><i class="fas fa-bookmark"></i> Bookmark List</button>
                  </div>
                  
                  <div class="col-12 m-0">
                    <?php
                    if(isset($_GET["menu"])){
                      if($_GET["menu"] != "chat-box"){?>
                        <a href="<?php echo DB_LOCAL.DB_LINK."/user/".$userDB["user_name"]."/?menu=chat-box";?>" title="Chat Box">
    					  <button type="button mb-3" class="btn btn-outline-danger col-12 rounded-0 <?php echo $chatbox;?>" id="userMassager" style="text-align: left;font-size: 14px;"><i class="fas fa-comment-dots"></i> Chat Box</button>
    					</a>
    				  <?php }
                      else {?>
                        <button type="button mb-3" class="btn btn-outline-danger col-12 rounded-0 <?php echo $chatbox;?>" id="userMassager" style="text-align: left;font-size: 14px;"><i class="fas fa-comment-dots"></i> Chat Box</button>
                      <?php }
                    } else {?>
                      
                        <a href="<?php echo DB_LOCAL.DB_LINK."/user/".$userDB["user_name"]."/?menu=chat-box";?>" title="Chat Box">
    					  <button type="button mb-3" class="btn btn-outline-danger col-12 rounded-0 <?php echo $chatbox;?>" id="userMassager" style="text-align: left;font-size: 14px;"><i class="fas fa-comment-dots"></i> Chat Box</button>
    					</a>
                    <?php }
                    ?>
                  </div>
				  <?php } ?>
				  
				  <?php if($userposition == "member"){?>
				  
                  <div class="col-12 m-0">
                    <?php
                    if(isset($_GET["menu"])){
                      if($_GET["menu"] != "chat-box"){?>
                        <a href="<?php echo DB_LOCAL.DB_LINK."/user/".$userDB["user_name"]."/?menu=chat-box";?>" title="Chat Box">
    					  <button type="button mb-3" class="btn btn-outline-danger col-12 rounded-0 <?php echo $chatbox;?>" id="userMassager" style="text-align: left;font-size: 14px;"><i class="fas fa-comment-dots"></i> Chat Box</button>
    					</a>
    				  <?php }
                      else {?>
                        <button type="button mb-3" class="btn btn-outline-danger col-12 rounded-0 <?php echo $chatbox;?>" id="userMassager" style="text-align: left;font-size: 14px;"><i class="fas fa-comment-dots"></i> Chat Box</button>
                      <?php }
                    } else {?>
                      
                        <a href="<?php echo DB_LOCAL.DB_LINK."/user/".$userDB["user_name"]."/?menu=chat-box";?>" title="Chat Box">
    					  <button type="button mb-3" class="btn btn-outline-danger col-12 rounded-0 <?php echo $chatbox;?>" id="userMassager" style="text-align: left;font-size: 14px;"><i class="fas fa-comment-dots"></i> Chat Box</button>
    					</a>
                    <?php }
                    ?>
                  </div>

                  <div class="col-12 m-0">
					<button type="button mb-3" class="btn btn-outline-danger col-12 rounded-0" id="userVisitors" style="text-align: left;font-size: 14px;"><i class="fas fa-chart-line"></i> Visitors Analityc</button>
                  </div>
				  <?php } ?>
                  
                  <div class="col-12 m-0">
					<button type="button" class="btn btn-outline-danger col-12 rounded-0 <?php echo $usersetting;?>" id="userSetting" style="text-align: left;font-size: 14px;"><i class="fas fa-user-cog"></i> User Setting</button>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          
          <div class="col-12 col-lg-9">
            <div class="row">
              <div class="col-12 col-lg-12">
                <?php
                if(isset($_SESSION["login"]) && isset($_SESSION["email"])){
                  $emailcheck = $_SESSION["email"];
                  $usercheckDB = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_email`='".$emailcheck."' && `user_status`='draft'");
                  $usercheckNUM = $usercheckDB -> num_rows;
                  if($usercheckNUM == 1){
                    echo "<div class='alert alert-danger alert-dismissible' style='font-size:16px;'>
                	  <p>Your account has not verified, we have sent a verification button, please check your email</p>
                    </div>";
                  }
                }
                ?>
              </div>
			
    	      <div class="col-12 col-lg-12">
    		    <?php 
    			include "mdl-includes/admin/user-setting.php";
				
				$user_category = $usersessionDB["user_category"];
				//$user_category = 2;
				
    			if($userposition == "member"){
    			  $usercatQR = $db->conn -> query("SELECT * FROM `mdl_user_category` WHERE `usercat_id`='".$user_category."'");
    				if($usercatDB["usercat_slug"] == "platinum") {
    				  include "mdl-includes/admin/company-profile-platinum.php";
    				}
    				if($usercatDB["usercat_slug"] == "gold") {
    				  //include "mdl-includes/admin/company-profile-gold.php";
    				  include "mdl-includes/admin/company-profile-platinum.php";
    				}
    				if($usercatDB["usercat_slug"] == "silver") {
    				  //include "mdl-includes/admin/company-profile-silver.php";
    				  include "mdl-includes/admin/company-profile-platinum.php";
    				}
    				if($usercatDB["usercat_slug"] == "bronze") {
    				  include "mdl-includes/admin/company-profile-bronze.php";
    				}
    			}
    			
    			if($userposition == "subscriber"){
    				include "mdl-includes/admin/my-profile.php";
    				
    				include "mdl-includes/admin/bookmark.php";
    				
    				include "mdl-includes/admin/chat-box.php";
    			}
    			
    			
    			if($userposition == "sponsor"){
    				include "mdl-includes/admin/my-profile.php";
    				
    				include "mdl-includes/admin/visitors.php";
    			}
    			
    			if($userposition == "member"){
    				include "mdl-includes/admin/video.php";
    				
    				include "mdl-includes/admin/product.php";
    				
    				include "mdl-includes/admin/chat-box.php";
    				
    				include "mdl-includes/admin/visitors.php";
    			} ?>
    			
    		  </div>
    		  
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->
  
  <?php if(isset($_SESSION["login"]) && isset($_SESSION["email"])){?>
  <div class="lightbox" id="featuredImageBOX">
    <div class="container-lightbox">
      <div class="container-lightbox-display">
        <div class="row" style="height: 100%;">
		  <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12" style="height: 100%;">
            <div class="card card-primary card-outline card-outline-tabs rounded-0" style="height: 100%;">
              <div class="card-header p-0 border-bottom-0">
				<div class="col-12 p-2">
				  <h2 class="card-title mb-2" style="font-size: 28px;">Fetured Image</h2>
				  <div class="float-right">
					<button class="btn btn-default btn-sm rounded-0" id="featuredImageClose">
					  <i class="fas fas fa-window-close"></i>&nbsp;&nbsp;Close
					</button>
				  </div>
				</div>
                <ul class="nav nav-tabs col-12" id="custom-tabs-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link rounded-0" id="custom-tabs-home-tab" data-toggle="pill" href="#custom-tabs-home" role="tab" aria-controls="custom-tabs-home" aria-selected="true">Upload Files</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active rounded-0" id="custom-tabs-media-library-tab" data-toggle="pill" href="#custom-tabs-media-library" role="tab" aria-controls="custom-tabs-media-library" aria-selected="false">Media Library</a>
                  </li>
                </ul>
              </div>
              <div class="card-body p-2" style="height: 100%;">
                <div class="tab-content" id="custom-tabs-tabContent" style="width: 100%; height: 100%;">
                  <div class="tab-pane fade" id="custom-tabs-home" role="tabpanel" aria-labelledby="custom-tabs-home-tab" style="height: 100%;">
                    <div id="formuploadPhoto"></div>
					<div class="container">
					  <div class="content">
					    <?php
					    $mediaQR = $db->conn -> query("SELECT * FROM `mdl_media` WHERE `media_author`='".$usersessionDB["user_id"]."'");
					    $mediaNUM = $mediaQR -> num_rows;
					    
					    if($mediaNUM < 20){
					    ?>
					    <form action="../../mdl-includes/media/media-upload-action.php?user=<?php echo $usersessionDB["user_id"];?>" class="dropzone" id="dropzonewidget"></form>
					    <?php } else {
					       echo "<h2>Batas Maksimal Upload File adalah 30</h2>"; 
					    }?>
					  </div>
					</div>
                  </div>
                  <div class="tab-pane fade show active" id="custom-tabs-media-library" role="tabpanel" aria-labelledby="custom-tabs-media-library-tab" style="height:100%; overflow: hidden;">
				    <div id="media-library" style="height: 100%;"></div>
                  </div>
                </div>
              </div>
			  <div class="card-footer">
                <button type="submit" class="btn btn-secondary disabled float-right set-image set-image-product">Set Featured Image</button>
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
  
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<?php include "footer-user.php";?>