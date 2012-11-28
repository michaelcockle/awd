<?php
$page_title = "Contact us";
$page_extra = "contact";
$page_description = "How to contact Axisweb Developments and where to find us";
include_once "inc/header.html";
?>


<div class="container">
    <div class="row"> 
        <div class="span12 ">
            <h2 class="strapline">If you’d like to talk through your project or chat about how we can help, please get in touch:</h2> 
        </div>
    </div>
</div>

<div id="content" class="container">
              <!-- <div class="page-header"><h1><?php echo $page_title; ?></h1></div> -->
    <div class="row"> 
        <div class="span12 ">
            <div class="row"> 
              <!---->      
                <div class="span6">
                    
                    <section>
                        
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

                            <div class="control-group">
                            <label class="control-label" for="inputName">Message</label>
                            <div class="controls">
                            <textarea rows="6" name="enquiry" placeholder="Message"></textarea>
                            </div>
                            </div>

                            <div class="control-group">
                            <div class="controls">
                            <input type="submit" value="Submit" class="btn">
                            </div>
                            </div>
                        </form>
                    </section>
                </div>        
               
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3rcfYpgWe6lixKbXDTgLf0ye8BxCFQBs&amp;sensor=false"></script>

                <!-- <script type="text/javascript">
                  function initialize() {
                    var mapOptions = {
                      center: new google.maps.LatLng(53.7944791, -1.5374265),
                      zoom: 16,
                      mapTypeId: google.maps.MapTypeId.ROADMAP
                    };
                    var map = new google.maps.Map(document.getElementById("map_canvas"),
                        mapOptions);
                  }
                  
                </script> -->

                
                <!-- <script>
                  function initialize() {
                    var myLatlng = new google.maps.LatLng(53.7944791, -1.5374265);
                    var mapOptions = {
                      zoom: 16,
                      center: myLatlng,
                      mapTypeId: google.maps.MapTypeId.ROADMAP
                    }
                
                    var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
                
                    var contentString = '<div id="content">'+
                        '<div id="siteNotice">'+
                        '</div>'+
                        '<h3 id="firstHeading" class="firstHeading">Axisweb Developments</h3>'+
                        '<div id="bodyContent">'+
                        '<p><b>XXXX</b>, xxxxx ' +
                        '</div>'+
                        '</div>';
                
                    var infowindow = new google.maps.InfoWindow({
                        content: contentString,
                        maxWidth: 200
                    });
                
                    var marker = new google.maps.Marker({
                        position: myLatlng,
                        map: map,
                        title: 'Uluru (Ayers Rock)'
                    });
                    google.maps.event.addListener(marker, 'click', function() {
                      infowindow.open(map,marker);
                    });
                  }
                
                </script> -->
                
                
                
                <!-- <script>
                  function initialize() {
                    var fenway = new google.maps.LatLng(53.7946285, -1.5374008);
                
                    // Note: constructed panorama objects have visible: true
                    // set by default.
                    var panoOptions = {
                      position: fenway,
                      addressControlOptions: {
                        position: google.maps.ControlPosition.BOTTOM
                      },
                      linksControl: false,
                      panControl: false,
                      zoomControlOptions: {
                        style: google.maps.ZoomControlStyle.SMALL
                      },
                      enableCloseButton: false
                    };
                
                    var panorama = new google.maps.StreetViewPanorama(
                        document.getElementById('map_canvas'), panoOptions);
                  }
                </script> -->
                
                
                
                <script>

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
                
                <div class="span6">
                    <div id="map_canvas" ></div>
                    <div id="pano" style=" width: 400px; height: 300px;"></div>
                </div>
                
            </div>
        </div>
    </div>

</div><!-- end container --> 


<div class="container">
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
</div>

 

<?php include_once "inc/footer.html"; ?>