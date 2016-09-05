<?php 
session_start();
require_once __DIR__ . '/vendor/autoload.php';
$fb = new Facebook\Facebook([
  'app_id' => '154780491386487',
  'app_secret' => '1ac6f082d1a7e41b0d879874c595cb0f',
  'default_graph_version' => 'v2.5',
  ]);

$access_token = $_SESSION['fb_access_token'];

// var_dump($access_token );die;

  // getting basic info about user
  try {
      // post on behalf of page
    $pages = $fb->get('/me/accounts', $access_token );
    $pages = $pages->getGraphEdge()->asArray();
    echo '<pre>';
    $codeto_page = $pages[2];

    $post = $fb->post('/1592733144373244_1644012255911999_1644016122578279/comments', array('message' => 'just for testing...'), $codeto_page['access_token']);
    $post = $post->getGraphNode()->asArray(); 
    print_r($post); //1644012255911999_1644019685911256

  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }
?>