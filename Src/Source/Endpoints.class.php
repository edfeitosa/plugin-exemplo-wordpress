<?php
namespace Source;

use Shared\Route;
use Shared\Response;
use Interfaces\IEndpoints;

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
	
	private static function verify_endpoint() {
		$uri = explode('/', Route::uri());
		$endpoint = explode('?', end($uri));
		return $endpoint[0];
	}

	private static function verify_authorization($headers) {
		if (!isset($headers['Authorization'])) {
			Response::set_code(400);
			Response::response(array('erro' => 'é necessário informar um token para acesso'));
			exit();
		}
	}

	private static function data_authorization($headers) {
		global $wpdb;
		$auth = $headers['Authorization'];
		$bearer = explode(' ', $auth);
		$code = end($bearer);
		$data = $wpdb->get_results("select uri_endpoint, uri_resources from " . $wpdb->prefix ."endpoints_uri where uri_auth_code = '$code'");

		if (count($data) == 0) {
			Response::set_code(401);
			Response::response(array('erro' => 'token informado não é válido'));
			exit();
		}

		foreach($data as $item) {
			return array(
				'endpoint' => $item->uri_endpoint,
				'categorias' => $item->uri_resources
			);
		}
	}

	public static function get_endpoint() {
		// http://localhost/estudo-plugins-wordpress/wp-json/localiza/v1/autorizacao?id=9
		// $id = $_REQUEST['id'];

		/* echo self::verify_endpoint();
		if (isset($_GET['categoria'])) { echo $_GET['categoria']; }
		if (isset($_GET['id'])) { echo $_GET['id']; } */

		$headers = apache_request_headers();
		self::verify_authorization($headers);
		//print_r(self::data_authorization($headers));

		/* http_response_code(200);
		echo json_encode(array(
			'type' => 'success',
			'title' => 'Sucesso',
			'message' => 'Site autorizado com sucesso | id: ' . $_REQUEST
		)); */
		
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