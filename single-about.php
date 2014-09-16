<?php
/**
 * The template for displaying project type posts.
 *
 * @package hgise
 */

get_header();

?>
<div class="content">
	<h2><?php the_title(); ?></h2>
	<?php
	// check if the flexible content field has rows of data
	if( have_rows('about_content') ):
		$module_counter = 0;

		// loop through the rows of data searching particularities
		//echo description();

	    // loop through the rows of data
	    while ( have_rows('about_content') ) : the_row();
	    	
	        if( get_row_layout() == 'description' ): ?>
	        	<section class="about description">
					<div class="wrapper">
						<?php the_sub_field('content')?>
						<h4><?php the_sub_field('title')?></h4>
						<p class="about about_content"><?php the_sub_field('content')?></p>
					</div>
				</section>
			<?php
	        endif;
			
	    endwhile;

	else :

	    // no layouts found

	endif;

	?>
</div> <!-- content -->
<?php get_footer(); ?>