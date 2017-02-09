<?php

# wrapper around simplexml_load_file() via http
# and some handy functions 4 japangoodsfinder.com

/* NoPro - Webwork
 * (c) 2014 by NoPro, Limburg (Germany)
 * nopro4biz@gmail.com
 */

$HTTP_STATUS = null; // global var status of last nopro_fetch()
$HTTP_HEAD = null; // global var head of last nopro_fetch()

function nopro_err() {
  // check if last nopro_fetch was 200 or 2xx and not 4xx 5xx nor 3xx
  global $HTTP_STATUS;
  return !($HTTP_STATUS && substr($HTTP_STATUS, 0, 1) == '2');
}

function curl_get($url, $getit = true, $gzip = false) {
  // do http-request using curl-lib

  $ch = curl_init();

  if ($gzip):;
    # $header[] = "Accept: application/json";
    $header[] = "Accept-Encoding: gzip";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_ENCODING, "gzip");
  # curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
  endif;

  // set URL and other appropriate options
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_HEADER, true); // 1 = true
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_NOBODY, !$getit);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_MAXREDIRS, 0);

  curl_setopt($ch, CURLOPT_COOKIEFILE, '');
  curl_setopt($ch, CURLOPT_COOKIEJAR, '');

  curl_setopt($ch, CURLOPT_TIMEOUT, 25);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

  # curl_exec($ch);		// grab URL and pass it to the browser
  $http_resp = curl_exec($ch); // grab URL as string
  curl_close($ch);  // close cURL resource, and free up system resources

  return $http_resp;
}

function nopro_loggit($msg) {
  // log msg
  $loglvl = LOG_INFO;
  $loglvl = LOG_DEBUG;
  #return syslog($loglvl, preg_replace("/\n/", " ", $msg));

  $now = gmdate('Y-m-d\TH:i:s');
  $lh = fopen('nopro_load.log', 'a');
  fwrite($lh, "$now " . preg_replace("/\n/", " ", $msg) . "\n");
  fclose($lh);
}

function nopro_log($url, $head, $t) {
  // log http transfer and duration
  nopro_loggit("nopro_load($url)");
  nopro_loggit("duration $t");
  nopro_loggit(preg_replace("/\r/", ' |', $head));
}

function nopro_fetch_url($url) {
  // return http-body
  $t0 = microtime(true);
  $http_resp = curl_get($url, true, true);
  $t1 = microtime(true);
  list($http_head, $http_data) = explode("\r\n\r\n", $http_resp, 2);
  // store http-status in global var
  global $HTTP_STATUS, $HTTP_HEAD;
  $HTTP_HEAD = $http_head;
  $HTTP_STATUS = substr($http_head, strlen('HTTP/1.1 '), 3);
  #nopro_loggit("http-stat $HTTP_STATUS");

  nopro_log($url, $http_head, $t1 - $t0);
  return $http_data;
}
/*
function nopro_cache($url, $refresh = false) {
  // return local filename
  $tbl = 'nopro_cache';

  // url is _not_always_ free of whitespace yet
  #$url = preg_replace('/\s+/', '%20', $url);
  $url = preg_replace('/ +/', '%20', $url);

  $url4sql = addslashes($url);
  if (!$refresh):
    // lookup if already in cache
    $q = "SELECT * FROM $tbl WHERE url = '$url4sql' LIMIT 1";
    $res = mysql_query($q) OR die("$tbl select(): " . mysql_error());
    $row = mysql_fetch_assoc($res);
    mysql_free_result($res);
  endif; // !$refresh
  $now = gmdate('Y-m-d H:i:s');
  if (!$refresh && $row !== false) {
    // found in cache
    $path = $row['path'];
    $count = 1 + $row['counted'];
    $q = "UPDATE $tbl SET `accesstim` = '$now', `counted` = $count WHERE `id` = " . $row['id'];
    mysql_query($q) OR die("$tbl update(): " . mysql_error());
    nopro_loggit("from cache " . $row['filelen'] . " $url");
  } else {
    $path = tempnam('cache', 'nc_');
    $fh = fopen($path, 'w');
    $len = fwrite($fh, nopro_fetch_url($url));
    fclose($fh);
    if ($len === false || nopro_err()) {
      // skip db-entry for bad cachefile or bad http-request
      $len = 'NULL';
      unlink($path);
      $path = '/dev/null';
      #if(nopro_err()) nopro_loggit("http-error");
    } else {
      $q = "INSERT INTO $tbl SET `updatetim` = '$now', `accesstim` = '$now', `filelen` = $len, `path` = '$path', `url` = '$url4sql'";
      //nopro_loggit($q); // for debugging
      mysql_query($q) OR die("$tbl insert(): " . mysql_error());
    }
  }
  return $path;
}
*/
function nopro_load($url, $refresh = false) {
  if (!defined('ADMIN')) {
    // in case we're called via ajax,
    nopro_loggit("via ajax $url");
    //return file_get_contents($url);
    require_once("config/config.php");
  }
  $lfn = nopro_cache($url, $refresh);
  if ($lfn == '/dev/null') {
    return file_get_contents($url);
  }
  return file_get_contents($lfn);
}

function nopro_load_xml($url) {
/*  $lfn = nopro_cache($url);
  if ($lfn == '/dev/null')
    return false;*/
  return simplexml_load_file($url);
}

# some handy functions 4 japangoodsfinder.com

/* NoPro - Webwork
 * (c) 2014 by NoPro, Limburg (Germany)
 * nopro4niz@gmail.com
 */

function nopro_translate($str) {
  // wrapper aropund ms-translator-api
  // cache the result

  $str = trim($str);
  if (!$str)
    return '';

  // valid MS BING appIDs
  $bings = array(
      // ids from config/config.php
      '37E13AC276BAB67F701AFE3EB1B5AC14EE66A049',
      '73B027BB51D74FB461C097BCCF841DB5678FDBB3', // 15 times hard-coded
      //'B611C8D94F8ADC0E7A70F9F0395B648730314502', // invalid appID 2014-04-23
      '4AE4E978C7F81A2F27946EAE4F40548B725506CA',
      // hard-coded
      '58C40548A812ED699C35664525D8A8104D3006D2', // 56 times hard-coded
      '34D72613A8B6146B5D0BD0929AB0A9F355262DC6'  // once hard-coded
  );
  define('noptl_use_cache', 0);      // translator uses cache

  if (noptl_use_cache)
    $key = 2; // no random key when cached
  else
    $key = array_rand($bings);

  #$apicall = 'http://api.microsofttranslator.com/V2/Ajax.svc/Translate?appId='. $bings[$key] .'&from=ja&to=en&text='. urlencode($str);
  $apicall = 'http://api.microsofttranslator.com/V2/Ajax.svc/Translate?appId=' . $bings[$key] . '&from=ja&to=en&text=' . $str;

  if (noptl_use_cache)
    return file_get_contents(nopro_cache($apicall)); // use cache
  return $str;
  return 'NoPro_translate()';    // skip loading
  return nopro_fetch_url($apicall);   // realtime-load
}

function curr_100($c1, $c2, $refresh = false) {
  // read value from html-page and
  // return as string: yen for 100 U$
  $ptrn = '_result>';
  $htm = nopro_load("https://www.google.com/finance/converter?a=100&from=$c1&to=$c2", $refresh);
  $p1 = strpos($htm, $ptrn);
  if ($p1 === false)
    return "?";
  $p1 += strlen($ptrn);
  $p1 = strpos($htm, '>', $p1);
  if ($p1 === false)
    return "?";
  $p2 = strpos($htm, '<', $p1);
  if ($p2 === false)
    return "?";
  return substr($htm, ++$p1, $p2 - $p1);
}

function nopro_currconv($val, $src, $dst, $numbonly = false) {

  $r = nopro_currcurr($val, $src, $dst, $numbonly);
  return $numbonly ? $r : "$r&nbsp;$dst";

  // read quotient from html-page and
  // return as html: number-formated result
  $usd100 = curr_100('USD', 'JPY');
  if ($usd100 == "?")
    return "?&nbsp;$dst";
  #$usd100 = .0 + $usd100;
  if ($src == 'JPY' && $dst == 'USD')
    $rv = 100.0 * $val / $usd100;
  else if ($src == 'USD' && $dst == 'JPY')
    $rv = $usd100 * $val / 100;
  else
    return "?&nbsp;$dst";
  if ($dst == 'JPY')
    return number_format($rv, 0) . "&nbsp;$dst";
  return number_format($rv, 2) . "&nbsp;$dst";
}

function nopro_currcurr($val, $src, $dst) {
  // fetch quotient from DB and
  // return as string: number-formated result
  $tbl = 'nopro_currency';
  $q = "SELECT * FROM $tbl";
  $q .= " WHERE (currency1 = '$src' AND currency2 = '$dst')";
  $q .= " OR (currency1 = '$dst' AND currency2 = '$src')";
  $q .= " LIMIT 1";
  $res = mysql_query($q) OR die("$tbl select(): " . mysql_error());
  $row = mysql_fetch_assoc($res);
  mysql_free_result($res);
  if ($row === false) {
    $v = curr_100($src, $dst, true);
    $q = "INSERT INTO $tbl SET updatetim = NOW(), currency1='$src', currency2='$dst', amount1=100, amount2='$v'";
    mysql_query($q) OR die("$tbl insert(): " . mysql_error());
    return 1.0 * $val * $v / 100;
  }

  if ($row['currency1'] == $src)
    $x = 1.0 * $val * $row['amount2'] / $row['amount1'];
  else
    $x = 1.0 * $val * $row['amount1'] / $row['amount2'];

  return number_format($x, 2);
}

/**
  include('config/config.php');
  $dbh = new database;
  $link = $dbh->connect();
  //$usd100 = curr_100('USD', 'JPY');
  //die("$usd100, ". (.0 + $usd100));
  echo nopro_currconv("23", "USD", "JPY"). "\n";
  echo nopro_currconv("23", "EUR", "JPY"). "\n";
  echo nopro_currconv("72112", "JPY", "USD"). "\n";
  /* */
?>
