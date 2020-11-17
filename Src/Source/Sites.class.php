<?php
namespace Source;

class Sites {
	
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
						'sit_url' => $_POST['url'],
						'sit_auth_code' => md5(date(DATE_RFC822)),
						'sit_status' => $_POST['status'],
						'sit_user' => get_current_user_id()
          ),
          array('%s', '%s', '%s', '%s', '%s')
      );
		}
	}
	
} ?>