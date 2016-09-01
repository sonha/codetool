<?php 
session_start();
require_once __DIR__ . '/vendor/autoload.php';
$fb = new Facebook\Facebook([
  'app_id' => '154780491386487',
  'app_secret' => '1ac6f082d1a7e41b0d879874c595cb0f',
  'default_graph_version' => 'v2.5',
  ]);

$access_token = $_SESSION['fb_access_token'];

  // getting basic info about user
  try {
    $profile_request = $fb->get('/me', $access_token);
    $profile = $profile_request->getGraphNode()->asArray();
    $groups = $fb->get('/me/groups', $access_token);
    $groups = $groups->getGraphEdge()->asArray();
    echo '<pre>';
    $codeto_group = $groups[1];
    $post = $fb->get('/528418770697762/feed', $access_token );
    $post = $post->getGraphEdge()->asArray();
    foreach($post as $key => $value) {
        // var_dump($value);die;
        if(isset($value['message']) && $value['message'] == 'Tối nay học bình thường đi các anh nhé!!') {
          $post = $fb->delete('/'.$value['id'].'/feed', $access_token );
          $post = $post->getGraphNode()->asArray();
          print_r($post);
        }
    }

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