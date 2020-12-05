<?php
namespace Shared;

class Header {
	
	public static function header() {
		$html = "
			<div class='cabecalho-plugin'>
				<img src='" . WP_PLUGIN_URL . "/endpoints/Src/Assets/img/Localiza.png' title='Localiza' alt='Localiza' />
			</div>
		";
		return $html;
	}
	
} ?>