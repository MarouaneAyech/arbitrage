<?php
// Template Name: Page normale
get_header();
?>
<style>
    .large-width-image {
        max-width: 100%;
        min-height: 300px;
        background-size: cover;
    }
</style>
<div style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/top-image-page-normale.jpg'); top: 0px; left: 0px; background-repeat: no-repeat; background-position: center; background-size: cover; min-height: 300px;">

</div>

<div class="container">
    <?php the_content(); ?>
    
</div>

<div class="fixtab" style="height: 100px; width: 200px;">
    <a href="<?php echo esc_url(home_url('/')); ?>"> 
    <img src="<?php echo get_template_directory_uri(); ?>/images/logo IiMA_small.png" width="100%" height="100%">
    <!-- <p class="m-0" style="text-align: center; margin-bottom: 30px;">IIMA</p> -->
    </a>
</div>

<?php
get_footer();
?>
