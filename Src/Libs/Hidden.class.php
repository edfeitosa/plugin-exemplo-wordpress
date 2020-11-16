<?php
namespace Libs;

use Interfaces\IHidden;

class Hidden {
	
	private static $id;
	private static $value;
	
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
	
	public static function hidden() {
		$html = "<input type='hidden' id='" . self::getId() . "' value='" . self::getValue() . "' />";
		return $html;
	}
	
} ?>