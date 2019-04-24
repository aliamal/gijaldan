<?php


function encryptR($key, $payload) {
	$iv_size = 16;
  $iv = mcrypt_create_iv($iv_size, MCRYPT_DEV_URANDOM);
  $crypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $payload, MCRYPT_MODE_CBC, $iv);
  $combo = $iv . $crypt;
  $garble = base64_encode($iv . $crypt);
  return $garble;
}

function decryptR($key, $garble) {
	$iv_size = 16;
  $combo = base64_decode($garble);
  $iv = substr($combo, 0, $iv_size);
  $crypt = substr($combo, $iv_size, strlen($combo));
  //$payload = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $crypt, MCRYPT_MODE_CBC, $iv);

  $cipher = "aes-128-gcm";

  $payload = openssl_decrypt($crypt, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);

  return $payload;
}


//echo dirname(__FILE__);
?>