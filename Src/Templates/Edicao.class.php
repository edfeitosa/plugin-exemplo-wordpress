<?php
namespace Templates;

use Shared\Header;
use Source\Sites;

class Edicao {
	
	private static function input($titulo, $name, $id, $value = '', $class = 'input-text') {
		$html = "
			<p>
				<div class='titulo-input'>
					" . $titulo . "
				</div>
				<input type='text' name='" . $name . "' id='" . $id . "' value='" . $value . "' class='" . $class . "' />
			</p>
		";
		return $html;
	}
	
	private static function select($titulo, $name, $id, $options, $value = '', $class = 'input-text') {
		$options_value = "";
		foreach($options as $item) {
			$selected = ($item["value"] == $value) ? 'selected' : '';
			$options_value .= "<option value='" . $item["value"] . "' " . $selected . ">" . $item["option"] . "</option>";
		}
		$html = "
			<p>
				<div class='titulo-input'>
					" . $titulo . "
				</div>
				<select type='submit' name='" . $name . "' id='" . $id . "' class='" . $class . "' />
					" . $options_value . "
				</select>
			</p>
		";
		return $html;
	}
	
	private static function hidden($id, $value) {
		$html = "<input type='hidden' id='" . $id . "' value='" . $value . "' />";
		return $html;
	}
	
	private static function button($titulo, $name, $id, $class = 'input-button') {
		$html = "
			<button name='" . $name . "' id='" . $id . "' class='" . $class . "'>" . $titulo . "</button>
		";
		return $html;
	}
	
	private static function servidor() {
		return 'http://' . strval($_SERVER['HTTP_HOST']);
	}
	
	private static function uri() {
		return strval($_SERVER['REQUEST_URI']);
	}
	
	private static function identificador() {
		return (empty($_GET['id'])) ? '0' : $_GET['id'];
	}
	
	private static function html() {
		$data_select = array(
			[ "value" => "1", "option" => "Sim" ],
			[ "value" => "0", "option" => "Não" ]
		);
		$html = Modal::padrao() .
			"<div class='content-plugin'>
				" . Header::header() . "
				<h1>Adicionando novo site</h1>
				<p>Preencha as informações do novo bloqueio</p>
				" . Edicao::input('Título do site', 'titulo', 'titulo') . "
				" . Edicao::input('Url do site', 'url', 'url') . "
				" . Edicao::select('Deve estar ativo?', 'status', 'status', $data_select) . "
				" . Edicao::hidden('identificador', self::identificador()) . "
				" . Edicao::hidden('servidor', self::servidor()) . "
				" . Edicao::hidden('uri', self::uri()) . "
				" . Edicao::button('Salvar', 'salvarEdicao', 'salvarEdicao') . "
				" . Edicao::button('Cancelar', 'cancelarEdicao', 'cancelarEdicao', 'cancel-button') . "
			</div>
		";
		return $html;
	}
	
	public static function novo() {
		Sites::adiciona();
		echo self::html();
	}
	
	public static function edicao() {
		echo self::html();
	}
	
} ?>