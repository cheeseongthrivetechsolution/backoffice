<?php
  //Import configs
  include_once '../../config/main.php';
  include_once '../../config/Database.php';
  //Import models
  include_once '../../models/WhitelistIP.php';
  include_once '../../models/User.php';
  //header
  header('Access-Control-Allow-Methods: POST');




  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog post object
  $whitelist = new WhitelistIP($db);
  $user = new User($db);
  //prepare respond array
  $respond_array = array( 'code' => 500,
                          'msg' => '',
                          'token' => '');
  //Get request
  parse_str(file_get_contents("php://input"),$put_vars);
  $ip = isset($put_vars["ip"]) ? $put_vars["ip"] : "";
  $token = isset($put_vars["token"]) ? $put_vars["token"] : "";
  $lang = isset($put_vars["lang"]) ? strtolower($put_vars['lang']) : "en";
  //Translate return message
  $message = file_get_contents("../../translate/".$lang.".json");
  $message = preg_replace( '![ \t]*//.*[ \t]*[\r\n]!', '', $message );
  $message = json_decode( $message, true );

  //Input Validation
  if ($token == "") {
    $respond_array['code'] = 401;
    $respond_array['msg'] = $message['m50013'];
    echo json_encode($respond_array);
    die();
  }
  //Get User Data
  $user->access_token = $token;
  $user->getInfoByToken();
  //Check user Exists
  if ($user->user_id == null) {
    $respond_array['code'] = 401;
    $respond_array['msg'] = $message['m50014'];
    echo json_encode($respond_array);
    die();
  }

  if ($ip == "") {
    $respond_array['msg'] = $message['whitelist0001'];
    echo json_encode($respond_array);
    die();
  }




  $ip_detail = file_get_contents('https://www.iplocate.io/api/lookup/'.$ip);
  $res = json_decode($ip_detail);

  $whitelist->ip
  $whitelist->country = $res->country;
  $whitelist->city = $res->city;
  $whitelist->postcode = $res->postal_code;

  $whitelist->created_by = $res->postal_code;
  $whitelist->updated_by = $res->postal_code;















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
