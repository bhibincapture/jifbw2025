<?php
// page
include "header.php";

?>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="/" title="Home">Home</a></li>
          <li><a href="<?php echo DB_LOCAL.DB_LINK."/exhibitor/platinum/";?> title="Exhibitor">Exhibitor</a></li>
          <li><?php echo $userDB["user_name"];?></li>
        </ol>
        <h1><?php 
		if($userDB["user_company"] != ""){
			echo $userDB["user_company"];
		} else {
		echo $userDB["user_first_name"]." ".$userDB["user_last_name"];}?></h1>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-12 entries">
			<?php
			  if($userDB["user_thumb"] != ""){
			    $thumb = $userDB["user_thumb"];
			    $mediaDB = $db->conn -> query("SELECT * FROM `mdl_media` WHERE `media_id`='$thumb'") -> fetch_assoc();
			    $thumb = DB_LOCAL.DB_LINK.$mediaDB["media_attachment_large"];
			  }
			  else { $thumb = FOLDER_THEMES."/assets/img/image-not-available.jpg"; }
			
			  if($mediaDB["media_alt"] != ""){$alt = $mediaDB["media_alt"];} else {$alt = $mediaDB["media_title"];}
			  
			  echo "
              <article class='entry'>

                <div class='col-12 col-lg-12 mt-2 text-center'>
				    <img src='".DB_LOCAL.DB_LINK.$mediaDB["media_attachment_small"]."' alt='".$userDB["user_name"]."' class='img-fluid' style='width:120px;'>
                </div>
				
				<hr></hr>
				
				<div class='row mb-4'>
				  <div class='col-12 col-lg-6'>
				    <h2 class='entry-title'>Company Profile</h2>
				    <p><i class='fas fa-hotel'></i> <b>Company Name</b> : ".$userDB["user_company"]."</p>
                    <p><i class='fas fa-address-card'></i> <b>Addres</b> : ".$userDB["user_address"]."</p>
				    <p><i class='fas fa-phone-square'></i> <b>Contact Person</b> : +".$userDB["user_wa"]."</p>
				    <p><i class='fas fa-globe'></i> <b>Website</b> : <a href='".$userDB["user_url"]."' title='".$userDB["user_company"]."' target='_blank'>".$userDB["user_url"]."</a></p>
				    <p><i class='fas fa-share-square'></i> <b>Go to Location</b> : <a href='".$userDB["user_location"]."' title='Google Map' target='_blank'>".$userDB["user_location"]."</a></p>
				  
				    <div class='col-12 col-lg-12' style='font-size:32px;'>
				      <i class='fab fa-whatsapp-square m-2'></i>
				      <i class='fab fa-instagram m-2'></i>
				      <i class='fab fa-facebook m-2'></i>
				      <i class='fab fa-youtube m-2'></i>
				      <i class='fab fa-linkedin m-2'></i>
				    </div>
				  </div>
				  
				  <div class='col-12 col-lg-6'>
				    <div class='row'>
				    <div class='col-12 col-lg-12'>
				      <div class='add-to-bookmark'>
					    <i class='fas fa-bookmark'></i>
					    <p>Add to Bookmark</p>
					  </div>
				      <div class='chat-massanger' id='chatNow'>
					    <i class='fas fa-comments'></i>
					    <p>Chat Us</p>
					  </div>
					</div>
				  </div>
				  </div>
				</div>
				
                <div class='col-12'>
				  <button type='button' class='btn btn-orange rounded-0'>
				    <i class='fas fa-angle-double-left'></i> <span>Back</span>
				  </button>
				  <button type='button' class='btn btn-orange rounded-0' id='btn-about'>
				    <i class='fas fa-hotel'></i> <span>About Us</span>
				  </button>
				  <button type='button' class='btn btn-orange rounded-0' id='btn-product'>
				    <i class='fas fa-images'></i> <span>Products</span>
				  </button>
				  <button type='button' class='btn btn-orange rounded-0' id='btn-location'>
				    <i class='fas fa-map-marker-alt'></i> <span>Geo Location</span>
				  </button>
                </div>
			  
				<hr class='mt-0'></hr>
				
				<div id='aboutUS'>
				  <div class='col-lg-12 d-flex justify-content-center align-middle p-4'>
                    <video class='w-100' controls=''><source src='".DB_LOCAL.DB_LINK."/mdl-content/themes/jifbw2024/assets/img/6401ae8de0363.mp4'></video>
                  </div>
				
				  <hr></hr>
				
                  <div class='entry-content'>
				    <h2><b>About Us :</b></h2>
				    ".$userDB["user_content"]."
				  </div>
				</div>
				
				<div class='col-12 col-lg-12' id='ourProduct' style='display:none;'>
				  <div class='row'>";
				  $productQR = $db->conn -> query("SELECT * FROM `mdl_product` WHERE `product_author`='".$userDB["user_id"]."'");
				  while($productDB = $productQR -> fetch_assoc()){
				    if($productDB["product_thumb"] != ""){
					  $thumb = $productDB["product_thumb"];
					  $mediaDB = $db->conn -> query("SELECT * FROM `mdl_media` WHERE `media_id`='$thumb'") -> fetch_assoc();
					  $thumb = DB_LOCAL.DB_LINK.$mediaDB["media_attachment_medium"];
				    }
				    else { $thumb = FOLDER_THEMES."/assets/img/image-not-available.jpg"; }
				
				    if($mediaDB["media_alt"] != ""){$alt = $mediaDB["media_alt"];} else {$alt = $mediaDB["media_title"];}
					
				    echo "
					<div class='col-6 col-lg-3 col-sm-6'>
					  <div class='post-box'>
					    <div class='post-img'>
						  <img src='".DB_LOCAL.DB_LINK.$mediaDB["media_attachment_medium"]."' alt='".$alt."' class='img-fluid'>
						</div>
						<h3 class='product-title'>".$productDB["product_title"]."</h3>
						<div class='product-content'>".substr($productDB["product_content"], 0, 60)." .....</div>
						<a href='".DB_LOCAL.DB_LINK."/product-detail/".$productDB["product_slug"]."/' title='".$productDB["product_title"]."'>
						  <button type='button' class='btn btn-orange rounded-0'>
						    <i class='fas fa-shopping-cart'></i> <span>Product Detail</span>
						  </button>
						</a>
					  </div>
					</div>
					";
				  }
				  echo "
				  </div>
				</div>
				
				<div id='ourLocation' style='display:none;'>
				  <div class='col-12 col-lg-12'>
				    ".$userDB["user_map"]."
				  </div>
				</div>
				
              </article>";
			?>

          </div>

        </div>

      </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->

<?php include "footer.php";?>