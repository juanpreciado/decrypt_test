<?php
include_once "class/Decrypt.php";
ini_set('display_errors', 1);
error_reporting(E_ALL);
//This function will filter the word list from around 100000 words
//to ony 2500
Decrypt::filterFile("assets/wordlist");
//This function will make combinations of the filtered words in order to
//find the secret phrase
Decrypt::combineFile();