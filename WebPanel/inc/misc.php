<?php
class Misc
{
  public static function appendParameters($url, $parameter, $value)
  {
    $new_data = array($parameter => $value);
    $parsedurl = parse_url($url);
    $query = $parsedurl['query'];
    $getparams = null;
    parse_str($query, $getparams);
    $full_data = array_merge($getparams, $new_data);  // New data will overwrite old entry
    $newurl = http_build_query($full_data);
    return $parsedurl['path'] . '?' . $newurl;
  }
}
