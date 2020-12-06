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
	
	public static function set_titulo($vtitulo) {
		self::$titulo = $vtitulo;
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

	private static function optionsCheckbox() {
		$html = "";
		
		if (!self::get_options()) {
			
			$html .= "<div class='alert'>
				Não existem categorias cadastradas. Para continuar, é necessário selecionar pelo menos uma categoria.
			</div>";
			
		} else {
			
			foreach (self::get_options() as $item) {
				$checked = (in_array($item["value"], self::get_value())) ? 'checked' : '';
				$html .= "<div class='" . self::get_class() . "'>
					<input type='checkbox' class='item-check' name='item-check' id='" . $item["id"] . "' value='" . $item["value"] . "' " . $checked . " />
					<label for='" . $item["value"] . "'>" . $item["label"] . "</label>
				</div>";
			}
			
		}
		
		return $html;
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