<?php
$title = $el_class = $value = $label_value= $units = '';

$array = preg_split("/\r\n|\n|\r/", $content);
$heading_lines = array_filter($array);

echo '<div class="nectar-split-heading">';

foreach($heading_lines as $k => $v) {
	echo '<span class="heading-line"> <span>' . do_shortcode($v) . ' </span> </span>';
}

echo '</div>';