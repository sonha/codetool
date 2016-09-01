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
  
    $requestGroups = $fb->get('/me/accounts?limit=100',  $access_token);
    $groups = $requestGroups->getGraphEdge()->asArray();
    echo '<pre>';
    var_dump( $groups);die;

  // $requestUserName  = $fb->get('/me?fields=id,name, email,bio,birthday,cover,devices,education,favorite_athletes,first_name,work', $access_token);
  // $user = $requestUserName->getGraphUser();

  // var_dump($user);die;
  // var_dump($requestUserName['name']);die;

  // $requestPostToFeed = $fb->post('/me/feed', $statusUpdate, $access_token);

} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
?>