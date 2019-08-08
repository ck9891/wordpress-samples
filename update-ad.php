<?php

function macstrap_update_ad_process()
{
  if (isset($_POST) && !empty($_POST)) :

    $keys = array_keys($_POST);
    $values = array_values($_POST);
    $post_id = $_POST['post_id'];
    foreach ($_POST as $key => $value) :
      if ('edit_rent' == $key) :
        update_field('rent', sanitize_text_field($value), $post_id);
      endif;
      if ('edit_date' == $key) :
        update_field('date_available', $value, $post_id);
      endif;
      if ('edit_rooms' == $key) :
        update_field('rooms_available', $value, $post_id);
      endif;
      if ('edit_description' == $key) :
        update_field('lead_text', sanitize_text_field($value), $post_id);
      endif;
      if ('amenities' == $key) :
        update_post_meta($post_id, 'amenities_available', $value);
      endif;
      if ('utilities' == $key) :
        update_field('utilities_included', $value, $post_id);
      endif;
      if ('accessible' == $key) :
        update_field('wheelchair_accessible', $value, $post_id);
      endif;
      if ('term_type' == $key) :
        update_field('term_type', $value, $post_id);
      endif;
    endforeach;

  endif;

  wp_die();
}

add_action('wp_ajax_macstrap_update_ad_process', 'macstrap_update_ad_process');
add_action('wp_ajax_nopriv_macstrap_update_ad_process', 'macstrap_update_ad_process');

function macstrap_remove_ad_process()
{
  $post_id = $_POST['post_ID'];
  wp_set_object_terms($post_id, 'Expired', 'property_type');
}

add_action('wp_ajax_macstrap_remove_ad_process', 'macstrap_remove_ad_process');
add_action('wp_ajax_nopriv_macstrap_remove_ad_process', 'macstrap_remove_ad_process');
