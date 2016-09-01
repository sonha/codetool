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
  // Requires the "read_stream" permission
  $response = $fb->get('/me/feed?fields=id,message&amp;limit=5', $access_token);

  var_dump($response);die;
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

// Page 1
$feedEdge = $response->getGraphEdge();

// var_dump($feedEdge );die;

foreach ($feedEdge as $status) {
  var_dump($status->asArray());die;
}

// Page 2 (next 5 results)
// $nextFeed = $fb->next($feedEdge);

// foreach ($nextFeed as $status) {
//   var_dump($status->asArray());
// }
 ?>