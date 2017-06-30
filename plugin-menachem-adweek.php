<?php
   /*
   Plugin Name: Menachem ADWEEK Code assessment
   Plugin URI: http://www.glikdesign.com/
   Description: a plugin assignment for the Adweek WordPress Developer Role.
   Version: 1.0
   Author: Menachem Glik
   Author URI: http://www.glikdesign.com/
   License: GPL2
   */
   
    wp_register_style ( 'AW-style', plugins_url ( 'style.css', __FILE__ ) );
	wp_enqueue_style('AW-style');
	
	
	/**
    * Displays the timestamp
    *
    */
	function time_ago( $type = 'post' ) {
		$d = 'posted' == $type ? 'get_comment_time' : 'get_post_time';
		return human_time_diff($d('U'), current_time('timestamp')) . " " . __('ago');

	}
	
   /**
   * Displays the latest post
   *
   */
   function display_most_recent_post($content) {
	   
	 global $post;

	 $html = "";
	 
     $my_query = new WP_Query( array(
		'post_type' => 'post',
		'posts_per_page' => 1
	  ));
	
	  $html .="<div class=\"AW-container\">" . "\n";
	  
      if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();
			
			$img_url = wp_get_attachment_image_src(get_post_thumbnail_id(),'single-post-thumbnail');
			$recent_post_img_url = $img_url [0]; 
	 
			$awcategory = get_the_category();
  
 
			$html .="<div class=\"AW-item\">" . "<img src=\"" . $recent_post_img_url . "\" class=\"AW-postImg\">" . "</div>" . "\n";
			$html .="<div class=\"AW-item-1\">". "\n";
			$html .= "<p class=\"AW-category\">" . $awcategory[0]->cat_name . "<span class=\"AW-TimestampMobile\">" .  "|" . time_ago(). "</span></p>". "\n";
			$html .= "<a href=\"" . get_permalink() . "\" class=\"AW-postLink\">" . get_the_title() . "</a>". "\n";
			$html .= "<br />". "\n";
			$html .= "<p class=\"AW-text\">By <span id=\"AW-Author\">" . ' ' . the_author() . "</span>" . "<span class=\"AW-Timestamp\">" . time_ago(). "</span></p>". "\n";
			 
        endwhile; endif;
 
	 $html .="</div>\n";
	
	 $content .= $html;	   
	 return $content;
	
	}
	
	add_action( 'the_content', 'display_most_recent_post');
	
?>
