<?php
  //Import configs
  include_once '../../config/main.php';
  include_once '../../config/Database.php';
  //Import models
  include_once '../../models/WhitelistIP.php';
  //header
  header('Access-Control-Allow-Methods: GET');
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog post object
  $whitelist = new WhitelistIP($db);
  //prepare respond array
  $respond_array = array( 'code' => 500);
  //Get IP
  $ip_address = $_SERVER['REMOTE_ADDR'];
  //Check IP
  $whitelist->ip = $ip_address;
  $validIP = $whitelist->check();

  if ($validIP == true) {
    $respond_array['code'] = 200;
  }
  echo json_encode($respond_array);
