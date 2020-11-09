<?php

namespace Shared;

class Scripts {
	
	public static function scripts_admin() {
		wp_enqueue_script(
			'scripts',
			WP_PLUGIN_URL . '/libera-site/Src/Assets/scripts/scripts.js',
			array(),
			'1.0',
			''
		);
	}
    
} ?>