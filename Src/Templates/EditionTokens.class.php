<?php
namespace Templates;

use Shared\Header;
use Shared\Route;
use Source\Endpoints;
use Source\Terms;
use Interfaces\IEditionTokens;
use Libs\Modal;
use Libs\Input;
use Libs\Select;
use Libs\Checkbox;
use Libs\Hidden;
use Libs\Button;

class EditionTokens implements IEditionTokens {
	
	private static function input($titulo, $name, $id, $value = '', $class = 'input-text') {
		Input::set_titulo($titulo);
		Input::set_name($name);
		Input::set_id($id);
		Input::set_value($value);
		Input::set_class($class);
		return Input::input();
	}
	
	private static function hidden($id, $value) {
		Hidden::set_id($id);
		Hidden::set_value($value);
		return Hidden::hidden();
	}
	
	private static function button($titulo, $name, $id, $class = 'input-button') {
		Button::set_titulo($titulo);
		Button::set_name($name);
		Button::set_id($id);
		Button::set_class($class);
		return Button::button();
	}
	
	private static function html() {
		$html = Modal::modal() .
			"<div class='content-plugin'>
				" . Header::header() . "
				<h1>Adicionando endpoint</h1>
				<p>Todos os campos marcados com <b>(*)</b> são de preenchimento obrigatório</p>
				" . self::input('Título do endpoint (*)', 'titulo', 'titulo') . "
				" . self::hidden('identificador', Route::identificator()) . "
				" . self::hidden('servidor', Route::servidor()) . "
				" . self::hidden('uri', Route::uri()) . "
				" . self::button('Salvar', 'salvarToken', 'salvarToken') . "
				" . self::button('Cancelar', 'cancelarEndpoint', 'cancelarEndpoint', 'cancel-button') . "
			</div>
		";
		return $html;
	}
	
	public static function new() {
		//Endpoints::insert();
		echo self::html();
	}
	
	public static function edition() {
		echo self::html();
	}
	
} ?>