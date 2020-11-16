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
	
	public static function setTitulo($vtitulo) {
		self::$titulo = $vtitulo;
	}
	
	public static function getName() {
		return self::$name;
	}
	
	public static function setName($vname) {
		self::$name = $vname;
	}
	
	public static function getId() {
		return self::$id;
	}
	
	public static function setId($vid) {
		self::$id = $vid;
	}
	
	public static function getValue() {
		return self::$value;
	}
	
	public static function setValue($vvalue) {
		self::$value = $vvalue;
	}
	
	public static function getClass() {
		return self::$class;
	}
	
	public static function setClass($vclass) {
		self::$class = $vclass;
	}
	
	public static function getOptions() {
		return self::$options;
	}
	
	public static function setOptions($voptions) {
		self::$options = $voptions;
	}
	
	public static function select() {
		$options_value = "";
		foreach(self::getOptions() as $item) {
			$selected = ($item["value"] == self::getValue()) ? 'selected' : '';
			$options_value .= "<option value='" . $item["value"] . "' " . $selected . ">" . $item["option"] . "</option>";
		}
		$html = "
			<p>
				<div class='titulo-input'>
					" . self::getTitulo() . "
				</div>
				<select type='submit' name='" . self::getName() . "' id='" . self::getId() . "' class='" . self::getClass() . "' />
					" . $options_value . "
				</select>
			</p>
		";
		return $html;
	}
	
} ?>