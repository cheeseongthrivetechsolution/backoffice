<?php
  //Import configs
  include_once '../../config/main.php';
  include_once '../../config/Database.php';
  //Import models
  include_once '../../models/Merchant.php';
  //header
  header('Access-Control-Allow-Methods: POST');
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog post object
  $merchant = new Merchant($db);
  //prepare respond array
  $respond_array = array( 'code' => 500,
                          'msg' => '',
                          'row' => array());
  //Get request
  parse_str(file_get_contents("php://input"),$put_vars);
  $code = isset($put_vars["code"]) ? $put_vars["code"] : "";
  $lang = isset($put_vars["lang"]) ? strtolower($put_vars['lang']) : "en";
  //Translate return message
  $message = file_get_contents("../../translate/".$lang.".json");
  $message = preg_replace( '![ \t]*//.*[ \t]*[\r\n]!', '', $message );
  $message = json_decode( $message, true );
  //Input Validation
  if ($code == "") {
    $respond_array['code'] = 403;
    echo json_encode($respond_array);
    die();
  }

  //Get Merchant Data
  $merchant->code = $code;
  $merchant->getByCode();
  //Check Merchant Exists
  if ($merchant->merchant_id == null) {
    $respond_array['msg'] = $message['merchant0001'];
    echo json_encode($respond_array);
    die();
  }
  //Verify User Status
  if ($merchant->status == 0) {
    $respond_array['code'] = 500;
    $respond_array['msg'] = $message['merchant0002'];
  } else if ($merchant->status == 2) {
    $respond_array['code'] = 500;
    $respond_array['msg'] = $message['merchant0003'];
  } else if ($merchant->status == 1) {
    $data =  array(
      'name' => $merchant->name,
      'logo' => $merchant->logo,
      'favicon' => $merchant->favicon,
      'api_url' => $merchant->api_url,
      'image_url' => $merchant->image_url,
    );
    $respond_array['code'] = 200;
    $respond_array['row'] =  $data;
    $respond_array['msg'] = $message['merchant0000'];
  }
  echo json_encode($respond_array);
