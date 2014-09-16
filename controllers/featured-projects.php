<?php
echo '<article><h3>Featured Projects</h3>';
echo '<ul id="home-featured-slider">';
$args = array( 'post_type' => 'projects', 'project_type' => 'featured' );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
	echo '<li class="slide">';
	echo '<a href="'.get_permalink( $post->ID).'" style="'.bg_image(search_image()).'">';
	the_title('<span><p class="item_title">','</p></span>');
	echo '</a></li>';
endwhile;
echo '</ul></article>';
?>