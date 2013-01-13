<?php

$target_string = "http://pepegoogle.com";
/*
if (preg_match('/http:\/\/([^\/]+)\//i', $target_string, $matches)) {
  $domain = $matches[1];
}
*/

$url = parse_url($target_string);

//print_r($url);

$host =  ucfirst(explode('.', str_ireplace('www.','',parse_url($target_string,PHP_URL_HOST)))[0]);

print_r($host);


$page = "http://google.no/page/page_1.html";
preg_match_all("/((?:[a-z][a-z\\.\\d\\-]+)\\.(?:[a-z][a-z\\-]+))(?![\\w\\.])/", $page, $result, PREG_PATTERN_ORDER);

//print_r($result);

