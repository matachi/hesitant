<?php
$client = 'client_code';
$ads = array(
  0 => array( 'id' => 'slot_code', 'format' => 'auto' ),
  1 => array( 'id' => 'slot_code', 'format' => 'link' ),
  2 => array( 'id' => 'slot_code', 'format' => 'link' ),
  3 => array( 'id' => 'slot_code', 'format' => 'link' )
);
$id = get_query_var( 'hesitant_ad_id', 0 );

if ( $id >= 0 && $id < sizeof( $ads ) ) {
?>
  <article class="ad-slot <?php if ($id == 0) print( 'first' ); else print( 'following' ); ?> <?php if ($ads[$id]['format'] == 'auto') print( 'aut' ); else print( 'link' ); ?>">
    <div>
      <ins class="adsbygoogle"
        style="display:block"
        data-ad-client="<?php print($client); ?>"
        data-ad-slot="<?php print($ads[$id]['id']); ?>"
        data-ad-format="<?php print($ads[$id]['format']); ?>"></ins>
      <script>
      (adsbygoogle = window.adsbygoogle || []).push({});
      </script>
    </div>
  </article>
<?php
}
if ( $id == 0 ) {
  function hesitant_adsense_script() {
    print( '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>' );
  }
  add_action( 'wp_footer', 'hesitant_adsense_script', 100 );
}
?>
