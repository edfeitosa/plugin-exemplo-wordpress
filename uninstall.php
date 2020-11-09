<?php
if (!defined('WP_UNINSTALL_PLUGIN')) exit();
define('PREFIX_PLUGIN', 'libera_site_');
global $wbdb;
$table_sites = $wbdb->prefix . PREFIX_PLUGIN . 'sites';
$wbdb->query("drop table if exists $table_sites");

delete_option('libera_site_plugin');
delete_site_option('libera_site_plugin');
?>