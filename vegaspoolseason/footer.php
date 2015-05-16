</div>
</div>
<!-- Close Mainbody and Sitecontainer and start footer
  ================================================== -->
<div class="clear"></div>
<div id="footer">
    <div class="container clearfix">
        <div class="footerwidgetwrap">
            <div class="footerwidget"><?php	/* Widget Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer Left') ) ?></div>
            <div class="footerwidget"><?php	/* Widget Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer Center') ) ?></div>
            <div class="footerwidget"><?php	/* Widget Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer Right') ) ?></div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="clear"></div>
</div>
<div style="background:#333;color:#FFF;padding: 15px 0;"><div class="container clearfix">
    <div class="one_col isobrick" style="border:none;padding:0;text-align:center;"><span>© Copyright 2014<img src="http://vegaspoolseason.com/wp-content/uploads/2013/02/home.png" style="vertical-align:middle;padding: 0 8px;" /><a href="http://vegaspoolseason.com" style="color:#FFF;">Vegas Pool Season</a></span></div><div class="one_col isobrick" style="border:none;float:right;padding:0;text-align:center;"></div></div></div>
<!-- Theme Hook -->
<?php wp_footer(); ?>
<?php echo of_get_option('of_google_analytics'); ?>
<!-- Close Site Container
  ================================================== -->
</body>
</html>