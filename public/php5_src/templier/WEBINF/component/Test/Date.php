<?php

class Test_Date extends Subsys_Templier_Component {
  // static
  function main($params) {
    return date($params['format']);
  }
}
?>