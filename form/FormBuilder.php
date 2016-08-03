<?php

class FormBuilder {

  public function buildForm($method, $action, $name = NULL, array $fields) {
    $form = "<!DOCTYPE html>\n<html lang=\"en\">\n<head>\n
    <meta charset=\"UTF-8\">\n    <title>Bets calculator</title>\n
    <style>	body {font-family: Courier New,Courier,Lucida Sans Typewriter,Lucida Typewriter,monospace;}
    </style></head>\n<body>
    \n<h2>Bets odds calculating</h2>\n";
    $form .= "<form method=\"$method\" action=\"$action\"";
    $form .= empty($name) ? ">" : " name=\"$name\">\n";
    for ($i = 0; $i < count($fields); $i++) {
      $form .= $this->buildField(
        $fields[$i]['field'],
        $fields[$i]['type'],
        $fields[$i]['name'],
        empty($fields[$i]['placeholder']) ? '' : $fields[$i]['placeholder'],
        empty($fields[$i]['style']) ? '' : $fields[$i]['style'],
        empty($fields[$i]['error_message']) ? '' : $fields[$i]['error_message'],
        empty($fields[$i]['value']) ? '' : $fields[$i]['value']
      );
    }
    $form .= "</form>\n</body>\n</html>";
    return $form;
  }

  public function buildField($field, $type, $name, $placeholder = NULL, $style = NULL,
                             $error_message = NULL, $value = NULL) {
    switch ($field) {
      case 'input':
        $fieldHTML = "<input type=\"$type\" name=\"$name\"";
        $fieldHTML .= empty($placeholder) ? "" : " placeholder=\"$placeholder\" ";
        $fieldHTML .= empty($style) ? "" : " style=\"$style\" ";
        if ($type == 'checkbox') {
          $fieldHTML .= empty($value) ? "" : " checked='checked'";
          $fieldHTML .= ">\n";
        }
        else {
          $fieldHTML .= empty($value) ? "" : " value=\"$value\" ";
          $fieldHTML .= "><br>\n";
        }
        if (!empty($error_message)) {
          $fieldHTML .= "<span>" . $error_message . "</span><br>";
        }
        break;
      case 'textbox':
        $fieldHTML = " <textbox type=\"$type\" name=\"$name\"";
        $fieldHTML .= empty($placeholder) ? "" : " placeholder=\"$placeholder\" ";
        $fieldHTML .= empty($style) ? "" : " style=\"$style\" ";
        $fieldHTML .= "></textbox>\n";
        break;
      case 'submit':
        $fieldHTML = " <input type=\"$type\" name=\"$name\"";
        $fieldHTML .= empty($style) ? "" : " style=\"$style\" ";
        $fieldHTML .= empty($value) ? "" : " value=\"$value\" ";
        $fieldHTML .= "><br>\n";
        break;
      default:
        $fieldHTML = "Failed to Build Field. Please make sure that you have set the field properties correctly.<br />";
        break;
    }
    return $fieldHTML;
  }

  public function isValidForm() {
    $step = !isset($_POST['step']) ? 0 : $_POST['step'];
    switch ($step) {
      case 1:
        $total = (int) $_POST['total'];
        $combinations = (int) $_POST['combinations'];
        if ($total < $combinations || $combinations < 1) {
          return FALSE;
        }
        break;
      case 2:
        for ($i = 0; $i < $_POST['total']; $i++) {
          $quote = (int) $_POST['u' . $i];
          if ($quote < 1) {
            return FALSE;
          }
        }
        break;
      default:
    }
    return TRUE;
  }

  public function changeElements($formElements) {
    $elements = $formElements;
    $step = !isset($_POST['step']) ? 0 : $_POST['step'];
    switch ($step) {
      case 1:
        $total = (int) $_POST['total'];
        $combinations = (int) $_POST['combinations'];
        if ($total < $combinations || $combinations < 1) {
          $elements[0]['value'] = (int) $_POST['combinations'];
          $elements[1]['error_message'] = 'Wrong numbers, check again!';
          $elements[1]['value'] = (int) $_POST['total'];
        }
        break;
      case 2:
        for ($i = 0; $i < $_POST['total']; $i++) {
          $quote = (int) $_POST['u' . $i];
          $elements[2 * $i + 1]['value'] = (double) $_POST['u' . $i];
          if ($quote < 1) {
            $elements[2 * $i + 1]['error_message'] = 'Please insert regular odds.';
          }
          if (isset($_POST['w' . $i])) {
            $elements[2 * $i]['value'] = $_POST['w' . $i];
          }
        }
        break;
      default:
    }
    return $elements;
  }
}
