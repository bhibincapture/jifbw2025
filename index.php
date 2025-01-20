<?php
/**
 * Front index of Madilog application. This file doesn't do anything, but loads
 * to themplate
 *
 */
ob_start();
session_start();

//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\SMTP;
//use PHPMailer\PHPMailer\Exception;

include "functions.php";
include "mdl-admin/functions.php";
$db = new DBGlobal;

$server = $_SERVER ["HTTP_HOST"];

define ("THEMES", "/mdl-content/themes/jifbw2025/");
define ("FOLDER_THEMES", DB_LOCAL.DB_LINK.THEMES);

//$_SERVER ["HTTP_HOST"]; // localhost

//$_SERVER ["REQUEST_URI"]; // /madilog/

//$_SERVER['PHP_SELF']; // /madilog/index.php
//$_SERVER['SERVER_NAME']; // localhost
//$_SERVER['HTTP_HOST']; // localhost
//echo "<p>".$_SERVER['SCRIPT_URI']."</p>";
//$_SERVER['HTTP_USER_AGENT']; // Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36
//$_SERVER['SCRIPT_NAME']; // /madilog/index.php

$lg = "en-US";
$companyidforvisitor = "";

$permalink = $_SERVER ["REQUEST_URI"];
$permalink = explode("/", $permalink);

$numpermalink = count($permalink);

if($server == "localhost"){
  $i = 1;
  $default = 2 + 1;
} else {
  $i = 0;
  $default = 2;
}

if(isset($_GET["lang"])){
	if($_GET["lang"] == "arabic"){ $lg = "sa"; }
	if($_GET["lang"] == "chinese"){ $lg = "cn"; }
	if($_GET["lang"] == "english"){ $lg = "en-US"; }
	if($_GET["lang"] == "france"){ $lg = "fr"; }
	if($_GET["lang"] == "indonesia"){ $lg = "id"; }
	if($_GET["lang"] == "spain"){ $lg = "es"; }
}
else { $lg = "en-US"; }

if($numpermalink == $default){
  //if($permalink[$i] == "madilog"){}
	include "mdl-content/themes/jifbw2025/index.php";
	
}

else if($numpermalink == $default + 1){
	/*
	if(
	  $permalink[$i+1] == "sa" || 
	  $permalink[$i+1] == "cn" || 
	  $permalink[$i+1] == "gb" || 
	  $permalink[$i+1] == "fr" || 
	  $permalink[$i+1] == "id" || 
	  $permalink[$i+1] == "es"){
		if($permalink[$i+1] == "sa") { $lg = "sa"; define("DB_LINK_LANG", "/sa"); }
		if($permalink[$i+1] == "cn") { $lg = "cn"; define("DB_LINK_LANG", "/cn"); }
		if($permalink[$i+1] == "gb") { $lg = "en-gb"; define("DB_LINK_LANG", ""); }
		if($permalink[$i+1] == "fr") { $lg = "fr"; define("DB_LINK_LANG", "/fr"); }
		if($permalink[$i+1] == "id") { $lg = "id"; define("DB_LINK_LANG", "/id"); }
		if($permalink[$i+1] == "es") { $lg = "es"; define("DB_LINK_LANG", "/es"); }
		
		include "mdl-content/themes/jifbw2025/index.php";
	}
	else {
	}
	*/
	  if($permalink[$i+1] == "category"){
		include "mdl-content/themes/jifbw2025/404.php";
	  }
	  if($permalink[$i+1] == "page"){
		include "mdl-content/themes/jifbw2025/404.php";
	  }
	  if($permalink[$i+1] == "post"){
		include "mdl-content/themes/jifbw2025/404.php";
	  }
	  if($permalink[$i+1] == "exhibitor"){
		include "mdl-content/themes/jifbw2025/404.php";
	  }
	  if($permalink[$i+1] == "search"){
		include "mdl-content/themes/jifbw2025/search.php";
	  }
	  if($permalink[$i+1] == "company-profile"){
		include "mdl-content/themes/jifbw2025/404.php";
	  }
	  if($permalink[$i+1] == "product"){
		include "mdl-content/themes/jifbw2025/404.php";
	  }
	  if($permalink[$i+1] == "contact-us"){
		include "mdl-content/themes/jifbw2025/contact.php";
	  }
	  if($permalink[$i+1] == "plan-visit"){
		include "mdl-content/themes/jifbw2025/plan-visit.php";
	  }
	  if($permalink[$i+1] == "users"){
		include "mdl-content/themes/jifbw2025/404.php";
	  }
	  if($permalink[$i+1] == "sign-up"){
		include "mdl-content/themes/jifbw2025/sign-up.php";
	  }
	  if($permalink[$i+1] == "login"){
		include "mdl-content/themes/jifbw2025/login.php";
	  }
	  if($permalink[$i+1] == "reset"){
		include "mdl-content/themes/jifbw2025/reset.php";
	  }
	  if($permalink[$i+1] == "logout"){
		include "mdl-content/themes/jifbw2025/logout.php";
	  }
	  if($permalink[$i+1] == "verify"){
		include "mdl-content/themes/jifbw2025/verify.php";
	  }
	  if($permalink[$i+1] == "register"){
		include "mdl-content/themes/jifbw2025/register.php";
	  }
	  if($permalink[$i+1] == "convert"){
		include "mdl-content/themes/jifbw2025/convert.php";
	  }
	  if($permalink[$i+1] == "mdl-includes"){
		include "mdl-content/themes/jifbw2025/404.php";
	  }
	  if($permalink[$i+1] == "mdl-content"){
		include "mdl-content/themes/jifbw2025/404.php";
	  }
	  if($permalink[$i+1] == "visitor"){
		include "mdl-content/themes/jifbw2025/visitor.php";
	  }
}

else if($numpermalink == $default + 2){
	/*
	if(
	  $permalink[$i+1] == "sa" || 
	  $permalink[$i+1] == "cn" || 
	  $permalink[$i+1] == "gb" || 
	  $permalink[$i+1] == "fr" || 
	  $permalink[$i+1] == "id" || 
	  $permalink[$i+1] == "es"){
		if($permalink[$i+1] == "sa") { $lg = "sa"; define("DB_LINK_LANG", "/sa"); }
		if($permalink[$i+1] == "cn") { $lg = "cn"; define("DB_LINK_LANG", "/cn"); }
		if($permalink[$i+1] == "gb") { $lg = "en-gb"; define("DB_LINK_LANG", ""); }
		if($permalink[$i+1] == "fr") { $lg = "fr"; define("DB_LINK_LANG", "/fr"); }
		if($permalink[$i+1] == "id") { $lg = "id"; define("DB_LINK_LANG", "/id"); }
		if($permalink[$i+1] == "es") { $lg = "es"; define("DB_LINK_LANG", "/es"); }
	}
	else {
	  define("DB_LINK_LANG", "");
	}
	*/
	  if($permalink[$i+1] == "verify"){
		$verify = $permalink[$i+2];
		$verifyQR = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_verify`='$verify'");
		$verifyDB = $verifyQR -> fetch_assoc();
		$verifyNUM = $verifyQR -> num_rows;
		
		if($verifyNUM != 0){
		  if($permalink[$i+2] == $verifyDB["user_verify"]){
			include "mdl-content/themes/jifbw2025/verify.php";
		  } else {
			include "mdl-content/themes/jifbw2025/404.php";
		  }
		} else {
		  include "mdl-content/themes/jifbw2025/404.php";
		}
	  }
	  
	  if($permalink[$i+1] == "reset"){
		$reset = $permalink[$i+2];
		$resetQR = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_verify`='$reset'");
		$resetDB = $resetQR -> fetch_assoc();
		$resetNUM = $resetQR -> num_rows;
		
		if($resetNUM != 0){
		  if($permalink[$i+2] == $resetDB["user_verify"]){
			include "mdl-content/themes/jifbw2025/reset-account.php";
		  } else {
			include "mdl-content/themes/jifbw2025/404.php";
		  }
		} else {
		  include "mdl-content/themes/jifbw2025/404.php";
		}
	  }
	  
	  if($permalink[$i+1] == "category"){
		$category = $permalink[$i+2];
		$postcatQR = $db->conn -> query("SELECT * FROM `mdl_post_category` WHERE `postcat_slug`='$category'");
		$postcatDB = $postcatQR -> fetch_assoc();
		$postcatNUM = $postcatQR -> num_rows;
		
		if($postcatNUM != 0){
		  if($permalink[$i+2] == $postcatDB["postcat_slug"]){
			include "mdl-content/themes/jifbw2025/post.php";
		  } else {
			include "mdl-content/themes/jifbw2025/404.php";
		  }
		} else {
		  include "mdl-content/themes/jifbw2025/404.php";
		}
	  }
	  
	  if($permalink[$i+1] == "post"){
		$post = $permalink[$i+2];
		$postQR = $db->conn -> query("SELECT * FROM `mdl_post` WHERE `post_slug`='$post'");
		$postDB = $postQR -> fetch_assoc();
		$postNUM = $postQR -> num_rows;
		
		if($postNUM != 0){
		  if($permalink[$i+2] == $postDB["post_slug"]){
			include "mdl-content/themes/jifbw2025/post-single.php";
		  } else {
			include "mdl-content/themes/jifbw2025/404.php";
		  }
		} else {
		  include "mdl-content/themes/jifbw2025/404.php";
		}
	  }
	  
	  if($permalink[$i+1] == "page"){
		$page = $permalink[$i+2];
		$pageQR = $db->conn -> query("SELECT * FROM `mdl_page` WHERE `page_slug`='$page'");
		$pageDB = $pageQR -> fetch_assoc();
		$pageNUM = $pageQR -> num_rows;
		
		if($pageNUM != 0){
		  if($permalink[$i+2] == "hotels"){
			include "mdl-content/themes/jifbw2025/hotels.php";
		  }
		  else if($permalink[$i+2] == "plan-visit"){
			include "mdl-content/themes/jifbw2025/plan-visit.php";
		  }
		  else if($permalink[$i+2] == "enjoy-jepara"){
			include "mdl-content/themes/jifbw2025/enjoy-jepara.php";
		  }
		  else if($permalink[$i+2] == "jepara-furniture-world"){
			include "mdl-content/themes/jifbw2025/jepara-furniture-world.php";
		  }
		  else if($permalink[$i+2] == "hospitalities"){
			include "mdl-content/themes/jifbw2025/hospitalities.php";
		  }
		  else if($permalink[$i+2] == "visa-immigration"){
			include "mdl-content/themes/jifbw2025/visa-immigration.php";	
		  }
		  else if($permalink[$i+2] == "logistics"){
			include "mdl-content/themes/jifbw2025/logistics.php";
		  }
		  else if($permalink[$i+2] == "how-to-get-to-jepara"){
			include "mdl-content/themes/jifbw2025/how-to-get-to-jepara.php";
		  }
		  else if($permalink[$i+2] == "indonesian-representatives"){
			include "mdl-content/themes/jifbw2025/indonesian-representatives.php";
		  }
		  else if($permalink[$i+2] == "contact-us"){
			include "mdl-content/themes/jifbw2025/contact.php";
		  }
		  else if($permalink[$i+2] == "gallery"){
			include "mdl-content/themes/jifbw2025/gallery.php";
		  }
		  else if($permalink[$i+2] == $pageDB["page_slug"]){
			include "mdl-content/themes/jifbw2025/page.php";
		  }
		  else {
			include "mdl-content/themes/jifbw2025/404.php";
			
		  }
		} else {
		  include "mdl-content/themes/jifbw2025/404.php";
		}
	  }
	  
	  if($permalink[$i+1] == "exhibitor"){
		$exhibitor = $permalink[$i+2];
		$usercatQR = $db->conn -> query("SELECT * FROM `mdl_user_category` WHERE `usercat_slug`='$exhibitor'");
		$usercatDB = $usercatQR -> fetch_assoc();
		$usercatNUM = $usercatQR -> num_rows;
		
		if($usercatNUM != 0){
		  if($permalink[$i+2] == $usercatDB["usercat_slug"]){
			include "mdl-content/themes/jifbw2025/exhibitor.php";
		  } else {
			include "mdl-content/themes/jifbw2025/404.php";
		  }
		} else {
		  include "mdl-content/themes/jifbw2025/404.php";
		}
	  }
	  
	  if($permalink[$i+1] == "company-profile"){
		$exhibitor = $permalink[$i+2];
		$userQR = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_name`='$exhibitor'");
		$userNUM = $userQR -> num_rows;
		if($userNUM != 0){
		  $userDB = $userQR -> fetch_assoc();
		  $companyidforvisitor = $userDB["user_id"];
		  if($userNUM != 0){
			$companyQR = $db->conn -> query("SELECT * FROM `mdl_user_company` WHERE `user_id`='".$userDB["user_id"]."'");
			$companyDB = $companyQR -> fetch_assoc();
		  
			if($permalink[$i+2] == $userDB["user_name"]){
			  include "mdl-content/themes/jifbw2025/company-profile.php";
			  $companyidforvisitor = $userDB["user_id"];
			} else {
			  include "mdl-content/themes/jifbw2025/404.php";
			  $companyidforvisitor = "";
			}
		  } else {
			include "mdl-content/themes/jifbw2025/404.php";
			$companyidforvisitor = "";
		  }
		} else {
		  $userQR2 =  $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_name_id`='$exhibitor'");
		  $userNUM2 = $userQR2 -> num_rows;
		  $userDB = $userQR2 -> fetch_assoc();
		  $companyidforvisitor = $userDB["user_id"];
		  if($userNUM2 != 0){
			$companyQR = $db->conn -> query("SELECT * FROM `mdl_user_company` WHERE `user_id`='".$userDB["user_id"]."'");
			$companyDB = $companyQR -> fetch_assoc();
		  
			if($permalink[$i+2] == $userDB["user_name_id"]){
			  include "mdl-content/themes/jifbw2025/company-profile.php";
			  $companyidforvisitor = $userDB["user_id"];
			} else {
			  include "mdl-content/themes/jifbw2025/404.php";
			  $companyidforvisitor = "";
			}
		  } else {
			include "mdl-content/themes/jifbw2025/404.php";
			$companyidforvisitor = "";
		  }
		}
	  }
	  
	  if($permalink[$i+1] == "product"){
		$product = $permalink[$i+2];
		$productQR = $db->conn -> query("SELECT * FROM `mdl_product` WHERE `product_slug`='$product'");
		$productDB = $productQR -> fetch_assoc();
		$productNUM = $productQR -> num_rows;
		
		if($productNUM != 0){
		  if($permalink[$i+2] == $productDB["product_slug"]){
			include "mdl-content/themes/jifbw2025/product-single.php";
		  } else {
			include "mdl-content/themes/jifbw2025/404.php";
		  }
		} else {
		  include "mdl-content/themes/jifbw2025/404.php";
		}
	  }
	  /*
	  if($permalink[$i+1] == "product"){
		$post = $permalink[$i+2];
		$postQR = $db->conn -> query("SELECT * FROM `mdl_post` WHERE `post_slug`='$post'");
		$postDB = $postQR -> fetch_assoc();
		$postNUM = $postQR -> num_rows;
		
		if($postNUM != 0){
		  if($permalink[$i+2] == $postDB["post_slug"]){
			include "mdl-content/themes/jifbw2025/post-single.php";
		  } else {
			include "mdl-content/themes/jifbw2025/404.php";
		  }
		} else {
		  include "mdl-content/themes/jifbw2025/404.php";
		}
	  }
	  */
	  if($permalink[$i+1] == "user"){
		$user = $permalink[$i+2];
		$userQR = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_name`='$user'");
		$userDB = $userQR -> fetch_assoc();
		$userNUM = $userQR -> num_rows;
		
		if($userNUM != 0){
		  if($permalink[$i+2] == $userDB["user_name"]){
			include "mdl-content/themes/jifbw2025/user.php";
		  } else {
			include "mdl-content/themes/jifbw2025/404.php";
		  }
		} else {
		  include "mdl-content/themes/jifbw2025/404.php";
		}
	  }
	
}

else {
   include "mdl-content/themes/jifbw2025/404.php";
}

?>