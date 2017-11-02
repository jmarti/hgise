<?php
$text = get_sub_field('text');
if ($module_separators):
	$wrapper_tag = 'div';
	$wrapper_classes = 'section';
else:
	$wrapper_tag = 'section';
	$wrapper_classes = '';
endif;
echo '<' . $wrapper_tag . ' class="text free_text ' . $wrapper_classes . '"><div class="wrapper">';
echo '<div class="text_content">'.$text.'</div>';
echo '</div></' . $wrapper_tag . '>';


?>