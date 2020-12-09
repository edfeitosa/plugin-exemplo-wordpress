<?php
if (!defined('WP_UNINSTALL_PLUGIN')) exit();
define('PREFIX_PLUGIN', 'endpoints_');
global $wbdb;
$table = $wpdb->prefix . PREFIX_PLUGIN . 'uri';
$wbdb->query("drop table if exists $table");

delete_option('endpoints_plugin');
delete_site_option('endpoints_plugin');
?>