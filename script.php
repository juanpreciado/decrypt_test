<?php
include_once "class/Decrypt.php";
ini_set('display_errors', 1);
error_reporting(E_ALL);
Decrypt::filterFile("assets/wordlist");
//Decrypt::combineFile();