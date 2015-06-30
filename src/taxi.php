<?php
/**
 * This file is part of the TripleI.taxi
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace TripleI\taxi;

class taxi
{
    /**
     *入力データ
     *@var str
     */
    public $inputdata;

    /**
     *初乗りデータ
     *@var array
     */
    public $startdata;

    /**
     *区間
     *@var array
     */
    public $intervalstr;

    /**
     *区間の距離と料金
     *@var array
     */
    public $intervalint;

    /**
     *合計の料金
     *@var int
     */
    public $pricecalc;

    public function InputData($data)
    {
        return $this->inputdata = $data;
    }

    public function StartData()
    {
        $inputdata = $this->inputdata;

        $startdata = array();
        $firststr = mb_substr($inputdata, 0, 1);

        switch($firststr) {
            case "A":
            case "B":
            case "C":
                array_push($startdata, 995, 400);
                break;
            case "D":
            case "E":
            case "F":
            case "G":
                array_push($startdata, 845, 350);
                break;
        }

        return $this->startdata = $startdata;
    }

    public function IntervalStr()
    {
        $inputdata = $this->inputdata;

        $intervalcount = strlen($inputdata)-1;
        $intervalstr = array();
        $trialcount = 0;

        while ($intervalcount > 0) {
            array_push($intervalstr, mb_substr($inputdata, $trialcount, 2));
            $trialcount = $trialcount + 1;
            $intervalcount = $intervalcount - 1;
        }

        return $this->intervalstr = $intervalstr;
    }

    public function IntervalInt()
    {
        $intervalint = [
            "AB"=>array(1090, 60),
            "BA"=>array(1090, 60),
            "AD"=>array(540, 50),
            "DA"=>array(540, 50),
            "AC"=>array(180, 60),
            "CA"=>array(180, 60),
            "BC"=>array(960, 60),
            "CB"=>array(960, 60),
            "BG"=>array(1270, 60),
            "GB"=>array(1270, 60),
            "CD"=>array(400, 50),
            "DC"=>array(400, 50),
            "CF"=>array(200, 60),
            "FC"=>array(200, 60),
            "DF"=>array(510, 50),
            "FD"=>array(510, 50),
            "FG"=>array(230, 50),
            "GF"=>array(230, 50),
            "DE"=>array(720, 50),
            "ED"=>array(720, 50),
            "EG"=>array(1050, 50),
            "GE"=>array(1050, 50)
            ];

        return $this->intervalint = $intervalint;
    }

    public function PriceCalc()
    {
        $startdata = $this->startdata;
        $intervalstr = $this->intervalstr;
        $intervalint = $this->intervalint;

        $upmeter = $startdata[0];
        $meter = 0;
        $price = array($startdata[1]);

        foreach ($intervalstr as $key=>$interval) {
            $meter = $meter + $intervalint[$interval][0];

            if ($meter > $upmeter) {
                while ($meter > $upmeter) {
                    $upmeter = $upmeter + 200;
                    array_push($price, $intervalint[$interval][1]);
                }
            }
        }

        $pricecalc = array_sum($price);
        return $this->pricecalc = $pricecalc;
    }
}
