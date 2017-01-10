<?php
$pages = array();
$pages['media/videos/watch/:any'] = array('view' => 'media/video');
$pages['media/videos'] = array('view' => 'media/index');
$pages['media/gallery'] = array('view' => 'media/gallery');

$vars['page_title'] = 'Upcoming and Latest Events';
$vars['open_graph_title'] = '';
$vars['open_graph_description'] = '';
$vars['open_graph_image'] = '';
