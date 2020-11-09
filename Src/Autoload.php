<?php
spl_autoload_extensions('.class.php');
spl_autoload_register(function($classname) {
	$file = str_replace(
		'\\',
		DIRECTORY_SEPARATOR,
		plugin_dir_path(__FILE__) . $classname . spl_autoload_extensions()
	);
	if (file_exists($file)) require_once($file);
});
?>