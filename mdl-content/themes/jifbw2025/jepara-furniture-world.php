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
			  
			    <div class="col-12 col-lg-6 p-1">
                  <img src="https://www.jifbw.com/mdl-content/uploads/2024/02/jepara-international-furniture-buyer-wekks-1-12040749.jpg" alt="History" class="img-fluid">
                </div>
			    <div class="col-12 col-lg-6 mb-4 mt-2">
			      <h3><b>History</b></h3>
			      <p>Jepara is an exquisite city welknown as centre of furniture industry in Indonesia, and had been famous as iconic brand of "the world carving Wood center" where more than 12 thousand bussiness units,related to furniture industry located. 4 subdistrics of Jepara is a home of dynamics and contiuounsly creative home industries, small and medium as well as big furniture factories exporting furniture to more than 140 countries world wide.</p>
			    </div>
				
				<hr></hr>
			  </div>
			</article>
          </div><!-- End blog entries list -->
		  
        </div>

      </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->

<?php include "footer.php";?>