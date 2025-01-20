<?php
// Post
include "header.php";
$userDB = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_id`='".$productDB["product_author"]."'") -> fetch_assoc();

$usercatQR = $db->conn -> query("SELECT * FROM `mdl_user_category` WHERE `usercat_id`='".$userDB["user_category"]."'");
$usercatDB = $usercatQR -> fetch_assoc();
		  
if($usercatDB["usercat_slug"] == "platinum"){
  $username = $userDB["user_name_id"];
} else {
  $username = $userDB["user_name"];
}

$companyDB = $db->conn -> query("SELECT * FROM `mdl_user_company` WHERE `user_id`='".$productDB["product_author"]."'") -> fetch_assoc();

if($productDB["product_thumb"] != ""){
  $thumb = $productDB["product_thumb"];
  $mediaDB = $db->conn -> query("SELECT * FROM `mdl_media` WHERE `media_id`='$thumb'") -> fetch_assoc();
  $thumb = DB_LOCAL.DB_LINK.$mediaDB["media_attachment_medium"];
}
else { $thumb = FOLDER_THEMES."/assets/img/image-not-available.jpg"; }
if($mediaDB["media_alt"] != ""){$alt = $mediaDB["media_alt"];} else {$alt = $mediaDB["media_title"];}
?>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="<?php echo DB_LOCAL.DB_LINK."/";?>" title="Home">Home</a></li>
          <li><a href="<?php echo DB_LOCAL.DB_LINK."/exhibitor/platinum/";?>" title="Exhibior">Exhibior</a></li>
          <li><a href="<?php echo DB_LOCAL.DB_LINK."/company-profile/".$username."/";?>" title="<?php echo $companyDB["company_name"];?>"><?php echo $companyDB["company_name"];?></a></li>
          <li>Product Detail</li>
        </ol>
        <h1><?php echo $productDB["product_title"];?></h1>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-8">
            <div class="portfolio-info mb-3 p-3">
              <div class="swiper-wrapper align-items-center">
                <div class="swiper-slide">
                  <img src="<?php echo DB_LOCAL.DB_LINK.$mediaDB["media_attachment_large"];?>" alt="<?php echo $alt;?>" class="img-fluid">
                </div>
              </div>
            </div>
            <div class="portfolio-info mb-3 p-3">
              <h3><?php echo $productDB["product_title"];?></h3>
              <div class="content-madilog"><?php echo htmlspecialchars_decode(strip_tags($productDB["product_content"]));?></div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="portfolio-info mb-3 p-3">
              <h3>Chat This Product</h3>
              <div class="">
				    <div class='chat-massanger-new' id="chatNow">
					  <i class='fas fa-comments'></i>
					  <p>Chat Us</p>
					</div>
			  </div>
            </div>
			
            <div class="portfolio-info mb-3 p-3">
              <h3>Company Profile</h3>
              <div class="">
			    <div class='col-12 col-lg-12 mt-2 text-center'>
				  <?php
				  
				  if($companyDB["company_thumb"] != ""){
					$thumb2 = $companyDB["company_thumb"];
					$mediaDB2 = $db->conn -> query("SELECT * FROM `mdl_media` WHERE `media_id`='$thumb2'") -> fetch_assoc();
					$thumb2 = DB_LOCAL.DB_LINK.$mediaDB2["media_attachment_small"];
				  }
				  else { $thumb2 = FOLDER_THEMES."/assets/img/image-not-available.jpg"; }
				
				  if($mediaDB2["media_alt"] != ""){$alt2 = $mediaDB2["media_alt"];} else {$alt2 = $mediaDB2["media_title"];}
				  ?>
				  <img src="<?php echo $thumb2;?>" alt="<?php echo $alt2;?>" class="img-fluid" style="width:120px;">
                </div>
			    <div class='col-12 col-lg-12 mt-2'>
				  <?php echo "
				  <div class='row'>
				  <div class='col-12 col-lg-12'>
				    <p><i class='fas fa-hotel'></i> <b>Company Name</b> : ".$companyDB["company_name"]."</p>
                    <p><i class='fas fa-address-card'></i> <b>Addres</b> : ".$companyDB["company_address"]."</p>
				    <p><i class='fas fa-phone-square'></i> <b>Contact Person</b> : +".$companyDB["company_wa"]."</p>
				    <p><i class='fas fa-globe'></i> <b>Website</b> : <a href='".$companyDB["company_url"]."' title='".$companyDB["company_name"]."' target='_blank' rel='sponsored'>".$companyDB["company_url"]."</a></p>
				    <p><i class='fas fa-share-square'></i> <b>Go to Location</b> : <a href='".$companyDB["company_location"]."' title='Google Map' target='_blank'>".$companyDB["company_location"]."</a></p>
				  </div>
				  </div>
				  ";?>
                </div>
			  </div>
            </div>
          </div>

        </div>
		
		<div class="row gy-4 mt-3">
		  <div class="col-lg-12">
            <div class="clients-slider swiper">
              <div class="swiper-wrapper align-items-center">
    		    <?php
    			$productQR = $db->conn -> query("SELECT * FROM `mdl_product` WHERE `product_author`='".$userDB["user_id"]."' ORDER BY RAND()");
    				  
    			while($productDB = $productQR -> fetch_assoc()){
    			  if($productDB["product_thumb"] != ""){
    				$thumb = $productDB["product_thumb"];
    				$mediaDB = $db->conn -> query("SELECT * FROM `mdl_media` WHERE `media_id`='$thumb'") -> fetch_assoc();
    				$thumb = DB_LOCAL.DB_LINK.$mediaDB["media_attachment_medium"];
    			  }
    			  else { $thumb = FOLDER_THEMES."/assets/img/image-not-available.jpg"; }
    			  
    			  if($mediaDB["media_alt"] != ""){$alt = $mediaDB["media_alt"];} else {$alt = $mediaDB["media_title"];}
    			  
    			  echo "
    			  <div class='swiper-slide p-1' style='border: 1px solid #ccc;'>
    			    <a href='".DB_LOCAL.DB_LINK."/product/".$productDB["product_slug"]."/' title='".$productDB["product_title"]."'>
    				  <img src='".$thumb."' class='img-fluid' alt='".$alt."'>
    				</a>
    			  </div>
    			  ";
    			}
    			?>
              </div>
              <div class="swiper-pagination"></div>
            </div>
		  </div>
        </div>

      </div>
	  
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->

<?php include "footer.php";?>