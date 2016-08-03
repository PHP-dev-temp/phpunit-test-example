<?php
$output = "<!DOCTYPE html>\n<html lang=\"en\">\n<head>\n
  <meta charset=\"UTF-8\">\n    <title>Bet quote</title>\n
  <style>	body {font-family: Courier New,Courier,Lucida Sans Typewriter,Lucida Typewriter,monospace;}
  </style></head>\n<body>\n";

$results = array();
$total = $_POST['total'];
$combinations = $_POST['combinations'];
$output .= "Ticket system: $combinations/$total <br> <br> Results: <br>";

for ($i = 0; $i < $total; $i++) {
  if (isset($_POST['w' . $i])) {
    $results[$i][0] = '1';
    $output .= "|x| ";
  }
  else {
    $results[$i][0] = '0';
    $output .= "| | ";
  }
  $results[$i][1] = (string) (double) $_POST['u' . $i];
  $output .= (string) (double) $_POST['u' . $i] . "<br>";
}
$output .= "</form>\n</body>\n</html>";

$bp = new BetProcessing($results, $combinations);
$output .= 'Total correct tips: ' . (string)$bp->getTotalCorrectTips() . "<br>";
$combinationsTotal = $bp->getBetCombinations();
$output .= 'Total combinations: '.(string)$combinationsTotal . "<br>";
$res = $bp->getCompresedResults();
$qp = new OddsProcessing($res, $combinations);
$sumOdds = $qp->getOdds();
$output .= 'Odds: '.(string)$sumOdds . "<br><br>";
$tq = $sumOdds / $combinationsTotal;
$output .= '<b>Total odds: '.(string)$tq . "</b>";

echo $output;
