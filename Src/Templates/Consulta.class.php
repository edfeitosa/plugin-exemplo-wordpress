<?php
namespace Templates;

use Shared\Header;

class Consulta {
	
	public static function home() {
		$html = "
			<div class='content-plugin'>" .
				Header::header() .
				"<h1>Libera Site</h1>
			</div>
		";
		echo $html;
	}
	
} ?>