<?php
namespace Libs;

use Interfaces\IInput;

class Input implements IInput {
	
	private static $titulo;
	private static $name;
	private static $id;
	private static $value;
	private static $class;
	
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
	
	public static function input() {
		$html = "
			<p>
				<div class='titulo-input'>
					" . self::getTitulo() . "
				</div>
				<input type='text' name='" . self::getName() . "' id='" . self::getId() . "' value='" . self::getValue() . "'	class='" . self::getClass() . "' />
			</p>
		";
		return $html;
	}
	
} ?>