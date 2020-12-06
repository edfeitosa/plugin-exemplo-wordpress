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

// dados da tabela
function table_name() {
	global $wpdb;
	return array(
		'endpoints' => $wpdb->prefix . PREFIX_PLUGIN . 'uri',
		'charset' => $wpdb->get_charset_collate()
	);
}

function endpoints_table($table_data) {
	return 'CREATE TABLE IF NOT EXISTS ' . $table_data['endpoints'] . ' (
		`uri_id` int(11) AUTO_INCREMENT PRIMARY KEY,
		`uri_title` varchar(255) NOT NULL,
		`uri_endpoint` varchar(150) NOT NULL,
		`uri_auth_code` varchar(255) NOT NULL,
		`uri_status` tinyint(1) NOT NULL DEFAULT 1,
		`uri_user` varchar(100) NOT NULL,
		`uri_resources` varchar(255) NOT NULL,
		`uri_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
	) ' . $table_data['charset'] . ';';
}

// cria tabela na ativação do plugin
register_activation_hook(__FILE__, 'create_table_on_activation');

function db_update($table_to_create) {
  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($table_to_create);
}

function create_table_on_activation() {
	$table = table_name();
	db_update(endpoints_table($table));
}

// limpa dados da tabela na desativação
register_deactivation_hook(__FILE__, 'truncate_table_on_deactivation');

function truncate_table_on_deactivation() {
	global $wpdb;
	$wpdb->query('TRUNCATE TABLE ' . table_name()['sites']);
	delete_option('endpoints_plugin');
	delete_site_option('endpoints_plugin');
}

// registra css e scripts
function styles_admin() {
	Shared\Styles::styles_admin();
	Shared\Scripts::scripts_admin();
}
add_action('admin_enqueue_scripts', 'styles_admin');

// registra item no menu laterial
add_action('admin_menu', 'add_custom_menu_item');

function add_custom_menu_item() {
	global $home, $create;
	add_menu_page(
		'',
		'Endpoints',
		'manage_options',
		'consultar',
		'consultation',
		'dashicons-privacy'
	);
	add_submenu_page(
		'consultar',
		'',
		'Novo',
		'manage_options',
		'editar',
		'new_edition'
	);
}

function new_edition() { Templates\Edition::new(); }

function consultation() { Templates\Consultation::home(); }

?>