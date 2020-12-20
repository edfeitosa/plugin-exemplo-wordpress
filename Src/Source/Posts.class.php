<?php
namespace Source;

use Interfaces\IPosts;

class Posts implements IPosts {

  private static function query_categories($categories) {
    $result = '';
    $list = explode(',', $categories);
    for($i = 0; $i < count($list); $i++) {
      if ($i == 0) {
        $result .= "AND terms.slug = '" . $list[$i] . "' ";
      } else {
        $result .= "OR terms.slug = '" . $list[$i] . "' ";
      }
    }
    return $result;
  }

  public static function get_posts($categories) {
    global $wpdb;

    $query = "
      SELECT terms.slug, posts.post_title, posts.post_content, posts.post_date 
      FROM  " . $wpdb->prefix ."terms AS terms 
      LEFT JOIN " . $wpdb->prefix ."term_relationships AS relations ON terms.term_id = relations.term_taxonomy_id 
      INNER JOIN " . $wpdb->prefix ."posts AS posts ON posts.ID = relations.object_id 
      WHERE 1=1
      " . self::query_categories($categories) . "
    ";

    $data = $wpdb->get_results($query);

    $result = array();

    foreach($data as $item) {
      array_push($result, [
        "categoria" => $item->slug,
        "titulo" => $item->post_title,
        "conteudo" => trim(strip_tags($item->post_content), "\n"),
        "data" => date('d/m/Y H:m:i', strtotime($item->post_date))
      ]);
    }

    return $result;
  }

} ?>