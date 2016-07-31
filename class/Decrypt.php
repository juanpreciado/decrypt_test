<?php

/**
 * Created by PhpStorm.
 * User: juan
 * Date: 7/30/16
 * Time: 11:50 PM
 */
class Decrypt {

	/**
	 * This function will filter the file "assets/wordlist" into "assets/filtered_wordlist"
	 *
	 *
	 * @param $fileName <string> Path to the file wordlist
	 */
	public static function filterFile($fileName) {
		if (file_exists($fileName)) {
			$fileReader = fopen($fileName, "r");
			var_dump(getcwd());
			$fileWriter = fopen("assets/filtered_wordlist", "w");

			if ($fileReader && $fileWriter) {
				ftruncate($fileWriter, 0);
				while (($line = fgets($fileReader)) !== false) {
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

	/**
	 * It will use the string "poultry outwits ants" to determinate
	 * if a given word is potentially part of the secret phrase
	 *
	 * @param $str
	 * @return int
	 */
	public static function isValid($str) {
		return preg_match('/^[poultry outwits ants]*$/', $str);
	}

	/**
	 * It will make combinations of 3 words to find the secret phrase
	 *
	 */
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
								var_dump("Found it, it is: " . $testSentence);
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
		} else {
			die ("Error opening files");
		}


	}
}