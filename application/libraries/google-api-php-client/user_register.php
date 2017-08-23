<?php 
// 	Include the google api php libraries
		include_once APPPATH."libraries/google-api-php-client/Google_Client.php";
		include_once APPPATH."libraries/google-api-php-client/contrib/Google_Oauth2Service.php";
		
		// Google Project API Credentials
		$clientId = '962031527806-lgqqsh28c4cn3g15c758i7pcasct4g33.apps.googleusercontent.com';
        $clientSecret = '5rrDAy51MKP6M0kYZY86XbZt';
        $redirectUrl = base_url() . 'user/google_login';
		
		// Google Client Configuration
        $gClient = new Google_Client();
        $gClient->setApplicationName(SITE_DISPNAME);
        $gClient->setClientId($clientId);
        $gClient->setClientSecret($clientSecret);
        $gClient->setRedirectUri($redirectUrl);
        $google_oauthV2 = new Google_Oauth2Service($gClient);

        if (isset($_REQUEST['code'])) {
            $gClient->authenticate();
            $this->session->set_userdata('token', $gClient->getAccessToken());
            redirect($redirectUrl);
        }

        $token = $this->session->userdata('token');
        if (!empty($token)) {
            $gClient->setAccessToken($token);
        }
		$userAuthUrl = $gClient->createAuthUrl();
?>