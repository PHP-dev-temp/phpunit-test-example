<?php

class BetProcessing {

  private $minCorrectTips;
  private $totalRows;
  private $correctTips = array();
  private $odds = array();

  function __construct(array $results, $minCorrectTips){
    $this->totalRows = count($results);
    $this->minCorrectTips = $minCorrectTips;
    foreach($results as $result){
      if ($result[0]>0) {
        $this->correctTips[] = true;
        $this->odds[] = (double) $result[1];
      } else {
        $this->correctTips[] = false;
        $this->odds[] = 0;
      }
    }
  }

  public function getTotalCorrectTips(){
    $total = 0;
    foreach($this->correctTips as $ctip){
      if($ctip) $total++;
    }
    return $total;
  }

  public function getCompresedResults() {
    $j = 0;
    $newResults = array();
    for ($i = 0; $i < $this->totalRows; $i++) {
      if ($this->correctTips[$i]) {
        $newResults[$j][0] = "1";
        $newResults[$j][1] = (string) $this->odds[$i];
        $j++;
      }
    }
    return $newResults;
  }

  public function getBetCombinations(){
    $sumUp = 1;
    $sumDown = 1;
    for ($i=1; $i<=$this->minCorrectTips; $i++){
      $sumUp*=($this->totalRows-$i+1);
      $sumDown*=$i;
    }
    return ($sumUp/$sumDown);
  }
}