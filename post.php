<?php
require_once __DIR__ . '/vendor/autoload.php';

postingInPage('Test Content');

function postingInPage($fb_content){
    
    $fb = new Facebook\Facebook([
         'app_id' => 'APP_ID',
         'app_secret' => 'APP_SECRET',
         'default_graph_version' => 'v10.0', //update latest version here
        ]);

    $url = 'https://www.youtube.com/channel/UCC5karY4syYf5J18g_DdcvQ'; //Coding Hands
    $linkData = [
        'link' => $url,
        'message' => strip_tags( html_entity_decode($fb_content) )
    ];
    $pageAccessToken ='PAGE_ACCESS_TOKEN';

    try {
        $response = $fb->post('/me/feed', $linkData, $pageAccessToken);
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: '.$e->getMessage();
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: '.$e->getMessage();
    }
    
    $graphNode = $response->getGraphNode();
}

?>