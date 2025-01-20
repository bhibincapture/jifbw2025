<?php
// Post
include "header.php";

?>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="<?php echo DB_LOCAL.DB_LINK."/";?>" title="Home">Home</a></li>
          <li><a href="<?php echo DB_LOCAL.DB_LINK."/category/news/";?>" title="News">News</a></li>
          <li><?php echo $postDB["post_title"];?></li>
        </ol>
        <h2>News</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container">

        <div class="row">

          <div class="col-lg-8 entries">
			<?php
			$mount = array(["01","Jan","January"],["02","Feb","February"],["03","Mar","March"],["04","04-Apr","Apr"],["05","05-May","May"],["06","06-Jun","Jun"],["07","07-Jul","Jul"],["08","08-Aug","Aug"],["09","09-Sep","Sep"],["10","10-Oct","Oct"],["11","11-Nov","Nov"],["12","12-Dec","Dec"]);
			
			$idpost = $postDB["post_id"];
			
			$postQR2 = $db->conn -> query("SELECT * FROM `mdl_post` WHERE `post_status`='published' && `post_id`='$idpost'");
			while($postDB = $postQR2 -> fetch_assoc()){
			  if($postDB["post_thumb"] != ""){
			    $thumb = $postDB["post_thumb"];
			    $mediaDB = $db->conn -> query("SELECT * FROM `mdl_media` WHERE `media_id`='$thumb'") -> fetch_assoc();
			    $thumb = DB_LOCAL.DB_LINK.$mediaDB["media_attachment_large"];
			  }
			  else { $thumb = FOLDER_THEMES."/assets/img/image-not-available.jpg"; }
			
			  if($mediaDB["media_alt"] != ""){$alt = $mediaDB["media_alt"];} else {$alt = $mediaDB["media_title"];}
			  
			  $iduser = $postDB["post_author"];
			  $userDB = $db->conn -> query("SELECT * FROM `mdl_user` WHERE `user_id`='$iduser'") -> fetch_assoc();
			  
			  echo "
              <article class='entry'>

                <div class='entry-img'>
                  <img src='$thumb' alt='$alt' class='img-fluid'>
                </div>

                <h2 class='entry-title'>
                  <a href='".DB_LOCAL.DB_LINK."/post/".$postDB["post_slug"]."/'>".$postDB["post_title"]."</a>
                </h2>

                <div class='entry-meta'>
                  <ul>
                    <li class='d-flex align-items-center'><i class='bi bi-person'></i> <a href='".DB_LOCAL.DB_LINK."/user/".$userDB["user_name"]."/'>".$userDB["user_first_name"]." ".$userDB["user_last_name"]."</a></li>
                    <li class='d-flex align-items-center'><i class='bi bi-clock'></i> <span style='color:#777;font-size: 14px;'>";for($b = 0; $b < 12; $b++){
				      if($mount[$b][0] == date('m', strtotime($postDB["post_datemodify"]))){
					    echo $mount[$b][2];
				      }
				    }
					echo " ".date('d', strtotime($postDB["post_datemodify"])).",";
					echo " ".date('Y', strtotime($postDB["post_datemodify"]))."</span></li>
                    <li class='d-flex align-items-center'><i class='bi bi-chat-dots'></i> <span style='color:#777;font-size: 14px;'>0 Comments</span></li>
                  </ul>
                </div>

                <div class='entry-content'>".$postDB["post_content"]."</div>
              </article>";
			}?>
			<!--
            <div class="blog-pagination">
              <ul class="justify-content-center">
                <li><a href="#">1</a></li>
                <li class="active"><a href="#">2</a></li>
                <li><a href="#">3</a></li>
              </ul>
            </div>-->

          </div><!-- End blog entries list -->

          <div class="col-12 col-lg-4">
            <?php include "sidebar.php";?>
          </div>

        </div>

      </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->

<?php include "footer.php";?>