<?php
    $fbconfig['appid' ]  = "172600182789198";                   // Dev Rafi - facebook application id
    $fbconfig['api'   ]  = "e3726f272e8e79602d67ae80f0be3b3e";  // Dev Rafi - facebook api id
    $fbconfig['secret']  = "e06263665aec8d2c4d7ed5d7bbdb903b";  // Dev Rafi - facebook api secret key
 
    try{
        include_once "facebook.php";
    }
    catch(Exception $o){
        echo '<pre>';
        print_r($o);
        echo '</pre>';
    }
    // Create our Application instance.
    $facebook = new Facebook(array(
      'appId'  => $fbconfig['appid'],
      'secret' => $fbconfig['secret'],
      'cookie' => true,
    ));
 
    // We may or may not have this data based on a $_GET or $_COOKIE based session.
    // If we get a session here, it means we found a correctly signed session using
    // the Application Secret only Facebook and the Application know. We dont know
    // if it is still valid until we make an API call using the session. A session
    // can become invalid if it has already expired (should not be getting the
    // session back in this case) or if the user logged out of Facebook.
    $session = $facebook->getSession();
 
    $fbme = null;
    // Session based graph API call.
    if ($session) {
      try {
        $uid = $facebook->getUser();
        $fbme = $facebook->api('/me');
      } catch (FacebookApiException $e) {
          d($e);
      }
    }
 
    function d($d){
        echo '<pre>';
        print_r($d);
        echo '</pre>';
    }
?>