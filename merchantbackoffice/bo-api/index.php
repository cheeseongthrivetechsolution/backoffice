<?php
  //Connecting to Redis server on localhost
  // echo phpinfo();
  $ip = "123.123.123.123";

  if(filter_var($ip, FILTER_VALIDATE_IP)) {
  $ip_detail = file_get_contents('https://www.iplocate.io/api/lookup/'.$ip);
  $res = json_decode($ip_detail);

  $country = $res->country;
  $city = $res->city;
  $postcode = $res->postal_code;

    echo $country;
    echo $city;
    echo $postcode;
}
else {
  echo "failed";
}
