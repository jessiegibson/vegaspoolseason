<?php
/*
Template Name: Bottle Service
*/
get_header('landing'); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="container clearfix titlecontainer">

    <!-- Page Title
    ================================================== -->
    <div class="pagetitlewrap">
        <div class="mobileclear"></div>
        <span class="description">
          <?php if ($tagline_text = get_post_meta($post->ID, 'ag_page_desc', $single = true)) { echo '<p>' . $tagline_text . '</p>'; } ?>
        </span>
    </div>
    <div class="clear"></div>

    <!-- Page Content
      ================================================== -->
    <div class="maincontent bottleservice">
        <div class="col-md-6">
          <?php the_thumbnail(); ?>
          <?php the_content(); ?>
        </div>
        <div class="col-md-6">
          <?php gravity_forms(2,false,false,false); ?>
        <?php endwhile; else :?>
        <!-- Else nothing found -->
        <h2><?php _e('Error 404 - Not found.', 'framework'); ?></h2>
        <p><?php _e("Sorry, but you are looking for something that isn't here.", 'framework'); ?></p>
       <!--BEGIN .navigation .page-navigation -->
        <?php endif; ?>

        <div class="clear"></div>
    </div>

    <div class="clear"></div>
</div>
<?php get_footer('landing'); ?>
