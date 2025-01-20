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
		        <div class="col-12 mb-4 mt-2">
		          <h3><b>Direction with Google Maps :</b></h3>
		          <p class="mb-2"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d37426.80542334957!2d110.67222328672497!3d-6.58219317680204!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7118d34b9ae3ab%3A0x9d3067f98797ae0f!2sJepara%2C%20Kec.%20Jepara%2C%20Kabupaten%20Jepara%2C%20Jawa%20Tengah!5e1!3m2!1sid!2sid!4v1734425341952!5m2!1sid!2sid" width="100%" height="550" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></p>
		        </div>
		        
		        <hr></hr>
		        
		        <div class="col-12 mb-4 mt-2">
		          <div class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                    <span>From Airport</span>
                  </div>
			      <h3><b>Soekarno – Hatta International Airport ( CGK )</b></h3>
			      
			    </div>
			  </div>
			</article>
          </div><!-- End blog entries list -->
		  
        </div>

      </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->

<?php include "footer.php";?>