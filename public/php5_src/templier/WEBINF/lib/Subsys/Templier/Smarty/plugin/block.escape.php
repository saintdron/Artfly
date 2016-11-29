<?php
function smarty_block_escape($params, $content, &$smarty) {
  if ($content === null) {
  } else {
    return htmlspecialchars($content);
  }
}
?>