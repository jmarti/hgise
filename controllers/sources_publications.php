<?php
echo '<section class="sources_and_publications '.$module_blue.'"><div class="wrapper">';
if ( have_rows('source') ) :
	echo '<article class="sources '.$sources_and_publications.'">';
	echo '<div class="title"><h3>Sources</h3></div>';
	echo '<ul>';
	while ( have_rows('source') ) : the_row();
		$source_title = get_sub_field('source');
		$source_url = get_sub_field('url');
		//if ($source_url != "") :
			echo '<li><a target="_blank" href="//'.remove_http($source_url).'">'.$source_title.'</a></li>';
		//else :
			echo '<li>'.$source_title.'</a></li>';
		//endif;
	endwhile;
	echo '</ul></article>';
endif;
if ( have_rows( 'publication' ) ) :
	echo '<article class="publications '.$sources_and_publications.'">';
	echo '<div class="title"><h3>Publications</h3></div>';
	echo '<ul>';
	while ( have_rows('publication') ) : the_row();
		echo '<li>';
		// The two next whiles have only one loop,
		// so all variables are defined in.
		// We took this silly decision to avoid sub-tabs in Wordpress 'backstage'.
		while ( have_rows('article') ) : the_row();
			$title = get_sub_field('title');
			$authors = array();
			while ( have_rows('authors') ) : the_row();
				$new_author = get_sub_field('author');
				array_push($authors,$new_author);
			endwhile;
			$pdf = get_sub_field('pdf');
			if ($pdf != "") :
				$pdf = $pdf['url'];
			endif;
			$url = get_sub_field('url');
			$lang = get_sub_field('language');
		endwhile;
		while ( have_rows('media') ) : the_row();
			$media = get_sub_field('media');
			$url_media = get_sub_field('url');
		endwhile;
		if ($pdf != "") :
			echo '<a target="_blank" class="title_article" href="'.$pdf.'">'.$title.'</a>';
		elseif ($url != "") :
			echo '<a target="_blank" class="title_article" href="//'.remove_http($url).'">'.$title.'</a>';
		else :
			echo '<span class="title_article">'.$title.'</span>';
		endif;
		echo '<br><span class="author">'.implode(', ', $authors).'</span>';
		if ($media != "") :
			if ($url_media != "") :
				echo '<a target="_blank" class="media" href="//'.remove_http($url_media).'">'.$media.'</a>';
			else :
				echo '<span class="media">'.$media.'</span>';
			endif;
		endif;
		echo '</li>';
	endwhile;
	echo '</ul></article>';
endif;
echo '</div></section>';


?>