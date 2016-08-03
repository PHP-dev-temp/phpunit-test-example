<?php

include_once ("../src/OddsProcessing.php");

class QuoteProcessingTest extends PHPUnit_Framework_TestCase {

  public function testQuoteProcessing(){
    $inputResults = array(
      array ("1", "2"),
      array ("1", "3"),
      array ("1", "4"),
      array ("1", "5"),);

    $qp = new OddsProcessing($inputResults, 3);
    $sumOdds = $qp->getOdds();
    $this->assertEquals($sumOdds, 154);
  }
}