<?php
// Requirements: php5, php5-json

// Define a -u option for the CLI
// Usage: php ghosteryscan.php -u http://www.example.com
$urlcli = getopt("u:");

// Read the Ghostery bug list an decode it into an array
// The most recent version can be found here: https://www.ghostery.com/update/bugs?format=json
$fileghostery = file_get_contents("ghostery.json");
$ghosterybugs = json_decode($fileghostery);

// Get the HTML content from the specified website
$fileurl = file_get_contents($urlcli["u"]);

// Determine if there are Ghostery 'bug-matches' in the HTML content and ouput the results
echo "The target is: ",$urlcli["u"],"\n";
foreach ($ghosterybugs->bugs as $value) {
	$pattern = "`".$value->pattern."`";
        if (preg_match($pattern, $fileurl))
		echo "Name: ".$value->name." [".$value->type."]\n";
}
?>

