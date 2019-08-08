add_action('macsites_listings', 'get_listings', 30);

function get_listings()
{
  $args = array(
    'post_type' => 'product',
    'post_status' => 'publish',
    'ignore_sticky_posts' => 1,
    'posts_per_page' => 4,
    'order' => 'ASC',
  );
  $products = new WP_Query($args);
  // empty the cart on page load, just in case
  if ($products->have_posts()) :
    while ($products->have_posts()) : $products->the_post();
      $_product = wc_get_product(get_the_id());

      $ad_title = clean(get_the_title());
      if ($ad_title === 'Ad-Extension') :
        $ad_title .= ' d-none';
      endif;

      print '<div class="col-md-4 col-sm-6 ' . $ad_title . '">
						        <div role="button" class="card card-shadow label-btn ajax_add_to_cart add_to_cart_button product_type_simple single_add_to_cart_button" data-product_id="' . $_product->get_id() . '">
						          <div class="card-body text-center card-link-floater card-link-floater-lg">
						                <span class="icon-circle"><span class="icon-text">$' . $_product->get_price() . '</span></span>
						                <h3 class="card-title">' . get_the_title() . '</h3>
						                <p class="card-text mb-5 pb-4 description">' . $_product->get_short_description() . '</p>
						                <div class="floater">
						                  <label class="hidden-radio d-block" for="' . clean(get_the_title()) . '-ad">
						                  <input type="radio" name="radio1" id="' . clean(get_the_title()) . '-ad" value="' . get_the_title() . '" class="ad-radio">
						                  <span class="btn btn-primary  btn-arrow rotate-arrow" >' . get_the_title() . '</div>
						                  </label>
						              </div>
						          </div>
						      </div>';
    endwhile;
  endif;
}
