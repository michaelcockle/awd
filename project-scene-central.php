<?php
$page_title = "Scene Central";
$page_extra = "projects";
$page_description = "";
include_once "inc/header.html";
?>

<div class="container">
    <section class="row">
        <div class="span12">
            <h1><?php include "inc/breadcrumb.php"; ?> <?php echo $page_title; ?> <small>( Web, Strategy )</small></h1>
            
            <div class="imgSlider flexslider">
                <ul class="slides">
                    <li>
                        <img src="img/work/scene-central.jpg" alt="Scene Central 1">
                    </li>
                    
                    <li>
                        <img src="img/work/scene-central-2.jpg" alt="Scene Central 2">
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section class="row">
        <div class="span12">
            <div class="row">
                <div class="span6">
                    <h4>The Brief:</h4>
                    <p>Audiences Central wanted to completely re-develop their existing events listing and mailing list service. </p>
                </div>
                <div class="span6">
                    <h4>What we did:</h4>
                    <p>The challenge for this project was to re-skin an existing site (digyorkshire.com) and import existing mailing list data for more than 25,000 subscribers within a very short period of time. We rose to the challenge and after only two weeks of system “cloning”, data-transfer and re-skinning, Scene Central was launched in July 2009. </p>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include_once "inc/footer.html"; ?>