<?php
namespace Libs;

use Interfaces\ICheckbox;

class Checkbox implements ICheckbox {

  private static $titulo;
	private static $value;
  private static $class;
  private static $options;
	
	public static function getTitulo() {
		return self::$titulo;
	}
	
	public static function setTitulo($vtitulo) {
		self::$titulo = $vtitulo;
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

	private static function optionsCheckbox() {
		$options_checkbox = "";
		foreach(self::getOptions() as $item) {
			$checked = (in_array($item["value"], self::getValue())) ? 'checked' : '';
			$options_checkbox .= "<div class='" . self::getClass() . "'>
				<input type='checkbox' name='" . $item["name"] . "' id='" . $item["id"] . "' value='" . $item["value"] . "' " . $checked . " />
				<label for='" . $item["value"] . "'>" . $item["label"] . "</label>
			</div>";
		}
		return $options_checkbox;
	}
  
  public static function checkbox() {
		$html = "
			<p>
				<div class='titulo-input'>
					" . self::getTitulo() . "
				</div>
				<div class='itens-checkbox'>
					" . self::optionsCheckbox() . "
				</div>
			</p>
		";
		return $html;
	}

} ?>