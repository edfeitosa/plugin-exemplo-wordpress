<?php

namespace Shared;

class Scripts {
	
	public static function scripts_admin() {
		wp_enqueue_script(
			'scripts',
			WP_PLUGIN_URL . '/endpoints/Src/Assets/scripts/scripts.js',
			array(),
			'1.0',
			''
		);
	}
    
} ?>