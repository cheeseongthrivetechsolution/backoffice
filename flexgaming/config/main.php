<?php
	//Defining environment DEV = development, STAGING = staging, PROD = production;
	$environment = "DEV";

	//Database
	putenv("host=localhost");
	putenv("db_name=ultraflexV2live");
	putenv("username=ultraflex");
	putenv("password=ultraflexultraflex");
	//Cors
	putenv("access_origin=frontend-production-url");

	if ($environment == 'DEV') {
		//Database
		putenv("host=localhost");
		putenv("db_name=flexgaming");
		putenv("username=root");
		putenv("password=");
		//Cors
		putenv("access_origin=*");
	} else if ($environment == 'STAGING') {
		//Database
		putenv("host=ultraoffice-sg.c7vw8waozug9.ap-southeast-1.rds.amazonaws.com");
		putenv("db_name=fgmainv2");
		putenv("username=ultraflex");
		putenv("password=ultraflexultraflex");
		//Cors
		putenv("access_origin=*");
	}
	header('Access-Control-Allow-Origin: '.getenv('access_origin'));
	header('Content-Type: application/json');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

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
