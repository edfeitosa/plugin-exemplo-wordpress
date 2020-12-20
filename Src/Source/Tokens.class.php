<?php
namespace Source;

use Interfaces\ITokens;

class Tokens implements ITokens {

	public static function authorization($header) {
		global $wpdb;
		$auth = $header['Authorization'];
		$bearer = explode(' ', $auth);
		$code = end($bearer);
		$data = $wpdb->get_results("SELECT tok_token FROM " . $wpdb->prefix ."endpoints_tokens WHERE tok_token = '$code' AND tok_status = '1'");

		if (count($data) == 0) {
			return false;
		}

		return true;
	}

	public static function get_tokens() {
		global $wpdb;

		$query = "SELECT tok_id, tok_title, tok_token, tok_date FROM " . $wpdb->prefix ."endpoints_tokens";

		$data = $wpdb->get_results($query);

		if (count($data) == 0) {
			return false;
		}

		$result = array();

		foreach($data as $item) {
			array_push($result, [
        "identificador" => $item->tok_id,
        "titulo" => $item->tok_title,
        "token" => $item->tok_token,
        "data" => date('d/m/Y H:m:i', strtotime($item->tok_date))
      ]);
		}

		return $result;
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