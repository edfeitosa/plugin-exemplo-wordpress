<?php
namespace Templates;

use Shared\Route;
use Shared\Header;
use Interfaces\IHomeTokens;
use Source\Tokens;

class HomeTokens implements IHomeTokens {
	
	private static function header() {
		$html = "
			<div class='content-plugin'>" .
				Header::header() .
				"<h1>Tokens</h1>" .
			"</div>
		";
		return $html;
	}

	private static function rows_table() {
		$html = '';

		$data = Tokens::get_tokens();

		if (!$data) {
			$html .= "
				<tr>
					<td colspan='4'>
						Ainda não existe nenhum token cadastrado. Clique no menu <b>Novo Token</b> para adicionar
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
					<td style='width:50%;'>" . $item['token'] . "</td>
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
						<td style='width:50%;'>Token</td>
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
	
	public static function home() {
		echo self::header() . self::table_list();
	}
	
} ?>