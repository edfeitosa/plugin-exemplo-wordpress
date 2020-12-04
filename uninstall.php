<?php
if (!defined('WP_UNINSTALL_PLUGIN')) exit();
define('PREFIX_PLUGIN', 'endpoints_');
global $wbdb;
$table_sites = $wbdb->prefix . PREFIX_PLUGIN . 'sites';
$wbdb->query("drop table if exists $table_sites");

delete_option('endpoints_plugin');
delete_site_option('endpoints_plugin');
?>