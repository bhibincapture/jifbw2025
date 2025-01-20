<?php
// page
include "header.php";

if(isset($_POST['submitvisit'])){
  $name = LEGALTEXT($_POST['name']);
  $country = LEGALTEXT($_POST['country']);
  $city = LEGALTEXT($_POST['city']);
  $email = LEGALTEXT($_POST['email']);
  $wa = LEGALTEXT($_POST['wa']);
  $note = LEGALTEXT($_POST['note']);
  $datetime = $DBdatetime;

  // if(!empty($name) && !empty($country) && !empty($city) && !empty($email) && !empty($wa)){
  if(!empty($name)){
    if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
      $notify = 'Your email is wrong. Please type the correct email address.';
      $notifyClassError = 'errordiv';
    }
    else {
            // Pengaturan penerima email dan subjek email
            $toEmail = 'info@jifbw.com'; // Ganti dengan alamat email yang Anda inginkan
            $emailSubject = 'Message from '.$name;
            $htmlContent = '<h2>Visitors Form Website</h2>
                <h4>Nama</h4><p>'.$name.'</p>
                <h4>Country</h4><p>'.$country.'</p>
                <h4>City</h4><p>'.$city.'</p>
                <h4>Email</h4><p>'.$email.'</p>
                <h4>WhatApp</h4><p>'.$wa.'</p>
                <h4>Note</h4><p>'.$note.'</p>';

            // Mengatur Content-Type header untuk mengirim email dalam bentuk HTML
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // Header tambahan
            $headers .= 'From: '.$name.'<'.$email.'>'. "\r\n";

            // Kirim email
            if(mail($toEmail,$emailSubject,$htmlContent,$headers)){
                $notify = 'Your message has been sent. Thank you!';
                $notifyClassSuccess = 'succdiv';
              
                $guest = "INSERT INTO `mdl_guest`(`guest_id`, `guest_name`, `guest_country`, `guest_city`, `guest_email`, `guest_wa`, `guest_content`, `guest_datetime`) VALUES ('','$name','$country','$city','$email','$wa','$note','$datetime')";

                $insert = $db->conn -> query($guest);
                
                if($insert === true){
            }else{
                $notify = 'Sorry, your message failed to send, please try again.';
                $notifyClassError = 'errordiv';
            }
        }
    } 
  }
  else {
    $notify = 'Please fill in all data fields';
    $notifyClassError = 'errordiv';
  }
}
?>

  <main id="main">
    <section class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="<?php echo DB_LOCAL.DB_LINK."/";?>" title="Home">Home</a></li>
          <li>Plan a Visit</li>
        </ol>
        <h1>Plan a Visit</h1>
      </div>
    </section>
    <section id="contact" class="contact" style="background:#f1f1f1;">
      <div class="container">
        <header class="section-header">
          <h2>Plan a Visit</h2>
          <p>Visitors Form</p>
        </header>
        <div class="row gy-4">
          <div class="col-lg-6" style="margin:0 auto">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" class="php-email-form-2">
              <div class="row gy-4">

                <div class="col-md-12">
                  <input type="text" name="name" class="form-control" placeholder="* Your Name" required>
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="country" placeholder="* Country">
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="city" placeholder="* City">
                </div>

                <div class="col-md-12">
                  <input type="email" class="form-control" name="email" placeholder="* Your Email">
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="wa" placeholder="* WhatsApp / Phone">
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="note" rows="6" placeholder="Note Optional"></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message <?php echo $notifyClassError;?>"><?php echo $notify;?></div>
                  <div class="sent-message <?php echo $notifyClassSuccess;?>"><?php echo $notify;?></div>

                  <button name="submitvisit" type="submit">Send Form</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

  </main>

<?php include "footer.php";?>