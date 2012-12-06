<?php
$page_title = "Work";
$page_extra = "work";
$page_description = "";
//$page_state = $_GET['page-state'];
include_once "inc/header.html";
?>





<div class="container">

    <div class="row">
        <section id="options" class="span12">
        <h2 class="strapline">Here’s a selection of our work. And please <a href="/contact.php">get in touch</a> if you’d like to know more.</h2>
          <ul id="filters" class="option-set clearfix" data-option-key="filter">
            <li><a href="#filter" data-option-value="*" class="selected">All</a></li>
            <li><a href="#filter" data-option-value=".web">Web</a></li>
            <li><a id="mob" href="#filter" data-option-value=".mobile">Mobile</a></li>
            <!-- <li><a href="#filter" data-option-value=".strategy">Strategy</a></li> -->
            <li><a href="#filter" data-option-value=".training">Training</a></li>
            <li><a href="#filter" data-option-value=".film">Film</a></li>
            <li><a href="#filter" data-option-value=".interactive">Interactive</a></li>
          </ul>
        </section>
    </div>  

    <div id="container" class="row">
        <div class="span12">

           <!-- Animation speed goes slower when using a link ?  -->
            
            <figure id="btnProjArtYork" class="element web mobile strategy">
              <img src="img/work/art-in-yorkshire.jpg" alt="Art in Yorkshire">
              <figcaption class="name">Art in Yorkshire</figcaption>
            </figure>

            <figure id="btnProjPhoto" class="element web strategy">
              <img src="img/work/photostore.jpg" alt="Photostore">
              <figcaption class="name">Photostore</figcaption>
            </figure>

            <figure id="btnProjCane" class="element web mobile strategy">
              <img src="img/work/contemporary-art-northeast.jpg" alt="Contemporary Arts North East">
              <figcaption class="name">Contemporary Art North East</figcaption>
            </figure>
                  
            <figure id="btnProjOwnArt" class="element film">
              <img src="img/work/own-art.jpg" alt="Own Art films">
              <figcaption class="name">Own Art films</figcaption>
            </figure>

            <figure id="btnProjOrmand" class="element interactive">
              <img src="img/work/great-ormand-street.jpg" alt="Great Ormand street Hospital">
              <figcaption class="name">Great Ormond Street Hospital</figcaption>
            </figure>
                  
            <figure id="btnProjDigYork" class="element web strategy">
              <img src="img/work/dig-yorkshire.jpg" alt="Dig Yorkshire">
              <figcaption class="name">Dig Yorkshire</figcaption>
            </figure>
                  
            <figure id="btnProjSceneCentral" class="element web strategy">
              <img src="img/work/scene-central.jpg" alt="Scene Central">
              <figcaption class="name">Scene Central</figcaption>
            </figure>
                
            <figure id="btnProjCane2" class="element training">
              <img src="img/work/contemporary-arts-north-east-workshop.jpg" alt="Contemporary Arts North East workshop">
              <figcaption class="name">Value Added: making and presenting content for the web</figcaption>
              <!-- <figcaption class="name">Value Added: making and presenting content for the web</figcaption> -->
            </figure>
                  
            <figure id="btnProjApn" class="element web">
              <img src="img/work/all-points-north.jpg" alt="All Points North">
              <figcaption class="name">All Points North</figcaption>
            </figure>
                  
            <figure id="btnProjWaysLook" class="element web mobile">
              <img src="img/work/ways-of-looking.jpg" alt="Ways of Looking">
              <figcaption class="name">Ways of Looking</figcaption>
            </figure>
            
            <figure id="btnProjHouton" class="element film">
              <figcaption class="name">Interview with Mark Houghton</figcaption>
              <img src="img/work/mark-houghton.jpg" alt="Mark Houghton Interview">

            </figure>
            
            <figure id="btnProjCollectors" class="element film">
              <figcaption class="name">Meet the Collectors</figcaption>
              <img src="img/work/meet-the-collectors.jpg" alt="Meet the Collectors">
            </figure>

        </div>
    </div>
</div>

<!-- <script src="js/jquery.isotope.min.js" defer="defer"></script> -->
<script src="js/jquery.isotope.min.js"></script>
<script type="text/javascript">

/*
        function getUrlVars()
          {
              var vars = [], hash;
              var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
              for(var i = 0; i < hashes.length; i++)
              {
                  hash = hashes[i].split('=');
                  vars.push(hash[0]);
                  vars[hash[0]] = hash[1];
              }
              return vars;
          }


        // Function to get query string from home page to set filters ----------
        function getParameterByName(name)
        {
          name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
          var regexS = "[\\?&]" + name + "=([^&#]*)";
          var regex = new RegExp(regexS);
          var results = regex.exec(window.location.search);
          if(results == null)
            return "";
          else
            return decodeURIComponent(results[1].replace(/\+/g, " "));
        }



        $(function(){
              
            var $container = $('#container');

            $container.isotope({
              itemSelector : '.element'
            });
            
            var $optionSets = $('#options .option-set'), $optionLinks = $optionSets.find('a');

            $optionLinks.click(function(){
              var $this = $(this);
              // don't proceed if already selected
              if ( $this.hasClass('selected') ) {
                return false;
              }
              var $optionSet = $this.parents('.option-set');
              $optionSet.find('.selected').removeClass('selected');
              $this.addClass('selected');

              // make option object dynamically, i.e. { filter: '.my-filter-class' }
              var options = {},
                  key = $optionSet.attr('data-option-key'),
                  value = $this.attr('data-option-value');
              // parse 'false' as false boolean
              value = value === 'false' ? false : value;
              options[ key ] = value;
              if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
                // changes in layout modes need extra logic
                changeLayoutMode( $this, options )
              } else {
                // otherwise, apply new options
                $container.isotope( options );
              }

              return false;


               
                    //var getQueryString = getUrlVars()["page-state"];
                    //console.log(getQueryString);
               
                var filterFromQuerystring = 'film'; // getParameterByName('filter'); data-slidenumber="<?php echo $page_state; ?>"
                $('a[data-option-value=".' + filterFromQuerystring  + '"]').click();
              
        });

*/

    // bUTTONS 
    $('#btnProjCane').click(function (e) {
        e.preventDefault();
        window.location = "project-cane-web.php";
    });

    $('#btnProjOwnArt').click(function (e) {
    e.preventDefault();
    window.location = "project-own-art-films.php";
    });

    $('#btnProjOrmand').click(function (e) {
    e.preventDefault();
    window.location = "project-great-ormand-street.php";
    });    

    $('#btnProjDigYork').click(function (e) {
    e.preventDefault();
    window.location = "project-dig-yorkshire.php";
    });

    $('#btnProjCane2').click(function (e) {
    e.preventDefault();
    window.location = "project-contemporary-art-north-east-workshop.php";
    });

    $('#btnProjApn').click(function (e) {
    e.preventDefault();
    window.location = "project-all-points-north.php";
    });

    $('#btnProjWaysLook').click(function (e) {
    e.preventDefault();
    window.location = "project-ways-of-looking.php";
    });

    $('#btnProjHouton').click(function (e) {
    e.preventDefault();
    window.location = "project-mark-houton.php";
    });

    $('#btnProjArtYork').click(function (e) {
    e.preventDefault();
    window.location = "project-art-in-yorkshire.php";
    });

    $('#btnProjPhoto').click(function (e) {
    e.preventDefault();
    window.location = "project-photostore.php";
    });

    $('#btnProjCollectors').click(function (e) {
    e.preventDefault();
    window.location = "project-meet-the-collectors.php";
    });

    $('#btnProjSceneCentral').click(function (e) {
    e.preventDefault();
    window.location = "project-scene-central.php";
    });



</script>


<?php include_once "inc/footer.html"; ?>



