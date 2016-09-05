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
    $profile_request = $fb->get('/me', $access_token);
    $profile = $profile_request->getGraphNode()->asArray();
    
      // post on behalf of page
    $pages = $fb->get('/me/accounts', $access_token );
    $pages = $pages->getGraphEdge()->asArray();
    echo "All Page";
    echo '<pre>';
    $codeto_page = $pages[2];

    foreach($pages as $key => $value) {
      if($value['name'] == 'Body Building') {
        $page_id = $value['id'];
        $page_token = $value['access_token'];
      }
    }
    // var_dump($pages );die;
    $post = $fb->post('/'.$page_id.'/feed', array('message' => 'just for tecccccsting...'), $page_token);
    $post = $post->getGraphNode()->asArray();
    print_r($post);

  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    // session_destroy();
    // redirecting user back to app login page
    // header("Location: ./");
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }
?>