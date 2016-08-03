<?php

class FormElements {
  public function getFormElements($formStep) {
    $elements = array();
    switch ($formStep) {
      case 0:
        $elements = array(
          array(
            'field' => 'input',
            'type' => 'text',
            'name' => 'combinations',
            'placeholder' => 'min correct tips',
            'style' => 'color: red;',
            'error_message' => '',
          ),
          array(
            'field' => 'input',
            'type' => 'text',
            'name' => 'total',
            'placeholder' => 'total matches',
            'style' => 'color: red;',
            'error_message' => '',
          ),
          array(
            'field' => 'input',
            'type' => 'hidden',
            'name' => 'step',
            'value' => "1"
          ),
          array(
            'field' => 'submit',
            'type' => 'submit',
            'name' => 'send',
            'placeholder' => '',
            'style' => 'color: red;',
            'error_message' => '',
            'value' => 'Next >'
          )
        );
        break;
      case 1:
        $elements = array();
        $total = $_POST['total'];
        $combinations = $_POST['combinations'];
        for ($i = 0; $i < $total; $i++) {
          $elements[$i * 2] = array(
            'field' => 'input',
            'type' => 'checkbox',
            'name' => 'w' . $i,
            'style' => 'color: red;',
            'value' => ''
          );
          $elements[$i * 2 + 1] = array(
            'field' => 'input',
            'type' => 'text',
            'name' => 'u' . $i,
            'placeholder' => 'Odds-' . $i,
            'style' => 'color: red;',
            'error_message' => '',
            'value' => ''
          );
        }
        $elements2 = array(
          array(
            'field' => 'input',
            'type' => 'hidden',
            'name' => 'total',
            'value' => $total
          ),
          array(
            'field' => 'input',
            'type' => 'hidden',
            'name' => 'step',
            'value' => "2"
          ),
          array(
            'field' => 'input',
            'type' => 'hidden',
            'name' => 'combinations',
            'value' => $combinations
          ),
          array(
            'field' => 'submit',
            'type' => 'submit',
            'name' => 'next',
            'placeholder' => '',
            'style' => 'color: red;',
            'error_message' => '',
            'value' => 'Next >'
          )
        );
        $elements = array_merge_recursive($elements, $elements2);
        break;
      default :
    }
    return $elements;
  }
}