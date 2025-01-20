<?php
if($numpermalink == $default + 1){
  if($permalink[$i+1] == "visitor" || $permalink[$i+1] == "visitors" || $permalink[$i+1] == "users" || $permalink[$i+1] == "convert"){
    // PHP code to obtain country, city,  
    // continent, etc using IP Address
    // $ip = $_SERVER['REMOTE_ADDR']; 
    // Use JSON encoded string and converts 
    // it into a PHP variable 
    // $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
    // echo 'Country Name: ' . $ipdat->geoplugin_countryName . "<br>"; 
    // echo 'City Name: ' . $ipdat->geoplugin_city . "<br>"; 
    // echo 'Continent Name: ' . $ipdat->geoplugin_continentName . "<br>"; 
    // echo 'Latitude: ' . $ipdat->geoplugin_latitude . "<br>"; 
    // echo 'Longitude: ' . $ipdat->geoplugin_longitude . "<br>"; 
    // echo 'Currency Symbol: ' . $ipdat->geoplugin_currencySymbol . "<br>"; 
    // echo 'Currency Code: ' . $ipdat->geoplugin_currencyCode . "<br>"; 
    // echo 'Timezone: ' . $ipdat->geoplugin_timezone; 
    // echo $companyidforvisitor;
    // VISITORS CODE INPUT
  } else {
    if(isset($_SESSION["login"]) && isset($_SESSION["email"])){
      $usersessionDB = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_email`='".$_SESSION["email"]."'") -> fetch_assoc();
      $userid = $usersessionDB["user_id"];
    } else { $userid = ""; }
    
    $companyid = $companyidforvisitor;
    $ipaddress = $_SERVER['REMOTE_ADDR'];
    $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ipaddress)); 
    $country = $ipdat->geoplugin_countryName;
    $countrycode = $ipdat->geoplugin_countryCode;
    $region = $ipdat->geoplugin_region;
    $city = $ipdat->geoplugin_city;
    $url = "https://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
    
    $browser = $_SERVER['HTTP_USER_AGENT'];
    $datetime = $DBdatetime;
    $date = date("Y-m-d", strtotime($datetime));
    $time = date("H:i:s", strtotime($datetime));
    
    if(
      $ipaddress == "182.1.85.209" || 
      $ipaddress == "180.253.79.161" ||
      $ipaddress == "180.253.71.149" || 
      $ipaddress == "36.65.194.8"
      // || $usersessionDB["user_position"] == "administrator" || 
      //$usersessionDB["user_position"] == "member"
    ){
        
    } else {
      $visitorsQR = $db->conn -> query("SELECT * FROM `mdl_visitors` WHERE `visitors_ip`='".$ipaddress."' && `visitors_url`='".$url."' && `visitors_date`='".$date."'");
      $visitorsDB = $visitorsQR -> fetch_assoc();
      $visitorsNUM = $visitorsQR -> num_rows;
      if($visitorsNUM == 0){
        $insert = $db->conn -> query("INSERT INTO `mdl_visitors`(`visitors_id`, `user_id`, `company_id`, `visitors_ip`, `visitors_country`, `visitors_region`, `visitors_city`, `visitors_country_code`, `visitors_url`, `visitors_url_name`, `visitors_browser`, `visitors_date`, `visitors_time`, `visitors_datetime`) VALUES ('', '$userid', '$companyid', '$ipaddress', '$country', '$region', '$city',  '$countrycode', '$url', '$urlname', '$browser', '$date', '$time', '$datetime')");
      } else {
        if(isset($_SESSION["login"]) && isset($_SESSION["email"])){
          $update = $db->conn -> query("UPDATE `mdl_visitors` SET `company_id`='$companyid' WHERE `visitors_id`='$visitorsDB'");
        }
      }
    }
  }
} else {
    if(isset($_SESSION["login"]) && isset($_SESSION["email"])){
      $usersessionDB = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_email`='".$_SESSION["email"]."'") -> fetch_assoc();
      $userid = $usersessionDB["user_id"];
    } else { $userid = ""; }
    
    $companyid = $companyidforvisitor;
    $ipaddress = $_SERVER['REMOTE_ADDR'];
    $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ipaddress)); 
    $country = $ipdat->geoplugin_countryName;
    $countrycode = $ipdat->geoplugin_countryCode;
    $region = $ipdat->geoplugin_region;
    $city = $ipdat->geoplugin_city;
    $url = "https://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
    
    $browser = $_SERVER['HTTP_USER_AGENT'];
    $datetime = $DBdatetime;
    $date = date("Y-m-d", strtotime($datetime));
    $time = date("H:i:s", strtotime($datetime));
    
    if(
      $ipaddress == "182.1.85.209" || 
      $ipaddress == "180.253.79.161" ||
      $ipaddress == "36.65.194.8"
      // || $usersessionDB["user_position"] == "administrator"
    ){
        
    } else {
      $visitorsQR = $db->conn -> query("SELECT * FROM `mdl_visitors` WHERE `visitors_ip`='".$ipaddress."' && `visitors_url`='".$url."' && `visitors_date`='".$date."'");
      $visitorsDB = $visitorsQR -> fetch_assoc();
      $visitorsNUM = $visitorsQR -> num_rows;
      if($visitorsNUM == 0){
        $insert = $db->conn -> query("INSERT INTO `mdl_visitors`(`visitors_id`, `user_id`, `company_id`, `visitors_ip`, `visitors_country`, `visitors_region`, `visitors_city`, `visitors_country_code`, `visitors_url`, `visitors_url_name`, `visitors_browser`, `visitors_date`, `visitors_time`, `visitors_datetime`) VALUES ('', '$userid', '$companyid', '$ipaddress', '$country', '$region', '$city',  '$countrycode', '$url', '$urlname', '$browser', '$date', '$time', '$datetime')");
      } else {
        if(isset($_SESSION["login"]) && isset($_SESSION["email"])){
          $update = $db->conn -> query("UPDATE `mdl_visitors` SET `company_id`='$companyid' WHERE `visitors_id`='$visitorsDB'");
        }
      }
    }
}
?> 

  <div class="lightbox" id="bookmarkBOX">
    <div class="container-lightbox">
      <div class="container-lightbox-display">
        <div class="row" style="height: 100%;">
		  <div class="col-12 col-xl-4 col-lg-4 col-md-4 col-sm-12" style="margin:0 auto;">
		    <form method="post" action="<?php echo "https://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];?>">
		      <div id="actionBookmark"></div>
		    </form>
          </div>
		</div>
	  </div>
	</div>
  </div>
  
  <?php
  if(isset($_SESSION["login"]) && isset($_SESSION["email"])){
    $userDB = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_email`='".$_SESSION["email"]."'") -> fetch_assoc();
    if($userDB["user_position"] == "subscriber"){?>
      <div class="bookmark-button" id="list-bookmark">
        <div class="btn btn-orange rounded-0">
          <span class="text"><b>Your List Bookmark</b></span> <i class="fas fa-book"></i>
        </div>
      </div>
      <div class="bookmark-box" id="list-bookmark-box">
        <div class="btn btn-orange rounded-0 box-header" id="list-bookmark-box-header">
          <i class="fas fa-book-open"></i> <b>Your List Bookmark</b> <span style="float:right;"><i class="fas fa-times"></i></span>
        </div>
        <div class="box-content">
          <ol class="mt-2" style="font-size: 14px;" id="list-of-bookmark">
            <?php
            $bookmarkQR = $db->conn -> query("SELECT * FROM `mdl_bookmark` WHERE `user_id`='".$userDB["user_id"]."'");
            $bookmarkNUM = $bookmarkQR -> num_rows;
            
            if($bookmarkNUM == 0){
              echo "Bookmark List is Empty";
            } else {
              while($bookmarkDB = $bookmarkQR -> fetch_assoc()){
                $companyDB = $db->conn -> query("SELECT * FROM `mdl_user_company` WHERE `user_id`='".$bookmarkDB["company_id"]."'") -> fetch_assoc();
                $userDB2 = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_id`='".$companyDB["user_id"]."'") -> fetch_assoc();
                if($userDB2["user_category"] == 2){
                    $username = $userDB2["user_name_id"];
                } else {
                    $username = $userDB2["user_name"];
                }
                echo "<li><a href='".DB_LOCAL.DB_LINK."/company-profile/".$username."/' title='".$companyDB["company_name"]."'>".$companyDB["company_name"]."</a></li>";
              }
            }
            ?>
          </ol>
        </div>
      </div>
  <?php }
  }?>
  
  <div class="lightbox" id="chatBOX">
    <div class="container-lightbox">
      <div class="container-lightbox-display">
        <div class="row" style="height: 100%;">
		  <div class="col-12 col-xl-4 col-lg-4 col-md-4 col-sm-12" style="margin:0 auto;">
		    <form method="post" action="<?php echo "https://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];?>">
		      <div id="actionChat"></div>
		    </form>
          </div>
		</div>
	  </div>
	</div>
  </div>
  
  <?php
  if(isset($_SESSION["login"]) && isset($_SESSION["email"])){
    //$userDB = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_email`='".$_SESSION["email"]."'") -> fetch_assoc();
    if($usersessionDB["user_position"] == "subscriber" || $usersessionDB["user_position"] == "member"){?>
      <div class="chatbox-button" id="chatbox-button">
        <div class="btn btn-orange active rounded-0">
          <span class="text"><b>Chat Box</b></span> <i class="fas fa-comments"></i>
        </div>
      </div>
      
      <div class="chatbox" id="chatBox">
        <div class="btn btn-orange active rounded-0 chatbox-header" id="chatbox-header-close">
          <i class="fas fa-comments"></i> <span class="text"><b>Chat Box</b></span> <span style="float:right;"><i class="fas fa-times"></i></span>
        </div>
        <div class="chatbox-content" id="list-chatbox">
          <ul id="list-of-chatbox entry">
            <?php
            $bookmarkQR = $db->conn -> query("SELECT * FROM `mdl_bookmark` WHERE `user_id`='".$usersessionDB["user_id"]."'");
            $bookmarkNUM = $bookmarkQR -> num_rows;
            
            // $chatQR = $db->conn -> query("SELECT * FROM `mdl_chat` WHERE `chat_send`='".$usersessionDB["user_id"]."' GROUP BY `chat_code` ORDER BY `chat_datetime` DESC");
            // $chatQR = $db->conn -> query("SELECT * FROM `mdl_chat` WHERE `chat_send`='".$usersessionDB["user_id"]."' || `chat_receive`='".$usersessionDB["user_id"]."' GROUP BY `chat_code` ORDER BY `chat_datetime` DESC");
            // $chatNUM = $chatQR -> num_rows;
            // || `chat_receive`='".$usersessionDB["user_id"]."'
            
            
            $chatuserQR = $db->conn -> query("SELECT * FROM `mdl_chat_user` WHERE `chatuser_first`='".$usersessionDB["user_id"]."' || `chatuser_second`='".$usersessionDB["user_id"]."' ORDER BY `chatuser_update` DESC");
            $chatuserNUM = $chatuserQR -> num_rows;
            
            if($chatuserNUM == 0){
              echo "Chat is Empty";
            } else {
              while($chatuserDB = $chatuserQR -> fetch_assoc()){
                if($chatuserDB["chatuser_first"] != $usersessionDB["user_id"]){
                  $companyDB = $db->conn -> query("SELECT * FROM `mdl_user_company` WHERE `user_id`='".$chatuserDB["chatuser_first"]."'") -> fetch_assoc();
                  
                  $userDB2 = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_id`='".$chatuserDB["chatuser_first"]."'") -> fetch_assoc();
                  if($userDB2["user_position"] == "member"){
                    $name = $companyDB["company_name"];
                  } else {
                    $name = $userDB2["user_first_name"]." ".$userDB2["user_last_name"];
                  }
                  
                  if($companyDB["company_thumb"] != ""){
				    $thumb = $companyDB["company_thumb"];
				    $mediaDB = $db->conn -> query("SELECT * FROM `mdl_media` WHERE `media_id`='$thumb'") -> fetch_assoc();
				    $thumb = "<img src='".DB_LOCAL.DB_LINK.$mediaDB["media_attachment_small"]."' alt='".$companyDB["company_name"]."' class='img-fluid' style='width: 40px;height: 40px;'>";
				  }
				  else { $thumb = "<img src='".DB_LOCAL.DB_LINK."/mdl-content/themes/jifbw2024/assets/img/blank-profile-picture.jpg' alt='".$companyDB["company_name"]."' class='img-fluid' style='width: 40px;height: 40px;'>"; }
				
				  if($mediaDB["media_alt"] != ""){$alt = $mediaDB["media_alt"];} else {$alt = $mediaDB["media_title"];}
                
                  echo "<li class='row p-1 add-chat-box' id='Chat_".$usersessionDB["user_id"]."-".$companyDB["user_id"]."'>
                    <div class='col-3'>".$thumb."</div>
                    <div class='col-9'>".$name."</div>
                  </li>";
                }/*
                else {
                  $companyDB = $db->conn -> query("SELECT * FROM `mdl_user_company` WHERE `user_id`='".$chatuserDB["chatuser_second"]."'") -> fetch_assoc();
                  $userDB2 = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_id`='".$companyDB["user_id"]."'") -> fetch_assoc();
                  if($userDB2["user_position"] == "member"){
                    $name = $companyDB["company_name"];
                  } else {
                    $name = $userDB2["user_first_name"]." ".$userDB2["user_last_name"];
                  }
                  if($companyDB["company_thumb"] != ""){
				    $thumb = $companyDB["company_thumb"];
				    $mediaDB = $db->conn -> query("SELECT * FROM `mdl_media` WHERE `media_id`='$thumb'") -> fetch_assoc();
				    $thumb = DB_LOCAL.DB_LINK.$mediaDB["media_attachment_small"];
				  }
				  else { $thumb = DB_LOCAL.DB_LINK."/mdl-content/themes/jifbw2024/assets/img/blank-profile-picture.jpg"; }
				
				  if($mediaDB["media_alt"] != ""){$alt = $mediaDB["media_alt"];} else {$alt = $mediaDB["media_title"];}
                
                  echo "<li class='row p-1 add-chat-box' id='Chat_".$usersessionDB["user_id"]."-".$companyDB["user_id"]."'>
                    <div class='col-3'><img src='".$thumb."' alt='".$companyDB["company_name"]."' class='img-fluid'></div>
                    <div class='col-9'>".$name."</div>
                  </li>";
                }*/
              }
            }
            ?>
          </ul>
        </div>
      </div>
      
      <div class="chatbox-user" id="chatBoxUser">
        <div class="spinner-border spinner-madilog" role="status" id="spinnerChatBox">
		  <span class="sr-only">Loading...</span>
		</div>
        <div id="chatbox-user-content"></div>
      </div>
      
  <?php }
  }?>
<footer id="footer" class="footer pb-0">
    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-5 col-md-12 footer-info">
            <a href="/" class="logo d-flex align-items-center">
              <img src="<?php echo FOLDER_THEMES;?>/assets/img/jifbw-logo-icon.png" alt="JIF BW Logo 2024">
              <span>JIFBW</span>
            </a>
            <p>JEPARA INTERNATIONAL FURNITURE BUYER WEEKS</p>
            <div class="social-links mt-3">
              <a href="https://instagram.com/jifbw/" class="instagram" title="Instagram @JIFBW" target="_blank" rel="nofollow"><i class="bi bi-instagram"></i></a>
              <a href="https://www.facebook.com/jifbw/" class="facebook" title="Facebook @JIFBW" target="_blank" rel="nofollow"><i class="bi bi-facebook"></i></a>
              <a href="https://www.youtube.com/@jifbw/" class="youtube" title="Youtube @JIFBW" target="_blank" rel="nofollow"><i class="bi bi-youtube"></i></a>
              <a href="https://www.pinterest.com/jif_bw/" class="pinterest" title="Pinterest @JIFBW" target="_blank" rel="nofollow"><i class="bi bi-pinterest"></i></a>
            </div>
          </div>
          <div class="col-lg-2 col-6 footer-links">
            <h4>Buyers Menu</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="<?php echo DB_LOCAL.DB_LINK."/sign-up/";?>" title="Sign Up" rel="nofollow">Sign Up</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="<?php echo DB_LOCAL.DB_LINK."/login/";?>" title="Log In" rel="nofollow">Log In</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="<?php echo DB_LOCAL.DB_LINK."/page/contact-us/";?>" title="Contact Us" rel="nofollow">Contact Us</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="<?php echo DB_LOCAL.DB_LINK."/page/plan-visit/";?>" title="Plan a Visit">Plan a Visit</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="<?php echo DB_LOCAL.DB_LINK."/page/why-visit-us/";?>" title="Why Visit Us ?">Why Visit Us ?</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="<?php echo DB_LOCAL.DB_LINK."/page/terms/";?>" title="Terms & Conditions">Terms & Conditions</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="<?php echo DB_LOCAL.DB_LINK."/page/hotels/";?>" title="Hotels" rel="nofollow">Hotels</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="<?php echo DB_LOCAL.DB_LINK."/page/travels/";?>" title="Travels" rel="nofollow">Travels</a></li>
            </ul>
          </div>
          <div class="col-lg-2 col-6 footer-links">
            <h4>Exhibitors Menu</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="<?php echo DB_LOCAL.DB_LINK."/register/";?>" title="Register" rel="nofollow">Register</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="<?php echo DB_LOCAL.DB_LINK."/login/";?>" title="Login" rel="nofollow">Log In</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="<?php echo DB_LOCAL.DB_LINK."/page/why-join-exhibitor/";?>" title="Why Join Us ?">Why Join Us ?</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="<?php echo DB_LOCAL.DB_LINK."/page/terms/";?>" title="Terms & Conditions">Terms & Conditions</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="<?php echo DB_LOCAL.DB_LINK."/page/packages/";?>" title="Packages & Price" rel="nofollow">Packages & Price</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="/" title="Blog">Blog</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
            <h4>Contact Us</h4>
            <p><b>Office</b> : Jl. Kopral Sapari No.6, Pengkol, Kec. Jepara, Kab. Jepara, Central Java 59415</p>
			<p><b>Email</b> : info@jifbw.com</p>
			<p><b>Contact Person</b> : 0291592386</p>
			<p><b>Whatsapp</b> : +6281392346101</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="copyright">
        2023 - <?php echo date("Y");?> &copy; Copyright <a href="<?php echo DB_LOCAL.DB_LINK."/";?>" title="JIF-BW" style="color:#fff;"><strong>JIFBW</span></strong></a>. All Rights Reserved
      </div>
    </div>
</footer>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'en,ar,es,jv,ko,pt,ru,zh-CN,id,fr', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<!-- jQuery -->
<script src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/toastr/toastr.min.js"></script>
  
<!-- Vendor JS Files -->
<script src="<?php echo FOLDER_THEMES;?>/assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="<?php echo FOLDER_THEMES;?>/assets/vendor/aos/aos.js"></script>
<script src="<?php echo FOLDER_THEMES;?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo FOLDER_THEMES;?>/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?php echo FOLDER_THEMES;?>/assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="<?php echo FOLDER_THEMES;?>/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?php echo FOLDER_THEMES;?>/assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="<?php echo FOLDER_THEMES;?>/assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="<?php echo FOLDER_THEMES;?>/assets/js/main-new.js"></script>
  
<!-- Bootstrap 4 -->
<script src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/select2/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/moment/moment.min.js"></script>
<script src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/daterangepicker/daterangepicker.js"></script>
<!-- date-range-picker -->
<script src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/daterangepicker/daterangepicker.js"></script>

<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/dropzone2/dropzone2.js"></script>
<script src="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/chart.js/Chart.min.js"></script>

<!-- Google tag (gtag.js)-->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-PPFJ75CKZZ"></script>
<script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-PPFJ75CKZZ'); </script>

<?php if($numpermalink == $default + 1){
  if($permalink[$i+1] == "visitor" || $permalink[$i+1] == "visitors"){?>
    <script>
    $(function () {
      'use strict'
      var ticksStyle = {
        fontColor: '#495057',
        fontStyle: 'bold'
      }
      var mode = 'index'
      var intersect = true
      var $visitorsChart = $('#visitors-chart')
      // eslint-disable-next-line no-unused-vars
      var visitorsChart = new Chart($visitorsChart, {
        data: {
          labels: [<?php
    	  $today     = new DateTime(); // today
    	  $begin     = $today->sub(new DateInterval('P30D')); //created 30 days interval back
    	  $end       = new DateTime();
    	  $end       = $end->modify('+1 day'); // interval generates upto last day
    	  $interval  = new DateInterval('P1D'); // 1d interval range
    	  $daterange = new DatePeriod($begin, $interval, $end); // it always runs forwards in date
    	  foreach ($daterange as $date) { // date object
    		echo "'".$date->format("d")."', "; // your date
    	  }?>],
          datasets: [{
            type: 'line',
            data: [<?php
    	    $today     = new DateTime(); // today
    	    $begin     = $today->sub(new DateInterval('P30D')); //created 30 days interval back
    	    $end       = new DateTime();
    	    $end       = $end->modify('+1 day'); // interval generates upto last day
    	    $interval  = new DateInterval('P1D'); // 1d interval range
    	    $daterange = new DatePeriod($begin, $interval, $end); // it always runs forwards in date
    	    foreach ($daterange as $date) { // date object
    		  $tgl = $date->format("Y-m-d");
    		  $visitorsQR = $db->conn -> query("SELECT * FROM `mdl_visitors` WHERE `visitors_date` = '".$tgl."' GROUP BY `visitors_ip`");
    		  $visitorsNUM = $visitorsQR -> num_rows;
    		  $visitorsDB = $visitorsQR -> fetch_assoc();
    		  if($visitorsNUM == 0){
    			echo "'0', ";
    		  }
    		  else {
    			echo "'".$visitorsNUM."', ";
    		  }
    	    }?>],
            backgroundColor: 'transparent',
            borderColor: '#007bff',
            pointBorderColor: '#007bff',
            pointBackgroundColor: '#007bff',
            fill: false
            // pointHoverBackgroundColor: '#007bff',
            // pointHoverBorderColor    : '#007bff'
          },
          {
            type: 'line',
            data: [<?php
    	    $today     = new DateTime(); // today
    	    $begin     = $today->sub(new DateInterval('P30D')); //created 30 days interval back
    	    $end       = new DateTime();
    	    $end       = $end->modify('+1 day'); // interval generates upto last day
    	    $interval  = new DateInterval('P1D'); // 1d interval range
    	    $daterange = new DatePeriod($begin, $interval, $end); // it always runs forwards in date
    	    foreach ($daterange as $date) { // date object
    		  $tgl = $date->format("Y-m-d");
    		  $tgl  = date('Y-m-d', strtotime($tgl.' - 71 days'));
    		  $visitorsQR = $db->conn -> query("SELECT * FROM `mdl_visitors` WHERE `visitors_date` = '".$tgl."' GROUP BY `visitors_ip`");
    		  $visitorsNUM = $visitorsQR -> num_rows;
    		  $visitorsDB = $visitorsQR -> fetch_assoc();
    		  if($visitorsNUM == 0){
    			echo "'0', ";
    		  }
    		  else {
    			echo "'".$visitorsNUM."', ";
    		  }
    	    }?>],
            backgroundColor: 'tansparent',
            borderColor: '#ced4da',
            pointBorderColor: '#ced4da',
            pointBackgroundColor: '#ced4da',
            fill: false
            // pointHoverBackgroundColor: '#ced4da',
            // pointHoverBorderColor    : '#ced4da'
          }]
        },
        options: {
          maintainAspectRatio: false,
          tooltips: {
            mode: mode,
            intersect: intersect
          },
          hover: {
            mode: mode,
            intersect: intersect
          },
          legend: {
            display: false
          },
          scales: {
            yAxes: [{
              // display: false,
              gridLines: {
                display: true,
                lineWidth: '4px',
                color: 'rgba(0, 0, 0, .2)',
                zeroLineColor: 'transparent'
              },
              ticks: $.extend({
                beginAtZero: true,
                suggestedMax: 200
              }, ticksStyle)
            }],
            xAxes: [{
              display: true,
              gridLines: {
                display: false
              },
              ticks: ticksStyle
            }]
          }
        }
      })
    })
    </script>
  <?php
  }
}?>

<?php if($numpermalink == $default){?>
<script>
  // Preload
  /*
  var delay = 1000;
  $(window).on('load', function() {
    setTimeout(function(){
      (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = 'https://api.anychat.one/widget/a8924da0-547e-3519-9c06-a7aa6cdb0d1c/livechat-js?r=' + encodeURIComponent(window.location);
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'contactus-jssdk'));
    },delay);
  });*/
</script>
<?php }?>

<script>
    var input = document.querySelector("#phone");
      window.intlTelInput(input, {
        initialCountry: "id",
        utilsScript: "../mdl-includes/plugin/tel-code/build/js/utils.js"
    });
    
    $('.carousel').carousel({
      interval: 3000;
    });
</script>

<?php if(!isset($_SESSION["login"]) && !isset($_SESSION["email"])){?>
<script>
  $(function () {
    // Add to Bookmark
    $(".add-to-bookmark").click(function(){
      var id = $(this).attr("id");
      company = id.replace("Bookmark_", "");
      
      $("#preloader").show();
      
      $.ajax({
		url: "../../mdl-includes/fiture/bookmark/add-to-bookmark.php",
		data: "id="+ company,
		type: "POST",
		success: function(data){
          var delay = 500;
          setTimeout(function(){
            $("#preloader").hide();
    		$("#bookmarkBOX").show();
    		$("#actionBookmark").html(data);
          },delay);
		},
		error: function (){}
      })
    });
    
    // Add Chat
    $(".add-chat-box").click(function(){
      var id = $(this).attr("id");
      idchat = id.replace("Chat_", "");
      
      $("#preloader").show();
      
      $.ajax({
		url: "../../mdl-includes/fiture/chat-messages/add-chat.php",
		data: "id="+idchat,
		type: "POST",
		success: function(data){
          var delay = 500;
          setTimeout(function(){
            $("#preloader").hide();
    		$("#chatBOX").show();
    		$("#actionChat").html(data);
          },delay);
		},
		error: function (){}
      })
    });
  });
</script>
<?php } ?>

<?php if(isset($_SESSION["login"]) && isset($_SESSION["email"])){
$userDB = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_email`='".$_SESSION["email"]."'") -> fetch_assoc();
$iduser = $userDB["user_id"];
if($userDB["user_status"] == "draft"){
  $usersessionDB = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_email`='".$_SESSION["email"]."'") -> fetch_assoc();
  $bookmarkQR = $db->conn -> query("SELECT * FROM `mdl_bookmark` WHERE `user_id`='".$usersessionDB["user_id"]."'");
  $bookmarkNUM = $bookmarkQR -> num_rows;
  
  if($bookmarkNUM > 2) {?>
    <script>
      $(function () {
        // Add to Bookmark
        $(".add-to-bookmark").click(function(){
          var id = $(this).attr("id");
          company = id.replace("Bookmark_", "");
          
          $("#preloader").show();
          
          $.ajax({
    		url: "../../mdl-includes/fiture/bookmark/add-to-bookmark.php",
    		data: "id="+ company,
    		type: "POST",
    		success: function(data){
              var delay = 500;
              setTimeout(function(){
                $("#preloader").hide();
        		$("#bookmarkBOX").show();
        		$("#actionBookmark").html(data);
              },delay);
    		},
    		error: function (){}
          })
        });
        
        // List Bookmark
        $("#list-bookmark").click(function(){
          $("#list-bookmark-box").show();
          $("#list-bookmark").hide();
        })
        $("#list-bookmark-box-header").click(function(){
          $("#list-bookmark-box").hide();
          $("#list-bookmark").show();
        });
      });
    </script>
  <?php
  } else {?>
    <script>
      $(function () {
        // Add to Bookmark
        $(".add-to-bookmark").click(function(){
          var id = $(this).attr("id");
          company = id.replace("Bookmark_", "");
          
          $("#preloader").show();
          
          $.ajax({
    		url: "../../mdl-includes/fiture/bookmark/add-to-bookmark.php",
    		data: "id="+ company,
    		type: "POST",
    		success: function(data){
              var delay = 500;
              setTimeout(function(){
                $("#preloader").hide();
        		$("#bookmarkBOX").show();
        		$("#actionBookmark").html(data);
        		$("#Bookmark_"+company).remove();
        		$("#bookmark-box-company-"+company).append("<div style='font-size: 26px;text-align: center;' title='On the List'><i class='fas fa-check-circle'></i> <p style='font-size:12px;'><b>On the List</b></p></div>");
              },delay);
              
              $.ajax({
        		url: "../../mdl-includes/fiture/bookmark/list-of-bookmark.php",
        		type: "POST",
        		success: function(data){
                  var delay = 200;
                  setTimeout(function(){
                    $("#list-of-bookmark").html(data);
                  },delay);
        		},
        		error: function (){}
              })
    		},
    		error: function (){}
          })
        });
        
        // List Bookmark
        $("#list-bookmark").click(function(){
          $("#list-bookmark-box").show();
          $("#list-bookmark").hide();
        })
        $("#list-bookmark-box-header").click(function(){
          $("#list-bookmark-box").hide();
          $("#list-bookmark").show();
        });
      });
    </script>
  <?php
  }
  ?>
  <script>
  $(function () {
    // Add Chat
    $(".add-chat-box").click(function(){
      var id = $(this).attr("id");
      idchat = id.replace("Chat_", "");
      
      $("#preloader").show();
      
      $.ajax({
		url: "../../mdl-includes/fiture/chat-messages/add-chat.php",
		data: "id="+idchat,
		type: "POST",
		success: function(data){
          var delay = 500;
          setTimeout(function(){
            $("#preloader").hide();
    		$("#chatBOX").show();
    		$("#actionChat").html(data);
          },delay);
		},
		error: function (){}
      })
    });
  });
  </script>
  <?php
}

else if($userDB["user_position"] == "member"){
?>
<script>
  $(function () {
    // Add to Bookmark
    $(".add-to-bookmark").click(function(){
      var id = $(this).attr("id");
      company = id.replace("Bookmark_", "");
      
      $("#preloader").show();
      
      $.ajax({
		url: "../../mdl-includes/fiture/bookmark/add-to-bookmark.php",
		data: "id="+ company,
		type: "POST",
		success: function(data){
          var delay = 500;
          setTimeout(function(){
            $("#preloader").hide();
    		$("#bookmarkBOX").show();
    		$("#actionBookmark").html(data);
          },delay);
		},
		error: function (){}
      })
    });
    
    
    // Add Chat
    $(".add-chat-box").click(function(){
      var id = $(this).attr("id");
      idchat = id.replace("Chat_", "");
      
      $("#chatBox").hide();
      $("#chatBoxUser").show();
      $("#spinnerChatBox").show();
      $("#chatbox-user-content-card").remove();
      
      $.ajax({
		url: "../../mdl-includes/fiture/chat-messages/add-chat.php",
		data: "id="+idchat,
		type: "POST",
		success: function(data){
          $("#spinnerChatBox").hide();
    	  $("#chatbox-user-content").html(data);
		},
		error: function (){}
      })
    });
    
    // Chat Button
    $("#chatbox-button").click(function(){
      $("#chatBox").show();
    });
    $("#chatbox-header-close").click(function(){
      $("#chatBox").hide();
    });
  });
</script>
<?php
}

else {
?>
<script>
  $(function () {
    // Add to Bookmark
    $(".add-to-bookmark").click(function(){
      var id = $(this).attr("id");
      company = id.replace("Bookmark_", "");
      
      $("#preloader").show();
      
      $.ajax({
		url: "../../mdl-includes/fiture/bookmark/add-to-bookmark.php",
		data: "id="+ company,
		type: "POST",
		success: function(data){
          var delay = 500;
          setTimeout(function(){
            $("#preloader").hide();
    		$("#bookmarkBOX").show();
    		$("#actionBookmark").html(data);
    		$("#Bookmark_"+company).remove();
    		$("#bookmark-box-company-"+company).append("<div style='font-size: 26px;text-align: center;' title='On the List'><i class='fas fa-check-circle'></i> <p style='font-size:12px;'><b>On the List</b></p></div>");
          },delay);
          
          $.ajax({
    		url: "../../mdl-includes/fiture/bookmark/list-of-bookmark.php",
    		type: "POST",
    		success: function(data){
              var delay = 200;
              setTimeout(function(){
                $("#list-of-bookmark").html(data);
              },delay);
    		},
    		error: function (){}
          })
		},
		error: function (){}
      })
    });
    
    // List Bookmark
    $("#list-bookmark").click(function(){
      $("#list-bookmark-box").show();
      $("#list-bookmark").hide();
    })
    $("#list-bookmark-box-header").click(function(){
      $("#list-bookmark-box").hide();
      $("#list-bookmark").show();
    });
    
    // Add Chat
    $(".add-chat-box").click(function(){
      var id = $(this).attr("id");
      idchat = id.replace("Chat_", "");
      
      $("#chatBox").hide();
      $("#chatBoxUser").show();
      $("#spinnerChatBox").show();
      $("#chatbox-user-content-card").remove();
      
      $.ajax({
		url: "../../mdl-includes/fiture/chat-messages/add-chat.php",
		data: "id="+idchat,
		type: "POST",
		success: function(data){
          $("#spinnerChatBox").hide();
    	  $("#chatbox-user-content").html(data);
		},
		error: function (){}
      })
    });
    
    // Chat Button
    $("#chatbox-button").click(function(){
      $("#chatBox").show();
    });
    $("#chatbox-header-close").click(function(){
      $("#chatBox").hide();
    });
  });
</script>
<?php } 
}?>

<script>
  // Preload
  var delay = 0;
  $(window).on('load', function() {
    setTimeout(function(){
      $("#preloader").hide();
    },delay);
  });
  
  $(function () {
    // Remove Link in Content
    if($(".content-madilog").html()){
      $(".content-madilog a").filter('[href^="http://"],[href^="https://"]').contents().unwrap();
    }
    
	// Sign Up & Login
	$(".btn-global").click(function(){
	  $("#preloader").show();
	  
	  var delay = 500;
      setTimeout(function(){
        $("#preloader").hide();
      },delay);
	});
	
	// Menu Sidebar User
	// User Setting
	$("#userSetting").click(function(){
	  $("#menuSetting").show();
	  $("#userSetting").addClass("active");
	  
	  $("#menuCompany").hide();
	  $("#userCompany").removeClass("active");
	  	  
	  $("#menuProfile").hide();
	  $("#userProfile").removeClass("active");
	  
	  $("#menuProduct").hide();
	  $("#userProduct").removeClass("active");
	  
	  $("#menuVideo").hide();
	  $("#userVideo").removeClass("active");
	  	  
	  $("#menuBookmark").hide();
	  $("#userBookmark").removeClass("active");
	  
	  $("#menuMassanger").hide();
	  $("#userMassager").removeClass("active");
	  
	  $("#menuVisitors").hide();
	  $("#userVisitors").removeClass("active");
	});
	
	// User Company Member
	$("#userCompany").click(function(){
	  $("#menuSetting").hide();
	  $("#userSetting").removeClass("active");
	  
	  $("#menuCompany").show();
	  $("#userCompany").addClass("active");
	  
	  $("#menuProduct").hide();
	  $("#userProduct").removeClass("active");
	  
	  $("#menuVideo").hide();
	  $("#userVideo").removeClass("active");
	  
	  $("#menuMassanger").hide();
	  $("#userMassager").removeClass("active");
	  
	  $("#menuVisitors").hide();
	  $("#userVisitors").removeClass("active");
	});
	
	// User Profile
	$("#userProfile").click(function(){
	  $("#menuSetting").hide();
	  $("#userSetting").removeClass("active");
	  	  
	  $("#menuProfile").show();
	  $("#userProfile").addClass("active");
	  
	  $("#menuVideo").hide();
	  $("#userVideo").removeClass("active");
	  	  
	  $("#menuBookmark").hide();
	  $("#userBookmark").removeClass("active");
	  	  
	  $("#menuMassanger").hide();
	  $("#userMassager").removeClass("active");

	  $("#menuVisitors").hide();
	  $("#userVisitors").removeClass("active");
	});
	
	// User Profile
	$("#userBookmark").click(function(){
	  $("#menuSetting").hide();
	  $("#userSetting").removeClass("active");
	  	  
	  $("#menuProfile").hide();
	  $("#userProfile").removeClass("active");
	  
	  $("#menuVideo").hide();
	  $("#userVideo").removeClass("active");
	  	  
	  $("#menuBookmark").show();
	  $("#userBookmark").addClass("active");
	  	  
	  $("#menuMassanger").hide();
	  $("#userMassager").removeClass("active");
      
	  $("#menuVisitors").hide();
	  $("#userVisitors").removeClass("active");
	});
	
	// User Product Member
	$("#userProduct").click(function(){
	  $("#menuSetting").hide();
	  $("#userSetting").removeClass("active");
	  
	  $("#menuCompany").hide();
	  $("#userCompany").removeClass("active");
	  
	  $("#menuProduct").show();
	  $("#userProduct").addClass("active");
	  
	  $("#menuVideo").hide();
	  $("#userVideo").removeClass("active");
	  
	  $("#menuMassanger").hide();
	  $("#userMassager").removeClass("active");
	  
	  $("#menuVisitors").hide();
	  $("#userVisitors").removeClass("active");
	})
	
	// User Massager
	$("#userMassager").click(function(){
	  $("#menuSetting").hide();
	  $("#userSetting").removeClass("active");
	  
	  $("#menuCompany").hide();
	  $("#userCompany").removeClass("active");
	  	  
	  $("#menuProfile").hide();
	  $("#userProfile").removeClass("active");
	  
	  $("#menuProduct").hide();
	  $("#userProduct").removeClass("active");
	  
	  $("#menuVideo").hide();
	  $("#userVideo").removeClass("active");
	  	  
	  $("#menuBookmark").hide();
	  $("#userBookmark").removeClass("active");
	  
	  $("#menuMassanger").show();
	  $("#userMassager").addClass("active");
	  
	  $("#menuVisitors").hide();
	  $("#userVisitors").removeClass("active");
	})
	
	// User Video
	$("#userVideo").click(function(){
	  $("#menuSetting").hide();
	  $("#userSetting").removeClass("active");
	  
	  $("#menuCompany").hide();
	  $("#userCompany").removeClass("active");
	  	  
	  $("#menuProfile").hide();
	  $("#userProfile").removeClass("active");
	  
	  $("#menuProduct").hide();
	  $("#userProduct").removeClass("active");
	  
	  $("#menuVideo").show();
	  $("#userVideo").addClass("active");
	  	  
	  $("#menuBookmark").hide();
	  $("#userBookmark").removeClass("active");
	  
	  $("#menuMassanger").hide();
	  $("#userMassager").removeClass("active");
	  
	  $("#menuVisitors").hide();
	  $("#userVisitors").removeClass("active");
	})
	
	// User Visitor Analitic
	$("#userVisitors").click(function(){
	  $("#menuSetting").hide();
	  $("#userSetting").removeClass("active");
	  
	  $("#menuCompany").hide();
	  $("#userCompany").removeClass("active");
	  	  
	  $("#menuProfile").hide();
	  $("#userProfile").removeClass("active");
	  
	  $("#menuProduct").hide();
	  $("#userProduct").removeClass("active");
	  
	  $("#menuVideo").hide();
	  $("#userVideo").removeClass("active");
	  
	  $("#menuMassanger").hide();
	  $("#userMassager").removeClass("active");
	  
	  $("#menuVisitors").show();
	  $("#userVisitors").addClass("active");
	})
	
	// Add New Product
	$("#addnewProduct").click(function(){
	  $("#formnewProduct").toggle();
	})
	
	// Indo New Product
	$("#infoaddProduct").click(function(){
	  $("#infoaddProductBox").toggle();
	})
	
	// Save Product
	$("#savenewProduct").click(function(){
	  var thumb = $("input[name='thumb']").val();
	  var name = encodeURIComponent($("input[name='nameproduct']").val());
	  var content = encodeURIComponent($("textarea[name='content']").val());
	  
	  //$("#formnewProduct").hide();
	  //$("#featuredImageProduct").html("");
	 // $("#nameProduct").val("");
	  //$("textarea[name='content']").val("");
	  
	  $.ajax({
		url: "../../mdl-includes/admin/product-add-action.php",
		data: "thumb="+thumb+"&name="+name+"&content="+content,
		type: "POST",
		success: function(data){
		  $("#tableProduct").append(name);
		  //$("#newproductBox").remove();
		},
		error: function (){}
	  })
	});
	
	$("#cancelnewProduct").click(function(){
	  //$("#formnewProduct").hide();
	  //$("#featuredImageProduct").html("");
	  //$("#nameProduct").val("");
	  //$("textarea[name='content']").val("");
	  
	  $.ajax({
		url: "../../mdl-includes/admin/product-add-box.php",
		success: function(data){
		  $("#newproductBox").html(data);
		},
		error: function (){}
	  })
	});
	
	// Remoce Product
	$("#removeediteProduct").click(function(){
	  $("#updateProductBox").remove();
	})
	
	// Add Feature Image
	$("#addfeaturedImage").click(function () {
	  var username = $("input[name='user']").val();
	  
	  $("#featuredImageBOX").show();
	  $("body").css({"overflow":"hidden","width":"100%"});
	  
	  $.ajax({
		url: "../../mdl-includes/media/media-library-profile.php",
		data: "username="+username,
		type: "POST",
		success: function(data){
		  $("#media-library").html(data);
		  $(".set-image").removeClass("btn-primary");
		  $(".set-image").addClass("btn-secondary disabled");
		},
		error: function (){}
	  });
	});
	
	// Add Feature Product
	$("#addfeaturedImageProduct").click(function () {
	  $("#featuredImageBOX").show();
	  $("body").css({"overflow":"hidden","width":"100%"});
	  
	  $.ajax({
		url: "../../mdl-includes/media/media-library-product.php",
		type: "POST",
		success: function(data){
		  $("#media-library").html(data);
		  $(".set-image").removeClass("btn-primary");
		  $(".set-image").addClass("btn-secondary disabled");
		},
		error: function (){}
	  });
	});
	
	// Remove Feature Image Product
	$("#removefeaturedImageProduct").click(function(){
	  $("#removefeaturedImageProduct").hide();
	  $(".add-featured-image").show();
	  $("#featuredImageProduct").html("");
	});
	
	
	// Add New Video
	$("#addnewVideo").click(function(){
	  $("#addnewVideoBox").toggle();
	})
	
	// Indo New Product
	$("#infoaddVideo").click(function(){
	  $("#infoaddVideoBox").toggle();
	})
	
	// Select Type Video
	$("select[name='typevideo']").on("change", function(){
	  var type = $(this).val();
	  
	  if (type == "youtube"){
		$("#youtubeVideoBox").show();
		$("#uploadVideoBox").hide();
	  }
	  if (type == "upload"){
		$("#youtubeVideoBox").hide();
		$("#uploadVideoBox").show();
	  }
	});
	
	// Preloader Upload Video
    $('#uploadFormVideo').click(function() {
      $('.spinner-border').show();
	  $("#preloader").show();
    });
	
	// Delete video
	$("#deleteVideo").click(function(){
	  $("#deletevideoBOX").show();
	  $("body").css({"overflow":"hidden","width":"100%"});
	})
	
	$("#deleteVideo2").click(function(){
	  $("#deletevideoBOX").show();
	  $("body").css({"overflow":"hidden","width":"100%"});
	})
	
	$("#deleteVideoClose").click(function(){
	  $("#deletevideoBOX").hide();
	  $("body").css({"overflow":"auto"});
	});
	
	// Media Upload & Library
	$("#custom-tabs-media-library-tab").click(function(){
	  $.ajax({
		url: "../../mdl-includes/media/media-library.php",
		type: "POST",
		success: function(data){
		  $("#media-library").html(data);
		  $(".set-image").removeClass("btn-primary");
		  $(".set-image").addClass("btn-secondary disabled");
		},
		error: function (){}
	  });
	});
	
	// Media Upload & Library
	$("#custom-tabs-home-tab").click(function(){
	  $.ajax({
		url: "../../mdl-includes/media/media-upload-form.php",
		type: "POST",
		success: function(data){
		  $("#formuploadPhoto").html(data);
		},
		error: function (){}
	  });
	});
	
	// Remove Feature Image
	$("#removefeaturedImage").click(function(){
	  $("#removefeaturedImage").hide();
	  $(".add-featured-image").show();
	  $("#featuredImage").html("");
	});
	
	// Close Feature Image
	$("#featuredImageClose").click(function () {
	  $("#featuredImageBOX").hide();
	  $(".set-image").removeClass("btn-primary");
	  $(".set-image").addClass("btn-secondary disabled");
	  $("body").css({"overflow":"auto"});
	});
	
	$("#btn-about").click(function () {
	  $("#aboutUS").show();
	  $("#btn-about").addClass("active");
	  $("#ourProduct").hide();
	  $("#btn-product").removeClass("active");
	  $("#ourLocation").hide();
	  $("#btn-location").removeClass("active");
	});
	
	$("#btn-product").click(function () {
	  $("#aboutUS").hide();
	  $("#btn-about").removeClass("active");
	  $("#ourProduct").show();
	  $("#btn-product").addClass("active");
	  $("#ourLocation").hide();
	  $("#btn-location").removeClass("active");
	});
	
	$("#btn-location").click(function () {
	  $("#aboutUS").hide();
	  $("#btn-about").removeClass("active");
	  $("#ourProduct").hide();
	  $("#btn-product").removeClass("active");
	  $("#ourLocation").show();
	  $("#btn-location").addClass("active");
	});
	
	$("#chatNow").click(function(){
	  $("#chat-massanger").toggle();
	});
	
	$("#info-time").click(function(){
	  $("#time-detail").show();
	  $("#info-time").hide();
	});
	
	$("#time-detail").click(function(){
	  $("#time-detail").hide();
	  $("#info-time").show();
	});

    //Timepicker Monday
    $('#timepicker-monday-open').datetimepicker({
      format: 'HH:mm'
    });
    $('#timepicker-monday-close').datetimepicker({
      format: 'HH:mm'
    });
	$('#empty-monday').click(function(){
	  $('input[name="mondayopen"]').val("");
	  $('input[name="mondayclose"]').val("");
	});

    //Timepicker Tuesday
    $('#timepicker-tuesday-open').datetimepicker({
      format: 'HH:mm'
    });
    $('#timepicker-tuesday-close').datetimepicker({
      format: 'HH:mm'
    });
	$('#empty-tuesday').click(function(){
	  $('input[name="tuesdayopen"]').val("");
	  $('input[name="tuesdayclose"]').val("");
	});

    //Timepicker Wednesday
    $('#timepicker-wednesday-open').datetimepicker({
      format: 'HH:mm'
    });
    $('#timepicker-wednesday-close').datetimepicker({
      format: 'HH:mm'
    });
	$('#empty-wednesday').click(function(){
	  $('input[name="wednesdayopen"]').val("");
	  $('input[name="wednesdayclose"]').val("");
	});

    //Timepicker thursday
    $('#timepicker-thursday-open').datetimepicker({
      format: 'HH:mm'
    });
    $('#timepicker-thursday-close').datetimepicker({
      format: 'HH:mm'
    });
	$('#empty-thursday').click(function(){
	  $('input[name="thursdayopen"]').val("");
	  $('input[name="thursdayclose"]').val("");
	});

    //Timepicker Friday
    $('#timepicker-friday-open').datetimepicker({
      format: 'HH:mm'
    });
    $('#timepicker-friday-close').datetimepicker({
      format: 'HH:mm'
    });
	$('#empty-friday').click(function(){
	  $('input[name="fridayopen"]').val("");
	  $('input[name="fridayclose"]').val("");
	});

    //Timepicker Saturday
    $('#timepicker-saturday-open').datetimepicker({
      format: 'HH:mm'
    });
    $('#timepicker-saturday-close').datetimepicker({
      format: 'HH:mm'
    });
	$('#empty-saturday').click(function(){
	  $('input[name="saturdayopen"]').val("");
	  $('input[name="saturdayclose"]').val("");
	});

    //Timepicker Sunday
    $('#timepicker-sunday-open').datetimepicker({
      format: 'HH:mm'
    });
    $('#timepicker-sunday-close').datetimepicker({
      format: 'HH:mm'
    });
	$('#empty-sunday').click(function(){
	  $('input[name="sundayopen"]').val("");
	  $('input[name="sundayclose"]').val("");
	});
	
	// Save User Profile Login
	$("#saveUserSetting").click(function(){
	  var firstname = encodeURIComponent($("input[name='firstname']").val());
	  var lastname = encodeURIComponent($("input[name='lastname']").val());
	  var user = $("input[name='user']").val();
	  
	  $("#spinnermenuSetting").css({"display" : "inline-block"});
	  
	  $.ajax({
		url : "../../mdl-includes/users/user-setting.php",
		data : "firstname="+ firstname +"&lastname="+ lastname +"&user="+ user,
		type : "POST",
		success : function(data) {
		  const loadPage = setTimeout(showAdd, 2000);
		  function showAdd(){
			$("#spinnermenuSetting").hide();
			$("#savedmenuSetting").css({"display" : "inline-block"});
			$("#menusettingBody").html(data);
			toastr.success('Data Saved');
		  }
		  const loadSaved = setTimeout(hideSaved, 6000);
		  function hideSaved(){
			$("#savedmenuSetting").hide();
		  }
		},
		error : function (){}
	  })
	})
	
	// Change Username
	$("#changeUsername").click(function(){
	  $("#changeUsernameBOX").show();
	  $("body").css({"overflow":"hidden","width":"100%"});
	})
	
	$("#changeUsernameClose").click(function(){
	  $("#changeUsernameBOX").hide();
	  $("body").css({"overflow":"auto"});
	});
	
	// Change User Email
	$("#changeEmail").click(function(){
	  $("#changeEmailBOX").show();
	  $("body").css({"overflow":"hidden","width":"100%"});
	})
	
	$("#changeEmailClose").click(function(){
	  $("#changeEmailBOX").hide();
	  $("body").css({"overflow":"auto"});
	});
	
	// Change User Whatsapp
	$("#changeWA").click(function(){
	  $("#changeWABOX").show();
	  $("body").css({"overflow":"hidden","width":"100%"});
	})
	
	$("#changeWAClose").click(function(){
	  $("#changeWABOX").hide();
	  $("body").css({"overflow":"auto"});
	});
	
	// Change User Password
	$("#changePassword").click(function(){
	  $("#changePasswordBOX").show();
	  $("body").css({"overflow":"hidden","width":"100%"});
	})
	
	$("#changePasswordClose").click(function(){
	  $("#changePasswordBOX").hide();
	  $("body").css({"overflow":"auto"});
	  $("input[name='newpassword']").val("");
	  $("input[name='renewpassword']").val("");
	});
	
	// Change Packages
	$("#changePackage").click(function(){
	  $("#changePackageBOX").show();
	  $("body").css({"overflow":"hidden","width":"100%"});
	})
	
	$("#changePackageClose").click(function(){
	  $("#changePackageBOX").hide();
	  $("body").css({"overflow":"auto"});
	});
	
	// Save Company Profile
	$("#saveCompanyProfile").click(function(){
	  var thumb = encodeURIComponent($("input[name='thumb']").val());
	  var companyname = encodeURIComponent($("input[name='companyname']").val());
	  var useraddress = encodeURIComponent($("input[name='useraddress']").val());
	  var userwebsite = encodeURIComponent($("input[name='userwebsite']").val());
	  var userphone = encodeURIComponent($("input[name='userphone']").val());
	  var userwhatsapp = encodeURIComponent($("input[name='userwhatsapp']").val());
	  
	  var content = encodeURIComponent($("textarea[name='content']").val());
	  
	  var userlocation = encodeURIComponent($("input[name='userlocation']").val());
	  var usermap = encodeURIComponent($("textarea[name='usermap']").val());
	  
	  var mondayopen = encodeURIComponent($("input[name='mondayopen']").val());
	  var mondayclose = encodeURIComponent($("input[name='mondayclose']").val());
	  
	  var tuesdayopen = encodeURIComponent($("input[name='tuesdayopen']").val());
	  var tuesdayclose = encodeURIComponent($("input[name='tuesdayclose']").val());
	  
	  var wednesdayopen = encodeURIComponent($("input[name='wednesdayopen']").val());
	  var wednesdayclose = encodeURIComponent($("input[name='wednesdayclose']").val());
	  
	  var thursdayopen = encodeURIComponent($("input[name='thursdayopen']").val());
	  var thursdayclose = encodeURIComponent($("input[name='thursdayclose']").val());
	  
	  var fridayopen = encodeURIComponent($("input[name='fridayopen']").val());
	  var fridayclose = encodeURIComponent($("input[name='fridayclose']").val());
	  
	  var saturdayopen = encodeURIComponent($("input[name='saturdayopen']").val());
	  var saturdayclose = encodeURIComponent($("input[name='saturdayclose']").val());
	  
	  var sundayopen = encodeURIComponent($("input[name='sundayopen']").val());
	  var sundayclose = encodeURIComponent($("input[name='sundayclose']").val());
	  
	  var userinstagram = encodeURIComponent($("input[name='userinstagram']").val());
	  var userfacebook = encodeURIComponent($("input[name='userfacebook']").val());
	  var useryoutube = encodeURIComponent($("input[name='useryoutube']").val());
	  var userlinkedin = encodeURIComponent($("input[name='userlinkedin']").val());
	  var usertwitter = encodeURIComponent($("input[name='usertwitter']").val());
	  var usertiktok = encodeURIComponent($("input[name='usertiktok']").val());
	  
	  var username = $("input[name='user']").val();
	  
	  queryStrings = "thumb="+thumb+"&companyname="+companyname+"&useraddress="+useraddress+"&userwebsite="+userwebsite+"&userphone="+userphone+"&userwhatsapp="+userwhatsapp+"&content="+content+"&userlocation="+userlocation+"&usermap="+usermap+"&mondayopen="+mondayopen+"&mondayclose="+mondayclose+"&tuesdayopen="+tuesdayopen+"&tuesdayclose="+tuesdayclose+"&wednesdayopen="+wednesdayopen+"&wednesdayclose="+wednesdayclose+"&thursdayopen="+thursdayopen+"&thursdayclose="+thursdayclose+"&fridayopen="+fridayopen+"&fridayclose="+fridayclose+"&saturdayopen="+saturdayopen+"&saturdayclose="+saturdayclose+"&sundayopen="+sundayopen+"&sundayclose="+sundayclose+"&userinstagram="+userinstagram+"&userfacebook="+userfacebook+"&useryoutube="+useryoutube+"&userlinkedin="+userlinkedin+"&usertwitter="+usertwitter+"&usertiktok="+usertiktok+"&username="+username;
	  
	  $("#spinnerCompanyProfile").css({"display" : "inline-block"});
	  
	  $.ajax({
		url : "../../mdl-includes/users/company-profile.php",
		data : queryStrings,
		type : "POST",
		success : function(data) {
		  const loadPage = setTimeout(showAdd, 2000);
		  function showAdd(){
			$("#spinnerCompanyProfile").hide();
			$("#savedCompanyProfile").css({"display" : "inline-block"});
			$("#companyProfileBody").html(data); 
			toastr.success('Data Saved');
		  }
		  const loadSaved = setTimeout(hideSaved, 6000);
		  function hideSaved(){
			$("#savedCompanyProfile").hide();
		  }
		},
		error : function (){}
	  })
	});
	
	// Save Company Profile
	$("#saveCompanyProfileGold").click(function(){
	  var thumb = encodeURIComponent($("input[name='thumb']").val());
	  var companyname = encodeURIComponent($("input[name='companyname']").val());
	  var useraddress = encodeURIComponent($("input[name='useraddress']").val());
	  var userwebsite = encodeURIComponent($("input[name='userwebsite']").val());
	  var userphone = encodeURIComponent($("input[name='userphone']").val());
	  var userwhatsapp = encodeURIComponent($("input[name='userwhatsapp']").val());
	  
	  var content = encodeURIComponent($("textarea[name='content']").val());
	  
	  var userlocation = encodeURIComponent($("input[name='userlocation']").val());
	  var usermap = encodeURIComponent($("textarea[name='usermap']").val());
	  
	  var mondayopen = encodeURIComponent($("input[name='mondayopen']").val());
	  var mondayclose = encodeURIComponent($("input[name='mondayclose']").val());
	  
	  var tuesdayopen = encodeURIComponent($("input[name='tuesdayopen']").val());
	  var tuesdayclose = encodeURIComponent($("input[name='tuesdayclose']").val());
	  
	  var wednesdayopen = encodeURIComponent($("input[name='wednesdayopen']").val());
	  var wednesdayclose = encodeURIComponent($("input[name='wednesdayclose']").val());
	  
	  var thursdayopen = encodeURIComponent($("input[name='thursdayopen']").val());
	  var thursdayclose = encodeURIComponent($("input[name='thursdayclose']").val());
	  
	  var fridayopen = encodeURIComponent($("input[name='fridayopen']").val());
	  var fridayclose = encodeURIComponent($("input[name='fridayclose']").val());
	  
	  var saturdayopen = encodeURIComponent($("input[name='saturdayopen']").val());
	  var saturdayclose = encodeURIComponent($("input[name='saturdayclose']").val());
	  
	  var sundayopen = encodeURIComponent($("input[name='sundayopen']").val());
	  var sundayclose = encodeURIComponent($("input[name='sundayclose']").val());
	  
	  var userinstagram = encodeURIComponent($("input[name='userinstagram']").val());
	  var userfacebook = encodeURIComponent($("input[name='userfacebook']").val());
	  var useryoutube = encodeURIComponent($("input[name='useryoutube']").val());
	  var userlinkedin = encodeURIComponent($("input[name='userlinkedin']").val());
	  var usertwitter = encodeURIComponent($("input[name='usertwitter']").val());
	  var usertiktok = encodeURIComponent($("input[name='usertiktok']").val());
	  
	  var username = $("input[name='user']").val();
	  
	  queryStrings = "thumb="+thumb+"&companyname="+companyname+"&useraddress="+useraddress+"&userwebsite="+userwebsite+"&userphone="+userphone+"&userwhatsapp="+userwhatsapp+"&content="+content+"&userlocation="+userlocation+"&usermap="+usermap+"&mondayopen="+mondayopen+"&mondayclose="+mondayclose+"&tuesdayopen="+tuesdayopen+"&tuesdayclose="+tuesdayclose+"&wednesdayopen="+wednesdayopen+"&wednesdayclose="+wednesdayclose+"&thursdayopen="+thursdayopen+"&thursdayclose="+thursdayclose+"&fridayopen="+fridayopen+"&fridayclose="+fridayclose+"&saturdayopen="+saturdayopen+"&saturdayclose="+saturdayclose+"&sundayopen="+sundayopen+"&sundayclose="+sundayclose+"&userinstagram="+userinstagram+"&userfacebook="+userfacebook+"&useryoutube="+useryoutube+"&userlinkedin="+userlinkedin+"&usertwitter="+usertwitter+"&usertiktok="+usertiktok+"&username="+username;
	  
	  $("#spinnerCompanyProfile").css({"display" : "inline-block"});
	  
	  $.ajax({
		url : "../../mdl-includes/users/company-profile-gold.php",
		data : queryStrings,
		type : "POST",
		success : function(data) {
		  const loadPage = setTimeout(showAdd, 2000);
		  function showAdd(){
			$("#spinnerCompanyProfile").hide();
			$("#savedCompanyProfile").css({"display" : "inline-block"});
			$("#companyProfileBody").html(data); 
			toastr.success('Data Saved');
		  }
		  const loadSaved = setTimeout(hideSaved, 6000);
		  function hideSaved(){
			$("#savedCompanyProfile").hide();
		  }
		},
		error : function (){}
	  })
	});
	
	
	
	// Save Company Profile
	$("#saveCompanyProfileSilver").click(function(){
	  var thumb = encodeURIComponent($("input[name='thumb']").val());
	  var companyname = encodeURIComponent($("input[name='companyname']").val());
	  var useraddress = encodeURIComponent($("input[name='useraddress']").val());
	  var userwebsite = encodeURIComponent($("input[name='userwebsite']").val());
	  var userphone = encodeURIComponent($("input[name='userphone']").val());
	  var userwhatsapp = encodeURIComponent($("input[name='userwhatsapp']").val());
	  
	  var content = encodeURIComponent($("textarea[name='content']").val());
	  
	  var userlocation = encodeURIComponent($("input[name='userlocation']").val());
	  var usermap = encodeURIComponent($("textarea[name='usermap']").val());
	  
	  var mondayopen = encodeURIComponent($("input[name='mondayopen']").val());
	  var mondayclose = encodeURIComponent($("input[name='mondayclose']").val());
	  
	  var tuesdayopen = encodeURIComponent($("input[name='tuesdayopen']").val());
	  var tuesdayclose = encodeURIComponent($("input[name='tuesdayclose']").val());
	  
	  var wednesdayopen = encodeURIComponent($("input[name='wednesdayopen']").val());
	  var wednesdayclose = encodeURIComponent($("input[name='wednesdayclose']").val());
	  
	  var thursdayopen = encodeURIComponent($("input[name='thursdayopen']").val());
	  var thursdayclose = encodeURIComponent($("input[name='thursdayclose']").val());
	  
	  var fridayopen = encodeURIComponent($("input[name='fridayopen']").val());
	  var fridayclose = encodeURIComponent($("input[name='fridayclose']").val());
	  
	  var saturdayopen = encodeURIComponent($("input[name='saturdayopen']").val());
	  var saturdayclose = encodeURIComponent($("input[name='saturdayclose']").val());
	  
	  var sundayopen = encodeURIComponent($("input[name='sundayopen']").val());
	  var sundayclose = encodeURIComponent($("input[name='sundayclose']").val());
	  
	  var userinstagram = encodeURIComponent($("input[name='userinstagram']").val());
	  var userfacebook = encodeURIComponent($("input[name='userfacebook']").val());
	  var useryoutube = encodeURIComponent($("input[name='useryoutube']").val());
	  var userlinkedin = encodeURIComponent($("input[name='userlinkedin']").val());
	  var usertwitter = encodeURIComponent($("input[name='usertwitter']").val());
	  var usertiktok = encodeURIComponent($("input[name='usertiktok']").val());
	  
	  var username = $("input[name='user']").val();
	  
	  queryStrings = "thumb="+thumb+"&companyname="+companyname+"&useraddress="+useraddress+"&userwebsite="+userwebsite+"&userphone="+userphone+"&userwhatsapp="+userwhatsapp+"&content="+content+"&userlocation="+userlocation+"&usermap="+usermap+"&mondayopen="+mondayopen+"&mondayclose="+mondayclose+"&tuesdayopen="+tuesdayopen+"&tuesdayclose="+tuesdayclose+"&wednesdayopen="+wednesdayopen+"&wednesdayclose="+wednesdayclose+"&thursdayopen="+thursdayopen+"&thursdayclose="+thursdayclose+"&fridayopen="+fridayopen+"&fridayclose="+fridayclose+"&saturdayopen="+saturdayopen+"&saturdayclose="+saturdayclose+"&sundayopen="+sundayopen+"&sundayclose="+sundayclose+"&userinstagram="+userinstagram+"&userfacebook="+userfacebook+"&useryoutube="+useryoutube+"&userlinkedin="+userlinkedin+"&usertwitter="+usertwitter+"&usertiktok="+usertiktok+"&username="+username;
	  
	  $("#spinnerCompanyProfile").css({"display" : "inline-block"});
	  
	  $.ajax({
		url : "../../mdl-includes/users/company-profile-silver.php",
		data : queryStrings,
		type : "POST",
		success : function(data) {
		  const loadPage = setTimeout(showAdd, 2000);
		  function showAdd(){
			$("#spinnerCompanyProfile").hide();
			$("#savedCompanyProfile").css({"display" : "inline-block"});
			$("#companyProfileBody").html(data); 
			toastr.success('Data Saved');
		  }
		  const loadSaved = setTimeout(hideSaved, 6000);
		  function hideSaved(){
			$("#savedCompanyProfile").hide();
		  }
		},
		error : function (){}
	  })
	});
	
	
	// Save Company Profile
	$("#saveCompanyProfileBronze").click(function(){
	  var thumb = encodeURIComponent($("input[name='thumb']").val());
	  var companyname = encodeURIComponent($("input[name='companyname']").val());
	  var useraddress = encodeURIComponent($("input[name='useraddress']").val());
	  var userwebsite = encodeURIComponent($("input[name='userwebsite']").val());
	  var userphone = encodeURIComponent($("input[name='userphone']").val());
	  var userwhatsapp = encodeURIComponent($("input[name='userwhatsapp']").val());
	  
	  var content = encodeURIComponent($("textarea[name='content']").val());
	  
	  var userlocation = encodeURIComponent($("input[name='userlocation']").val());
	  var usermap = encodeURIComponent($("textarea[name='usermap']").val());
	  
	  var mondayopen = encodeURIComponent($("input[name='mondayopen']").val());
	  var mondayclose = encodeURIComponent($("input[name='mondayclose']").val());
	  
	  var tuesdayopen = encodeURIComponent($("input[name='tuesdayopen']").val());
	  var tuesdayclose = encodeURIComponent($("input[name='tuesdayclose']").val());
	  
	  var wednesdayopen = encodeURIComponent($("input[name='wednesdayopen']").val());
	  var wednesdayclose = encodeURIComponent($("input[name='wednesdayclose']").val());
	  
	  var thursdayopen = encodeURIComponent($("input[name='thursdayopen']").val());
	  var thursdayclose = encodeURIComponent($("input[name='thursdayclose']").val());
	  
	  var fridayopen = encodeURIComponent($("input[name='fridayopen']").val());
	  var fridayclose = encodeURIComponent($("input[name='fridayclose']").val());
	  
	  var saturdayopen = encodeURIComponent($("input[name='saturdayopen']").val());
	  var saturdayclose = encodeURIComponent($("input[name='saturdayclose']").val());
	  
	  var sundayopen = encodeURIComponent($("input[name='sundayopen']").val());
	  var sundayclose = encodeURIComponent($("input[name='sundayclose']").val());
	  
	  var userinstagram = encodeURIComponent($("input[name='userinstagram']").val());
	  var userfacebook = encodeURIComponent($("input[name='userfacebook']").val());
	  var useryoutube = encodeURIComponent($("input[name='useryoutube']").val());
	  var userlinkedin = encodeURIComponent($("input[name='userlinkedin']").val());
	  var usertwitter = encodeURIComponent($("input[name='usertwitter']").val());
	  var usertiktok = encodeURIComponent($("input[name='usertiktok']").val());
	  
	  var username = $("input[name='user']").val();
	  
	  queryStrings = "thumb="+thumb+"&companyname="+companyname+"&useraddress="+useraddress+"&userwebsite="+userwebsite+"&userphone="+userphone+"&userwhatsapp="+userwhatsapp+"&content="+content+"&userlocation="+userlocation+"&usermap="+usermap+"&mondayopen="+mondayopen+"&mondayclose="+mondayclose+"&tuesdayopen="+tuesdayopen+"&tuesdayclose="+tuesdayclose+"&wednesdayopen="+wednesdayopen+"&wednesdayclose="+wednesdayclose+"&thursdayopen="+thursdayopen+"&thursdayclose="+thursdayclose+"&fridayopen="+fridayopen+"&fridayclose="+fridayclose+"&saturdayopen="+saturdayopen+"&saturdayclose="+saturdayclose+"&sundayopen="+sundayopen+"&sundayclose="+sundayclose+"&userinstagram="+userinstagram+"&userfacebook="+userfacebook+"&useryoutube="+useryoutube+"&userlinkedin="+userlinkedin+"&usertwitter="+usertwitter+"&usertiktok="+usertiktok+"&username="+username;
	  
	  $("#spinnerCompanyProfile").css({"display" : "inline-block"});
	  
	  $.ajax({
		url : "../../mdl-includes/users/company-profile-bronze.php",
		data : queryStrings,
		type : "POST",
		success : function(data) {
		  const loadPage = setTimeout(showAdd, 2000);
		  function showAdd(){
			$("#spinnerCompanyProfile").hide();
			$("#savedCompanyProfile").css({"display" : "inline-block"});
			$("#companyProfileBody").html(data); 
			toastr.success('Data Saved');
		  }
		  const loadSaved = setTimeout(hideSaved, 6000);
		  function hideSaved(){
			$("#savedCompanyProfile").hide();
		  }
		},
		error : function (){}
	  })
	});
	
	
	// Save Company Profile
	$("#saveMyProfile").click(function(){
	  var companyname = encodeURIComponent($("input[name='companyname']").val());
	  var useraddress = encodeURIComponent($("input[name='useraddress']").val());
	  var userwebsite = encodeURIComponent($("input[name='userwebsite']").val());
	  
	  var content = encodeURIComponent($("textarea[name='content']").val());
	  
	  var userinstagram = encodeURIComponent($("input[name='userinstagram']").val());
	  var userfacebook = encodeURIComponent($("input[name='userfacebook']").val());
	  var useryoutube = encodeURIComponent($("input[name='useryoutube']").val());
	  var userlinkedin = encodeURIComponent($("input[name='userlinkedin']").val());
	  var usertwitter = encodeURIComponent($("input[name='usertwitter']").val());
	  var usertiktok = encodeURIComponent($("input[name='usertiktok']").val());
	  
	  var username = $("input[name='user']").val();
	  
	  queryStrings = "companyname="+companyname+"&useraddress="+useraddress+"&userwebsite="+userwebsite+"&content="+content+"&userinstagram="+userinstagram+"&userfacebook="+userfacebook+"&useryoutube="+useryoutube+"&userlinkedin="+userlinkedin+"&usertwitter="+usertwitter+"&usertiktok="+usertiktok+"&username="+username;
	  
	  $("#spinnerMyProfile").css({"display" : "inline-block"});
	  
	  $.ajax({
		url : "../../mdl-includes/users/my-profile.php",
		data : queryStrings,
		type : "POST",
		success : function(data) {
		  const loadPage = setTimeout(showAdd, 2000);
		  function showAdd(){
			$("#spinnerMyProfile").hide();
			$("#savedMyProfile").css({"display" : "inline-block"});
			$("#myProfileBody").html(data); 
			toastr.success('Data Saved');
		  }
		  const loadSaved = setTimeout(hideSaved, 6000);
		  function hideSaved(){
			$("#savedMyProfile").hide();
		  }
		},
		error : function (){}
	  })
	});
	
	// Change User Password
	$("#changePassword").click(function(){
	  $("#changePasswordBOX").show();
	  $("body").css({"overflow":"hidden","width":"100%"});
	})
	
	$("#changePasswordClose").click(function(){
	  $("#changePasswordBOX").hide();
	  $("body").css({"overflow":"auto"});
	});
	
  });
</script>

<script>
  // Register Exhibitors 
  $(function () {
	// Calculation Membership Fees
	$("select[name='paketmember']").on("change", function(){
	  var hybrid = $(this).val();
	  var venue = $("select[name='paketvenue']").val();
	  var disc = $("input[name='discount']").val();
	    
	  if(hybrid == "platinum"){
	    $("#paketPlatinumBox").show();
	    $("#paketGoldBox").hide();
	    $("#paketSilverBox").hide();
	    $("#paketBronzeBox").hide();
	    
	    $("#paketVenue").html("<option value='no'><b>No, Next Time Join</b></option><option value='yes'><b>Yes, Join venue Exhibition</b></option>");
	    
	    var fees = 3000000;
		var xx = new Intl.NumberFormat('en-US', {
		  style: 'currency',
		  currency: 'IDR',
		  minimumFractionDigits: 2,
		  maximumFractionDigits: 2
		});
		
		if(venue == "yes"){
		  total = fees;
		}
		if(venue == "no"){
		  total = fees - ((disc/100) * fees);
		}
		
		// member select
	    $("#memberSelect").html("Hybrid Exhibition : <b>"+xx.format(fees)+"</b>");
		
		// total
	    $("#payTotal").html("<span>"+xx.format(total)+"</span>");
	  }
	    
	  if(hybrid == "gold"){
	    $("#paketPlatinumBox").hide();
	    $("#paketGoldBox").show();
	    $("#paketSilverBox").hide();
	    $("#paketBronzeBox").hide();
	    
	    $("#paketVenue").html("<option value='no'><b>No, Next Time Join</b></option><option value='yes'><b>Yes, Join venue Exhibition</b></option>");
	    
	    var fees = 2000000;
		var xx = new Intl.NumberFormat('en-US', {
		  style: 'currency',
		  currency: 'IDR',
		  minimumFractionDigits: 2,
		  maximumFractionDigits: 2
		});
		
		if(venue == "yes"){
		  total = fees;
		}
		if(venue == "no"){
		  total = fees - ((disc/100) * fees);
		}
		
		// member select
	    $("#memberSelect").html("Hybrid Exhibition : <b>"+xx.format(fees)+"</b>");
		
		// total
	    $("#payTotal").html("<span>"+xx.format(total)+"</span>");
	  }
	    
	  if(hybrid == "silver"){
	    $("#paketPlatinumBox").hide();
	    $("#paketGoldBox").hide();
	    $("#paketSilverBox").show();
	    $("#paketBronzeBox").hide();
	    
	    $("#paketVenue").html("<option value='no'><b>No, Next Time Join</b></option><option value='yes'><b>Yes, Join venue Exhibition</b></option>");
	    
	    var fees = 1000000;
		var xx = new Intl.NumberFormat('en-US', {
		  style: 'currency',
		  currency: 'IDR',
		  minimumFractionDigits: 2,
		  maximumFractionDigits: 2
		});
		
		if(venue == "yes"){
		  total = fees;
		}
		if(venue == "no"){
		  total = fees - ((disc/100) * fees);
		}
		
		// member select
	    $("#memberSelect").html("Hybrid Exhibition : <b>"+xx.format(fees)+"</b>");
		
		// total
	    $("#payTotal").html("<span>"+xx.format(total)+"</span>");
	  }
	    
	  if(hybrid == "bronze"){
	    $("#paketPlatinumBox").hide();
	    $("#paketGoldBox").hide();
	    $("#paketSilverBox").hide();
	    $("#paketBronzeBox").show();
	    
	    $("#paketVenue").html("<option value='no'><b>No, Next Time Join</b></option>");
	    
	    var fees = 500000;
		var xx = new Intl.NumberFormat('en-US', {
		  style: 'currency',
		  currency: 'IDR',
		  minimumFractionDigits: 2,
		  maximumFractionDigits: 2
		});
		
		if(venue == "yes"){
		  total = fees;
		}
		if(venue == "no"){
		  total = fees - ((disc/100) * fees);
		}
		
		// member select
	    $("#memberSelect").html("Hybrid Exhibition : <b>"+xx.format(fees)+"</b>");
		
		// total
	    $("#payTotal").html("<span>"+xx.format(total)+"</span>");
	  }
	});
	
	// Calculation Membership Fees
	$("select[name='paketvenue']").on("change", function(){
	  var venue = $(this).val();
	  var hybrid = $("select[name='paketmember']").val();
	  var disc = $("input[name='discount']").val();
	  
	  if(venue == "yes"){
	    $("#joinSelect").html("Yes Join");
	    $("#discountSelect").html("<del>"+disc+"%</del>&nbsp;0%");
	    
		var xx = new Intl.NumberFormat('en-US', {
		  style: 'currency',
		  currency: 'IDR',
		  minimumFractionDigits: 2,
		  maximumFractionDigits: 2
		});
		
		if(hybrid == "platinum"){
		  var fees = 3000000;
		}
		if(hybrid == "gold"){
		  var fees = 2000000;
		}
		if(hybrid == "silver"){
		  var fees = 1000000;
		}
		if(hybrid == "bronze"){
		  var fees = 500000;
		}
		
		total = fees;
		
		// member select
	    $("#memberSelect").html("Hybrid Exhibition : <b>"+xx.format(fees)+"</b>");
		
		// total
	    $("#payTotal").html("<span>"+xx.format(total)+"</span>");
	  }
	  
	  if(venue == "no"){
	    $("#joinSelect").html("No Join");
	    $("#discountSelect").html(disc+"%");
	    
		var xx = new Intl.NumberFormat('en-US', {
		  style: 'currency',
		  currency: 'IDR',
		  minimumFractionDigits: 2,
		  maximumFractionDigits: 2
		});
		
		if(hybrid == "platinum"){
		  var fees = 3000000;
		}
		if(hybrid == "gold"){
		  var fees = 2000000;
		}
		if(hybrid == "silver"){
		  var fees = 1000000;
		}
		if(hybrid == "bronze"){
		  var fees = 500000;
		}
		
		total = fees - ((disc/100) * fees);
		
		// member select
	    $("#memberSelect").html("Hybrid Exhibition : <b>"+xx.format(fees)+"</b>");
		
		// total
	    $("#payTotal").html("<span>"+xx.format(total)+"</span>");
	  }
	});
  })
</script>

<!-- Page specific script -->
<script>
  $(function () {
    // Summernote Specs
    $('#summernote').summernote({
		height: 200,
		toolbar: [
        //[groupname, [button list]]
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        //['view', ['codeview']],
    ]
	});
	
    // Summernote Specs
    $('#summernoteProduct').summernote({
		height: 200,
		toolbar: [
        //[groupname, [button list]]
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        //['view', ['codeview']],
    ]
	});
	
    // Summernote
    //$('#summernote').summernote({height: 200});
	
    // Summernote 2
    $('#summernote2').summernote({height: 200});
	
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    });//.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
	
    $('#globalTable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "responsive": true,
	  //"pageLength": 25,
    });
    
    $('.global-table').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
	  "pageLength": 25,
    });
	
    $('.toastrDefaultSuccess').click(function() {
      toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
  });
</script>
  
</body>

</html>