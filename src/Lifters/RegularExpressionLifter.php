<?php

namespace DataValidata\FuzzyCountries\Lifters;

use DataValidata\FuzzyCountries\CountryFactory;
use DataValidata\FuzzyCountries\CountryLifter;
use DataValidata\FuzzyCountries\FuzzyCountry;
use DataValidata\FuzzyStrings\WordCombinations;
use DataValidata\FuzzyStrings\WordSequences;

class RegularExpressionLifter implements CountryLifter
{
    private $regexps = [
        "AFG" => 'afghan',
        "ALA" => '\\b\\wland',
        "ALB" => 'albania',
        "DZA" => 'algeria',
        "ASM" => '^(?=.*americ).*samoa',
        "AND" => 'andorra',
        "AGO" => 'angola',
        "AIA" => 'anguill?a',
        "ATA" => 'antarctica',
        "ATG" => 'antigua',
        "ARG" => 'argentin',
        "ARM" => 'armenia',
        "ABW" => '^(?!.*bonaire).*\\baruba',
        "AUS" => 'australia',
        "AUT" => '^(?!.*hungary).*austria|\\baustri.*\\bemp',
        "AZE" => 'azerbaijan',
        "BHS" => 'bahamas',
        "BHR" => 'bahrain',
        "BGD" => 'bangladesh|^(?=.*east).*paki?stan',
        "BRB" => 'barbados',
        "BLR" => 'belarus|byelo',
        "BEL" => '^(?!.*luxem).*belgium',
        "BLZ" => 'belize|^(?=.*british).*honduras',
        "BEN" => 'benin|dahome',
        "BMU" => 'bermuda',
        "BTN" => 'bhutan',
        "BOL" => 'bolivia',
        "BES" => '^(?=.*bonaire).*eustatius|^(?=.*carib).*netherlands|\\bbes.?islands',
        "BIH" => 'herzegovina|bosnia',
        "BWA" => 'botswana|bechuana',
        "BVT" => 'bouvet',
        "BRA" => 'brazil',
        "IOT" => 'british.?indian.?ocean',
        "BRN" => 'brunei',
        "BGR" => 'bulgaria',
        "BFA" => 'burkina|\\bfaso|upper.?volta',
        "BDI" => 'burundi',
        "CPV" => 'verde',
        "KHM" => 'cambodia|kampuchea|khmer',
        "CMR" => 'cameroon',
        "CAN" => 'canada',
        "CYM" => 'cayman',
        "CAF" => '\\bcentral.african.republic',
        "TCD" => '\\bchad',
        "CHL" => '\\bchile',
        "CHN" => '^(?!.*\\bmac)(?!.*\\bhong)(?!.*\\btai)(?!.*\\brep).*china|^(?=.*peo)(?=.*rep).*china',
        "CXR" => 'christmas',
        "CCK" => '\\bcocos|keeling',
        "COL" => 'colombia',
        "COM" => 'comoro',
        "COG" => '^(?!.*\\bdem)(?!.*\\bd[\\.]?r)(?!.*kinshasa)(?!.*zaire)(?!.*belg)(?!.*l.opoldville)(?!.*free).*\\bcongo',
        "COK" => '\\bcook',
        "CRI" => 'costa.?rica',
        "CIV" => 'ivoire|ivory',
        "HRV" => 'croatia',
        "CUB" => '\\bcuba',
        "CUW" => '^(?!.*bonaire).*\\bcura(c|ç)ao',
        "CYP" => 'cyprus',
        "CSK" => 'czechoslovakia',
        "CZE" => '^(?=.*rep).*czech|czechia|bohemia',
        "COD" => '\\bdem.*congo|congo.*\\bdem|congo.*\\bd[\\.]?r|\\bd[\\.]?r.*congo|belgian.?congo|congo.?free.?state|kinshasa|zaire|l.opoldville|drc|droc|rdc',
        "DNK" => 'denmark',
        "DJI" => 'djibouti',
        "DMA" => 'dominica(?!n)',
        "DOM" => 'dominican.rep',
        "ECU" => 'ecuador',
        "EGY" => 'egypt',
        "SLV" => 'el.?salvador',
        "GNQ" => 'guine.*eq|eq.*guine|^(?=.*span).*guinea',
        "ERI" => 'eritrea',
        "EST" => 'estonia',
        "ETH" => 'ethiopia|abyssinia',
        "FLK" => 'falkland|malvinas',
        "FRO" => 'faroe|faeroe',
        "FJI" => 'fiji',
        "FIN" => 'finland',
        "FRA" => '^(?!.*\\bdep)(?!.*martinique).*france|french.?republic|\\bgaul',
        "GUF" => '^(?=.*french).*guiana',
        "PYF" => 'french.?polynesia|tahiti',
        "ATF" => 'french.?southern',
        "GAB" => 'gabon',
        "GMB" => 'gambia',
        "GEO" => '^(?!.*south).*georgia',
        "DDR" => 'german.?democratic.?republic|democratic.?republic.*germany|east.germany',
        "DEU" => '^(?!.*east).*germany|^(?=.*\\bfed.*\\brep).*german',
        "GHA" => 'ghana|gold.?coast',
        "GIB" => 'gibraltar',
        "GRC" => 'greece|hellenic|hellas',
        "GRL" => 'greenland',
        "GRD" => 'grenada',
        "GLP" => 'guadeloupe',
        "GUM" => '\\bguam',
        "GTM" => 'guatemala',
        "GGY" => 'guernsey',
        "GIN" => '^(?!.*eq)(?!.*span)(?!.*bissau)(?!.*portu)(?!.*new).*guinea',
        "GNB" => 'bissau|^(?=.*portu).*guinea',
        "GUY" => 'guyana|british.?guiana',
        "HTI" => 'haiti',
        "HMD" => 'heard.*mcdonald',
        "VAT" => 'holy.?see|vatican|papal.?st',
        "HND" => '^(?!.*brit).*honduras',
        "HKG" => 'hong.?kong',
        "HUN" => '^(?!.*austr).*hungary',
        "ISL" => 'iceland',
        "IND" => 'india(?!.*ocea)',
        "IDN" => 'indonesia',
        "IRN" => '\\biran|persia',
        "IRQ" => '\\biraq|mesopotamia',
        "IRL" => '(^ireland)|(^republic.*ireland)',
        "IMN" => '^(?=.*isle).*\\bman',
        "ISR" => 'israel',
        "ITA" => 'italy',
        "JAM" => 'jamaica',
        "JPN" => 'japan',
        "JEY" => 'jersey',
        "JOR" => 'jordan',
        "KAZ" => 'kazak',
        "KEN" => 'kenya|british.?east.?africa|east.?africa.?prot',
        "KIR" => 'kiribati',
        "PRK" => '^(?=.*democrat|people|north|d.*p.*.r).*\\bkorea|dprk|korea.*(d.*p.*r)',
        "KWT" => 'kuwait',
        "KGZ" => 'kyrgyz|kirghiz',
        "LAO" => '\\blaos?\\b',
        "LVA" => 'latvia',
        "LBN" => 'lebanon',
        "LSO" => 'lesotho|basuto',
        "LBR" => 'liberia',
        "LBY" => 'libya',
        "LIE" => 'liechtenstein',
        "LTU" => 'lithuania',
        "LUX" => '^(?!.*belg).*luxem',
        "MAC" => 'maca(o|u)',
        "MDG" => 'madagascar|malagasy',
        "MWI" => 'malawi|nyasa',
        "MYS" => 'malaysia',
        "MDV" => 'maldive',
        "MLI" => '\\bmali\\b',
        "MLT" => '\\bmalta',
        "MHL" => 'marshall',
        "MTQ" => 'martinique',
        "MRT" => 'mauritania',
        "MUS" => 'mauritius',
        "MYT" => '\\bmayotte',
        "MEX" => '\\bmexic',
        "FSM" => 'fed.*micronesia|micronesia.*fed',
        "MCO" => 'monaco',
        "MNG" => 'mongolia',
        "MNE" => '^(?!.*serbia).*montenegro',
        "MSR" => 'montserrat',
        "MAR" => 'morocco|\\bmaroc',
        "MOZ" => 'mozambique',
        "MMR" => 'myanmar|burma',
        "NAM" => 'namibia',
        "NRU" => 'nauru',
        "NPL" => 'nepal',
        "NLD" => '^(?!.*\\bant)(?!.*\\bcarib).*netherlands',
        "ANT" => '^(?=.*\\bant).*(nether|dutch)',
        "NCL" => 'new.?caledonia',
        "NZL" => 'new.?zealand',
        "NIC" => 'nicaragua',
        "NER" => '\\bniger(?!ia)',
        "NGA" => 'nigeria',
        "NIU" => 'niue',
        "NFK" => 'norfolk',
        "MNP" => 'mariana',
        "NOR" => 'norway',
        "OMN" => '\\boman|trucial',
        "PAK" => '^(?!.*east).*paki?stan',
        "PLW" => 'palau',
        "PSE" => 'palestin|\\bgaza|west.?bank',
        "PAN" => 'panama',
        "PNG" => 'papua|new.?guinea',
        "PRY" => 'paraguay',
        "PER" => 'peru',
        "PHL" => 'philippines',
        "PCN" => 'pitcairn',
        "POL" => 'poland',
        "PRT" => 'portugal',
        "PRI" => 'puerto.?rico',
        "QAT" => 'qatar',
        "KOR" => '^(?!.*d.*p.*r)(?!.*democrat)(?!.*people)(?!.*north).*\\bkorea(?!.*d.*p.*r)',
        "MDA" => 'moldov|b(a|e)ssarabia',
        "REU" => 'r(e|é)union',
        "ROU" => 'r(o|u|ou)mania',
        "RUS" => '\\brussia|soviet.?union|u\\.?s\\.?s\\.?r|socialist.?republics',
        "RWA" => 'rwanda',
        "BLM" => 'barth(e|é)lemy',
        "SHN" => 'helena',
        "KNA" => 'kitts|\\bnevis',
        "LCA" => '\\blucia',
        "MAF" => '^(?=.*collectivity).*martin|^(?=.*france).*martin(?!ique)|^(?=.*french).*martin(?!ique)',
        "SPM" => 'miquelon',
        "VCT" => 'vincent',
        "WSM" => '^(?!.*amer).*samoa',
        "SMR" => 'san.?marino',
        "STP" => '\\bs(a|ã)o.?tom(e|é)',
        "SAU" => '\\bsa\\w*.?arabia',
        "SEN" => 'senegal',
        "SRB" => '^(?!.*monte).*serbia',
        "SYC" => 'seychell',
        "SLE" => 'sierra',
        "SGP" => 'singapore',
        "SXM" => '^(?!.*martin)(?!.*saba).*maarten',
        "SVK" => '^(?!.*cze).*slovak',
        "SVN" => 'slovenia',
        "SLB" => 'solomon',
        "SOM" => 'somali',
        "ZAF" => 'south.africa|s\\\\..?africa',
        "SGS" => 'south.?georgia|sandwich',
        "SSD" => '\\bs\\w*.?sudan',
        "ESP" => 'spain',
        "LKA" => 'sri.?lanka|ceylon',
        "SDN" => '^(?!.*\\bs(?!u)).*sudan',
        "SUR" => 'surinam|dutch.?guiana',
        "SJM" => 'svalbard',
        "SWZ" => 'swaziland',
        "SWE" => 'sweden',
        "CHE" => 'switz|swiss',
        "SYR" => 'syria',
        "TWN" => 'taiwan|taipei|formosa|^(?!.*peo)(?=.*rep).*china',
        "TJK" => 'tajik',
        "THA" => 'thailand|\\bsiam',
        "MKD" => 'macedonia|fyrom',
        "TLS" => '^(?=.*leste).*timor|^(?=.*east).*timor',
        "TGO" => 'togo',
        "TKL" => 'tokelau',
        "TON" => 'tonga',
        "TTO" => 'trinidad|tobago',
        "TUN" => 'tunisia',
        "TUR" => 'turkey',
        "TKM" => 'turkmen',
        "TCA" => 'turks',
        "TUV" => 'tuvalu',
        "UGA" => 'uganda',
        "UKR" => 'ukrain',
        "ARE" => 'emirates|^u\\.?a\\.?e\\.?$|united.?arab.?em',
        "GBR" => 'united.?kingdom|britain|^u\\.?k\\.?$',
        "TZA" => 'tanzania',
        "USA" => 'united.?states\\b(?!.*islands)|\\bu\\.?s\\.?a\\.?\\b|^\\s*u\\.?s\\.?\\b(?!.*islands)',
        "UMI" => 'minor.?outlying.?is',
        "URY" => 'uruguay',
        "UZB" => 'uzbek',
        "VUT" => 'vanuatu|new.?hebrides',
        "VEN" => 'venezuela',
        "VNM" => '^(?!.*republic).*viet.?nam|^(?=.*socialist).*viet.?nam',
        "VGB" => '^(?=.*\\bu\\.?\\s?k).*virgin|^(?=.*brit).*virgin|^(?=.*kingdom).*virgin',
        "VIR" => '^(?=.*\\bu\\.?\\s?s).*virgin|^(?=.*states).*virgin',
        "WLF" => 'futuna|wallis',
        "ESH" => 'western.sahara',
        "YEM" => '^(?!.*arab)(?!.*north)(?!.*sana)(?!.*peo)(?!.*dem)(?!.*south)(?!.*aden)(?!.*\\bp\\.?d\\.?r).*yemen',
        "YMD" => '^(?=.*peo).*yemen|^(?!.*rep)(?=.*dem).*yemen|^(?=.*south).*yemen|^(?=.*aden).*yemen|^(?=.*\\bp\\.?d\\.?r).*yemen',
        "YUG" => 'yugoslavia',
        "ZMB" => 'zambia|northern.?rhodesia',
        "EAZ" => 'zanzibar',
        "ZWE" => 'zimbabwe|^(?!.*northern).*rhodesia'
    ];

    private $wordSequences;
    private $wordCombinations;

    private $aggressionEnabled;

    public function __construct($aggressionEnabled = false)
    {
        // wrap all the regular expressions, because i'm a bit lazy right now.
        foreach($this->regexps as $alpha3 => $regexp) {
            $this->regexps[$alpha3] = '/' . $regexp . '/i';
        }

        $this->aggressionEnabled = $aggressionEnabled;
    }


    public function setText($text)
    {
        $this->wordSequences = (new WordSequences($text, false));
        if($this->aggressionEnabled) {
            $this->wordCombinations = (new WordCombinations($text));
        } else {
            $this->wordCombinations = [];
        }
    }

    public function getIterator()
    {
        /** @var FuzzyCountry[] $found */
        $found = [];
        $unmatchedRegularExpressions = [];
        foreach($this->regexps as $alpha3 => $regexp) {
            $unmatchedRegularExpressions[$alpha3] = $regexp;
        }

        foreach($this->wordSequences as $wordSequence) {
            $imploded = implode(" ", $wordSequence);
            foreach($unmatchedRegularExpressions as $alpha3 => $regexp) {
                $isMatch = preg_match($regexp, $imploded, $matchData);
                if($isMatch) {
                    $uniqueMatches = array_unique(array_values($matchData));
                    if(!in_array($alpha3, array_keys($found))) {
                        $found[$alpha3] = CountryFactory::buildFromAlpha3AndRegularExpression($alpha3, $regexp);
                        yield $found[$alpha3];
                    }

                    foreach($uniqueMatches as $uniqueMatch) {
                        $found[$alpha3]->addMatchPart($uniqueMatch);
                    }

                    unset($unmatchedRegularExpressions[$alpha3]);
                }
            }
        }

        // if we still have no matching countries, lets get a bit more aggressive...
        if(count($found) === 0) {
            foreach($this->wordCombinations as $wordSequence) {
                $imploded = implode(" ", $wordSequence);
                foreach($unmatchedRegularExpressions as $alpha3 => $regexp) {
                    $isMatch = preg_match($regexp, $imploded, $matchData);
                    if($isMatch) {
                        $uniqueMatches = array_unique(array_values($matchData));
                        if(!in_array($alpha3, array_keys($found))) {
                            $found[$alpha3] = CountryFactory::buildFromAlpha3AndRegularExpression($alpha3, $regexp);
                            yield $found[$alpha3];
                        }

                        foreach($uniqueMatches as $uniqueMatch) {
                            $found[$alpha3]->addMatchPart($uniqueMatch);
                        }

                        unset($unmatchedRegularExpressions[$alpha3]);
                    }
                }
            }
        }
    }
}
