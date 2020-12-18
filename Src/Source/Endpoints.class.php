<?php
namespace Source;

use Shared\Route;
use Shared\Response;
use Interfaces\IEndpoints;
use Source\Tokens;

class Endpoints implements IEndpoints {

	private static function sanitize_string($str) {
    $str = preg_replace('/[áàãâä]/ui', 'a', $str);
    $str = preg_replace('/[éèêë]/ui', 'e', $str);
    $str = preg_replace('/[íìîï]/ui', 'i', $str);
    $str = preg_replace('/[óòõôö]/ui', 'o', $str);
    $str = preg_replace('/[úùûü]/ui', 'u', $str);
    $str = preg_replace('/[ç]/ui', 'c', $str);
    $str = preg_replace('/[^a-z0-9]/i', '_', $str);
    $str = preg_replace('/_+/', '-', $str);
		return $str;
	}

	private static function exists_authorization($headers) {
		if (!isset($headers['Authorization'])) {
			return false;
		}
		return true;
	}

	private static function verify_endpoint() {
		$uri = explode('/', Route::uri());
		$endpoint = explode('?', end($uri));
		return $endpoint[0];
	}

	private static function resources($endpoint) {
		global $wpdb;
		$data = $wpdb->get_results("select uri_resources from " . $wpdb->prefix ."endpoints_uri where uri_endpoint = '$endpoint' and uri_status = '1'");

		if (count($data) == 0) {
			return false;
		}

		foreach($data as $item) {
			return $item->uri_resources;
		}
	}

	public static function get_endpoint() {
		/* echo self::verify_endpoint();
		if (isset($_GET['categoria'])) { echo $_GET['categoria']; }
		if (isset($_GET['id'])) { echo $_GET['id']; } */

		$headers = apache_request_headers();

		if (!self::exists_authorization($headers)) {
			Response::set_code(400);
			Response::response(array('erro' => 'é necessário informar um token para acesso'));
			exit();
		}

		if (!Tokens::authorization($headers)) {
			Response::set_code(401);
			Response::response(array('erro' => 'token informado não é válido'));
			exit();
		}

		$resources = self::resources(self::verify_endpoint());

		if (!$resources) {
			Response::set_code(404);
			Response::response(array('erro' => 'recurso não encontrado'));
			exit();
		} else {
			echo $resources;
		}
		
	}
	
	public static function insert() {
		global $wpdb;
		if (isset($_POST['titulo'])) {
			$clean_uri = self::sanitize_string($_POST['endpoint']);
			
			$wpdb->insert(
          $wpdb->prefix . PREFIX_PLUGIN . 'uri',
          array(
						'uri_title' => $_POST['titulo'],
						'uri_endpoint' => $clean_uri,
						'uri_status' => $_POST['status'],
						'uri_user' => get_current_user_id(),
						'uri_resources' => $_POST['resources']
          ),
          array('%s', '%s', '%s', '%s', '%s')
			);
		}
	}
	
} ?>