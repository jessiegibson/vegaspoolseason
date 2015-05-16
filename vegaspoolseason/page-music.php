<?php
/*
Template Name: Page - Music
*/
 ?>
 
<?php get_header(); ?>
<?php 
    /* Get All Initial Variables */
    if ( !($columns = of_get_option('of_column_number') ) ) { $columns = 'twocol'; } else { $columns = of_get_option('of_column_number'); } 
    $thisCat = get_category(get_query_var('cat'),false);
    $cur_cat_id = $thisCat->cat_ID;
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="container clearfix titlecontainer">
  
    <!-- Page Title
    ================================================== -->
    <div class="pagetitlewrap">
        <h1 class="pagetitle">
            <?php wp_title("",true);
            if(!wp_title("",false)) { echo bloginfo( 'title');} ?>
        </h1>
        <div class="mobileclear"></div>
        <span class="description">
          <?php if ($tagline_text = get_post_meta($post->ID, 'ag_page_desc', $single = true)) { echo '<p>' . $tagline_text . '</p>'; } ?>
        </span>
    </div>
    <div class="clear"></div>

    <!-- Page Content
      ================================================== -->
    <div class="maincontent page">
        <?php the_content(); ?>
        <?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

        <?php endwhile; else :?>
        <!-- Else nothing found -->
        <h2><?php _e('Error 404 - Not found.', 'framework'); ?></h2>
        <p><?php _e("Sorry, but you are looking for something that isn't here.", 'framework'); ?></p>
       <!--BEGIN .navigation .page-navigation -->
        <?php endif; ?>
        
        <div class="clear"></div>
    
        <!-- Page Content
    ================================================== -->


                <?php 
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $postsperpage = get_option('posts_per_page');

                    query_posts( 
                        array(
                            'ignore_sticky_posts' => 1, 
                            'posts_per_page' => $postsperpage, 
                            'paged' => $paged, 
                            'cat' => $cur_cat_id
                        )
                    ); ?>

            <?php 
            //Two Column or One Column Layout
            switch ($columns) {
                case ('twocol'):
                    // Two Column Layout
                    get_template_part('functions/twocol'); 
                break;
                case ('onecol'):
                    // One Column Layout
                    get_template_part('functions/onecol');
                break;
                default:
                    // Two Column Layout
                    get_template_part('functions/twocol'); 
                break;

            } ?>

            <!-- Pagination
            ================================================== -->        
            <div class="pagination">
                <?php
                    global $wp_query;

                    $big = 999999999; // need an unlikely integer

                    echo paginate_links( array(
                        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                        'format' => '?paged=%#%',
                        'current' => max( 1, get_query_var('paged') ),
                        'total' => $wp_query->max_num_pages
                    ) );
                ?>   
                <div class="clear"></div>
            </div> <!-- End pagination -->                
                  
        </div><!-- End articlecontainer -->


    <!-- Sidebar
      ================================================== -->      
    <div class="sidebar">
        <?php  /* Widget Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Page Sidebar') ) ?>
    </div>

    <div class="clear"></div>

</div>
<?php get_footer(); ?>