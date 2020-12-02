<?php
namespace Templates;

use Shared\Header;

class Consultation {
	
	public static function home() {
		$html = "
			<div class='content-plugin'>" .
				Header::header() .
				"<h1>Libera Site</h1>" .
			"</div>
		";
		echo $html;
		// print_r(query_posts('category_name=posts'));
	}
	
} ?>