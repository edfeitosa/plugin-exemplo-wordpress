<?php
namespace Libs;

use Interfaces\IInput;

class Input implements IInput {
	
	private static $titulo;
	private static $name;
	private static $id;
	private static $value;
	private static $class;
	
	public static function get_titulo() {
		return self::$titulo;
	}
	
	public static function set_titulo($vtitulo) {
		self::$titulo = $vtitulo;
	}
	
	public static function get_name() {
		return self::$name;
	}
	
	public static function set_name($vname) {
		self::$name = $vname;
	}
	
	public static function get_id() {
		return self::$id;
	}
	
	public static function set_id($vid) {
		self::$id = $vid;
	}
	
	public static function get_value() {
		return self::$value;
	}
	
	public static function set_value($vvalue) {
		self::$value = $vvalue;
	}
	
	public static function get_class() {
		return self::$class;
	}
	
	public static function set_class($vclass) {
		self::$class = $vclass;
	}
	
	public static function input() {
		$html = "
			<p>
				<div class='titulo-input'>
					" . self::get_titulo() . "
				</div>
				<input type='text' name='" . self::get_name() . "' id='" . self::get_id() . "' value='" . self::get_value() . "'	class='" . self::get_class() . "' />
			</p>
		";
		return $html;
	}
	
} ?>