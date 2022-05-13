<?php
	//Defining environment DEV = development, STAGING = staging, PROD = production;
	$environment = "DEV";
	putenv("environment=".$environment);
	//captcha secret
	$captchaSecret = "6LdCK1cfAAAAAMpSvzND9MI6w6HBEx1DtXHVoOal";
	putenv("captcha=".$captchaSecret);
	//Database variable default value
	$host = "localhost";
	$db_name = "ultraflex_v2";
	$username = "ultraflex";
	$password = "ultraflexultraflex";

	//Request variable default value
	$access_origin = "frontend-production-url";
	$content_type = "application/json";
	$access_control_allow_headers = "Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With";


	if ($environment == 'DEV') {
		$host = "localhost";
		$db_name = "test";
		$username = "root";
		$password = "";
		$access_origin = "*";
	} else if ($environment == 'STAGING') {
		$host = "ultraoffice-sg.c7vw8waozug9.ap-southeast-1.rds.amazonaws.com";
		$db_name = "test";
		$username = "ultraflex";
		$password = "ultraflexultraflex";
		$access_origin = "*";
	}

	putenv("host=".$host);
	putenv("db_name=".$db_name);
	putenv("username=".$username);
	putenv("password=".$password);

	header('Access-Control-Allow-Origin: '.$access_origin);
	header('Content-Type: '.$content_type);
	header('Access-Control-Allow-Headers: '.$access_control_allow_headers);

	try {
		// Create a Redis Instance
		$redis = new \Redis();
		$redis->connect('127.0.0.1', 6379);
	} catch (Exception $ex) {
		$respond_array = array( 'code' => 401,//200 500
	                          'msg' => "Redis server down! Please contact admin.");
		echo json_encode($respond_array);
		die();
	}
