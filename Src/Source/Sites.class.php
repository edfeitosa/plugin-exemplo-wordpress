<?php
namespace Source;

class Sites {

	private function sanitizeString($str) {
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
	
	public static function auth() {
		// http://localhost/estudo-plugins-wordpress/wp-json/liberasite/v1/autorizacao?id=9
		$id = $_REQUEST['id'];
		
		http_response_code(201);
		echo json_encode(array(
			'type' => 'success',
			'title' => 'Sucesso',
			'message' => 'Site autorizado com sucesso'
		));
	}
	
	public static function insert() {
		global $wpdb;
		if (isset($_POST['titulo'])) {
			$wpdb->insert(
          $wpdb->prefix . PREFIX_PLUGIN . 'sites',
          array(
						'sit_title' => $_POST['titulo'],
						'sit_endpoint' => self::sanitizeString($_POST['endpoint']),
						'sit_auth_code' => md5(date(DATE_RFC822)),
						'sit_status' => $_POST['status'],
						'sit_user' => get_current_user_id(),
						'sit_resources' => $_POST['resources']
          ),
          array('%s', '%s', '%s', '%s', '%s', '%s')
      );
		}
	}
	
} ?>