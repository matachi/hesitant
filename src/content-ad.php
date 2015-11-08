<?php
$client = 'client_code';
$ads = array(
  0 => 'slot_code',
  1 => 'slot_code'
);
$id = get_query_var( 'hesitant_ad_id', 0 );

if ($id > 0)
  return
?>
<article>
  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  <!-- Annons 3 -->
  <ins class="adsbygoogle"
    style="display:block"
    data-ad-client="<?php print($client); ?>"
    data-ad-slot="<?php print($ads[$id]); ?>"
    data-ad-format="auto"></ins>
  <script>
  (adsbygoogle = window.adsbygoogle || []).push({});
  </script>
</article>
