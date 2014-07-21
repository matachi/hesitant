<form id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" role="search">
  <div class="input-group">
    <!--<label class="screen-reader-text" for="s">-->
      <!--Sök efter:-->
    <!--</label>-->
    <input id="s" name="s" type="text" class="form-control" value="<?php echo get_search_query(); ?>">
    <span class="input-group-btn">
      <input class="btn btn-default" type="submit" value="<?php esc_attr_e( 'Search', 'dunham-2036' ); ?>">
    </span>
  </div>
</form>
