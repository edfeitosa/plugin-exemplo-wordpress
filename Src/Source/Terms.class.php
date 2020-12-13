<?php
namespace Source;

use Interfaces\ITerms;

class Terms implements ITerms {

  public static function getTerms() {
    global $wpdb;
		$categories = $wpdb->get_results("select * from $wpdb->terms where slug <> 'sem-categoria'");
		$optionsCheckbox = array();
		foreach ($categories as $item) {
			array_push($optionsCheckbox, [
				"value" => $item->slug,
				"id" => $item->slug,
				"name" => $item->slug,
				"label" => $item->name
			]);
		}
		return $optionsCheckbox;
  }

} ?>