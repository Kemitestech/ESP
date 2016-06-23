<?php
/*
|--------------------------------------------------------------------------
| MY Custom Modules
|--------------------------------------------------------------------------
|
| Specifies the module controller (key) and the name (value) for fuel
*/


/*********************** EXAMPLE ***********************************

$config['modules']['quotes'] = array(
	'preview_path' => 'about/what-they-say',
);

$config['modules']['projects'] = array(
	'preview_path' => 'showcase/project/{slug}',
	'sanitize_images' => FALSE // to prevent false positives with xss_clean image sanitation
);

*********************** /EXAMPLE ***********************************/
$config['modules']['events'] = array(
	'preview_path' => 'events/{slug}',
	'display_field' => 'title',
);
$config['modules']['hosts'] = array(
	'preview_path' => 'hosts/{slug}',
	'display_field' => 'name',
);


/*********************** OVERWRITES ************************************/

$config['module_overwrites']['categories']['hidden'] = FALSE; // change to FALSE if you want to use the generic categories module
$config['module_overwrites']['tags']['hidden'] = FALSE; // change to FALSE if you want to use the generic tags module

/*********************** /OVERWRITES ************************************/
