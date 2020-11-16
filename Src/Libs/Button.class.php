<?php 
namespace Libs;

use Interfaces\IButton;

class Button implements IButton {

  private static $name;
	private static $id;
	private static $titulo;
  private static $class;
  
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
	
	public static function getTitulo() {
		return self::$titulo;
	}
	
	public static function setTitulo($vtitulo) {
		self::$titulo = $vtitulo;
	}
	
	public static function getClass() {
		return self::$class;
	}
	
	public static function setClass($vclass) {
		self::$class = $vclass;
	}
	
	public static function button() {
		$html = "
			<button name='" . self::getName() . "' id='" . self::getId() . "' class='" . self::getClass() . "'>" . self::getTitulo() . "</button>
		";
		return $html;
	}

} ?>