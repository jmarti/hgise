<?php
if ($module_separators):
	$wrapper_classes = 'section';
	$wrapper_tag = 'div';
else:
	$wrapper_classes = '';
	$wrapper_tag = 'section';
endif;

$title = get_sub_field('table_title');
$subtitle = get_sub_field('table_subtitle');
++$tables_counter;
if ( $tables_counter == 1 || $pending_tables == true ):
	echo '<' . $wrapper_tag . ' class="tables ' . $wrapper_classes . '"><div class="wrapper">';
	echo '<h3 class="tables_set_title">Tables</h3>';
endif;
echo '<article class="table">';
echo '<div class="header accordionButton"><h4>'.$title.'</h4>';
if ($subtitle != "") :
	echo '<p class="small_description">'.$subtitle.'</p>';
endif; 
echo '</div><div class="accordionContent">';
$table = get_sub_field('table');
echo '<div class="table_content">'.$table.'</div></div></article>';
if ( $tables_counter == $tables_c ) :
	echo '</div></' . $wrapper_tag . '>';
endif;

	
	