<?php
namespace Shared;

class Header {
	
	public static function header() {
		$html = "
			<div class='cabecalho-plugin'>
				<img src='" . WP_PLUGIN_URL . "/endpoints/Src/Assets/img/Labs.png' title='Labs' alt='Labs' width='150px' />
			</div>
		";
		return $html;
	}
	
} ?>