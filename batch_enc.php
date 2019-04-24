<?php

require 'encryptor.php';
$key = file_get_contents('key_file.txt');
//echo $key;

$dir = dirname(__FILE__)."/files/";
$dst_dir = dirname(__FILE__)."/enc_files/";
//echo !ini_get("allow_url_fopen");
$counter = 0;

// Open a directory, and read its contents
if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
      //echo "filename:" . $file . "<br>";

    	if (strpos($file, 'php')){
    		$counter += 1;
    		$content = file_get_contents($dir.$file);
            //echo $content.'<br><br>';

            str_replace("<?php", "", $content);
    		//echo $content;
    		$encrypted_content = encryptor($key, $content);
    		//$decrypted_content = decryptor($key, $encrypted_content);
    		//echo $decrypted_content;
    		$open =fopen($dst_dir . $counter . '.php', 'w');
    		fclose($open);
    		file_put_contents($dst_dir . $counter . '.php', $encrypted_content);

    	}

    }
    closedir($dh);
    echo 'Encryption Finished!';
  }
}



?>