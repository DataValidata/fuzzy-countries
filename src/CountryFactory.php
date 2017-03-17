<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 16/03/17
 * Time: 17:50
 */

namespace DataValidata\FuzzyCountries;


use League\ISO3166\ISO3166;

class CountryFactory
{
    /** @var  ISO3166 */
    private static $countryData;

    public static function buildFromAlpha2($alpha2)
    {
        if(!self::$countryData) {
            self::$countryData = (new ISO3166);
        }

        return Country::buildFromDataArray(
            self::$countryData->getByAlpha2($alpha2)
        );
    }

    public static function buildFromAlpha3($alpha3)
    {
        if(!self::$countryData) {
            self::$countryData = (new ISO3166);
        }

        return Country::buildFromDataArray(
            self::$countryData->getByAlpha3($alpha3)
        );
    }
}