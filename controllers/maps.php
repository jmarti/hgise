<?php

$i = 0; // maps counter
$j = 0; // array position counter

//global fields
$title = get_sub_field('maps_set_title');
$subtitle = get_sub_field('maps_set_subtitle');
$description = get_sub_field('maps_general_description');
$download = get_sub_field('download');

//propieties - aspect ratio
while (has_sub_field('maps')) :
	++$i;
	$image = get_sub_field('map');
	$images_url[] = $image['url'];
	$aspect_ratio[] = aspect_ratio($images_url[$j]);
	++$j;
endwhile;
$aspect_ratio = array_icount_values($aspect_ratio);
if ($aspect_ratio['portrait'] > $aspect_ratio['landscape']) :
	$aspect_ratio = "portrait";
else :
	$aspect_ratio = "landscape";
endif;

//propieties - description
if ($description == "") :
	$has_description = "no_description";
else :
	$has_description = "with_description";
endif;

//propieties builder
$section_propieties = $aspect_ratio.' '.$has_description.' '.$module_blue;


//one map
if ( $i == 1 ) : 
	echo '<section class="maps maps_'.$j.' '.$section_propieties.'"><div class="wrapper">';
	while ( have_rows('maps') ) : the_row();
		$map_title = get_sub_field('map_title');
		$image = get_sub_field('map');
		$image_url = $image['url'];
		if ($has_description == "no_description") :
			echo '<h3>'.$map_title.'</h3>';
			if ( $subtitle != "" ) :
				echo '<p class="subtitle">'.$subtitle.'</p>';
			endif;
		endif;
		echo '<a class="fancybox" href="'.$image_url.'"><img src="'.$image_url.'"></a>';
		if ($has_description == "with_description") :
			echo '<div class="text"><h3>'.$map_title.'</h3>';
		endif;
	endwhile;
		if ($has_description == "with_description") :
			if ( $subtitle != "" ) :
				echo '<p class="subtitle">'.$subtitle.'</p>';
			endif;
			echo '<div class="description">'.$description.'</div>';
		endif;
		echo download_link();
	echo '</div></section>';


//two maps portrait
elseif ( $i == 2 && $aspect_ratio == "portrait" ) : 
	echo '<section class="maps maps_'.$j.' '.$section_propieties.'"><div class="wrapper">';
	$i = 0;
	if ( $has_description == "no_description" ) :
		echo title_and_subtitle();
	endif;
	while ( have_rows('maps') ) : the_row();
		++$i;
		$map_title = get_sub_field('map_title');
		$image = get_sub_field('map');
		$image_url = $image['url'];
		echo '<div class="item_'.$i.'">';
		echo '<a class="fancybox" href="'.$image_url.'" rel="galery_'.$module_counter.'"><img src="'.$image_url.'"></a>';
		echo '<h4>'.$map_title.'</h4></div>';
	endwhile;
	if ( $has_description == "with_description" ) :
		echo '<div class="maps_text">';
		echo title_and_subtitle();
		echo '<div class="description">'.$description.'</div>';
	endif;
	echo download_link();
	echo '</div></div></section>';


//twree maps portrait or two maps landscape
elseif ( ( $i == 2 && $aspect_ratio == "landscape" ) || ( $i == 3 && $aspect_ratio == "portrait" ) ) :
	echo '<section class="maps maps_'.$j.' '.$section_propieties.'"><div class="wrapper">';
	$i = 0;
	echo title_and_subtitle();
	while ( have_rows('maps') ) : the_row();
		++$i;
		$map_title = get_sub_field('map_title');
		$image = get_sub_field('map');
		$image_url = $image['url'];
		echo '<div class="item_'.$i.'">';
		echo '<a class="fancybox" href="'.$image_url.'" rel="galery_'.$module_counter.'"><img src="'.$image_url.'"></a>';
		echo '<h4>'.$map_title.'</h4></div>';
	endwhile;
	if ( $has_description == "with_description" ) :
		echo '<div class="description">'.$description.'</div>';
	endif;
	echo download_link();
	echo '</div></div></section>';


//gallery landscape (2 elements per slide)
elseif ( $i >= 3 && $aspect_ratio == "landscape" ) :
	++$gallery_n;
	$i = 1;
	echo '<section class="maps '.$section_propieties.'"><div class="wrapper">';
	echo title_and_subtitle();
	$p = "left";
	echo '<ul id="map-gallery-slider-'.$gallery_n.'" class="'.$aspect_ratio.'"><li class="slide">';
	while ( have_rows('maps') ) : the_row();
		if ( ($i % 2 ) == 1 && $i != 1 ) :
			echo '</li><li class="slide">';
			$p = "left";
		endif;
		$map_title = get_sub_field('map_title');
		$image = get_sub_field('map');
		$image_url = $image['url'];
		$image_new_height = img_resize($image_url,400,false);
		echo '<div class="item item_'.$p.'" style="height:'.$image_new_height.'px">';
		echo '<a href="'.$image_url.'" class="fancybox" rel="gallery_'.$module_counter.'"><img src="'.$image_url.'"></a>';
		echo '<h4>'.$map_title.'</h4></div>';
		++$i;
		$p = "right";
	endwhile;
	echo '</li></ul>';
	if ( $has_description == "with_description" ) :
		echo '<div class="description">'.$description.'</div>';
	endif;
	echo download_link();
	echo '</div></section>';

//gallery portrait (3 elements per slide)
elseif ( $i >= 4 && $aspect_ratio == "portrait" ) :
	++$gallery_n;
	$p = "first";
	$items = $i;
	$items_per_slide = 3;
	$slides = counting_slides($items_per_slide );
	$rest_elements = $slides * $items_per_slide  - $items;
	$slides_counter = 0;
	$i = 1;
	echo '<section class="maps '.$section_propieties.'"><div class="wrapper">';
	echo title_and_subtitle();
	echo '<ul id="map-gallery-slider-'.$gallery_n.'" class="'.$aspect_ratio.'"><li class="slide">';
	while ( have_rows('maps') ) : the_row();
		if ( ( $i % $items_per_slide  ) == 1 && $i != 1 ) :
			++$slides_counter ;
			if ( $slides_counter == $slides ) :
				echo '</li><li class="slide last rest_elements_'.$rest_elements.'">';
			else :
				echo '</li><li class="slide">';
			endif;
			$p = "first";
		elseif ( ( $i % $items_per_slide  ) == 2 ) :
			$p = "second";
		elseif ( ( $i % $items_per_slide  ) == 3 ) :
			$p = "third";
		endif;
		$map_title = get_sub_field('map_title');
		$image = get_sub_field('map');
		$image_url = $image['url'];
		echo '<div class="item item_'.$i.' item_'.$p.'">';
		echo '<a href="'.$image_url.'" class="fancybox" rel="gallery_'.$module_counter.'"><img src="'.$image_url.'"></a>';
		echo '<h4>'.$map_title.'</h4></div>';
		++$i;
	endwhile;
	echo '</li></ul>';
	if ( $has_description == "with_description" ) :
		echo '<div class="description">'.$description.'</div>';
	endif;
	echo download_link();
	echo '</div></section>';
endif;
unset($images_url);
unset($aspect_ratio);
?>