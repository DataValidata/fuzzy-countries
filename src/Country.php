<?php

namespace DataValidata\FuzzyCountries;


class Country
{
    public $name;
    public $iso3166Alpha2;
    public $iso3166Alpha3;
    public $iso3166Numeric;
    public $currency;

    /**
     * Country constructor.
     * @param $name
     * @param $iso3166Alpha2
     * @param $iso3166Alpha3
     * @param $iso3166Numeric
     * @param $currency
     */
    public function __construct($name, $iso3166Alpha2, $iso3166Alpha3, $iso3166Numeric, $currency)
    {
        $this->name = $name;
        $this->iso3166Alpha2 = $iso3166Alpha2;
        $this->iso3166Alpha3 = $iso3166Alpha3;
        $this->iso3166Numeric = $iso3166Numeric;
        $this->currency = $currency;
    }

    public function __toString()
    {
        return sprintf("Country [%s, %s] %s", $this->iso3166Alpha2, $this->iso3166Alpha3, $this->name);
    }

    public static function buildFromDataArray($data)
    {
        return new static(
            $data['name'],
            $data['alpha2'],
            $data['alpha3'],
            $data['numeric'],
            $data['currency']
        );
    }
}