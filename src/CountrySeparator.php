<?php

namespace DataValidata\FuzzyCountries;


use Traversable;

class CountrySeparator implements \IteratorAggregate
{

    private $text;
    private $lifter;

    /** @var Country[] */
    private $matches;

    public function __construct(Lifter $lifter)
    {
        $this->lifter = $lifter;
    }

    public function setText($text)
    {
        $this->text = $text;
        $this->lifter->setText($text);
        $this->matches = iterator_to_array($this->lifter);
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