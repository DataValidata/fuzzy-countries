<?php

namespace spec\DataValidata\FuzzyCountries;

use DataValidata\FuzzyCountries\CountryLifter;
use DataValidata\FuzzyCountries\Lifter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LifterSpec extends ObjectBehavior
{
    function let()
    {
        $this->setText("tonlegee road, dublin, ireland");
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Lifter::class);
        $this->shouldImplement('DataValidata\FuzzyCountries\CountryLifter');
    }

    function it_returns_nothing_when_no_lifters_are_added()
    {
        $this->shouldHaveCount(0);
    }
}
