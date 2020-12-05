<?php
namespace Shared;

use Interfaces\IRoute;

class Route implements IRoute {

  public static function servidor() {
		return 'http://' . strval($_SERVER['HTTP_HOST']);
	}
	
	public static function uri() {
		return strval($_SERVER['REQUEST_URI']);
	}
	
	public static function identificator() {
		return (empty($_GET['id'])) ? '0' : $_GET['id'];
	}

} ?>