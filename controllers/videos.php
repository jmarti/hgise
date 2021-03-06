<?php

$i = 0; // video counter
while (the_repeater_field('video')) :
	++$i;
endwhile;
//global fields
$title = get_sub_field('videos_set_title');
$subtitle = get_sub_field('videos_set_subtitle');
$description = get_sub_field('description');

//propieties - description
if ($description == "") :
	$has_description = "no_description";
else :
	$has_description = "with_description";
endif;

if ($module_separators):
	$wrapper_classes = 'section ' . $has_description . ' ' . $module_blue;
	$wrapper_tag = 'div';
else:
	$wrapper_classes = $module_blue . ' ' . $has_description . ' ' . $module_blue;;
	$wrapper_tag = 'section';
endif;


//one video
if ( $i == 1 ) : 
	echo '<' . $wrapper_tag . ' class="video full_video '. $wrapper_classes . '"><div class="wrapper">';
	while ( have_rows('video') ) : the_row();
		$video_title = get_sub_field('title');
		if ($has_description == "no_description" && $video_title != '_blank') :
			echo '<h3>'.$video_title.'</h3>';
			if ( $subtitle != "" ) :
				echo '<p class="subtitle">'.$subtitle.'</p>';
			endif;
		endif;
		the_sub_field('url');
		if ($has_description == "with_description" && $video_title != '_blank') :
			echo '<div class="text"><h3>'.$video_title.'</h3>';
		endif;
	endwhile;
		if ($has_description == "with_description") :
			if ( $subtitle != "" ) :
				echo '<p class="subtitle">'.$subtitle.'</p>';
			endif;
			echo '<div class="description">'.$description.'</div>';
		endif;
		echo download_link();
	echo '</div></' . $wrapper_tag . '>';


//two maps portrait
elseif ( $i == 2 ) : 
	echo '<' . $wrapper_tag . ' class="video videos_2 '.$wrapper_classes.'"><div class="wrapper">';
	$i = 0;
	if ( $has_description == "no_description" ) :
		echo title_and_subtitle();
	endif;
	while ( have_rows('video') ) : the_row();
		++$i;
		$video_title = get_sub_field('title');
		echo '<div class="item item_'.$i.'">';
		the_sub_field('url');
		echo '<h4>'.$video_title.'</h4></div>';
	endwhile;
	if ( $has_description == "with_description" ) :
		echo '<div class="video_text">';
		echo title_and_subtitle();
		echo '<div class="description">'.$description.'</div>';
	endif;
	echo '</div></div></' . $wrapper_tag . '>';


//gallery landscape (2 elements per slide)
elseif ( $i >= 3 ) :
	++$gallery_n;
	$i = 1;
	echo '<' . $wrapper_tag . ' class="video video_gallery '.$wrapper_classes.'"><div class="wrapper">';
	echo title_and_subtitle();
	$p = "left";
	echo '<ul id="video-gallery-slider-'.$gallery_n.'"><li class="slide">';
	while ( have_rows('video') ) : the_row();
		if ( ($i % 2 ) == 1 && $i != 1 ) :
			echo '</li><li class="slide">';
			$p = "left";
		endif;
		$video_title = get_sub_field('title');
		echo '<div class="item item_'.$p.'">';
		the_sub_field('url');
		echo '<h4>'.$video_title.'</h4></div>';
		++$i;
		$p = "right";
	endwhile;
	echo '</li></ul>';
	if ( $has_description == "with_description" ) :
		echo '<div class="description">'.$description.'</div>';
	endif;
	echo download_link();
	echo '</div></' . $wrapper_tag . '>';
endif;
?>