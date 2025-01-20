<?php
// company profile
include "header.php";
$companyDB = $db->conn -> query("SELECT * FROM `mdl_user_company` WHERE `user_id`='".$userDB["user_id"]."'") -> fetch_assoc();
?>
<style>.post-box{border:1px solid #aba5a5;padding:5px;}.post-box:hover{background:#f1f1f1;}</style>
<main id="main">
	<section class="breadcrumbs">
		<div class="container">
			<ol>
			  <li><a href="<?php echo DB_LOCAL.DB_LINK."/";?>" title="Home">Home</a></li>
			  <li><a href="<?php echo DB_LOCAL.DB_LINK."/exhibitor/platinum/";?>" title="Exhibitor">Exhibitor</a></li>
			  <li>Company Profile</li>
			</ol>
			<h1><?php if($companyDB["company_name"] != ""){ echo $companyDB["company_name"]; } else { echo $userDB["user_first_name"]." ".$userDB["user_last_name"];}?></h1>
		</div>
    </section>
    <section id="blog" class="blog">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 entries">
				<?php
				if($companyDB["company_thumb"] != ""){
				  $thumb_company = $companyDB["company_thumb"];
				  $mediaDB = $db->conn -> query("SELECT * FROM `mdl_media` WHERE `media_id`='$thumb_company'") -> fetch_assoc();
				  $thumb = DB_LOCAL.DB_LINK.$mediaDB["media_attachment_small"];
				} else { 
				  $thumb = FOLDER_THEMES."/assets/img/blank-profile-picture.jpg";
				}
				  
				if($mediaDB["media_alt"] != ""){$alt = $mediaDB["media_alt"];} else {$alt = $mediaDB["media_title"];}
				  
				$idusercat = $userDB["user_category"];
				
				$usercatQR = $db->conn -> query("SELECT * FROM `mdl_user_category` WHERE `usercat_id`='".$idusercat."'");
				$usercatDB = $usercatQR -> fetch_assoc();
				
				if($usercatDB["usercat_slug"] == "platinum" || $usercatDB["usercat_slug"] == "silver" || $usercatDB["usercat_slug"] == "gold"){
				  
				  echo "
				  <article class='entry'>

					<div class='col-12 col-lg-12 mt-2 text-center'>
						<img src='".$thumb."' alt='".$userDB["user_name"]."' class='img-fluid' style='width:120px;'>
					</div>
					
					<hr></hr>
					
					<div class='row mb-4'>
					  <div class='col-12 col-lg-6'>
						<h2 class='entry-title'>Company Profile</h2>
						<p><i class='fas fa-hotel'></i> <b>Company Name</b> : ".$companyDB["company_name"]."</p>
						<p><i class='fas fa-address-card'></i> <b>Addres</b> : ".$companyDB["company_address"]."</p>
						<p>
						  <span><i class='fas fa-clock'></i> <b>Hours</b> : </span>
						  <span>
							<span class='pointer' id='info-time'>";
							  $day = array(["Mon","monday"],["Tue","tuesday"],["Wed","wednesday"],["Thu","thursday"],["Fri","friday"],["Sat","saturday"],["Sun","sunday"]);
							  
							  for($tm = 0; $tm < 7; $tm++){
								if($tm + 1 != 7){$ntm = $tm + 1;} else {$ntm = 0;}
								if(date("D") == $day[$tm][0]){
								  if(date("H:i") < date("H:i", strtotime($companyDB["company_".$day[$tm][1]."_open"]))){
									echo "<span class='text-danger'><b>Closed</b></span>";
									if($companyDB["company_".$day[$tm][1]."_open"] != "00:00:00"){
									  echo ", Opens at ".date("h:i A", strtotime($companyDB["company_".$day[$tm][1]."_open"]))." ".$day[$tm][0];
									} echo "&nbsp;&nbsp;&nbsp;<i class='fas fa-chevron-down'></i>";
								  }
								  
								  else if(date("H:i") >= date("H:i", strtotime($companyDB["company_".$day[$tm][1]."_open"]))){
									if(date("H:i") >= date("H:i", strtotime($companyDB["company_".$day[$tm][1]."_close"]))){
									  echo "<span class='text-danger'><b>Closed</b></span>";
									  if($companyDB["company_".$day[$tm][1]."_open"] != "00:00:00"){
										echo ", Opens at ".date("h:i A", strtotime($companyDB["company_".$day[$ntm][1]."_open"]))." ".$day[$ntm][0];
									  }
									} else {
									  echo "<span class='text-primary'><b>Open</b></span>, ".date("H:i A", strtotime($companyDB["company_".$day[$tm][1]."_open"]))." – ".date("H:i A", strtotime($companyDB["company_".$day[$tm][1]."_close"])); echo "&nbsp;&nbsp;&nbsp;<i class='fas fa-chevron-down'></i>";
									} echo "&nbsp;&nbsp;&nbsp;<i class='fas fa-chevron-down'></i>";
								  }

								  else if(date("H:i") >= date("H:i", strtotime($companyDB["company_".$day[$tm][1]."_close"]))){
									echo "<span class='text-danger'><b>Closed</b></span>, Opens at ".date("H:i A", strtotime($companyDB["company_".$day[$ntm][1]."_open"]))." ".date("D");
								  }
								  else { echo "Oke ada"; }
								  //echo date("H:i A", strtotime($companyDB["company_".$day[$tm][1]."_open"]))." – ".date("H:i A", strtotime($companyDB["company_".$day[$tm][1]."_close"]));
								}
							  }
							echo "
							</span>
							<table class='pointer mb-3' id='time-detail' style='display:none;'>
							  <tbody>
								<tr>
								  <td>Monday</td>
								  <td style='padding: 0px 10px;'>:</td>
								  <td>";
								  if($companyDB["company_monday_open"] == "00:00:00"){
									echo "<span class='text-danger'><b>Closed</b></span>";
								  } else {
									echo date("H:i A", strtotime($companyDB["company_monday_open"]))." – ".date("H:i A", strtotime($companyDB["company_monday_close"]));
								  }
								  echo "</td>
								</tr>
								<tr>
								  <td>Tuesday</td>
								  <td style='padding: 0px 10px;'>:</td>
								  <td>";
								  if($companyDB["company_tuesday_open"] == "00:00:00"){
									echo "<span class='text-danger'><b>Closed</b></span>";
								  } else {
									echo date("H:i A", strtotime($companyDB["company_tuesday_open"]))." – ".date("H:i A", strtotime($companyDB["company_tuesday_close"]));
								  }
								  echo "</td>
								</tr>
								<tr>
								  <td>Wednesday</td>
								  <td style='padding: 0px 10px;'>:</td>
								  <td>";
								  if($companyDB["company_wednesday_open"] == "00:00:00"){
									echo "<span class='text-danger'><b>Closed</b></span>";
								  } else {
									echo date("H:i A", strtotime($companyDB["company_wednesday_open"]))." – ".date("H:i A", strtotime($companyDB["company_wednesday_close"]));
								  }
								  echo "</td>
								</tr>
								<tr>
								  <td>Thursday</td>
								  <td style='padding: 0px 10px;'>:</td>
								  <td>";
								  if($companyDB["company_thursday_open"] == "00:00:00"){
									echo "<span class='text-danger'><b>Closed</b></span>";
								  } else {
									echo date("H:i A", strtotime($companyDB["company_thursday_open"]))." – ".date("H:i A", strtotime($companyDB["company_thursday_close"]));
								  }
								  echo "</td>
								</tr>
								<tr>
								  <td>Friday</td>
								  <td style='padding: 0px 10px;'>:</td>
								  <td>";
								  if($companyDB["company_friday_open"] == "00:00:00"){
									echo "<span class='text-danger'><b>Closed</b></span>";
								  } else {
									echo date("H:i A", strtotime($companyDB["company_friday_open"]))." – ".date("H:i A", strtotime($companyDB["company_friday_close"]));
								  }
								  echo "</td>
								</tr>
								<tr>
								  <td>Saturday</td>
								  <td style='padding: 0px 10px;'>:</td>
								  <td>";
								  if($companyDB["company_saturday_open"] == "00:00:00"){
									echo "<span class='text-danger'><b>Closed</b></span>";
								  } else {
									echo date("H:i A", strtotime($companyDB["company_saturday_open"]))." – ".date("H:i A", strtotime($companyDB["company_saturday_close"]));
								  }
								  echo "</td>
								</tr>
								<tr>
								  <td>Sunday</td>
								  <td style='padding: 0px 10px;'>:</td>
								  <td>";
								  if($companyDB["company_sunday_open"] == "00:00:00"){
									echo "<span class='text-danger'><b>Closed</b></span>";
								  } else {
									echo date("H:i A", strtotime($companyDB["company_sunday_open"]))." – ".date("H:i A", strtotime($companyDB["company_sunday_close"]));
								  }
								  echo "
								  </td>
								</tr>
							  </tbody>
							</table>
						  </span>
						</p>
						<p><i class='fas fa-phone-square'></i> <b>Contact Person</b> : +".$companyDB["company_wa"]."</p>
						<p><i class='fas fa-globe'></i> <b>Website</b> : <a href='".$companyDB["company_url"]."' title='".$companyDB["company_name"]."' target='_blank' rel='sponsored'>".$companyDB["company_url"]."</a></p>
						
						<div class='col-12 col-lg-12' style='font-size:32px;'>";
						  /*<h3 class='entry-title mb-1'>Find Us :</h3>*/
						  if($companyDB["company_wa"] != ""){
							echo "<a href='https://wa.me/+".$companyDB["company_wa"]."' title='WhatsApp' target='_blank' class='company-whatsapp'><i class='fab fa-whatsapp-square m-1'></i></a>";
						  }
						  if($companyDB["company_phone"] != ""){
							echo "<a href='tel:+".$companyDB["company_phone"]."' title='TelPhone' class='company-phone'><i class='fas fa-phone-square m-1'></i></a>";
						  }
						  if($companyDB["company_instagram"] != ""){
							echo "<a href='".$companyDB["company_instagram"]."' title='Instagram' target='_blank' class='company-instagram'><i class='fab fa-instagram-square m-1'></i></a>";
						  }
						  if($companyDB["company_facebook"] != ""){
							echo "<a href='".$companyDB["company_facebook"]."' title='Facebook' target='_blank' class='company-facebook'><i class='fab fa-facebook-square m-1'></i></a>";
						  }
						  if($companyDB["company_youtube"] != ""){
							echo "<a href='".$companyDB["company_youtube"]."' title='YouTube' target='_blank' class='company-youtube'><i class='fab fa-youtube-square m-1'></i></a>";
						  }
						  if($companyDB["company_linkedin"] != ""){
							echo "<a href='".$companyDB["company_linkedin"]."' title='LinkedIn' target='_blank' class='company-linkedin'><i class='fab fa-linkedin m-1'></i></a>";
						  }
						  if($companyDB["company_twitter"] != ""){
							echo "<a href='".$companyDB["company_twitter"]."' title='Twitter' target='_blank' class='company-twitter'><i class='fab fa-twitter-square m-2'></i></a>";
						  }
						  if($companyDB["company_tiktok"] != ""){
							echo "<a href='".$companyDB["company_tiktok"]."' title='Tiktok' target='_blank' class='company-tiktok'><i class='fab fa-tiktok m-1'></i></a>";
						  }
						echo "
						</div>
					  </div>
					  
					  <div class='col-12 col-lg-6 mt-2'>
						<div class='row'>
						  <div class='col-4 col-lg-4'>";
							if($companyDB["company_location"] != ""){
							  echo "
							  <a href='".$companyDB["company_location"]."' title='Go to Location' target='_blank'>
								<div class='go-location' id='goLocation'>
								  <i class='fas fa-map-marked-alt'></i>
								  <p style='font-size:12px;'>Go to Location</p>
								</div>
							  </a>";
							}
							echo "
						  </div>
						  
						  <div class='col-4 col-lg-4'>";
						    if(isset($_SESSION["login"]) && isset($_SESSION["email"])){
								$usersessionDB = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_email`='".$_SESSION["email"]."'") -> fetch_assoc();
								echo "
								<div class='text-center chat-messages add-chat-box' title='Chat Now' id='Chat_".$usersessionDB["user_id"]."-".$userDB["user_id"]."'>
								  <i class='fas fa-comments'></i>
								  <p style='font-size:12px;'>Contact Us</p>
								</div>";
							}
							else {
								echo "
								<div class='text-center chat-messages add-chat-box' title='Chat Now' id='Chat_-".$userDB["user_id"]."'>
								  <i class='fas fa-comments'></i>
								  <p style='font-size:12px;'>Contact Us</p>
								</div>";
							}
						  echo "
						  </div>
						  
						  <div class='col-4 col-lg-4' id='bookmark-box-company-".$userDB["user_id"]."'>";
						    if(isset($_SESSION["login"]) && isset($_SESSION["email"])){
								$bookmarkQR = $db->conn -> query("SELECT * FROM `mdl_bookmark` WHERE `user_id`='".$usersessionDB["user_id"]."' && `company_id`='".$userDB["user_id"]."'");
								$bookmarkNUM = $bookmarkQR -> num_rows;
								  
								if($bookmarkNUM == 0){
								  echo "
								  <div class='text-center add-to-bookmark' title='Add to Bookmark' id='Bookmark_".$userDB["user_id"]."'>
									<i class='fas fa-bookmark'></i>
									<p style='font-size:12px;'>Add to Bookmark</p>
								  </div>
								 ";
								}
								else {
								  echo "
								  <div class='text-center' style='font-size: 25px;' title='On the List'>
									<i class='fas fa-check-circle'></i>
									<p style='font-size:12px;'><b>On the List</b></p>
								  </div>";
								}
							}
							else {
								echo "
								<div class='text-center add-to-bookmark' title='Add to Bookmark' id='Bookmark_".$userDB["user_id"]."'>
									<i class='fas fa-bookmark'></i>
									<p style='font-size:12px;'>Add to Bookmark</p>
								</div>";
							}
							echo "
						  </div>
						</div>
					  </div>
					</div>
					
					<div class='col-12'>
					  <a href='".DB_LOCAL.DB_LINK."/exhibitor/platinum/' title='Exhibitor'>
						<button type='button' class='btn btn-orange rounded-0 mt-1'>
						  <i class='fas fa-angle-double-left'></i> <span>Back</span>
						</button>
					  </a>
					  <a href='#aboutUS' type='button' class='btn btn-orange rounded-0 mt-1 scrollto active' id='btn-about'>
						<i class='fas fa-hotel'></i> <span>About Us</span>
					  </a>
					  <a href='#ourProduct' type='button' class='btn btn-orange rounded-0 mt-1' id='btn-product'>
						<i class='fas fa-images'></i> <span>Products</span>
					  </a>
					  <a href='#ourLocation' type='button' class='btn btn-orange rounded-0 mt-1' id='btn-location'>
						<i class='fas fa-map-marker-alt'></i> <span>Geo Location</span>
					  </a>
					</div>
				  
					<hr class='mt-0'></hr>
					
					<div id='aboutUS' class='mb-4'>";
					  // Video View
					if($companyDB["company_video_type"] != ""){
					  if($companyDB["company_video_type"] == "youtube"){
						echo "
						<div class='entry-content'>
						  <div class='embed-responsive embed-responsive-16by9'>
							<iframe class='embed-responsive-item' src='".$companyDB["company_video"]."' allowfullscreen></iframe>
						  </div>
						</div>";
					  }
					  
					  if($companyDB["company_video_type"] == "upload"){
						echo "
						<div class='embed-responsive embed-responsive-16by9'>
						  <video class='embed-responsive-item' controls>
							<source src='".DB_LOCAL.DB_LINK.$companyDB["company_video"]."' type='video/mp4'> </source>
						  </video>
						</div>";
					  }
					}
					echo "
					  <hr></hr>
					  <div class='entry-content'>
						<h3><b>About Us :</b></h3>
						<div class='content-madilog'>".$companyDB["company_content"]."</div>
					  </div>
					</div>";
					?>
					<script>
					
					</script>
					<?php
					echo "
					<div class='col-12 col-lg-12' id='ourProduct'>
					  <div class='row'>
					    <hr></hr>
						<h3><b>Product :</b></h3>";
						$userDB = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_id`='".$userDB["user_id"]."'") -> fetch_assoc();
						
						$usercatDB = $db->conn -> query("SELECT * FROM `mdl_user_category` WHERE `usercat_id`='".$userDB["user_category"]."'") -> fetch_assoc();
						
						if($usercatDB["usercat_slug"] == "platinum"){
							$paket = $usercatDB["usercat_title"];
							$batasupload = 10;
						}
						if($usercatDB["usercat_slug"] == "gold"){
							$paket = $usercatDB["usercat_title"];
							$batasupload = 7;
						}
						if($usercatDB["usercat_slug"] == "silver"){
							$paket = $usercatDB["usercat_title"];
							$batasupload = 5;
						}
						if($usercatDB["usercat_slug"] == "bronze"){
							$paket = $usercatDB["usercat_title"];
							$batasupload = 0;
						}
						  $productQR = $db->conn -> query("SELECT * FROM `mdl_product` WHERE `product_author`='".$userDB["user_id"]."' ORDER BY `product_datemodify` DESC LIMIT ".$batasupload."");
						  
						  while($productDB = $productQR -> fetch_assoc()){
				
							if($productDB["product_thumb"] != ""){
							  $thumb = $productDB["product_thumb"];
							  $mediaDB = $db->conn -> query("SELECT * FROM `mdl_media` WHERE `media_id`='$thumb'") -> fetch_assoc();
							  $thumb = DB_LOCAL.DB_LINK.$mediaDB["media_attachment_medium"];
							}
							else { $thumb = FOLDER_THEMES."/assets/img/image-not-available.jpg"; }
						
							if($mediaDB["media_alt"] != ""){$alt = $mediaDB["media_alt"];} else {$alt = $mediaDB["media_title"];}
							
							echo "
							<div class='col-6 col-lg-3 col-sm-3 col-md-3 col-sm-3 mb-3'>
							  <div class='post-box'>
								<a href='".DB_LOCAL.DB_LINK."/product/".$productDB["product_slug"]."/' title='".$productDB["product_title"]."'>
								  <div class='mb-3'>
									<div class='post-img'>
										<img src='".DB_LOCAL.DB_LINK.$mediaDB["media_attachment_medium"]."' alt='".$alt."' class='img-fluid image-ready'>
									</div>
									
									<h3 class='product-title'><a href='".DB_LOCAL.DB_LINK."/product/".$productDB["product_slug"]."/' title='".$productDB["product_title"]."'>".$productDB["product_title"]."</a></h3>
									
									<div class='product-content mb-2 content-madilog' style='color:#4a4a4a'>".substr(strip_tags(htmlspecialchars_decode($productDB["product_content"])), 0, 80)." .....</div>
								  </div>
								</a>
								<a href='".DB_LOCAL.DB_LINK."/product/".$productDB["product_slug"]."/' title='".$productDB["product_title"]."'>
									<button type='button' class='btn btn-orange rounded-0'>
										<i class='fas fa-external-link-square-alt'></i> <span>Read Detail</span>
									</button>
								</a>
							  </div>
							</div>
							";
						  }
					  echo "
					  </div>
					</div>
					
					<div id='ourLocation'>
					  <div class='row'>
						<hr></hr>
						<h3><b>Geo Location :</b></h3>
						<div class='col-12 col-lg-12'>";
							if($companyDB["latitude"] == ""  OR $companyDB["longitude"] == ""){
							  echo $companyDB["company_map"];  
							} else {?>
							  <!-- ".$companyDB["company_map"]." -->
							  <!-- map : company -->
							  <div id="map_company_profile" style="height:650px;width:100%;z-index: 1;"></div>
							<?php }
						  echo "
						</div>
					  </div>
					</div>
					
				  </article>";
				}
				else {
				  echo "
				  <div class='col-12'>
					<a href='".DB_LOCAL.DB_LINK."/exhibitor/platinum/' title='Exhibitor'>
					  <button type='button' class='btn btn-orange rounded-0 mt-1'>
						<i class='fas fa-angle-double-left'></i> <span>Back</span>
					  </button>
					</a>
				  </div>
				  <article class='entry mb-4'>
					<div class='row'>
					  <div class='col-3 col-lg-3 col-md-3 col-sm-3 mt-2 text-center'>
						<img src='".DB_LOCAL.DB_LINK.$mediaDB["media_attachment_small"]."' alt='".$userDB["user_name"]."' class='img-fluid' style='width:120px;'>
					  </div>
					  <div class='col-9 col-lg-9 col-md-9 col-sm-9'>
						<h2 class='entry-title'>Company Profile</h2>
						<p><i class='fas fa-hotel'></i> <b>Company Name</b> : ".$companyDB["company_name"]."</p>
						<p><i class='fas fa-address-card'></i> <b>Addres</b> : ".$companyDB["company_address"]."</p>
						<p><i class='fas fa-globe'></i> <b>Website</b> : <a href='".$companyDB["company_url"]."' title='".$companyDB["company_name"]."' target='_blank' rel='sponsored'>".$companyDB["company_url"]."</a></p>
					  </div>
					</div>
				  </article>
				  <div class='row'>
					<div class='col-12'>
					  <article class='entry p-3 mb-3'>
						<h2 class='entry-title mb-0'>Platinum Exhibitors</h2>
					  </article>
					</div>
				  ";
				  $userQR = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_category`='2' && `user_status`='published' ORDER BY RAND() DESC LIMIT 12");
				  
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
							  $thumb = DB_LOCAL.DB_LINK.$mediaDB["media_attachment_large"];
							
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
						  <div class='col-10 col-lg-10 mt-10'>
						  <a href='".DB_LOCAL.DB_LINK."/company-profile/".$username."/' title='".$companyDB["company_name"]."'>
							<div class='row'>
							  <div class='col-2 col-lg-2 col-md-2 col-sm-2 mt-2 text-center'>
								<img src='".DB_LOCAL.DB_LINK.$mediaDB["media_attachment_small"]."' alt='".$companyDB["company_name"]."' class='img-fluid' style='width:60px;'>
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
				  }
				  echo "</div>";
				}?>
				</div>
			</div>
		</div>
    </section>
</main>

<!-- Map:Script -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
<script>
	// Inisialisasi variabel pointTempat untuk definisi lokasi tempat
	var pointTempat = [];
	<?php
	// Menambahkan titik point perusahaan terpilih berdasarkan ID
	// $companyDB = $db->conn->query("SELECT * FROM `mdl_user_company` WHERE `user_id`='" . $userDB["user_id"] . "'")->fetch_assoc();
	$companyDB = $db->conn->query("SELECT * FROM `mdl_user_company` WHERE `user_id`='" . $userDB["user_id"] . "'")->fetch_assoc(); 
	?>
	pointTempat.push([<?= $companyDB["latitude"]; ?>, <?= $companyDB["longitude"]; ?>, ['<?= $companyDB["company_name"]; ?>', '<?= $companyDB["company_map"]; ?>', 'offices']]);
	// console.log(pointTempat)
	// Inisialisasi Tampilan Peta, Fokus Koordinat, dan Nilai Zoom
	var map = L.map('map_company_profile').setView([pointTempat[0][0], pointTempat[0][1]], 16);
	// Inisialisasi Gambar Tampilan Peta
	L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
	}).addTo(map);

	// Menambahkan titik point tempat umum
	point_perusahaan = []
	<?php
	$result = $db->conn->query("SELECT company.*,user.user_name FROM mdl_user_company as company JOIN mdl_user as user  where company.user_id=user.user_id AND company.latitude <>'' AND company.longitude <>'';");
	while ($row = $result->fetch_assoc()) :
	?>
		<?php if ($row["company_name"] != $companyDB['company_name']) : ?>
			point_perusahaan.push(['<?= $row["latitude"]; ?>', '<?= $row["longitude"]; ?>',[ '<?= $row["company_name"]; ?>', '<?= $companyDB['company_map']; ?>', 'office', '<?= $row["user_name"]; ?>']]);
		<?php endif; ?>
	<?php endwhile; ?>

	// console.log(point_perusahaan)

	// Fungsi Penentuan Icon Tempat
	function getIcon(type) {
		switch (type) {
			case "restaurant":
				return L.icon({
					iconUrl: '<?= FOLDER_THEMES . '/assets/img/point/restaurant.png' ?>',
					iconSize: [38, 45],
				});
			case "hospital":
				return L.icon({
					iconUrl: '<?= FOLDER_THEMES . '/assets/img/point/hospital.png' ?>',
					iconSize: [38, 45],
				});
			case "terminal":
				return L.icon({
					iconUrl: '<?= FOLDER_THEMES . '/assets/img/point/bus.png' ?>',
					iconSize: [38, 45],
				});
			case "station":
				return L.icon({
					iconUrl: '<?= FOLDER_THEMES . '/assets/img/point/train.png' ?>',
					iconSize: [38, 45],
				});
			case "offices":
				return L.icon({
					iconUrl: '<?= FOLDER_THEMES . '/assets/img/point/offices.png' ?>',
					iconSize: [38, 45],
				});
			case "office":
				return L.icon({
					iconUrl: '<?= FOLDER_THEMES . '/assets/img/point/office.png' ?>',
					iconSize: [38, 45],
				});
			case "visitor":
				return L.icon({
					iconUrl: '<?= FOLDER_THEMES . '/assets/img/point/position.png' ?>',
					iconSize: [38, 45],
				});
			default:
				return L.icon({
					iconUrl: '<?= FOLDER_THEMES . '/assets/img/point/point_user.png' ?>',
					iconSize: [38, 45],
				});
		}
	}

	// Membuat setiap marker point perusahaan dan tempat umum pada peta
	var markers = [];
	var markers_perusahaan_lain = [];
	// Menentukan Point berdasarkan Koordinat, Ikon, dan draggable marker
	pointTempat.forEach((element, idx) => {
		var marker = L.marker([element[0], element[1]], {
			icon: getIcon(element[2][2]),
			draggable: false,
		}).bindPopup(`<h6><b>${element[2][0]}</b></h6><br/><iframe src = 'https://www.google.com/maps?q=${element[0]}, ${element[1]}+&output=embed'> </iframe>`).addTo(map);
		// Menambahkan properti tambahan untuk marker seperti popup nama tempat, iframe, dan tombol rute
		markers.push(marker);
		// markers[idx]
		// markers[idx].bindPopup(`<div class='d-flex p-2 mx-auto'><h5><b>${element[2]}</b></h5><br/><iframe src='https://www.google.com/maps?q=${element[0]},${element[1]}&output=embed'></iframe><div class="text-center"><br><button class="btn btn-success m-1 p-1" onClick="addRoute(${element[0]}, ${element[1]})">Rute Ke Sini</button><button class="btn btn-danger m-1 p-1" onClick="resetRoute()">Reset Route</button></div></div>`);
	});
	point_perusahaan.forEach((element, idx) => {
		// Menambahkan properti tambahan untuk marker seperti popup nama tempat, iframe, dan tombol rute
		var marker = L.marker([element[0], element[1]], {
			icon: getIcon(element[2][2]),
			draggable: false,
		}).bindPopup(`<h5><b>${element[2][0]}</b></h5><br/><iframe src='https://www.google.com/maps?q=${element[0]},${element[1]}&output=embed'></iframe><div class="text-center"><br><a class="btn btn-sm btn-primary  mx-auto text-light" href='../../company-profile/${element[2][3]}/ ' role="button" >Visit Exhibitor!</a><br/><button class="btn btn-success m-1 p-1" onClick="addRoute(${element[0]}, ${element[1]})">Route Here!</button><button class="btn btn-danger m-1 p-1" onClick="resetRoute()">Reset Route</button></div>`).addTo(map);
		markers.push(marker);
		// markers[idx];
		// markers[idx].bindPopup(`<div class='d-flex p-2 mx-auto'><h5><b>${element[2]}</b></h5><br/><iframe src='https://www.google.com/maps?q=${element[0]},${element[1]}&output=embed'></iframe><div class="text-center"><br><button class="btn btn-success m-1 p-1" onClick="addRoute(${element[0]}, ${element[1]})">Rute Ke Sini</button><button class="btn btn-danger m-1 p-1" onClick="resetRoute()">Reset Route</button></div></div>`);
	});
	// markers[0].openPopup();

	// Definisi titik tengah pointTempat dan radius

    var centerPointTempat = L.latLng([pointTempat[0][0], pointTempat[0][1]]);
    var radius = 500; // dalam meter

    // Fungsi Filter titik yang berada dalam jangkauan radius
    var filteredMarkers = markers.filter(function(marker) {
        var markerLatLng = marker.getLatLng();
        return centerPointTempat.distanceTo(markerLatLng) <= radius;
    });

    // Menghapus titik non-filtered dari peta
    markers.forEach(function(marker) {
        if (!filteredMarkers.includes(marker)) {
            map.removeLayer(marker);
        }
    });
	// Pendefinisian Jalur peta
	var routingControl;
    // Pembentukan Jalur 
    routingControl = L.Routing.control({
        waypoints: [
            L.latLng([pointTempat[0][0], pointTempat[0][1]]),
        ],
        routeWhileDragging: false,
        createMarker: function() {
            return null;
        },
    });
    routingControl.addTo(map);

    // Fungsi Ketika Ingin Meneruskan Rute Ke titik Lain
    function addRoute(lat, lng) {
        var latLng = L.latLng(lat, lng);
        routingControl.spliceWaypoints(routingControl.getWaypoints().length - 1, 1, latLng);
        routingControl.spliceWaypoints(routingControl.getWaypoints().length, 0, latLng);
    }

    // Fungsi Penanganan Ketika Terjadi Error dalam mendapatkan lokasi
    function showError(error) {
        console.log("Error getting geolocation:", error.message);
    }

    // Fungsi Ketika Ingin Mereset Rute Jalur ke titik Awal
    function resetRoute() {
        routingControl.setWaypoints([L.latLng([pointTempat[0][0], pointTempat[0][1]])]);
    }
	function resize_map() {
		setTimeout(function() {
			map.invalidateSize()
			markers[0].openPopup();
			
		}, 2000);
	}
</script>

<?php include "footer.php";?>