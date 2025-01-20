<!DOCTYPE html>
<html lang="<?php echo $lg; ?>">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title><?php include "mdl-includes/meta/mdl-title.php";?></title>
<meta name="description" content="<?php include "mdl-includes/meta/mdl-description.php";?>" rel="stylesheet">
<meta name="keywords" content="<?php include "mdl-includes/meta/mdl-keywords.php";?>" rel="stylesheet">
<meta name="robots" content="<?php include "mdl-includes/meta/mdl-robots.php";?>">
<meta property="og:title" content="<?php include "mdl-includes/meta/mdl-title.php";?>" rel="stylesheet">
<meta property="og:description" content="<?php include "mdl-includes/meta/mdl-description.php";?>" rel="stylesheet">
<meta property="og:image" content="https://www.jifbw.com/mdl-content/themes/jifbw2025/assets/img/JIFBW_Banner_2025.jpg" rel="stylesheet">
<meta property="og:url" content="<?php echo $_SERVER ["HTTP_HOST"].$_SERVER ["REQUEST_URI"];?>" rel="stylesheet">
<meta name="twitter:title" content="<?php include "mdl-includes/meta/mdl-title.php";?>" rel="stylesheet">
<meta name="twitter:description" content="<?php include "mdl-includes/meta/mdl-description.php";?>" rel="stylesheet">
<meta name="twitter:url" content="https://www.jifbw.com/mdl-content/themes/jifbw2025/assets/img/JIFBW_Banner_2025.jpg" rel="stylesheet">
<meta name="twitter:card" content="summary_large_image" />
<meta name="p:domain_verify" content="1fc071e5d1714da20b2ff0eec7a73510"/>
<link href="https://fonts.googleapis.com/css?family=Nunito:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
<link href="<?php echo FOLDER_THEMES;?>/assets/img/icon.png" rel="icon">
<link href="<?php echo FOLDER_THEMES;?>/assets/img/icon.png" rel="apple-touch-icon">
<link href="<?php echo FOLDER_THEMES;?>/assets/vendor/aos/aos.css" rel="stylesheet">
<link href="<?php echo FOLDER_THEMES;?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo FOLDER_THEMES;?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="<?php echo FOLDER_THEMES;?>/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
<link href="<?php echo FOLDER_THEMES;?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="<?php echo FOLDER_THEMES;?>/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
<link href="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/fontawesome-free/css/all.min.css">
<link href="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css" rel="stylesheet">
<link href="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/toastr/toastr.min.css" rel="stylesheet">
<link href="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/fontawesome-free/css/all.min.css" rel="stylesheet">
<link href="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/summernote/summernote-bs4.min.css" rel="stylesheet">
<link href="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/datatables-responsive/css/responsive.bootstrap4.min.css" rel="stylesheet">
<link href="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/datatables-buttons/css/buttons.bootstrap4.min.css" rel="stylesheet">
<link href="<?php echo DB_LOCAL.DB_LINK;?>/mdl-includes/plugins/dropzone2/dropzone.css" rel="stylesheet">
<link href="<?php echo FOLDER_THEMES;?>/assets/css/jifbw-style-01-08-2025.min.css" rel="stylesheet">
<link href="<?php echo FOLDER_THEMES;?>/assets/css/flag-icons-master/flag-icons.min.css" rel="stylesheet">
<link href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""  rel="stylesheet" />
<link href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" rel="stylesheet" />
<link href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" rel="stylesheet" />
</head>
<body>
  <header id="header" class="header">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="<?php echo DB_LOCAL.DB_LINK."/".DB_LINK_LANG;?>" class="logo d-flex align-items-center">
        <img src="<?php echo FOLDER_THEMES;?>/assets/img/JIFBW-2025-Logo.png" alt="JIF-BW">
      </a>
        <div class="btn-gadget">
			<div class="dropdown">
				<span class='getstarted2' style='color: #fff;' id="google_translate_element_gadget"><i class="fas fa-language" style="font-size:18px;"></i>&nbsp;Language&nbsp;<i class="bi bi-chevron-down"></i></span>
			</div>
        </div>
      <nav id="navbar" class="navbar">
		<?php
		/*
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
				  <li><a href='".DB_LOCAL.DB_LINK.DB_LINK_LANG."/login/' title='LogIn'>LogIn <i class='fas fa-user-lock'></i></a></li>
				</ul>
			  </div>";
		}
		*/
		?>
        <ul>
          <li><a href="<?php echo DB_LOCAL.DB_LINK."/".DB_LINK_LANG;?>">Home</a></li>
		  
          <li class="dropdown"><a href="#"><span>About Us</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="<?php echo DB_LOCAL.DB_LINK."/page/about-us/".DB_LINK_LANG;?>" rel="nofollow">The Overview</a></li>
              <li><a href="<?php echo DB_LOCAL.DB_LINK."/page/why-visit-us/".DB_LINK_LANG;?>" title="Why Must Visit ?">Why Must Visit ?</a></li>
              <li><a href="<?php echo DB_LOCAL.DB_LINK."/page/contact-us/".DB_LINK_LANG;?>" rel="nofollow">Contact Us</a></li>
              <li><a href="<?php echo DB_LOCAL.DB_LINK."/page/gallery/".DB_LINK_LANG;?>">Gallery</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>Visitors</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="<?php echo DB_LOCAL.DB_LINK."/page/plan-visit/".DB_LINK_LANG;?>" title="Plan a Visit" rel="nofollow">Plan a Visit</a></li>
              <li><a href="<?php echo DB_LOCAL.DB_LINK."/page/enjoy-jepara/".DB_LINK_LANG;?>" title="About Jepara" rel="nofollow">Enjoy Jepara</a></li>
              <li><a href="<?php echo DB_LOCAL.DB_LINK."/page/jepara-furniture-world/".DB_LINK_LANG;?>" title="Jepara Furniture World">Jepara Furniture World</a></li>
              <li><a href="<?php echo DB_LOCAL.DB_LINK."/page/hospitalities/".DB_LINK_LANG;?>" title="Hospitalities" rel="nofollow">Hospitalities</a></li>
              <li><a href="<?php echo DB_LOCAL.DB_LINK."/page/visa-immigration/".DB_LINK_LANG;?>" title="Visa & Immigration" rel="nofollow">Visa & Immigration</a></li>
              <li><a href="<?php echo DB_LOCAL.DB_LINK."/page/logistics/".DB_LINK_LANG;?>" title="Logictics" rel="nofollow">Logistics</a></li>
              <li><a href="<?php echo DB_LOCAL.DB_LINK."/page/how-to-get-to-jepara/".DB_LINK_LANG;?>" title="How to Get to Jepara" rel="nofollow">How to Get to Jepara</a></li>
              <li><a href="<?php echo DB_LOCAL.DB_LINK."/page/indonesian-representatives/".DB_LINK_LANG;?>" title="Indonesian Representatives" rel="nofollow">Indonesian Representatives</a></li>
            </ul>
          </li>
          <li><a href="<?php echo DB_LOCAL.DB_LINK."/exhibitor/platinum/".DB_LINK_LANG;?>"><span>Exhibitor List</span></a></li> 
          <!--<li class="dropdown"><a href="#"><span>Language</span> <i class="bi bi-chevron-down"></i></a>
			<ul class="language"><li></li></ul>
		  </li>-->
		  <li class='dropdown btn-dekstop btn-dekstop language'>
		    <span class='getstarted2' style='color: #fff;' id="google_translate_element"><i class="fas fa-language" style="font-size:18px;"></i>&nbsp;Language&nbsp;<i class="bi bi-chevron-down"></i>&nbsp;</span>
		  </li>
		    <?php
			/*
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
			*/
			?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
    </div>
</header>