<?php

namespace DataValidata\FuzzyCountries;

use Traversable;

class Lifter implements CountryLifter
{
    /** @var CountryLifter[]  */
    private $lifters = [];
    private $text = "";

    public function setText($text)
    {
        $this->text = $text;
        foreach($this->lifters as $lifter) {
            $lifter->setText($text);
        }
    }

    public function addLifter(CountryLifter $countryLifter)
    {
        $countryLifter->setText($this->text);
        $this->lifters[] = $countryLifter;
    }

    public function getIterator()
    {
        foreach ($this->lifters as $lifter) {
            foreach($lifter as $lifted) {
                yield $lifted;
            }
        }
    }

    public function lift($text)
    {
        $liftedCountries = [];

        foreach($this as $lifter) {
            foreach($lifter->lift($text) as $lifted)
            $liftedCountries[] = $lifted;
        }

        return $liftedCountries;
    }
}
