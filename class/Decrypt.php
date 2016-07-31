<?php

/**
 * Created by PhpStorm.
 * User: juan
 * Date: 7/30/16
 * Time: 11:50 PM
 */
class Decrypt {

	public static function filterFile($fileName) {

		if (file_exists($fileName)) {
			$fileReader = fopen($fileName, "r");
			var_dump(getcwd());
			$fileWriter = fopen("assets/filtered_wordlist", "w");

			if ($fileReader && $fileWriter) {
				ftruncate($fileWriter, 0);
				while (($line = fgets($fileReader)) !== false) {
					var_dump("Writing: " . $line);
					if (SELF::isValid($line)) {
						fwrite($fileWriter, $line);
					}
				}

				fclose($fileReader);
				fclose($fileWriter);
			} else {
				// error opening the file.
				die("error opening the file.");
			}
		} else {
			die("File doesnt exist.");
		}
	}

	public static function isValid($str) {
		return preg_match('/^[poultry outwits ants]*$/', $str);
	}


	public static function combineFile() {
		$reader1 = fopen("assets/filtered_wordlist", "r");
		$reader2 = fopen("assets/filtered_wordlist", "r");
		$reader3 = fopen("assets/filtered_wordlist", "r");
		$anagramLenght = strlen("poultry outwits ants");

		if ($reader1 && $reader2 && $reader3) {

			while (($line1 = fgets($reader1)) !== false) {
				while (($line2 = fgets($reader2)) !== false) {
					while (($line3 = fgets($reader3)) !== false) {
						$testSentence = str_replace("\n", "", $line1) . " " . str_replace("\n", "", $line2) . " " . str_replace("\n", "", $line3);

						if (strlen($testSentence) == $anagramLenght) {
							if (md5($testSentence) === '4624d200580677270a54ccff86b9610e') {
								var_dump("Lo encontré, es: " . $testSentence);
								mail("juan.preciado@gmail.com", "Done", $testSentence);
								die("here");
							}
						} else {
							//print "$testSentence IS NOT \n";
						}
					}
					fclose($reader3);
					$reader3 = fopen("assets/filtered_wordlist", "r");
				}
				fclose($reader2);
				$reader2 = fopen("assets/filtered_wordlist", "r");
			}
			fclose($reader1);
			fclose($reader2);
			fclose($reader3);
		}else {
			print "Error opening files";
			}


	}
}