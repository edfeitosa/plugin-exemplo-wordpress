<?php
namespace Libs;

use Interfaces\IHidden;

class Hidden {
	
	private static $id;
	private static $value;
	
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
	
	public static function hidden() {
		$html = "<input type='hidden' id='" . self::get_id() . "' value='" . self::get_value() . "' />";
		return $html;
	}
	
} ?>