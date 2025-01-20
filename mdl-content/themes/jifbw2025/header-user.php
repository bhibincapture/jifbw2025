<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title><?php include "mdl-includes/meta/mdl-title.php";?></title>
<meta name="description" content="<?php include "mdl-includes/meta/mdl-description.php";?>" rel="stylesheet">
<meta name="keywords" content="<?php include "mdl-includes/meta/mdl-keywords.php";?>" rel="stylesheet">
<meta name="robots" content="<?php include "mdl-includes/meta/mdl-robots.php";?>">
<meta name="p:domain_verify" content="1fc071e5d1714da20b2ff0eec7a73510"/>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" rel="stylesheet">
<link href="<?php echo FOLDER_THEMES;?>/assets/img/icon.png" rel="icon">
<link href="<?php echo FOLDER_THEMES;?>/assets/img/icon.png" rel="apple-touch-icon">

<link href="<?php echo FOLDER_THEMES;?>/assets/vendor/aos/aos.css" rel="stylesheet">
<link href="<?php echo FOLDER_THEMES;?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo FOLDER_THEMES;?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="<?php echo FOLDER_THEMES;?>/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

<link href="<?php echo FOLDER_THEMES;?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="<?php echo FOLDER_THEMES;?>/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
<link href="<?php echo FOLDER_THEMES;?>/assets/css/style-3.css" rel="stylesheet">
<link href="<?php echo FOLDER_THEMES;?>/assets/css/main-tambahan-3.css" rel="stylesheet">

<link href="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/fontawesome-free/css/all.min.css">
<link href="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css" rel="stylesheet">
<link href="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/toastr/toastr.min.css" rel="stylesheet">
<link href="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/fontawesome-free/css/all.min.css" rel="stylesheet">
<link href="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/summernote/summernote-bs4.min.css" rel="stylesheet">
<link href="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/datatables-responsive/css/responsive.bootstrap4.min.css" rel="stylesheet">
<link href="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/datatables-buttons/css/buttons.bootstrap4.min.css" rel="stylesheet">
<link href="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/dropzone2/dropzone.css" rel="stylesheet">
<link href="<?php echo FOLDER_THEMES;?>/assets/css/jifbw-style.css" rel="stylesheet">
<link href="<?php echo FOLDER_THEMES;?>/assets/css/jifbw-style-3.css" rel="stylesheet">
<link href="<?php echo FOLDER_THEMES;?>/assets/css/flag-icons-master/flag-icons.min.css" rel="stylesheet">
<!-- Map: Leaflet JS -->
<link href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""  rel="stylesheet" />
<!-- Map: Leaflet Roting Machine -->
<link href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" rel="stylesheet" />
<link href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" rel="stylesheet" />
<style>.skiptranslate{position: absolute;}.skiptranslate iframe {display: none;}img.goog-te-gadget-icon{display: none;}.hero {margin-top: -40px !important;} main#main{   margin-top: -40px;}</style>
</head>
<body>
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="<?php echo DB_LOCAL.DB_LINK."/";?>" class="logo d-flex align-items-center">
        <img src="<?php echo FOLDER_THEMES;?>/assets/img/JIFBW-2025-Logo.png" alt="JIF-BW">
      </a>
      <nav id="navbar" class="navbar">
        <div class="btn-gadget">
		<?php
		if(isset($_SESSION["login"]) && isset($_SESSION["email"])){
		  $email = $_SESSION["email"];
		  $usersessionDB = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_email`='".$email."'") -> fetch_assoc();
		  if($_SESSION["login"] = "loginactive" && $_SESSION["user_email"] = $usersessionDB["user_email"]){
				echo "
				<div class='dropdown'>
				  <a href='#' class='getstarted2' style='color: #fff;'>Hi, ".$usersessionDB["user_first_name"]." <i class='bi bi-chevron-down'></i></a>
				  <ul>
					<li><a href='".DB_LOCAL.DB_LINK."/user/".$usersessionDB["user_name"]."/' title='My Profile'>My Profile <i class='fas fa-cog'></i></a></li>
					<li><a href='".DB_LOCAL.DB_LINK."/logout/' title='Log Out'>Log Out <i class='fas fa-user-times'></i></a></li>
				  </ul>
				</div>";
			  }
				
		} 
		else {
			  echo "<div class='dropdown'>
			    <a href='#' class='getstarted2' style='color: #fff;'>Reg / Log <i class='bi bi-chevron-down'></i></a>
				<ul>
				  <li><a href='".DB_LOCAL.DB_LINK."/register/' title='Register'>Register <i class='fas fa-user-plus'></i></a></li>
				  <li><a href='".DB_LOCAL.DB_LINK."/login/' title='LogIn'>LogIn <i class='fas fa-user-lock'></i></a></li>
				</ul>
			  </div>";
		}
		?>
        </div>
        <ul>
          <li><a class="nav-link scrollto active" href="<?php echo DB_LOCAL.DB_LINK."/";?>">Home</a></li>
		  
          <li class="dropdown"><a href="#"><span>About Us</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="<?php echo DB_LOCAL.DB_LINK;?>/page/about-us/">The Overview</a></li>
              <li><a href="<?php echo DB_LOCAL.DB_LINK;?>/page/why-visit-us/" title="Why Must Visit ?">Why Must Visit ?</a></li>
              <li><a href="<?php echo DB_LOCAL.DB_LINK;?>/page/contact-us/">Contact Us</a></li>
              <li><a href="<?php echo DB_LOCAL.DB_LINK;?>/page/gallery/">Gallery</a></li>
            </ul>
          </li>
		  
          <li class="dropdown"><a href="#"><span>Visitors</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li>
                <a href="<?php echo DB_LOCAL.DB_LINK;?>/page/enjoy-jepara/" title="About Jepara">Enjoy Jepara</a>
              </li>
              <li><a href="<?php echo DB_LOCAL.DB_LINK;?>/page/jepara-furniture-world/" title="Jepara Furniture World">Jepara Furniture World</a></li>
              <li><a href="<?php echo DB_LOCAL.DB_LINK;?>/page/hospitalities/" title="Hospitalities">Hospitalities</a></li>
              <li><a href="<?php echo DB_LOCAL.DB_LINK;?>/page/visa-immigration/" title="Visa & Immigration">Visa & Immigration</a></li>
              <li><a href="<?php echo DB_LOCAL.DB_LINK;?>/page/logistics/" title="Logictics">Logistics</a></li>
              <li><a href="<?php echo DB_LOCAL.DB_LINK;?>/page/how-to-get-to-jepara/" title="How to Get to Jepara">How to Get to Jepara</a></li>
              <li><a href="<?php echo DB_LOCAL.DB_LINK;?>/page/indonesian-representatives/" title="Indonesian Representatives">Indonesian Representatives</a></li>
              <!--<li><a href="<?php echo DB_LOCAL.DB_LINK;?>/exhibitor/platinum/" title="Exhibitor List">Exhibitor List</a></li>
              <li><a href="<?php echo DB_LOCAL.DB_LINK;?>/login/" title="Login / Sign Up">Login / Sign Up</a></li>
              <li><a href="<?php echo DB_LOCAL.DB_LINK;?>/plan-visit/" title="Plan a Visit">Plan a Visit</a></li>-->
            </ul>
          </li>
		  
          <li><a href="<?php echo DB_LOCAL.DB_LINK;?>/exhibitor/platinum/"><span>Exhibitor List</span></a></li>
		  <li class="dropdown"><a href="#"><span>Language</span> <i class="bi bi-chevron-down"></i></a>
			<ul style="background:none;"><li id="google_translate_element"></li></ul>
          </li>
		    <?php
			if(isset($_SESSION["login"]) && isset($_SESSION["email"])){
			  $email = $_SESSION["email"];
			  
			  $usersessionDB = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_email`='".$email."'") -> fetch_assoc();
			  
			  if($_SESSION["login"] = "loginactive" && $_SESSION["user_email"] = $usersessionDB["user_email"]){
				echo "
				<li class='dropdown btn-dekstop'>
				  <a href='#' class='getstarted2' style='color: #fff;'>Hi, ".$usersessionDB["user_first_name"]." <i class='bi bi-chevron-down'></i></a>
				  <ul>
					<li><a href='".DB_LOCAL.DB_LINK."/user/".$usersessionDB["user_name"]."/' title='My Profile'>My Profile <i class='fas fa-cog'></i></a></li>
					<li><a href='".DB_LOCAL.DB_LINK."/logout/' title='Log Out'>Log Out <i class='fas fa-user-times'></i></a></li>
				  </ul>
				</li>";
			  }
				
			} else {
			  echo "<li class='dropdown btn-dekstop btn-dekstop'>
			    <a href='#' class='getstarted2' style='color: #fff;'>Reg / Log <i class='bi bi-chevron-down'></i></a>
				<ul>
				  <li><a href='".DB_LOCAL.DB_LINK."/register/' title='Register'>Register <i class='fas fa-user-plus'></i></a></li>
				  <li><a href='".DB_LOCAL.DB_LINK."/login/' title='LogIn'>LogIn <i class='fas fa-user-lock'></i></a></li>
				</ul>
			  </li>";
			}
			?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
    </div>
  </header>
	
	<div class="lightbox" style="display:block;" id="preloader">
      <div class="container-lightbox">
        <div class="container-lightbox-display">
          <div class="row">
		    <div class="col-12 col-lg-3 col-md-4 col-12 mx-auto d-flex justify-content-center" style="font-size: 40px; color:#8d0b10;"><div style="position: absolute; top: 50%; -ms-transform: translateY(-50%); transform: translateY(-50%);">
			  <div class="spinner-border loader" role="status" style="width:60px; height:60px;">
				<span class="sr-only">Loading...</span>
			  </div>
			</div></div>
          </div>
        </div>
      </div>
    </div>

<?php
// remove header
// header_remove('ETag');
// header_remove('Pragma');
// header_remove('Cache-Control');
// header_remove('Last-Modified');
// header_remove('Expires');

// set header
// header('Expires: Thu, 1 March 2024 13:54:00 GMT');
// header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
// header('Cache-Control: post-check=0, pre-check=0',false);
// header('Pragma: no-cache');

$notify = '';
$notifyClassError = '';
$notifyClassSuccess = '';

if(isset($_POST['submit'])){
    // Membuat variabl untuk menerima data dari form
    $email = $_POST['email'];
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Cek apakah ada data yang belum diisi
    if(!empty($email) && !empty($name) && !empty($subject) && !empty($message)){

        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            $notify = 'Your email is wrong. Please type the correct email address.';
            $notifyClassError = 'errordiv';
        }else{
            // Pengaturan penerima email dan subjek email
            $toEmail = 'info@jifbw.com'; // Ganti dengan alamat email yang Anda inginkan
            $emailSubject = 'Pesan website dari '.$name;
            $htmlContent = '<h2>Via Form Kontak Website</h2>
                <h4>Nama</h4><p>'.$name.'</p>
                <h4>Email</h4><p>'.$email.'</p>
                <h4>Subject</h4><p>'.$subject.'</p>
                <h4>Pesan</h4><p>'.$message.'</p>';

            // Mengatur Content-Type header untuk mengirim email dalam bentuk HTML
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // Header tambahan
            $headers .= 'From: '.$name.'<'.$email.'>'. "\r\n";

            // Kirim email
            if(mail($toEmail,$emailSubject,$htmlContent,$headers)){
                $notify = 'Your message has been sent. Thank you!';
                $notifyClassSuccess = 'succdiv';
            }else{
                $notify = 'Sorry, your message failed to send, please try again.';
                $notifyClassError = 'errordiv';
            }
        }
    } else{
        $notify = 'Please fill in all data fields';
        $notifyClassError = 'errordiv';
    }
}
?>