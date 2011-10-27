<?php

function voyant_viewer_display($items = null) {
  $html = '';

  if ($items) {
    
    // Create an array for our Voyant input params
    $itemUrls = array();

    // Loop through our items.
    foreach ($items as $item) {

      // Get the URL for the item.
      $itemUrls[] = abs_item_uri($item);

    }

    $voyantInputParams = array('input' => $itemUrls);

    $voyantInputString = http_build_query($voyantInputParams, '', '&amp;');

    $voyantInputUrl = 'http://voyeurtools.org/tool/Cirrus/?'.$voyantInputString;


    $html = '<iframe src="'.$voyantInputUrl.'" id="voyant-viewer" width="400px" height="400px"></iframe>';
  }

  return $html;
}

function voyant_viewer_echo($items = null) {
  if (!$items) {
    $items = get_items(array('collection'=>get_current_collection()->id));
  }

  echo voyant_viewer_display($items);
}

add_plugin_hook('public_append_to_collections_show', 'voyant_viewer_echo');
