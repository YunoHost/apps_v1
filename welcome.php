<?php

$rss_tags = array(  
'title',  
'link',  
'guid',  
'comments',  
'description',  
'pubDate',  
'category',  
);  
$rss_item_tag = 'item';  
$rss_url = 'http://yunohost.org/feed/';

$rssfeed = rss_to_array($rss_item_tag, $rss_tags, $rss_url);

// echo '<pre>';  
// print_r($rssfeed);

function rss_to_array($tag, $array, $url) {  
  $doc = new DOMdocument();  
  $doc->load($url);  
  $rss_array = array();  
  $items = array();  
  foreach($doc-> getElementsByTagName($tag) AS $node) {  
    foreach($array AS $key => $value) {  
      $items[$value] = $node->getElementsByTagName($value)->item(0)->nodeValue;  
    }  
    array_push($rss_array, $items);  
  }  
  return $rss_array;  
}  
?>

<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Yunohost apps</title>
  <link media="all" type="text/css" href="welcome.css" rel="stylesheet">
</head>
<body class="gradient" style="overflow: hidden">
  <img src="yourapps.png" alt="Your apps" class="yourapps">
  <img src="profileandlogout.png" alt="Profile and logout" class="profileandlogout">
  <img src="mailandim.png" alt="Mail and IM" class="mailandim">
</body>