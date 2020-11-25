<?
if(isSet($_GET['lang_set']) && ($_GET['lang_set']=='ro' || $_GET['lang_set']=='en' || $_GET['lang_set']=='tr'))
  $lang_set = $_GET['lang_set'];
elseif(isSet($_COOKIE['lang']) && ($_COOKIE['lang']=='ro' || $_COOKIE['lang']=='en' || $_COOKIE['lang']=='tr'))
  $lang_set = $_COOKIE['lang'];
else if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) && ($_SERVER['HTTP_ACCEPT_LANGUAGE']=='ro' || $_SERVER['HTTP_ACCEPT_LANGUAGE']=='en' || $_SERVER['HTTP_ACCEPT_LANGUAGE']=='tr'))
  $lang_set = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
else
  $lang_set = 'en';


setcookie('lang', $lang_set, time() + (3600 * 24 * 30));

include 'languages/'.$lang_set.'.php';
?>
