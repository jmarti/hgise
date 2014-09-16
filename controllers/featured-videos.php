<?php
echo '<article><h3>Featured Videos</h3>';
echo '<ul id="home-videos-slider">';
$args = array( 'post_type' => 'projects' );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
	while ( have_rows('project_content') ) : the_row();
		if( get_row_layout() == 'videos' ):
			while( have_rows('video') ) : the_row();
				if( get_sub_field('featured') != "" ) :
					$title = get_sub_field('title');
					$video = get_sub_field('url');
					echo '<li class="slide">';
					echo $video;
					echo 'hola';
					echo '<span><p class="item_title">'.$title.'</p></span>';
					echo '</a></li>';
				endif;
			endwhile;
		endif;
	endwhile;
endwhile;
echo '</ul></article>';
?>