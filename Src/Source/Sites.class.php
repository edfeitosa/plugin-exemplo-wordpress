<?php
namespace Source;

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

	private static function register_endpoint() {
		/* add_action(
			'rest_api_init',
			function () {
				register_rest_route (
					'localiza/v1',
					'/autorizacao',
					array(
						'methods' => 'GET',
						'callback' => 'getEndpoint'
					)
				);
			}
		); */
	}

	private static function deregister_endpoint() {
		/*
		function disables_wordpress_api($endpoints) {
			$apis = array('posts', 'pages', 'comments', 'users', 'media');
			for($i = 0; $i < count($apis); $i++) {
				if (isset($endpoints['/localiza/v1/' . $apis[$i]])) {
					unset($endpoints['/localiza/v1/' . $apis[$i]]);
				}
				if (isset( $endpoints['/localiza/v1/' .  $apis[$i] . '/(?P<id>[\d]+)'] ) ) {
					unset($endpoints['/localiza/v1/' .  $apis[$i] . '/(?P<id>[\d]+)'] );
				}
			}
			return $endpoints;
		}

		add_filter('rest_endpoints', 'disables_wordpress_api');
		*/
	}
	
	public static function getEndpoint() {
		// http://localhost/estudo-plugins-wordpress/wp-json/localiza/v1/autorizacao?id=9
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
			echo $wpdb->insert(
          $wpdb->prefix . PREFIX_PLUGIN . 'uri',
          array(
						'uri_title' => $_POST['titulo'],
						'uri_endpoint' => self::sanitize_string($_POST['endpoint']),
						'uri_auth_code' => md5(date(DATE_RFC822)),
						'uri_status' => $_POST['status'],
						'uri_user' => get_current_user_id(),
						'uri_resources' => $_POST['resources']
          ),
          array('%s', '%s', '%s', '%s', '%s', '%s')
      );
		}
	}
	
} ?>