<?php
$page_title = "Contact us";
$page_extra = "contact";
$page_description = "How to contact Axisweb Developments and where to find us";
include_once "inc/header.html";
?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3rcfYpgWe6lixKbXDTgLf0ye8BxCFQBs&amp;sensor=false"></script>   
<script>
    window.onload = function() { 
       initialize(); 
    } 
  function initialize() {
    var axisLocation = new google.maps.LatLng(53.7946285, -1.5374008);
    var mapOptions = {
      center: axisLocation,
      zoom: 14,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(
        document.getElementById('map_canvas'), mapOptions);

    var panoramaOptions = {
      position: axisLocation,
      addressControl: false,
    /*
      addressControlOptions: {
        position: google.maps.ControlPosition.BOTTOM,
        //description: "Google Sydney - Reception"
      },
    */
      linksControl: false,
      panControl: false,
      zoomControlOptions: {
        style: google.maps.ZoomControlStyle.SMALL
      },
      enableCloseButton: false,
      pov: {
        heading: 200,
        pitch: 0,
        zoom: 1
      }
    };
    var panorama = new  google.maps.StreetViewPanorama(document.getElementById('pano'),panoramaOptions);
    map.setStreetView(panorama);
  }
</script>

<div class="container">
    <div class="row"> 
        <div class="span12 ">
            <h2 class="strapline">If you’d like to talk through your project or chat about how we can help, please get in touch:</h2> 
            <div class="row"> 
                <section class="span6">
                    <form class="form-horizontal" action="contact.php" method="POST">
                        <div class="control-group">
                            <label class="control-label" for="inputName">Name</label>
                            <div class="controls">
                            <input type="text" name="fullname" id="inputName" placeholder="Name">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="inputEmail">Email</label>
                            <div class="controls">
                            <input type="text" name="email" id="inputEmail" placeholder="Email">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="inputPhone">Phone</label>
                            <div class="controls">
                            <input type="text" name="telephone" id="inputPhone" placeholder="Phone">
                            </div>
                        </div>

                    </form>
                </section>
                
                <section class="span6">
                    
                        <div class="control-group">
                            <label class="control-label" for="inputName">Message</label>
                            <div class="controls">
                            <textarea rows="6" name="enquiry" placeholder="Message"></textarea>
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="controls">
                            <input id="contactBtn" type="submit" value="Submit" class="btn">
                            </div>
                        </div>
                    
                </section>
            </div>
            
            
            <div id="map" class="row"> 
                
                <h2 class="span12">We live in leeds <br><small>Studio 17/18, 46 The Calls Leeds, LS2 7EY</small></h2>
                
                <section class="span6">
                    <div id="map_canvas" ></div>
                </section>
                <section class="span6">
                    <div id="pano"></div>
                </section>
            </div>
            
            
            
            
        </div>
    </div>

    <div class="row"> 
        <div class="span12 ">
            <?php 
                if(isset($_POST['email'])) {
                     
                    $email_to = "michael@axisweb.org";
                    $email_subject = "AWD Enquiry";
                    $fullname = $_POST['fullname']; // required
                    $email_from = $_POST['email']; // required
                    $telephone = $_POST['telephone']; // not required
                    $enquiry = $_POST['enquiry']; // required
                     
                    function clean_string($string) {
                        $bad = array("content-type","bcc:","to:","cc:","href");
                        return str_replace($bad,"",$string);
                    }

                    $error_message = "";
                    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

                    if(!preg_match($email_exp,$email_from)) {
                        $error_message .= 'Please enter a valid email address';
                    }

                    if(strlen($error_message) > 0) {
                        echo "<h3 class='alert alert-error'>" .$error_message ."</h3>";
                    }

                    else {
                      $error_message = "";

                      $email_message .= "Name: ".clean_string($fullname)."\n";
                      $email_message .= "Email: ".clean_string($email_from)."\n";
                      $email_message .= "Telephone: ".clean_string($telephone)."\n";
                      $email_message .= "Enquiry: ".clean_string($enquiry)."\n";
                    
                       // create email headers
                      $headers = 'From: '.$email_from."\r\n".
                      'Reply-To: '.$email_from."\r\n" .
                      'X-Mailer: PHP/' . phpversion();
                      $send_contact = mail($email_to, $email_subject, $email_message, $headers); 
                      // Check, if message sent to your email
                      // display message "We've recived your information"
                      if($send_contact) {
                        echo "<h3 class='alert alert-success'>Thank you for contacting us. We will be in touch with you very soon.</h3>";

                      }
                    }
                }
            ?>
        </div>
    </div>
</div><!-- end container --> 
 

<?php include_once "inc/footer.html"; ?>