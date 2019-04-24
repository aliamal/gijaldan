<?php


function encryptor($key, $plaintext) {
	//$key should have been previously generated in a cryptographically safe way, like openssl_random_pseudo_bytes
$cipher = "aes-128-gcm";
if (in_array($cipher, openssl_get_cipher_methods()))
{
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivlen);
    
    $ciphertext = openssl_encrypt($plaintext, $cipher, $key, $options=0, $iv, $tag);
    //$tag_size = strlen($tag);
    // echo $tag_size; --> 16
    //echo 'Tag: '.$tag.'<br><br>';

    //echo 'enc crypt:  '.$ciphertext.'<br><br>';
    //echo 'enc iv:  '.$iv.'<br><br>';

    $combo = $iv . $tag . $ciphertext;
    $garble = base64_encode($iv . $tag .$ciphertext);


    return $garble;
}

}

function decryptor($key, $garble) {

$cipher = "aes-128-gcm";
  if (in_array($cipher, openssl_get_cipher_methods()))
{
	
  $tag_size = 16;
  $combo = base64_decode($garble);
  
//  $payload = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $crypt, MCRYPT_MODE_CBC, $iv);
  $ivlen = openssl_cipher_iv_length($cipher);
  
  $iv = substr($combo, 0, $ivlen);
  $tag = substr($combo, $ivlen, $tag_size);
  $crypt = substr($combo, $ivlen + $tag_size, strlen($combo));
  //echo 'dec crypt:  '.$crypt.'<br><br>';
  //echo 'dec iv:  '.$iv.'<br><br>';

  $decrypted = openssl_decrypt($crypt, $cipher, $key, $options=0, $iv, $tag);


  return $decrypted;
}
}

//$encrypted_text = 'tXqFEK86pbbzAEFBdKgJIP7U4Mw8x7P6b2rXd+DozTo=';


//echo $file;


//echo $file;
//$key = '1234567891011120';


//$file = "Text to encrypt!";
//$encrypted_text = encryptor($key, $file);

//file_put_contents('1.php', $encrypted_text);

//echo '<br><br>';

//file_put_contents($enc_file, $encrypted_text);
//$encrypted_text = file_get_contents($enc_file);
//echo $encrypted_text;
//echo $file.'<br><br>';
//echo $encrypted_text;
//echo '<br><br>';
//$decrypted_text = decryptor($key, $encrypted_text);
//echo $decrypted_text;

?>