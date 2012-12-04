<?php
$page_title = "All Points North";
$page_extra = "projects";
$page_description = "";
include_once "inc/header.html";
?>

<div id="content" class="container">
    <section class="row">
        <div class="span12">
            <h1><?php include "inc/breadcrumb.php"; ?> <?php echo $page_title; ?> <small>( Web )</small></h1>
            
            <div class="imgSlider flexslider">
                <ul class="slides">
                    <li>
                        <img src="img/work/all-points-north.jpg" alt="All Points North">
                    </li>
                    
                    <li>
                        <img src="img/work/all-points-north-gallery-page.jpg" alt="All Points North Gallery Page">
                        </li>
                    <li>
                        <img src="img/work/all-points-north-about.jpg" alt="All Points North About Page">
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="row project">
        <div class="span12">
            <div class="row">
                <div class="span6">
                    <h4>The Brief:</h4>
                    <p>Create a website to profile the strength of contemporary art events and festivals happening across the North of England during the autumn of 2011.</p>
                </div>
                <div class="span6">
                    <h4>What we did:</h4>
                    <p>All Points North (APN) was an initiative centred around six satellite festivals, exhibitions and prizes including the Turner Prize, New Contemporaries and the Northern Art Prize.</p>
                    <p>Our development window was only three weeks, to coincide with the opening of New Contemporaries in Sheffield.</p>
                    <p>Launched on budget and on time, the microsite documented the wealth of contemporary art activity taking place across the region and enabled commentary via integrated social media channels.</p>
                </div>                
            </div>
        </div>
    </section>
</div>
<?php include_once "inc/footer.html"; ?>
