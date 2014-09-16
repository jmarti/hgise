<?php
$args = array( 'post_type' => 'about' );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post(); ?>
	<?php the_content();
	$about_text = get_field('about_text');
	echo '<section class="about"><div class="wrapper">';
	the_title('<h2>', '</h2>');
	if( $about_text != "" ):
    	echo '<article class="about description">'.$about_text.'</article>';
	endif;
    echo '<article class="about members">';
    echo '<h4>Members</h4><hr><br>';
    while( have_rows('members') != "" ): the_row();
	    $name = get_sub_field('name');
	    $position = get_sub_field('position');
	    $cv = get_sub_field('cv');
		echo '<div class="member">';
		echo '<p class="name">'.$name.'</p>';
		if ($position != "") :
			echo '<p>'.$position.'</p>';
		endif;
		if ($cv != "") :
			echo '<a href="'.$cv.'" target="_blank">More info</a>';
		endif;
		echo '</div>';
	endwhile;
	echo '</article>';
	echo '</div></section>';
endwhile;			
?>