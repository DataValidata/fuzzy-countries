<?php

namespace DataValidata\FuzzyCountries;


use Traversable;

class CountrySeparator implements \IteratorAggregate
{

    private $text;

    /** @var Country[] */
    private $matches;

    public function __construct($text, Lifter $lifter)
    {
        $lifter->setText($text);
        $this->matches = iterator_to_array($lifter);
        $this->text = $text;
    }

    public function getIterator()
    {
        $fullyStrippedText = $this->text;
        foreach($this->matches as $matchedCountry) {
            $cleanText = $this->text;

            if($matchedCountry instanceof FuzzyCountry) {
                foreach($matchedCountry->matchedParts as $part) {
                    $fullyStrippedText = str_replace($part, "", $fullyStrippedText);
                    $cleanText = str_replace($part, "", $cleanText);
                }
            }

            yield $matchedCountry->iso3166Alpha3 => $cleanText;
        }

        yield null => $fullyStrippedText;
    }
}