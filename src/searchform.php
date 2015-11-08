<form id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" role="search">
  <input id="s" name="s" type="text" class="form-control" value="<?php echo get_search_query(); ?>" placeholder="<?php esc_attr_e( 'Search', 'hesitant' ); ?>">
</form>
