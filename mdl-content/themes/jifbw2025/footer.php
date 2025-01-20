<?php
/*
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
*/
?>
<footer id="footer" class="footer pb-0">
    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-12 col-lg-3 footer-info">
            <a href="/" class="d-flex align-items-center mb-3">
              <img src="<?php echo FOLDER_THEMES;?>/assets/img/jifbw-logo.png" alt="JEPARA INTERNATIONAL FURNITURE BUYER WEEKS" title="JEPARA INTERNATIONAL FURNITURE BUYER WEEKS">
            </a>
            <p><b>Office</b> : Jl. Kopral Sapari No.6, Pengkol, Kec. Jepara, Kab. Jepara, Central Java 59415</p>
			<p><b>Email</b> : info@jifbw.com</p>
			<p><b>Contact Person</b> : 0291592386</p>
			<p><b>Whatsapp</b> : +6281392346101</p>
          </div>
          <div class="col-6 col-lg-3 footer-links">
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
          <div class="col-6 col-lg-3 footer-links">
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
          <div class="col-12 col-lg-3 col-md-12 footer-contact text-center text-md-start">
            <h4>Follow Us</h4>
            <div class="social-links mt-3">
              <a href="https://instagram.com/jifbw/" class="instagram" title="Instagram @JIFBW" target="_blank" rel="noopener noreferrer nofollow"><i class="bi bi-instagram"></i></a>
              <a href="https://www.facebook.com/jifbw/" class="facebook" title="Facebook @JIFBW" target="_blank" rel="noopener noreferrernofollow"><i class="bi bi-facebook"></i></a>
              <a href="https://www.youtube.com/@jifbw/" class="youtube" title="Youtube @JIFBW" target="_blank" rel="noopener noreferrernofollow"><i class="bi bi-youtube"></i></a>
              <a href="https://www.pinterest.com/jif_bw/" class="pinterest" title="Pinterest @JIFBW" target="_blank" rel="noopener noreferrernofollow"><i class="bi bi-pinterest"></i></a>
            </div>
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
  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'en,ar,es,jv,ko,pt,ru,zh-CN,id,fr', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: true}, 'google_translate_element');
}
function googleTranslateElementInitHP() {
  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'en,ar,es,jv,ko,pt,ru,zh-CN,id,fr', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: true}, 'google_translate_element_gadget');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInitHP"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo FOLDER_THEMES;?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo FOLDER_THEMES;?>/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?php echo FOLDER_THEMES;?>/assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="<?php echo FOLDER_THEMES;?>/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?php echo FOLDER_THEMES;?>/assets/vendor/swiper/swiper-bundle.min.js"></script>
<!-- Template Main JS File -->
<script src="<?php echo FOLDER_THEMES;?>/assets/js/main-new.js"></script>
<!-- Google tag (gtag.js)-->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-PPFJ75CKZZ"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-PPFJ75CKZZ'); </script>
</body>

</html>