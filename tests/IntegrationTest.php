<?php

include_once ("../src/BetProcessing.php");
include_once ("../src/OddsProcessing.php");

class IntegrationTest extends PHPUnit_Framework_TestCase {

  public function testIntegrationTest(){
    $inputResults = array(
      array ("1", "2"),
      array ("0", "3"),
      array ("1", "4"),
      array ("0", "5"),
      array ("1", "3"),
      array ("0", "4"),
      array ("0", "5"),
      array ("0", "3"),
      array ("0", "4"),
      array ("1", "5"),);

    $bp = new BetProcessing($inputResults, 3);
    $combinationsTotal = $bp->getBetCombinations();
    $res = $bp->getCompresedResults();
    $qp = new OddsProcessing($res, 3);
    $sumOdds = $qp->getOdds();
    $formatedOdds = number_format($sumOdds/$combinationsTotal, 2, '.', '');
    $this->assertEquals($formatedOdds, '1.28');
  }

}