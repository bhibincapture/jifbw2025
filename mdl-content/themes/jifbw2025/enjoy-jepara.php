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
		      <div class="row">
		        <div class="col-12 mb-4 mt-2">
		          <h3><b>Jepara Tourism</b></h3>
		          <p class="mb-2">Jepara although only a small town but has many tourist attractions, the mountain tourism, beach tourism, underwater tours, tour the islands. 
		          Foreign tourists often visit Tirto Samodra Beach (Bandengan Beach), Karimunjava Island (Crimon Java), Kartini Beach, etc.</p>
		        </div>
		        
			    <div class="col-12 col-lg-6 mb-4 mt-2">
			      <h3><b>Karimunjawa Island</b></h3>
			      <p class="mb-2">The Karimunjawa National Park is one of seven marine national parks in Indonesia. Taking only a four to five-hour trip from Semarang, you will be surrounded by a natural beauty so stunning, you wish you could stay here forever.</p>
			      <p class="mb-2">The sparkling beaches and pristine seas are home to healthy coral reefs that scatter around an 80 km wide area all the way to the coast of Jepara. Here, you can find two protected marine biota species. Namely, the black coral (Antiphates sp )and organ pipe coral (Tubipora musica).</p>
			    </div>
			    <div class="col-12 col-lg-6 p-1">
                  <!--<img src="https://www.jifbw.com/mdl-content/themes/jifbw2025/assets/img/visitors/snorkelling-karimunjawa-jepara.jpg" alt="Karimun Jawa" class="img-fluid">-->
                  
                  <div class='entry-content'>
					  <div class='embed-responsive embed-responsive-16by9'>
						<iframe class='embed-responsive-item' src='https://www.jifbw.com/mdl-content/themes/jifbw2025/assets/video/Ayo-ke-Karimunjawa.mp4' allowfullscreen></iframe>
					  </div>
				  </div>
                </div>
                
				<hr></hr>
		        
			    <div class="col-12 col-lg-6 mb-4 mt-2">
			      <h3><b>Tirto Samodra Beach (Bandengan Beach)</b></h3>
			      <p class="mb-2">Natural Beauty in Jepara Regency, with its untouched natural beauty and unique charm, Tirto Samodra Beach has become a prime destination for tourists seeking a different travel experience.
			      </p>
			      <p class="mb-2">One of the main attractions of Tirto Samodra Beach is its stunning natural scenery. The beach boasts fine white sand and clear sea water, making it an ideal spot for swimming and relaxation. Additionally, the view of the sunset on the horizon provides a romantic and breathtaking atmosphere for visitors.</p>
			      <p class="mb-2">At Tirto Samodra Beach, tourists can enjoy various activities such as swimming, snorkeling, and building sandcastles. Besides, visitors can also savor local cuisine at the beachside stalls available.</p>
			    </div>
			    <div class="col-12 col-lg-6 p-1">
                  <!--<img src="https://www.jifbw.com/mdl-content/themes/jifbw2025/assets/img/visitors/snorkelling-karimunjawa-jepara.jpg" alt="Karimun Jawa" class="img-fluid">-->
                  
                  <div class='entry-content'>
					  <div class='embed-responsive embed-responsive-16by9'>
						<iframe class='embed-responsive-item' src='https://www.jifbw.com/mdl-content/themes/jifbw2025/assets/video/Wisata-Jepara-2024.mp4' allowfullscreen></iframe>
					  </div>
				  </div>
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