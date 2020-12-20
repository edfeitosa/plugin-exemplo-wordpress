<?php
namespace Templates;

use Shared\Route;
use Shared\Header;
use Interfaces\IHomeEndpoints;
use Source\Endpoints;

class HomeEndpoints implements IHomeEndpoints {

	private static function header() {
		$html = "
			<div class='content-plugin'>" .
				Header::header() .
				"<h1>Endpoints</h1>" .
			"</div>
		";
		return $html;
	}

	private static function rows_table() {
		$html = '';

		$data = Endpoints::get_endpoints();

		if (!$data) {
			$html .= "
				<tr>
					<td colspan='4'>
						Ainda não existe nenhum endpoint cadastrado. Clique no menu <b>Novo Endpoint</b> para adicionar
					</td>
				</tr>
			";
			return $html;
		}

		$uri = explode('/', Route::uri());

		foreach($data as $item) {
			$html .= "
				<tr>
					<td style='width:20%;'>" . $item['titulo'] . "</td>
					<td style='width:50%;'>" . Route::servidor() . "/" . $uri[1] . "/wp-json/localiza/v1/api/" . $item['endpoint'] . "</td>
					<td style='width:20%;'>" . $item['data'] . "</td>
					<td style='width:10%;'>
						<div class='edit'>
							<span class='dashicons dashicons-edit-large'></span>
						</div>
						<div class='delete'>
							<span class='dashicons dashicons-trash'></span>
						</div>
					</td>
				</tr>
			";
		}
		return $html;
	}

	private static function table_list() {
		$html = "
			<table cellspacing='0' class='table'>
				<thead>
					<tr>
						<td style='width:20%;'>Título</td>
						<td style='width:50%;'>Endpoint</td>
						<td style='width:20%;'>Criado em</td>
						<td style='width:10%;'>Ações</td>
					</tr>
				</thead>
				<tbody>" .
					self::rows_table() . "
				</tbody>
			</table>
		";
		return $html;
	}

	private static function body() {
		$html = "
			<p>Endpoints cadastrados</p>" .
			self::table_list() .
		"";
		return $html;
	}
	
	public static function home() {
		echo self::header() . self::body();
	}
	
} ?>