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
          <li><?php echo $pageDB["page_title"];?></li>
        </ol>
        <h1><?php echo $pageDB["page_title"];?></h1>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container">

        <div class="row">

          <div class="col-12 col-lg-12 entries">
		    <article class="entry">
			  <h2 class="entry-title mb-3"></h2>
			  <div class="row">
			  
			  </div>
			</article>
          </div><!-- End blog entries list -->
		  
        </div>

      </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->

<?php include "footer.php";?>