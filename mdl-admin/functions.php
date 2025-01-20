<?php
// Date Time
date_default_timezone_set('Asia/Jakarta');

// Module
//define("DB_LOCAL", "https://www.jifbw.com");
define("DB_LOCAL", "");
//define("DB_LINK", "");
define("DB_LINK", "http://localhost/jifbw");

if(isset($_GET["lang"])){
	if($_GET["lang"] == "arabic"){ define("DB_LINK_LANG", "?lang=arabic"); }
	if($_GET["lang"] == "chinese"){ define("DB_LINK_LANG", "?lang=chinese"); }
	if($_GET["lang"] == "english"){ define("DB_LINK_LANG", "?lang=english"); }
	if($_GET["lang"] == "france"){ define("DB_LINK_LANG", "?lang=france"); }
	if($_GET["lang"] == "indonesia"){ define("DB_LINK_LANG", "?lang=indonesia"); }
	if($_GET["lang"] == "spain"){ define("DB_LINK_LANG", "?lang=spain"); }
}
else { define("DB_LINK_LANG", ""); }

define("DB_FOLDER_ADMIN", "mdl-admin");
define("DB_PAGE", "page.php");
define("DB_PAGE_NEW", "page-new.php");

define("DB_POST", "post.php");
define("DB_POST_NEW", "post-new.php");

define("DB_POST_CATEGORIES", "categories-post.php");
define("DB_PRODUCT", "product.php");

define("DB_PRODUCT_NEW", "product-new.php");
define("DB_PRODUCT_CATEGORIES", "categories-product.php");

define("DB_USERS", "users.php");
define("DB_USER_NEW", "users-new.php");
define("DB_USER_CATEGORIES", "categories-user.php");


// Date Time
$DBdatetime = DATETIME("Y-m-d H:i:s");
function DATETIME($value){
  $value = date($value);
  return $value;
}

// Function Legalitas Text Input
function LEGALTEXT($value) {
  $value = trim($value);
  $value = stripslashes($value);
  $value = addslashes($value);
  //$value = htmlspecialchars($value);
  return $value;
}

// Function Link Slug
function LINKSLUG($value){
  $c = array (' ');
  $d = array ('_','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','& ',' &','*','=','?','+',' - ');
  $e = array ('--');
  $value = str_replace($d, '', $value); // Hilangkan karakter yang telah disebutkan di array $d
  $value = strtolower(str_replace($c, '-', $value)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
  $value = str_replace($e, '-', $value); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
  return $value;
}

// Format Angka
function ANGKA($value){
  $value = number_format($value,0,',','.');
  return $value;
}

// Format Rupiah
function RP($angka){
  $value = "IDR " . number_format($angka,2,'.',',');
  return $value;
}


function page_title($url) {
    $fp = file_get_contents($url);
    if (!$fp) 
        return null;

    $res = preg_match("/<title>(.*)<\/title>/siU", $fp, $title_matches);
    if (!$res) 
        return null; 

    // Clean up title: remove EOL's and excessive whitespace.
    $title = preg_replace('/\s+/', ' ', $title_matches[1]);
    $title = trim($title);
    return $title;
}
?>