<?php ## Использование wordwrap().
setlocale(LC_ALL, '');
echo mb_internal_encoding();
function cite($ourText, $maxlen=60, $prefix="> ") {
   $st = mb_strtolower($ourText);
   $st = wordwrap($st, $maxlen-strlen($prefix), "\n");
   $st = $prefix.str_replace("\n", "\n$prefix", $st);
   return $st;
}
echo "<pre>";
echo cite("Авыфв ЫФ АПМ В f art - flawless, sublime. A triumph
equalled only by its monumental failure. The inevitability
of its doom is apparent to me now as a consequence of the
imperfection inherent in every human being. Thus, I
redesigned it based on your history to more accurately reflect
the varying grotesqueries of your nature. However, I was again
frustrated by failure.", 20);
echo "</pre>";
?>