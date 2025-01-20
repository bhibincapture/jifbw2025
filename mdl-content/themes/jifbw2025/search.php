<?php
/*
// Template Name: Hotels
*/

include "header.php";
?>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="<?php echo DB_LOCAL.DB_LINK."/";?>" title="Home">Home</a></li>
          <li>Search</li>
        </ol>
        <h1 style="font-size: 28px;">Exhibitor Search : <?php echo $query;?></h1>

      </div>
    </section><!-- End Breadcrumbs -->
	
    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container">

        <div class="row">
		  <div class="col-12 col-lg-12">
		    <article class='entry hover mb-3 entries' style="padding: 10px;">
		      <div class="row">
		        <div class="col-12 col-lg-6">
				  <?php
				  if($usercatDB["usercat_slug"] == "platinum"){ $platinum = "active";}
				  if($usercatDB["usercat_slug"] == "gold"){ $gold = "active";}
				  if($usercatDB["usercat_slug"] == "silver"){ $silver = "active";}
				  if($usercatDB["usercat_slug"] == "bronze"){ $bronze = "active";}
				  ?>
				  <a href="<?php echo DB_LOCAL.DB_LINK."/exhibitor/platinum/";?>" title="Platinum">
			        <button type="button" class="btn btn-orange rounded-0 <?php echo $platinum;?>">
				      <span>Platinum</span>
				    </button>
				  </a>
				  <a href="<?php echo DB_LOCAL.DB_LINK."/exhibitor/gold/";?>" title="Gold">
			        <button type="button" class="btn btn-orange rounded-0 <?php echo $gold;?>">
				      <span>Gold</span>
				    </button>
				  </a>
				  <a href="<?php echo DB_LOCAL.DB_LINK."/exhibitor/silver/";?>" title="Silver">
			        <button type="button" class="btn btn-orange rounded-0 <?php echo $silver;?>">
				      <span>Silver</span>
				    </button>
				  </a>
				  <a href="<?php echo DB_LOCAL.DB_LINK."/exhibitor/bronze/";?>" title="Bronze">
			        <button type="button" class="btn btn-orange rounded-0 <?php echo $bronze;?>">
				      <span>Bronze</span>
				    </button>
				  </a>
		        </div>
		        <div class="col-12 col-lg-6 entries">
		          <form method="get" action="<?php echo DB_LOCAL.DB_LINK."/search/";?>">
			        <div class="input-group input-group-sm">
                      <input type="text" class="form-control" name="q" value="<?php echo $query;?>" placeholder="Search Exhibitor...." required>
                      <span class="input-group-append">
                        <button type="submit" class="btn btn-info btn-flat" style="background: #c90c16;color: #fff;">Go!</button>
                      </span>
                    </div>
                  </form>
		        </div>
			  </div>
		    </article>
		  </div>
		</div>
	  </div>
		  
      <div class="container">

        <div class="row">
		  <?php
		  $usercatQR2 = $db->conn -> query("SELECT * FROM `mdl_user_category` WHERE `usercat_slug`='platinum' || `usercat_slug`='gold' || `usercat_slug`='bronze'");
		  $usercatDB2 = $usercatQR2 -> fetch_assoc();
		  
		  $companyQR = $db->conn -> query("SELECT * FROM `mdl_user_company` WHERE `company_name` LIKE '%".$query."%'");
		  
		  while($companyDB = $companyQR -> fetch_assoc()){
		   $userQR = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_id`='".$companyDB["user_id"]."' && `user_status`='published' ORDER BY `user_category` ASC");
		   /*
		   $companyNUM = $userQR -> num_rows;
		   if($companyNUM == 0){
		    echo "
			<div class='col-12 col-lg-12 entries'>
			  <article class='entry p-3 mb-4'>
				<div class='row'>
				  <h2>Exhibitor <b>".$query."</b> was not found</h2>
				</div>
			  </article>
			</div>";
		   }
		   */
		   while($userDB = $userQR -> fetch_assoc()){
		    
			$idusercat = $userDB["user_category"];
			
			if($userDB["user_category"] == $usercatDB2["usercat_id"]){
			  $username = $userDB["user_name_id"];
			} else {
			  $username = $userDB["user_name"];
			}
			
			$usercatQR = $db->conn -> query("SELECT * FROM `mdl_user_category` WHERE `usercat_id`='".$idusercat."'");
			$usercatDB = $usercatQR -> fetch_assoc();
			
		    if($usercatDB["usercat_slug"] == "platinum" || $usercatDB["usercat_slug"] == "silver" || $usercatDB["usercat_slug"] == "gold"){
			  echo "
			  <div class='col-12 col-lg-6 entries'>
				<article class='entry hover p-3 mb-4'>
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
					
					//$idmedia = $companyDB["company_thumb"];
					//$mediaDB = $db->conn -> query("SELECT * FROM `mdl_media` WHERE `media_id`='$idmedia'") -> fetch_assoc();
					
					if($companyDB["company_thumb"] != ""){
        			  $thumb_company = $companyDB["company_thumb"];
        			  $mediaDB = $db->conn -> query("SELECT * FROM `mdl_media` WHERE `media_id`='$thumb_company'") -> fetch_assoc();
        			  $thumb = DB_LOCAL.DB_LINK.$mediaDB["media_attachment_small"];
        			} else { 
        			  $thumb = FOLDER_THEMES."/assets/img/blank-profile-picture.jpg";
        			}
					echo "
				  </div>
					<div class='row'>
					  <div class='col-10 col-lg-10 mt-10'>
					  <a href='".DB_LOCAL.DB_LINK."/company-profile/".$username."/' title='".$companyDB["company_name"]."'>
					    <div class='row'>
						  <div class='col-2 col-lg-2 col-md-2 col-sm-2 mt-2 text-center'>
							<img src='".$thumb."' alt='".$companyDB["company_name"]."' class='img-fluid' style='width:60px;'>
						  </div>
						  <div class='col-10 col-lg-10 col-md-10 col-sm-10 mt-2'>
							<h2 class='title-exhibitor'><b>".$companyDB["company_name"]."</b></h2>
							<p class='p-exhibitor m-0' style='color:#4a4a4a'><b>Address</b> : ".$companyDB["company_address"]."</p>
						  </div>
						</div>
					  </a>
					  </div>
					  <div class='col-2 col-lg-2 mt-2 text-center' id='bookmark-box-company-".$userDB["user_id"]."'>";
						$usersessionDB = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_email`='".$_SESSION["email"]."'") -> fetch_assoc();
						  
						$bookmarkQR = $db->conn -> query("SELECT * FROM `mdl_bookmark` WHERE `user_id`='".$usersessionDB["user_id"]."' && `company_id`='".$userDB["user_id"]."'");
                        $bookmarkNUM = $bookmarkQR -> num_rows;
                          
                        if($bookmarkNUM == 0){
                          echo "
                          <div class='bookmark-exhibitor add-to-bookmark' title='Add to Bookmark' id='Bookmark_".$userDB["user_id"]."'>
						    <i class='fas fa-bookmark'></i> <p style='font-size:12px;'>Add to Bookmark</p>
						  </div>";
                        }
                        else {
                          echo "
                          <div style='font-size: 26px;text-align: center;' title='On the List'>
                            <i class='fas fa-check-circle'></i> <p style='font-size:12px;'><b>On the List</b></p>
						  </div>";
						}
						echo "
					  </div>
					</div>
				</article>
			  </div>";
			} else {
			  echo "
			  <div class='col-12 col-lg-6 entries'>
				<article class='entry hover p-3 mb-4'>
				  <a href='".DB_LOCAL.DB_LINK."/company-profile/".$username."/' title='".$companyDB["company_name"]."'>
				  <div class='row'>";
					$idmedia = $companyDB["company_thumb"];
					$mediaDB = $db->conn -> query("SELECT * FROM `mdl_media` WHERE `media_id`='$idmedia'") -> fetch_assoc();
					echo "
					<div class='row'>
					  <div class='col-2 col-lg-2 mt-2 text-center'>
						<img src='".DB_LOCAL.DB_LINK.$mediaDB["media_attachment_small"]."' alt='".$companyDB["company_name"]."' class='img-fluid' style='width:60px;'>
					  </div>
					  <div class='col-8 col-lg-8 mt-2'>
						<h2 class='title-exhibitor'><b>".$companyDB["company_name"]."</b></h2>
						<p class='p-exhibitor m-0' style='color:#4a4a4a'><b>Address</b> : ".$companyDB["company_address"]."</p>
					  </div>
					</div>
				  </div>
				  </a>
				</article>
			  </div>";
			}}
		  }?>
		  
        </div>

      </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->

<?php include "footer.php";?>