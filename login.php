<?php 
session_start();
require_once __DIR__ . '/vendor/autoload.php';
$fb = new Facebook\Facebook([
  'app_id' => '154780491386487', // Replace {app-id} with your app id
  'app_secret' => '1ac6f082d1a7e41b0d879874c595cb0f',
  'default_graph_version' => 'v2.5',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email', 'publish_actions', 'manage_pages','user_managed_groups', 'publish_pages']; // Optional permissions
$loginUrl = $helper->getLoginUrl('https://localhost/facebook/fb-callback.php', $permissions);
echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
?>