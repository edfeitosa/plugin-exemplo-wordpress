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

	private static function getOptionsSelect() {
		return array(
			[ "value" => "1", "option" => "Sim" ],
			[ "value" => "0", "option" => "Não" ]
		);
	}
	
	public static function input($titulo, $name, $id, $value = '', $class = 'input-text') {
		Input::setTitulo($titulo);
		Input::setName($name);
		Input::setId($id);
		Input::setValue($value);
		Input::setClass($class);
		return Input::input();
	}
	
	private static function select($titulo, $name, $id, $options, $value = '', $class = 'input-text') {
		Select::setTitulo($titulo);
		Select::setName($name);
		Select::setId($id);
		Select::setOptions($options);
		Select::setValue($value);
		Select::setClass($class);
		return Select::select();
	}

	private static function checkbox($titulo, $options, $value = array(), $class = 'input-checkbox') {
		Checkbox::setTitulo($titulo);
		Checkbox::setOptions($options);
		Checkbox::setValue($value);
		Checkbox::setClass($class);
		return Checkbox::checkbox();
	}
	
	private static function hidden($id, $value) {
		Hidden::setId($id);
		Hidden::setValue($value);
		return Hidden::hidden();
	}
	
	private static function button($titulo, $name, $id, $class = 'input-button') {
		Button::setTitulo($titulo);
		Button::setName($name);
		Button::setId($id);
		Button::setClass($class);
		return Button::button();
	}
	
	/* private static function servidor() {
		return 'http://' . strval($_SERVER['HTTP_HOST']);
	}
	
	private static function uri() {
		return strval($_SERVER['REQUEST_URI']);
	}
	
	private static function identificator() {
		return (empty($_GET['id'])) ? '0' : $_GET['id'];
	} */
	
	private static function html() {
		$html = Modal::modal() .
			"<div class='content-plugin'>
				" . Header::header() . "
				<h1>Adicionando endpoint</h1>
				<p>Todos os campos marcados com <b>(*)</b> são de preenchimento obrigatório</p>
				" . self::input('Título do endpoint (*)', 'titulo', 'titulo') . "
				" . self::input('URI do endponint (*)', 'endpoint', 'endpoint') . "
				" . self::select('Deve estar ativo?', 'status', 'status', self::getOptionsSelect()) . "
				" . self::checkbox('O que pode ser acessado? (*)', Terms::getTerms()) . "
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