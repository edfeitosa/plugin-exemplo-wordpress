<?php

/**
 * Plugin Name: Libera Site
 * Description: Verifica permissão de sites para acesso às informações
 * Version: 1.0
 * Author: Localiza Labs
**/

error_reporting(-1);
ini_set('display_errors', 'On');

if (!defined('ABSPATH')) exit;

date_default_timezone_set('America/Sao_Paulo');

define('WP_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('WP_UNINSTALL_PLUGIN', WP_PLUGIN_PATH . '/libera_site/uninstall.php');
define('PREFIX_PLUGIN', 'libera_site_');

require_once(WP_PLUGIN_PATH . 'Src/Autoload.php');

// dados da tabela
function table_name() {
	global $wpdb;
	return array(
		'sites' => $wpdb->prefix . PREFIX_PLUGIN . 'sites',
		'charset' => $wpdb->get_charset_collate()
	);
}

function sites_table($table_data) {
	return 'CREATE TABLE IF NOT EXISTS ' . $table_data['sites'] . ' (
		`sit_id` int(11) AUTO_INCREMENT PRIMARY KEY,
		`sit_title` varchar(255) NOT NULL,
		`sit_url` varchar(255) NOT NULL,
		`sit_auth_code` varchar(255) NOT NULL,
		`sit_status` tinyint(1) NOT NULL DEFAULT 1,
		`sit_user` varchar(100) NOT NULL,
		`sit_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
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
	db_update(sites_table($table));
}

// limpa dados da tabela na desativação
register_deactivation_hook(__FILE__, 'truncate_table_on_deactivation');

function truncate_table_on_deactivation() {
	global $wpdb;
	$wpdb->query('TRUNCATE TABLE ' . table_name()['sites']);
	delete_option('libera_site_plugin');
	delete_site_option('libera_site_plugin');
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
		'Libera Site',
		'manage_options',
		'consultar',
		'consulta',
		'dashicons-privacy'
	);
	add_submenu_page(
		'consultar',
		'',
		'Novo',
		'manage_options',
		'editar',
		'novo'
	);
}

function novo() { Templates\Edicao::novo(); }

function consulta() { Templates\Consulta::home(); }

// adiciona novo endpoint
add_action(
	'rest_api_init',
	function () {
		register_rest_route (
			'liberasite/v1',
			'/autorizacao',
			array(
				'methods' => 'GET',
				'callback' => 'autorizacao'
			)
		);
	}
);

function autorizacao() { Source\Sites::autorizacao(); }

?>