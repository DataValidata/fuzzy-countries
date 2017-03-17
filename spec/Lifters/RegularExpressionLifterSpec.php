<?php

namespace spec\DataValidata\FuzzyCountries\Lifters;

use DataValidata\FuzzyCountries\Lifters\RegularExpressionLifter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RegularExpressionLifterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(RegularExpressionLifter::class);
        $this->shouldImplement('DataValidata\FuzzyCountries\CountryLifter');
    }

    function it_matches_countries()
    {
        $this->setText("raheny, dublin, northern rhodesia");
    }
}
