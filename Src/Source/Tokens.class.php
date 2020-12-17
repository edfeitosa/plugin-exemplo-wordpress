<?php
namespace Source;

use Interfaces\ITokens;

class Tokens implements ITokens {

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