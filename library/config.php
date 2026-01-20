<?php

  session_start();

  
  if ($_SERVER['SERVER_NAME'] == 'zehn-meter-dunkel.de') {
    $app['url'] = 'https://zehn-meter-dunkel.de';
  } else {
	  $app['url'] = 'https://localhost/zehn-meter-dunkel.de';
  }

  function the_url($string = '', $echo = true) {
    global $app;
    $url = $app['url'] . $string;
    if ($echo) {
      echo $url;
    } else {
      return $url;
    }
  }

?>