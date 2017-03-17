<?php

require_once(dirname(__DIR__) . '/vendor/autoload.php');

$lifter = new \DataValidata\FuzzyCountries\Lifter();
$lifter->addLifter(new \DataValidata\FuzzyCountries\Lifters\RegularExpressionLifter());

$fullyStrippedText = $text = "94 vernon avenue dublin is in Ireland, not the united kingdom. One day, I might visit the peoples republic of CHINA";
//$fullyStrippedText = $text = "94 vernon avenue dublin is in , not the . One day, I might visit the";
$lifter->setText($text);

$matchedCountries = iterator_to_array($lifter);
foreach($matchedCountries as $matchedCountry) {
    /** @var \DataValidata\FuzzyCountries\FuzzyCountry $matchedCountry */
    echo $matchedCountry . "\n";
    $strippedText = $text;
    foreach($matchedCountry->matchedParts as $part) {
        $fullyStrippedText = str_replace($part, "", $fullyStrippedText);
        $strippedText = str_replace($part, "", $strippedText);
        echo "$part stripped: " . str_replace($part, "", $text)."\n";
    }
    echo "Country {$matchedCountry->name} stripped: ". $strippedText . "\n";
    echo "\n";
}

echo "Fully stripped: " . $fullyStrippedText."\n";



$countSep = new \DataValidata\FuzzyCountries\CountrySeparator($lifter);
$countSep->setText($text);
foreach ($countSep as $isoCode => $cleanAddress) {
    echo "address=$cleanAddress&country=$isoCode\n";
}