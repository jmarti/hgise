<?php

$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
$opened = get_sub_field('opened');
++$diagrams_counter;
if ($module_separators):
	$wrapper_tag = 'div';
	$wrapper_classes = 'section';
else:
	$wrapper_tag = 'section';
	$wrapper_classes = $module_blue;
endif;
if ( $diagrams_counter == 1 || $pending_diagrams == true ):
	echo '<' . $wrapper_tag . ' class="diagrams ' . $wrapper_classes . '"><div class="wrapper">';
	echo '<h3 class="diagrams_set_title">Diagrams</h3>';
endif;
echo '<article class="diagram">';
echo '<div class="header accordionButton' . ($opened ? ' opened' : '') . '"><h4>'.$title.'</h4>';
if ($subtitle != "") :
	echo '<p class="small_description">'.$subtitle.'</p>';
endif;
echo '</div><div class="accordionContent">';
while (have_rows('diagram')) : the_row();
	$diagram_title = get_sub_field('title');
	$diagram_subtitle = get_sub_field('subtitle');
	$image = get_sub_field('image');
	$img_url = $image['url'];
	$description = get_sub_field('description');
	echo' <div class="image"><a class="fancybox" rel="'.$diagrams_counter.'" href="'.$img_url.'"><img src="'.$img_url.'"></img></a></div><div class="diagram_description">';
	echo '<h4>'.$diagram_title.'</h4>';
	if ( $diagram_subtitle != "" ) :
		echo '<p class="subtitle">'.$subtitle.'</p>';
	endif;
	if ( $description != "") :
		echo '<div>'.$description.'</div>';
	endif;
	echo '</div>';
endwhile;
echo '</div></article>';
if ( $diagrams_counter == $diagrams_c ) :
	echo '</div></' . $wrapper_tag . '>';
endif;
	
	