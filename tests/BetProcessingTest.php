<?php

include_once ("../src/BetProcessing.php");

class BetProcessingTest extends PHPUnit_Framework_TestCase {

  public function testBetProcessing(){
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
    $this->assertEquals($bp->getTotalCorrectTips(), 4);
    $this->assertEquals($bp->getBetCombinations(), 120);
    $res = $bp->getCompresedResults();
    $this->assertEquals(count($res, COUNT_RECURSIVE), 12);
  }

}