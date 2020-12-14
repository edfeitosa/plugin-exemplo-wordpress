<?php
if (!defined('WP_UNINSTALL_PLUGIN')) exit();
define('PREFIX_PLUGIN', 'endpoints_');

global $wbdb;

$uri = $wpdb->prefix . PREFIX_PLUGIN . 'uri';
$wbdb->query("drop table if exists $uri");

$tokens = $wpdb->prefix . PREFIX_PLUGIN . 'tokens';
$wbdb->query("drop table if exists $tokens");

delete_option('endpoints_plugin');
delete_site_option('endpoints_plugin');
?>