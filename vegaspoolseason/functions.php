<?php

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Home Content Area',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div><div class="clear"></div>',
		'before_title' => '<h4 style="display:none;">',
		'after_title' => '</h4>',
	));
}

if ( function_exists( 'register_nav_menu' ) ) {
	register_nav_menu( 'bottom-menu', 'Bottom Menu' );
}
