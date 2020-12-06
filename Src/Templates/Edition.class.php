<?php
namespace Templates;

use Shared\Header;
use Shared\Route;
use Source\Sites;
use Source\Terms;
use Interfaces\IEdition;
use Libs\Modal;
use Libs\Input;
use Libs\Select;
use Libs\Checkbox;
use Libs\Hidden;
use Libs\Button;

class Edition implements IEdition {

	private static function get_options_select() {
		return array(
			[ "value" => "1", "option" => "Sim" ],
			[ "value" => "0", "option" => "Não" ]
		);
	}
	
	public static function input($titulo, $name, $id, $value = '', $class = 'input-text') {
		Input::set_titulo($titulo);
		Input::set_name($name);
		Input::set_id($id);
		Input::set_value($value);
		Input::set_class($class);
		return Input::input();
	}
	
	private static function select($titulo, $name, $id, $options, $value = '', $class = 'input-text') {
		Select::set_titulo($titulo);
		Select::set_name($name);
		Select::set_id($id);
		Select::set_options($options);
		Select::set_value($value);
		Select::set_class($class);
		return Select::select();
	}

	private static function checkbox($titulo, $options, $value = array(), $class = 'input-checkbox') {
		Checkbox::set_titulo($titulo);
		Checkbox::set_options($options);
		Checkbox::set_value($value);
		Checkbox::set_class($class);
		return Checkbox::checkbox();
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
				" . self::input('URI do endponint (*)', 'endpoint', 'endpoint') . "
				" . self::select('Deve estar ativo?', 'status', 'status', self::get_options_select()) . "
				" . self::checkbox('O que pode ser acessado? (*)', Terms::getTerms()) . "
				<p style='margin-top: -7px;'>
					A categoria não está na lista? 
					<a href='edit-tags.php?taxonomy=category'>Clique aqui</a> 
					para adicionar
				</p>
				" . self::hidden('identificador', Route::identificator()) . "
				" . self::hidden('servidor', Route::servidor()) . "
				" . self::hidden('uri', Route::uri()) . "
				" . self::button('Salvar', 'salvarEdicao', 'salvarEdicao') . "
				" . self::button('Cancelar', 'cancelarEdicao', 'cancelarEdicao', 'cancel-button') . "
			</div>
		";
		return $html;
	}
	
	public static function new() {
		Sites::insert();
		echo self::html();
	}
	
	public static function edition() {
		echo self::html();
	}
	
} ?>