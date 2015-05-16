<?php get_header(); ?>
<!-- toparea -->
<div class="djHeader" id="djDetails">
<!-- Page Title, Category, Post Information ================================================== -->
    <h1 class="blogtitle entry-title" style="margin:0;" itemprop="itemReviewed" itemscope itemtype="http://schema.org/Thing">
      <span itemprop="name">
        <?php wp_title("",true); ?>
      </span>
    </h1>
    <div class="clear"></div>

<div class="dj"><div class="djHeader" id="djImage">
<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
<div><?php the_post_thumbnail('smallfeatured'); ?></div>
<?php }; ?></div>
    <div class="categories"><?php echo ag_get_cats(3); ?>
    </div>
  <?php
		$cfv = do_shortcode('[ct id="ct_dj_faceboo_text_00b6"]');
			if( ! empty($cfv) ): ?>
			<a href="<?php echo do_shortcode('[ct id="ct_dj_faceboo_text_00b6" property="title | description | value"]'); ?>" target="_blank"><img src="http://vegaspoolseason.com/wp-content/uploads/2013/04/facebook.png" alt="Facebook" />
		<?php endif; ?>
		<?php
			$cfv = do_shortcode('[ct id="ct id="ct_dj_twitter_text_db11"]');
			if( ! empty($cfv) ): ?>
			<a href="<?php echo do_shortcode('[ct id="ct_dj_twitter_text_db11" property="title | description | value"]'); ?>" target="_blank"><img src="http://vegaspoolseason.com/wp-content/uploads/2013/04/twitter.png" alt="Twitter" />
		<?php endif; ?>
    <?php
			$cfv = do_shortcode('[ct id="ct_dj_website_text_4f16"]');
			if( ! empty($cfv) ): ?>
			<a href="<?php // echo do_shortcode('[ct id="ct_dj_website_text_4f16" property="title | description | value"]'); ?>" target="_blank"><img src="http://vegaspoolseason.com/wp-content/uploads/2013/04/website.png" alt="Website" />
         <?php endif; ?>
        <div class="clear"></div></a><!-- social media links - end -->
</div>
<div class="djHeader" id="djExtra">
<!-- Custom fields here for testing -->
       <div id="djLogo"><img src="<?php //echo do_shortcode('[ct id="ct_dj_logo_text_563f" property="title | description | value"]'); ?>" width="150" class="alignnone size-medium wp-image-560" /></div>
       <div style="padding:10px;"><?php echo do_shortcode('[ct id="_ct_textarea_511d087d85c3f" property="title | description | value"]'); ?></div><!-- Code for Soundcloud -->
</div>
</div>
<div style="clear:both;padding-bottom:8px;"></div><!-- top area end -->
<?php
  /* Get All Initial Variables */
  $review_post = get_post_meta(get_the_ID(), 'ag_review_post', true);  // check if review post
  $auto_play = get_post_meta(get_the_ID(), 'ag_auto_play', true);  // check for autoplay
  $review_place = get_post_meta(get_the_ID(), 'ag_review_place', true);  // check review placement
  $author_style = get_post_meta(get_the_ID(), 'ag_author_style', true);  // check author style
  $share_style = get_post_meta(get_the_ID(), 'ag_share_style', true);  // check share style
  $slide_crop = get_post_meta(get_the_ID(), 'ag_slide_crop', true); if ($slide_crop == 'Yes' || $slide_crop == 'yes') { $slide_crop = 'post'; } else { $slide_crop = 'postnc'; } // check if review post
  if ( !($related = of_get_option('of_related_posts') ) ) { $related = 'no'; } else { $related = of_get_option('of_related_posts'); }
  setPostViews(get_the_ID());  // count the number of views for popular posts
?>
<!-- Page Content ================================================== -->
<div class="container clearfix">
  <div class="blogpost maincontent"><div class="clear"></div> <!-- for stupid ie7 -->
    <?php if (have_posts()) : while (have_posts()) : the_post();  ?>
<!-- Post Image, Video, Content ================================================== -->
        <div <?php if ($review_post == 'Yes') { echo 'itemscope itemtype="http://schema.org/Review"'; } ?> <?php post_class(); ?> id="<?php echo get_the_ID(); ?>">
<!-- Post Information ================================================== -->
        <?php /* If Video Post -----------------------------------------------------------------------------------*/
        $video_url = get_post_meta(get_the_ID(), 'ag_video_url', true);
        if ($video_url != '') : $vendor = parse_url($video_url); ?>
        <div class="featuredimage">
            <div class="videocontainer">
                <?php if ($vendor['host'] == 'www.youtube.com' || $vendor['host'] == 'youtu.be' || $vendor['host'] == 'www.youtu.be' || $vendor['host'] == 'youtube.com'){ // If from Youtube.com ?>
                    <?php if ($vendor['host'] == 'www.youtube.com') { parse_str( parse_url( $video_url, PHP_URL_QUERY ), $my_array_of_vars ); ?>
                        <iframe width="620" height="350" src="http://www.youtube.com/embed/<?php echo $my_array_of_vars['v']; ?>?modestbranding=1;rel=0;showinfo=0;autoplay=0;autohide=1;yt:stretch=16:9;wmode=transparent;" frameborder="0" allowfullscreen></iframe>
                    <?php } else { ?>
                        <iframe width="620" height="350" src="http://www.youtube.com/embed<?php echo parse_url($video_url, PHP_URL_PATH);?>?modestbranding=1;rel=0;showinfo=0;autoplay=0;autohide=1;yt:stretch=16:9;wmode=transparent;" frameborder="0" allowfullscreen></iframe>
                    <?php } } ?>
                <?php if ($vendor['host'] == 'vimeo.com'){ // If from Vimeo.com ?>
                    <iframe src="http://player.vimeo.com/video<?php echo parse_url($video_url, PHP_URL_PATH);?>?title=0&amp;byline=0&amp;portrait=0" width="620" height="350" frameborder="0"></iframe>
                <?php } ?> </div></div>
        <?php else :
/* If Not a Video Post ===================== */
        $crop = get_option('of_slide_crop'); $popup = get_option('of_slideshow_popup'); // Get number of slides or set the default
        if ( $thumbnum = of_get_option('of_thumbnail_number') ) { $thumbnum = ($thumbnum + 1); } else { $thumbnum = 7;}
          if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : // if the post has a WP 2.9+ Thumbnail
          get_post_info($slide_crop, $post->ID, $slide_crop, $thumbnum); ?>
        <?php endif;
        endif; ?>
      <div class="blogcontent">
        <div class="leftblogcontent">
          <?php
/* Author -----------------------------------------------------------------------------------*/
          if ($author_style == 'Avatar Box' || $author_style == 'avatar_box') { ?>
            <div class="details">
              <?php $author_id = get_the_author_meta('ID');
              $author_name = get_the_author_meta('display_name');
              $author_url = get_the_author_meta('user_url');
               echo get_avatar( $author_id, 64, '', $author_name ); ?>
              <ul class="authorinfo">
                <meta itemprop="datePublished" content="<?php the_time('Y'); ?>-<?php the_time('m'); ?>-<?php the_time('d'); ?>">
               <li class="name vcard author" itemprop="author"><strong class="fn"><?php the_author_posts_link();?></strong></li>
               <li class="date"><?php _e('On', 'framework');?> <span class="updated"><?php the_time(get_option('date_format')); ?></span> </li>
               <li class="url"><?php echo $author_url; ?></li>
             </ul>
               <div class="clear"></div>
           </div>
		  <?php };
/* Review -----------------------------------------------------------------------------------*/
      if ($review_post == 'Yes') {
            if ($review_place == 'Top of Post' || $review_place == 'Both') {
              get_template_part('functions/review');
            } } ?></div>
    <?php /* Author -----------------------------------------------------------------------------------*/
       if ($author_style == 'Simple' || $author_style == 'simple') {
              $author_id = get_the_author_meta('ID');
              $author_name = get_the_author_meta('display_name');
              $author_url = get_the_author_meta('user_url'); ?>
             <p><a href="<?php echo $author_url; ?>"  itemprop="author" target="_blank"><?php the_author(); ?></a> | <?php _e('On', 'framework');?> <?php the_time('d'); ?>, <?php the_time('M'); ?>  <?php the_time('Y'); ?></p>
		  <?php } ?>
         <!-- Content  ================================================== -->
          <?php the_content(); ?> <div class="clear"></div>
          <?php edit_post_link( __('Edit Post', 'framework'), '', '' ); ?>
          <?php $args = array(
					'before'           => '<div class="linkpagebutton"><span class="pagelabel">' . __('Pages:', 'framework') . '</span>',
					'after'            => '<div class="clear"></div></div><div class="clear"></div>',
					'link_before'      => '<span class="page-numbers">',
					'link_after'       => '</span>',
					'next_or_number'   => 'number',
					'nextpagelink'     => __('Next page', 'framework'),
					'previouspagelink' => __('Previous page', 'framework'),
					'pagelink'         => '%',
					'echo'             => 1
				); ?>
           <?php wp_link_pages( $args ); ?>
          <?php
/* Review --------------------------------------------------------------------------*/
          if ($review_post == 'Yes') {
            if ($review_place == 'Bottom of Post' || $review_place == 'Both') { ?>
              <div class="bottomreview">
              <?php get_template_part('functions/review'); ?>
              </div>
            <?php }
          } ?>
<!-- Tags ================================================== -->
        <?php the_tags('<div class="tagcloud"><h5>'.__("Tags", "framework"). '</h5>', ' ', '</div><div class="clear"></div>'); ?>
        <div class="clear"></div></div></div> <!-- End Post Div -->
<!-- Share Links  ================================================== -->
          <?php
          if ($share_style != 'None' && $share_style != 'none') {
            if ($share_style == 'Box Count' || $share_style == 'box_count') {
              get_template_part('functions/countshare');
            } else { get_template_part('functions/minimalshare');
          } } ?>
<!-- Optin code ================================================== -->
          <?php get_template_part('functions/optin'); ?>
<!-- previous - next links ================================================== -->
          <?php the_previousnextlinks(); // declared in extra-functions.phg
          if ($related == 'yes')  ag_get_related_post_args($post->ID); // get info for related posts
          endwhile; // end loop
          if ($related == 'yes')  get_template_part('functions/related');
     	  	if (have_posts()) : while (have_posts()) : the_post();
  					comments_template('', true); // comments
          endwhile; endif;
    endif;  ?></div>
    <div class="sidebar"><?php	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Single Post Sidebar') ) ?></div><div class="clear"></div></div>
<!-- Begin Footer -->
<?php get_footer(); ?>
