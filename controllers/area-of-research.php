<?php
$i = 0;
while ( $loop->have_posts() ) : $loop->the_post();
	$position = three_in_row($i);
	echo '<a class="project" '.$position.' href="'.get_permalink( $post->ID).'" style="'.bg_image(search_image()).'">';
	the_title('<p>','</p></a>');
endwhile; ?>