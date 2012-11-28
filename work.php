<?php
$page_title = "Work";
$page_extra = "work";
$page_description = "";
include_once "inc/header.html";
?>

<div class="container">
    <div class="row">
        <div class="span12">

<h2 class="strapline">Here’s a selection of our work. And please <a href="/contact.php">get in touch</a> if you’d like to know more.</h2>


            <section id="options" >

              <ul id="filters" class="option-set clearfix" data-option-key="filter">
                <li><a href="#filter" data-option-value="*" class="selected">All</a></li>
                <li><a href="#filter" data-option-value=".web">Web</a></li>
                <li><a href="#filter" data-option-value=".mobile">Mobile</a></li>
                <li><a href="#filter" data-option-value=".strategy">Strategy</a></li>
                <li><a href="#filter" data-option-value=".training">Training</a></li>
                <li><a href="#filter" data-option-value=".film">Film</a></li>
                <li><a href="#filter" data-option-value=".interactive">Digital exhibition</a></li>

                <!-- <li><a href="#filter" data-option-value=".alkali, .alkaline-earth">XXXX</a></li>
                <li><a href="#filter" data-option-value=":not(.transition)">XXXX</a></li>
                <li><a href="#filter" data-option-value=".metal:not(.transition)">XXXX</a></li> -->

              </ul>

            </section> <!-- #options -->
        </div>
    </div>  
</div>
<!-- data-category="alkaline-earth" -->
<div id="container" class="container">
    <div class="row">
        <div class="span12">
      
          <!-- 
            <a id="btnProjCane" class="element web mobile" href="">
                <img src="img/work/contemporary-art-northeast.jpg" alt="Contemporary Arts North East">
                <h2 class="name">Contemporary Arts North East</h2>
            </a> 
           -->

           <!-- Animation speed goes slower when using a link ?  -->
            
            <div id="btnProjArtYork" class="element web mobile strategy">
              <img src="img/work/art-in-yorkshire.jpg" alt="Art in Yorkshire">
              <h2 class="name">Art in Yorkshire</h2>
            </div>

            <div id="btnProjPhoto" class="element web strategy">
              <img src="img/work/photostore.jpg" alt="Photostore">
              <h2 class="name">Photostore</h2>
            </div>

            <div id="btnProjCane" class="element web mobile strategy">
              <img src="img/work/contemporary-art-northeast.jpg" alt="Contemporary Arts North East">
              <h2 class="name">Contemporary Art North East</h2>
            </div>
                  
            <div id="btnProjOwnArt" class="element film">
              <img src="img/work/own-art.jpg" alt="Own Art films">
              <h2 class="name">Own Art films</h2>
            </div>

            <div id="btnProjOrmand" class="element interactive">
              <img src="img/work/great-ormand-street.jpg" alt="Great Ormand street Hospital">
              <h2 class="name">Great Ormond Street Hospital</h2>
            </div>
                  
            <div id="btnProjDigYork" class="element web strategy">
              <img src="img/work/dig-yorkshire.jpg" alt="Dig Yorkshire">
              <h2 class="name">Dig Yorkshire</h2>
            </div>
                  
            <div id="btnProjSceneCentral" class="element web strategy">
              <img src="img/work/scene-central.jpg" alt="Scene Central">
              <h2 class="name">Scene Central</h2>
            </div>
                
            <div id="btnProjCane2" class="element training">
              <img src="img/work/contemporary-arts-north-east-workshop.jpg" alt="Contemporary Arts North East workshop">
              <h2 class="name">Value Added: making and presenting content for the web</h2>
              <!-- <h2 class="name">Value Added: making and presenting content for the web</h2> -->
            </div>
                  
            <div id="btnProjApn" class="element web">
              <img src="img/work/all-points-north.jpg" alt="All Points North">
              <h2 class="name">All Points North</h2>
            </div>
                  
            <div id="btnProjWaysLook" class="element web mobile">
              <img src="img/work/ways-of-looking.jpg" alt="Ways of Looking">
              <h2 class="name">Ways of Looking</h2>
            </div>
            
            <div id="btnProjHouton" class="element film">
              <h2 class="name">Interview with Mark Houghton</h2>
              <img src="img/work/mark-houghton.jpg" alt="Mark Houghton Interview">

            </div>


            
            <div id="btnProjCollectors" class="element film">
              <h2 class="name">Meet the Collectors</h2>
              <img src="img/work/meet-the-collectors.jpg" alt="Meet the Collectors">
            </div>
                  


        </div>
    </div>
</div>

<script src="js/jquery.isotope.min.js" defer="defer"></script>
<?php include_once "inc/footer.html"; ?>



