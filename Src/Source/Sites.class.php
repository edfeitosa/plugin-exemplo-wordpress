<?php
namespace Source;

use Shared\Route;

class Sites {

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
		$endpoint = explode('?', $uri[6]);
		return $endpoint[0];
	}

	public static function get_endpoint() {
		// http://localhost/estudo-plugins-wordpress/wp-json/localiza/v1/autorizacao?id=9
		// $id = $_REQUEST['id'];

		echo self::verify_endpoint();
		if (isset($_GET['categoria'])) { echo $_GET['categoria']; }
		if (isset($_GET['id'])) { echo $_GET['id']; }

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
						'uri_auth_code' => md5(date(DATE_RFC822) . $clean_uri),
						'uri_status' => $_POST['status'],
						'uri_user' => get_current_user_id(),
						'uri_resources' => $_POST['resources']
          ),
          array('%s', '%s', '%s', '%s', '%s', '%s')
			);
		}
	}
	
} ?>