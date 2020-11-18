<?php
namespace Templates;

use Shared\Header;
use Source\Sites;
use Interfaces\IEdition;
use Libs\Modal;
use Libs\Input;
use Libs\Select;
use Libs\Checkbox;
use Libs\Hidden;
use Libs\Button;

class Edition implements IEdition {

	private static $optionsSelect = array(
		[ "value" => "1", "option" => "Sim" ],
		[ "value" => "0", "option" => "Não" ]
	);

	private static $optionsCheckbox = array(
		[ "value" => "post", "label" => "Post", "id" => "post", "name" => "post" ],
		[ "value" => "page", "label" => "Page", "id" => "page", "name" => "page" ],
		[ "value" => "media", "label" => "Mídia", "id" => "media", "name" => "media" ]
	);

	private static function getOptionsSelect() {
		return self::$optionsSelect;
	}

	private static function getOptionsCheckbox() {
		return self::$optionsCheckbox;
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
	
	private static function servidor() {
		return 'http://' . strval($_SERVER['HTTP_HOST']);
	}
	
	private static function uri() {
		return strval($_SERVER['REQUEST_URI']);
	}
	
	private static function identificator() {
		return (empty($_GET['id'])) ? '0' : $_GET['id'];
	}
	
	private static function html() {
		$html = Modal::modal() .
			"<div class='content-plugin'>
				" . Header::header() . "
				<h1>Adicionando novo site</h1>
				<p>Preencha as informações do novo bloqueio</p>
				" . self::input('Título do site (*)', 'titulo', 'titulo') . "
				" . self::select('Deve estar ativo?', 'status', 'status', self::getOptionsSelect()) . "
				" . self::checkbox('O que pode ser acessado? (*)', self::getOptionsCheckbox()) . "
				" . self::hidden('identificador', self::identificator()) . "
				" . self::hidden('servidor', self::servidor()) . "
				" . self::hidden('uri', self::uri()) . "
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