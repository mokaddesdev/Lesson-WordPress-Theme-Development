<?php
/**
 * Template Name: Start Leraning Section
 * 
 * @package lessonlms
 */
?>

<section class="start-learning-section">
    <div class="container">
        <div class="start-learning-breadcrumb">
            <a href="">Home</a>
            <span>
                /
            </span>
            <span>
                <a href="">Dashboard</a>
            </span>
        </div>
    </div>

</section>

<!-- start laerning resource -->
 <section class="start-learning-section">
    <div class="container">
        <!-- left video and description -->
         <div class="left-vedio-description">
            <div class="show-video">
<iframe 
  width="860" 
  height="515" 
  src="https://player.vimeo.com/video/1181424234"
  frameborder="0"
  allow="autoplay; fullscreen; picture-in-picture"
  allowfullscreen>
</iframe>
            </div>
            <!-- course description -->
             <div class="course-description">
                <h2>
                    <?php echo esc_html( get_the_title() ); ?>
                </h2>
                <p>
                    <?php echo esc_html( get_the_content() ); ?>
                </p>
             </div>
         </div>
    </div>
 </section>