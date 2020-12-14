<?php

/**
 * Plugin Name: Endpoints
 * Description: Gerenciamento de endpoints para acesso a informações via API
 * Version: 1.0
 * Author: Eduardo Feitosa | Squad Robocorp - Localiza Labs
**/

error_reporting(-1);
ini_set('display_errors', 'On');

if (!defined('ABSPATH')) exit;

date_default_timezone_set('America/Sao_Paulo');

define('WP_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('WP_UNINSTALL_PLUGIN', WP_PLUGIN_PATH . '/endpoints/uninstall.php');
define('PREFIX_PLUGIN', 'endpoints_');

require_once(WP_PLUGIN_PATH . 'Src/Autoload.php');

function table_name() {
	global $wpdb;
	return array(
		'endpoints' => $wpdb->prefix . PREFIX_PLUGIN . 'uri',
		'tokens' => $wpdb->prefix . PREFIX_PLUGIN . 'tokens',
		'charset' => $wpdb->get_charset_collate()
	);
}

function endpoints_table($table_data) {
	return 'CREATE TABLE IF NOT EXISTS ' . $table_data['endpoints'] . ' (
		`uri_id` int(11) AUTO_INCREMENT PRIMARY KEY,
		`uri_title` varchar(255) NOT NULL,
		`uri_endpoint` varchar(150) NOT NULL,
		`uri_status` tinyint(1) NOT NULL DEFAULT 1,
		`uri_user` varchar(100) NOT NULL,
		`uri_resources` varchar(255) NOT NULL,
		`uri_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
	) ' . $table_data['charset'] . ';';
}

function tokens_table($table_data) {
	return 'CREATE TABLE IF NOT EXISTS ' . $table_data['tokens'] . ' (
		`tok_id` int(11) AUTO_INCREMENT PRIMARY KEY,
		`tok_title` varchar(255) NOT NULL,
		`tok_status` tinyint(1) NOT NULL DEFAULT 1,
		`tok_user` varchar(100) NOT NULL,
		`tok_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
	) ' . $table_data['charset'] . ';';
}

register_activation_hook(__FILE__, 'create_table_on_activation');

function db_update($table_to_create) {
  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($table_to_create);
}

function create_table_on_activation() {
	$table = table_name();
	db_update(endpoints_table($table));
	db_update(tokens_table($table));
}

register_deactivation_hook(__FILE__, 'truncate_table_on_deactivation');

function truncate_table_on_deactivation() {
	global $wpdb;
	$wpdb->query('TRUNCATE TABLE ' . table_name()['endpoints']);
	$wpdb->query('TRUNCATE TABLE ' . table_name()['tokens']);
	delete_option('endpoints_plugin');
	delete_site_option('endpoints_plugin');
}

function styles_admin() {
	Shared\Styles::styles_admin();
	Shared\Scripts::scripts_admin();
}
add_action('admin_enqueue_scripts', 'styles_admin');

add_action('admin_menu', 'add_custom_menu_item');

function add_custom_menu_item() {
	global $home, $create;
	add_menu_page('', 'Endpoints', 'manage_options', 'homeEndpoints', 'home_endpoints', 'dashicons-privacy');
	add_submenu_page('homeEndpoints', '', 'Novo Endpoint', 'manage_options', 'edition_endpoints', 'edition_endpoints');
	add_submenu_page('homeEndpoints', '', 'Tokens', 'manage_options', 'home_tokens', 'home_tokens');
	add_submenu_page('homeEndpoints', '', 'Novo Token', 'manage_options', 'edition_tokens', 'edition_tokens');
}

function home_endpoints() { Templates\HomeEndpoints::home(); }
function edition_endpoints() { Templates\EditionEndpoints::new(); }
function home_tokens() { Templates\HomeTokens::home(); }
function edition_tokens() { Templates\EditionTokens::new(); }

add_action(
	'rest_api_init',
	function () {
		register_rest_route (
			'localiza/v1',
			'/api/(?P<endpoint>[a-zA-Z0-9 .\-]+)',
			array(
				'methods' => 'GET',
				'callback' => 'get_endpoint',
				'args' => array('endpoint')
				)
			);
		}
	);
	
function get_endpoint() { Source\Endpoints::get_endpoint(); }

function remove_upgrade_nag() {
	echo '<style type="text/css"> .update-nag {display: none} </style>';
}

add_action('admin_head', 'remove_upgrade_nag');

?>