<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once $_SERVER['DOCUMENT_ROOT']."public/header.php";
if(sizeof($_POST)){
    if((isset($_POST['name']) || isset($_POST['email']) || isset($_POST['subject']) || isset($_POST['message']))){
        if(preg_match("#^[^0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$#", $_POST['email'])){
            $name = addslashes($_POST['name']);
            $email = addslashes($_POST['email']);
            $subject = addslashes($_POST['subject']);
            $message = addslashes($_POST['message']);
            if(strlen($name) && strlen($email) && strlen($subject) && strlen($message)){
                $sql = "INSERT INTO feedbacks (name, email, subject, message) VALUES (\"$name\",\"$email\",\"$subject\",\"$message\")";
                if(mysqli_query($conn, $sql)){
                    $succes = "Feedback Successfully Sended!";
                }else{
                    $error['main'] = "Please fill all required fields";
                }
            }else {
                $error['main'] = "Please fill all required fields";
            }
        }else {
            $error['main'] = "Invalid Email address";
        }
    }else {
        $error['main'] = "Please fill all required fields";
    }
}
?>
<div class="container d-flex justify-content-center">
        <div class="row">
            <div class="col-md-10">
                <h2 align="center">Feedback Page</h2>
            </div>
            <?php
                if(isset($succes)){
                    echo"
                        <div class='col-md-10'>
                            <div class='alert alert-success' role='alert'>
                                {$succes}
                            </div>
                        </div>
                    ";
                    die();
                }
            ?>
        </div>
    
</div>
    
    <!-- ================ start banner area ================= -->
    <!-- <section class="blog-banner-area" id="contact">
        <div class="container h-100">
            <div class="blog-banner">
                <div class="text-center">
                    <h1>Contact Us</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
            </ol>
          </nav>
                </div>
            </div>
    </div>
    </section> -->
    <!-- ================ end banner area ================= -->

    <!-- ================ contact section start ================= -->
  <section class="section-margin--small">
    <div class="container">
      <!-- <div class="d-none d-sm-block mb-5 pb-4">
        <div id="map" style="height: 420px;"></div>
        <script>
          function initMap() {
            var uluru = {lat: -25.363, lng: 131.044};
            var grayStyles = [
              {
                featureType: "all",
                stylers: [
                  { saturation: -90 },
                  { lightness: 50 }
                ]
              },
              {elementType: 'labels.text.fill', stylers: [{color: '#A3A3A3'}]}
            ];
            var map = new google.maps.Map(document.getElementById('map'), {
              center: {lat: -31.197, lng: 150.744},
              zoom: 9,
              styles: grayStyles,
              scrollwheel:  false
            });
          }
          
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpfS1oRGreGSBU5HHjMmQ3o5NLw7VdJ6I&callback=initMap"></script>
        
      </div> -->
        


      <div class="row">
        <div class="col-md-4 col-lg-3 mb-4 mb-md-0">
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-home"></i></span>
            <div class="media-body">
              <h3>California United States</h3>
              <p>Santa monica bullevard</p>
            </div>
          </div>
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-headphone"></i></span>
            <div class="media-body">
              <h3><a href="tel:454545654">00 (440) 9865 562</a></h3>
              <p>Mon to Fri 9am to 6pm</p>
            </div>
          </div>
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-email"></i></span>
            <div class="media-body">
              <h3><a href="mailto:support@colorlib.com">support@colorlib.com</a></h3>
              <p>Send us your query anytime!</p>
            </div>
          </div>
        </div>
        <div class="col-md-8 col-lg-9">
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-contact contact_form" method="post" id="contactForm" novalidate="novalidate">
            <?=printIfError('main')?>
            <div class="row">
              <div class="col-lg-5">
                <div class="form-group">
                  <input class="form-control" name="name" id="name" type="text" placeholder="Enter your name" value="<?=$_POST['name'] ?? ''?>" required="">
                </div>
                <div class="form-group">
                  <input class="form-control" name="email" id="email" type="email" placeholder="Enter email address" <?=$_POST['email'] ?? ''?> required="">
                </div>
                <div class="form-group">
                  <input class="form-control" name="subject" id="subject" type="text" placeholder="Enter Subject" <?=$_POST['subject'] ?? ''?> required="">
                </div>
              </div>
              <div class="col-lg-7">
                <div class="form-group">
                    <textarea class="form-control different-control w-100" name="message" id="message" cols="30" rows="5" placeholder="Enter Message" required=""> <?=$_POST['message'] ?? ''?></textarea>
                </div>
              </div>
            </div>
            <div class="form-group text-center text-md-right mt-3">
              <button type="submit" class="button button--active button-contactForm">Send Message</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
    <!-- ================ contact section end ================= -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'].'public/footer.php'
?>