<?php
namespace Source;

use Interfaces\ITokens;

class Tokens implements ITokens {

	public static function authorization($header) {
		global $wpdb;
		$auth = $header['Authorization'];
		$bearer = explode(' ', $auth);
		$code = end($bearer);
		$data = $wpdb->get_results("select tok_token from " . $wpdb->prefix ."endpoints_tokens where tok_token = '$code' and tok_status = '1'");

		if (count($data) == 0) {
			return false;
		}

		return true;
	}

  public static function insert() {
		global $wpdb;
		if (isset($_POST['titulo'])) {			
			$wpdb->insert(
          $wpdb->prefix . PREFIX_PLUGIN . 'tokens',
          array(
						'tok_title' => $_POST['titulo'],
						'tok_token' => md5($_POST['titulo'] . date()),
						'tok_status' => $_POST['status'],
						'tok_user' => get_current_user_id()
          ),
          array('%s', '%s', '%s', '%s')
			);
		}
	}

} ?>