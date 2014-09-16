<?php
echo '<article><h3>Featured Maps</h3>';
echo '<ul id="ines">';
$args = array( 'post_type' => 'featured-maps' );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
		$image_url = get_field('map');
		echo '<li class="slide">';
		echo '<a class="fancybox" rel="featured" href="'.$image_url.'" style="'.bg_image($image_url).'">';
		the_title('<span><p class="item_title">','</p></span>');
		echo '</a></li>';
endwhile;
echo '</ul></article>';
?>