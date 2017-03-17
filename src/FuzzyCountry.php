<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 17/03/17
 * Time: 11:38
 */

namespace DataValidata\FuzzyCountries;


class FuzzyCountry extends Country
{
    public $regularExpression;

    public $matchedParts = [];
    /**
     * @param mixed $regularExpression
     */
    public function setRegularExpression($regularExpression)
    {
        $this->regularExpression = $regularExpression;
    }

    public function addMatchPart($part)
    {
        $this->matchedParts = array_unique(
            array_merge(
                $this->matchedParts,
                [$part]
            )
        );
    }
}