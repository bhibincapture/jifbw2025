
<div class="sidebar p-3 mb-4">
  <h3 class="sidebar-title">Exhibitor Search</h3>
  <div class="sidebar-item search-form mb-3">
    <form method="get" action="<?php echo DB_LOCAL.DB_LINK."/search/";?>">
      <input type="text" name="q" placeholder="Search Exhibitor...." required>
      <button type="submit"><i class="bi bi-search"></i></button>
    </form>
  </div>
</div>

<div class="sidebar p-3 mb-4">
  <h3 class="sidebar-title">Platinum Exhibitor</h3>
  <div class="sidebar-item row">
    <?php
    $userQR = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_category`='2' && `user_status`='published' ORDER BY RAND() DESC LIMIT 6");
    $usercatQR2 = $db->conn -> query("SELECT * FROM `mdl_user_category` WHERE `usercat_slug`='platinum' || `usercat_slug`='gold' || `usercat_slug`='bronze'");
	$usercatDB2 = $usercatQR2 -> fetch_assoc();
	
	while($userDB = $userQR -> fetch_assoc()){
	  $idusercat = $userDB["user_category"];
	  
	  if($userDB["user_category"] == $usercatDB2["usercat_id"]){
		$username = $userDB["user_name_id"];
	  } else {
	    $username = $userDB["user_name"];
	  }
	  
	  $companyDB = $db->conn -> query("SELECT * FROM `mdl_user_company` WHERE `user_id`='".$userDB["user_id"]."'") -> fetch_assoc();
	  
	  echo "
	  <div class='col-12 mb-3 exhibitor-widget'>
	    <div class='row'>";
		  $productQR = $db->conn -> query("SELECT * FROM `mdl_product` WHERE `product_author`='".$userDB["user_id"]."' && `product_status`='published' ORDER BY RAND() LIMIT 3");
		  $productNUM = $productQR -> num_rows;
		  
		  if($productNUM != 0){
		    while($productDB = $productQR -> fetch_assoc()){
		      $alt = $productDB["product_title"];
		      if($productDB["product_thumb"] != ""){
		        $thumb = $productDB["product_thumb"];
		        $mediaDB = $db->conn -> query("SELECT * FROM `mdl_media` WHERE `media_id`='$thumb'") -> fetch_assoc();
				$thumb = DB_LOCAL.DB_LINK.$mediaDB["media_attachment_medium"];
				if($mediaDB["media_alt"] != ""){$alt = $mediaDB["media_alt"];} else {$alt = $mediaDB["media_title"];}
			  }
			  else { $thumb = FOLDER_THEMES."/assets/img/image-not-available.jpg"; }
			  
			  echo "
			  <div class='col-4 col-lg-4 col-md-4 col-sm-4 img-exhibitor'>
				<a href='".DB_LOCAL.DB_LINK."/company-profile/".$username."/' title='".$companyDB["company_name"]."'><img src='".$thumb."' alt='".$alt."' class='img-fluid image-ready'></a>
			  </div>";
			}
					  if($productNUM == 1){
					    $productQR1 = $db->conn -> query("SELECT * FROM `mdl_product` WHERE `product_author`='".$userDB["user_id"]."' && `product_status`='published' ORDER BY RAND() LIMIT 1");
					    $productDB = $productQR1 -> fetch_assoc();
						$alt = $productDB["product_title"];
						if($productDB["product_thumb"] != ""){
						  $thumb = $productDB["product_thumb"];
						
						  $mediaDB = $db->conn -> query("SELECT * FROM `mdl_media` WHERE `media_id`='$thumb'") -> fetch_assoc();
						  $thumb = DB_LOCAL.DB_LINK.$mediaDB["media_attachment_medium"];
						
						  if($mediaDB["media_alt"] != ""){$alt = $mediaDB["media_alt"];} else {$alt = $mediaDB["media_title"];}
						}
						else { $thumb = FOLDER_THEMES."/assets/img/image-not-available.jpg"; }
						
						echo "
						<div class='col-4 col-lg-4 col-md-4 col-sm-4 img-exhibitor'>
						  <a href='".DB_LOCAL.DB_LINK."/company-profile/".$username."/' title='".$companyDB["company_name"]."'><img src='".$thumb."' alt='".$alt."' class='img-fluid image-ready'></a>
						</div>";
						echo "
						<div class='col-4 col-lg-4 col-md-4 col-sm-4 img-exhibitor'>
						  <a href='".DB_LOCAL.DB_LINK."/company-profile/".$username."/' title='".$companyDB["company_name"]."'><img src='".$thumb."' alt='".$alt."' class='img-fluid image-ready'></a>
						</div>";
					  }
					  if($productNUM == 2){
					    $productQR2 = $db->conn -> query("SELECT * FROM `mdl_product` WHERE `product_author`='".$userDB["user_id"]."' && `product_status`='published' ORDER BY RAND() LIMIT 2");
					    $productDB = $productQR2 -> fetch_assoc();
						$alt = $productDB["product_title"];
						if($productDB["product_thumb"] != ""){
						  $thumb = $productDB["product_thumb"];
						
						  $mediaDB = $db->conn -> query("SELECT * FROM `mdl_media` WHERE `media_id`='$thumb'") -> fetch_assoc();
						  $thumb = DB_LOCAL.DB_LINK.$mediaDB["media_attachment_medium"];
						
						  if($mediaDB["media_alt"] != ""){$alt = $mediaDB["media_alt"];} else {$alt = $mediaDB["media_title"];}
						}
						else { $thumb = FOLDER_THEMES."/assets/img/image-not-available.jpg"; }
						
						echo "
						<div class='col-4 col-lg-4 col-md-4 col-sm-4 img-exhibitor'>
						  <a href='".DB_LOCAL.DB_LINK."/company-profile/".$username."/' title='".$companyDB["company_name"]."'><img src='".$thumb."' alt='".$alt."' class='img-fluid image-ready'></a>
						</div>";
					  }
		  }
		  else {
		    echo "
		    <div class='col-4 col-lg-4 col-md-4 col-sm-4 img-exhibitor'>
			  <a href='".DB_LOCAL.DB_LINK."/company-profile/".$username."/' title='".$companyDB["company_name"]."'><img src='".FOLDER_THEMES."/assets/img/image-not-available.jpg"."' alt='".$companyDB["company_name"]."' class='img-fluid image-ready'></a>
			</div>";
			
			echo "
			<div class='col-4 col-lg-4 col-md-4 col-sm-4 img-exhibitor'>
			  <a href='".DB_LOCAL.DB_LINK."/company-profile/".$username."/' title='".$companyDB["company_name"]."'><img src='".FOLDER_THEMES."/assets/img/image-not-available.jpg"."' alt='".$companyDB["company_name"]."' class='img-fluid image-ready'></a>
			</div>";
			
			echo "
			<div class='col-4 col-lg-4 col-md-4 col-sm-4 img-exhibitor'>
			  <a href='".DB_LOCAL.DB_LINK."/company-profile/".$username."/' title='".$companyDB["company_name"]."'><img src='".FOLDER_THEMES."/assets/img/image-not-available.jpg"."' alt='".$companyDB["company_name"]."' class='img-fluid image-ready'></a>
			</div>";
		  }
		  
		  $idmedia = $companyDB["company_thumb"];
		  $mediaDB = $db->conn -> query("SELECT * FROM `mdl_media` WHERE `media_id`='$idmedia'") -> fetch_assoc();
		  echo "
		</div>
		
		<div class='row'>
		  <div class='col-12 col-lg-12 mt-12'>
			<a href='".DB_LOCAL.DB_LINK."/company-profile/".$username."/' title='".$companyDB["company_name"]."'>
			  <div class='row'>
				<div class='col-3 col-lg-3 col-md-3 col-sm-3 mt-2 text-center'>
				  <img src='".DB_LOCAL.DB_LINK.$mediaDB["media_attachment_small"]."' alt='".$companyDB["company_name"]."' class='img-fluid' style='width:60px;'>
				</div>
				<div class='col-9 col-lg-9 col-md-9 col-sm-9 mt-2'>
				  <h4 class='title-exhibitor'><b>".$companyDB["company_name"]."</b></h4>
				  <p class='p-exhibitor mb-2' style='color:#4a4a4a'><b>Address</b> : ".$companyDB["company_address"]."</p>
				</div>
			  </div>
			</a>
		  </div>
		</div>
	  </div>";
	}
    ?>
  </div>
</div>