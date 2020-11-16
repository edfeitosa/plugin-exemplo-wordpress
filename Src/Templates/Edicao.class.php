<?php
namespace Templates;

use Shared\Header;
use Source\Sites;
use Interfaces\IEdicao;
use Libs\Input;
use Libs\Select;
use Libs\Hidden;

class Edicao implements IEdicao {
	
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
	
	private static function hidden($id, $value) {
		Hidden::setId($id);
		Hidden::setValue($value);
		return Hidden::hidden();
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
				" . self::input('Título do site', 'titulo', 'titulo') . "
				" . self::input('Url do site', 'url', 'url') . "
				" . self::select('Deve estar ativo?', 'status', 'status', $data_select) . "
				" . self::hidden('identificador', self::identificador()) . "
				" . self::hidden('servidor', self::servidor()) . "
				" . self::hidden('uri', self::uri()) . "
				" . self::button('Salvar', 'salvarEdicao', 'salvarEdicao') . "
				" . self::button('Cancelar', 'cancelarEdicao', 'cancelarEdicao', 'cancel-button') . "
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