<?php

namespace TripleI\taxi;

class taxiTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var taxi
     */
    protected $skeleton;

    protected function setUp()
    {
        parent::setUp();
        $this->skeleton = new taxi;
    }

    public function testNew()
    {
        $actual = $this->skeleton;
        $this->assertInstanceOf('\TripleI\taxi\taxi', $actual);
    }

    public function testException()
    {
        $this->setExpectedException('\TripleI\taxi\Exception\LogicException');
        throw new Exception\LogicException;
    }

    public function testPrice()
    {
        $testdata = array(
                        array( "ADFC", "510" ),
                        array( "CFDA", "500" ), 
                        array( "AB", "460" ),
                        array( "BA", "460" ),
                        array( "CD", "400" ),
                        array( "DC", "350" ),
                        array( "BG", "520" ),
                        array( "GB", "530" ),
                        array( "FDA", "450" ),
                        array( "ADF", "450" ),
                        array( "FDACB", "750" ),
                        array( "BCADF", "710" ),
                        array( "EDACB", "800" ),
                        array( "BCADE", "810" ),
                        array( "EGFCADE", "920" ),
                        array( "EDACFGE", "910" ),
                        array( "ABCDA", "960" ),
                        array( "ADCBA", "1000" ),
                        array( "BADCFGB", "1180" ),
                        array( "BGFCDAB", "1180" ),
                        array( "CDFC", "460" ),
                        array( "CFDC", "450" ),
                        array( "ABGEDA", "1420" ),
                        array( "ADEGBA", "1470" ),
                        array( "CFGB", "640" ),
                        array( "BGFC", "630" ),
                        array( "ABGEDFC", "1480" ),
                        array( "CFDEGBA", "1520" ),
                        array( "CDFGEDABG", "1770" ),
                        array( "GBADEGFDC", "1680" )
                );

        $taxi = new taxi;
        foreach ($testdata as $key=>$test) {

            $taxi->inputdata;
            $taxi->startdata;
            $taxi->intervalstr;
            $taxi->intervalint;
            $taxi->pricecalc;
    
            $taxi->InputData($test[0]);
            $taxi->StartData();
            $taxi->IntervalStr();
            $taxi->IntervalInt();
            $answer = $taxi->Pricecalc();

            $this->assertEquals($answer, $test[1]);
    
            if ($test[1] = $answer) {
                echo $test[1], " = ", $answer, "\n";
            } else {
                echo $test[1], " = ", $answer, "エラー\n";
            }
        }
    }
}
