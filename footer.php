<?php

/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package hgise
 */
?>

	<?php
$args = array( 'post_type' => 'footer' );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post(); 
	$funding = get_field('funding_institutions');
	$contact = get_field('contact');
	echo '<section class="footer">';
	echo '<article class="funding">';
	echo '<h3>Funding Institutions</h3>';
	while ( have_rows('funding_institutions') ) : the_row(); 
		$logo_title = get_sub_field('logo_title');
		$image = get_sub_field('logo');
		$image_url = $image['url'];
		$link = get_sub_field('link');
		echo '<a href="'.$link.'"><img alt="'.$logo_title.'" src="'.$image_url.'"></img></a>';
	endwhile;
    echo'</article>';
    echo '<article class="contact">';
    echo '<h3>Contact</h3>';
    if( $contact != "" ):
    	echo '<article class="contact">'.$contact.'</article>';
	endif;
	echo '</article>';
	echo '</section>';
endwhile;			
?>

	<?php wp_footer(); ?>

	<!--[if lt IE 10]>
    	<script src="js/css3-multi-column.js"></script>
    <![endif]-->
</body>
</html>
