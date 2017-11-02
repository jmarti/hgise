<?php
$title = get_sub_field('title');
$text = get_sub_field('text');

if ($module_separators):
	$wrapper_classes = 'section';
	$wrapper_tag = 'div';
else:
	$wrapper_classes = $module_blue;
	$wrapper_tag = 'section';
endif;

echo '<' . $wrapper_tag . ' class="text long_text ' . $wrapper_classes . '"><div class="wrapper">';
if ($title != '' && $title != '_blank'):
	echo '<h3>'.$title.'</h3>';
endif;
echo '<div class="text_content">'.$text.'</div>';
echo '</div></' . $wrapper_tag . '>';


?>