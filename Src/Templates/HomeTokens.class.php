<?php
namespace Templates;

use Shared\Header;

class HomeTokens {
	
	public static function home() {
		$html = "
			<div class='content-plugin'>" .
				Header::header() .
				"<h1>Tokens</h1>" .
			"</div>
		";
		echo $html;
	}
	
} ?>