<?php 
namespace Libs;

use Interfaces\IButton;

class Button implements IButton {

  private static $name;
	private static $id;
	private static $titulo;
  private static $class;
  
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
	
	public static function getTitulo() {
		return self::$titulo;
	}
	
	public static function set_titulo($vtitulo) {
		self::$titulo = $vtitulo;
	}
	
	public static function get_class() {
		return self::$class;
	}
	
	public static function set_class($vclass) {
		self::$class = $vclass;
	}
	
	public static function button() {
		$html = "
			<button name='" . self::get_name() . "' id='" . self::get_id() . "' class='" . self::get_class() . "'>" . self::getTitulo() . "</button>
		";
		return $html;
	}

} ?>