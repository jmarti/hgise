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
	if( have_rows('project_content') ):
		$module_counter = 0;
		$diagrams_counter = 0;
		$pending_diagrams = false;
		$tables_counter = 0;
		$gallery_n = 0;


		// loop through the rows of data searching particularities
		$sources_and_publications = sources_and_publications();
		$diagrams_c = counting_diagrams();
		$tables_c = counting_tables();

	    // loop through the rows of data
	    while ( have_rows('project_content') ) : the_row();
	    	if ( ( get_row_layout() != "diagrams" || $diagrams_counter == 0 ) || ( get_row_layout() != "tables" || $tables_counter == 0 ) ):
		    	++$module_counter;
	    	endif;
	    	if ( get_row_layout() != "diagrams" && $diagrams_counter != $diagrams_c && $diagrams_counter != 0 ) :
	    		echo '</div></section>';
	    		$pending_diagrams = true;
	    	endif;
	    	if ( get_row_layout() != "tables" && $tables_counter != $tables_c && $tables_counter != 0 ) :
	    		echo '</div></section>';
	    		$pending_tables = true;
	    	endif;
			if ($module_counter % 3 == 0):
				$module_blue = "module_blue";
			endif;
			
			if( get_row_layout() == 'videos' ) : 
				include $_SERVER['DOCUMENT_ROOT']."/wp-content/themes/hgise/controllers/videos.php";
	        
			elseif( get_row_layout() == 'video_and_facts' ): ?>
	        	<section class="video video_facts <?php echo $module_blue?>">
					<div class="wrapper">
						<h3>Video and related facts</h3>
						<div class="video_item">
							<?php the_sub_field('url')?>
							<h4><?php the_sub_field('title')?></h4>
							<p class="general_description"><?php the_sub_field('description')?></p>
						</div>
						<?php
						$i = 0;
						while (has_sub_field('facts')) :
							++$i;
						endwhile;
						if ($i < 3) : ?>
							<ul class="facts-gallery-noSlider">
						<?php
						else : ?>
							<ul id="facts-gallery-slider">
						<?php
						endif; ?>
								<li class="slide">
									<?php
									$i = 0;
									$p = "left";
									while ( have_rows('facts') ) : the_row();
										++$i;
										$image = get_sub_field('fact_image');
										if(($i % 2) == 1 and $i!=1) :
											echo '</li><li class="slide">';
											$p = "left";
										endif; ?>
										<div class="item item_<?php echo $i?> item_<?php echo $p?>">
											<img class="facts_gallery_img" width="183" src="<?php echo $image['url'] ?>"></img>
											<h4><?php the_sub_field('title')?></h4>
											<p class="particular_description"><?php the_sub_field('description')?><?php echo $height?></p>
										</div>
									<?php
									$p = "right";
									endwhile; ?>
								</li>
							</ul>
					</div>
				</section>
			<?php
	       	elseif( get_row_layout() == 'maps' ) :
				include $_SERVER['DOCUMENT_ROOT']."/wp-content/themes/hgise/controllers/maps.php";
			elseif( get_row_layout() == 'long_text' ) :
				include $_SERVER['DOCUMENT_ROOT']."/wp-content/themes/hgise/controllers/text.php";
			elseif( get_row_layout() == 'sources' ) :
				include $_SERVER['DOCUMENT_ROOT']."/wp-content/themes/hgise/controllers/sources_publications.php";
			elseif( get_row_layout() == 'diagrams' ) :
				include $_SERVER['DOCUMENT_ROOT']."/wp-content/themes/hgise/controllers/diagrams.php";
			elseif( get_row_layout() == 'tables' ) :
				include $_SERVER['DOCUMENT_ROOT']."/wp-content/themes/hgise/controllers/tables.php";
	        endif;
			unset($module_blue);
	    endwhile;

	else :

	    // no layouts found

	endif;

	?>
</div> <!-- content -->
<?php get_footer(); ?>