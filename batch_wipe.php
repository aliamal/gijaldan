<?php

require 'encryptor.php';


//echo $key;

$dir = dirname(__FILE__)."/files/";
$dst_dir = dirname(__FILE__)."/changed_files/";
//echo !ini_get("allow_url_fopen");
$counter = 0;

// Open a directory, and read its contents
if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
      //echo "filename:" . $file . "<br>";

    	if (strpos($file, 'php')){
    		$counter += 1;
    		//$content = file_get_contents($dir.$file);
            //echo $content.'<br><br>';

            $exampleContent = file_get_contents('exampleFile.php');
            echo $exampleContent;
            $newContent = str_replace("FFFFFF", $counter.'', $exampleContent);


            //to make a file with the main file name
            $open =fopen($dst_dir . $file, 'w');
            fclose($open);

            
            //echo $exampleContent;

            file_put_contents($dst_dir . $file, $newContent);

    	}

    }
    closedir($dh);
    echo 'Completed!';
  }
}



?>