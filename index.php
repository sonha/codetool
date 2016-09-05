<?php 
session_start();
require_once __DIR__ . '/vendor/autoload.php';
$fb = new Facebook\Facebook([
  'app_id' => '154780491386487',
  'app_secret' => '1ac6f082d1a7e41b0d879874c595cb0f',
  'default_graph_version' => 'v2.5',
  ]);

$access_token = $_SESSION['fb_access_token'];

try {
  // Returns a `Facebook\FacebookResponse` object
  $requestUserName  = $fb->get('/me?fields=id,name, email,bio,birthday,cover,devices,education,favorite_athletes,first_name,work', $access_token);
  $user = $requestUserName->getGraphUser();
  $user_decode = $requestUserName->getDecodedBody();

  $request  = $fb->get('/'.$user_decode['id'].'/permissions', $access_token);

  $graphObject = $request->getDecodedBody();
  echo '<pre>';
  var_dump($graphObject);die;

} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}


// OR
// echo 'Name: ' . $user->getName();
?>
