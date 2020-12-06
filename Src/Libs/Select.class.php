<?php
namespace Libs;

use Interfaces\ISelect;

class Select implements ISelect {
	
	private static $titulo;
	private static $name;
	private static $id;
	private static $value;
	private static $class;
	private static $options;
	
	public static function getTitulo() {
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
	
	public static function get_options() {
		return self::$options;
	}
	
	public static function set_options($voptions) {
		self::$options = $voptions;
	}

	private static function optionsSelect() {
		$options_value = "";
		foreach(self::get_options() as $item) {
			$selected = ($item["value"] == self::get_value()) ? 'selected' : '';
			$options_value .= "<option value='" . $item["value"] . "' " . $selected . ">" . $item["option"] . "</option>";
		}
		return $options_value;
	}
	
	public static function select() {
		$html = "
			<p>
				<div class='titulo-input'>
					" . self::getTitulo() . "
				</div>
				<select type='submit' name='" . self::get_name() . "' id='" . self::get_id() . "' class='" . self::get_class() . "' />
					" . self::optionsSelect() . "
				</select>
			</p>
		";
		return $html;
	}
	
} ?>