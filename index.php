<?php
include_once('form/FormBuilder.php');
include_once('form/FormElements.php');
include_once ("src/BetProcessing.php");
include_once ("src/OddsProcessing.php");

$formBuilder = new FormBuilder();
$formElements = new FormElements();
$finish = 0;

if ($formBuilder->isValidForm()) {
  $step = !isset($_POST['step']) ? 0 : $_POST['step'];
  if ($step == 2) {
    $finish = 1;
    $elements = array();
  }
  else {
    $elements = $formElements->getFormElements($step);
  }
}
else {
  $step = $_POST['step'] - 1;
  $defaultElements = $formElements->getFormElements($step);
  $elements = $formBuilder->changeElements($defaultElements);
}

if ($finish == 1) {
  require('form/results.php');
}
else {
  echo $formBuilder->buildForm('post', 'index.php', 'form_' . $step, $elements);
}