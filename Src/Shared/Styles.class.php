<?php

namespace Shared;

class Styles {
	
	public static function styles_admin() {
		wp_enqueue_style(
			'styles',
			WP_PLUGIN_URL . '/libera-site/Src/Assets/css/styles.css',
			array(),
			'1.0',
			''
		);
	}
    
} ?>