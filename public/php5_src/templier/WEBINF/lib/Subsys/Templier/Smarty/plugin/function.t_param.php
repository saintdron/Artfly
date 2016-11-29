<?php
// Replace (or add) URI parameter.
function smarty_function_t_param($params, &$smarty) {
	$t =& $smarty->Subsys_Templier;

	$href     = isset($params['href'])?   $params['href'] : $_SERVER['REQUEST_URI'];
	$name     = urlencode(isset($params['name'])?   $params['name'] : null);
	$value    = urlencode(isset($params['value'])?  $params['value'] : null);

	if ($href === null) {
		$smarty->trigger_error("croak[2]: t_param: missing 'href' parameter");
		return;
	}

	$new = preg_replace("/([?&]{$name}=)[^&?]*/s", '${1}'.$value, $href);
	if ($new == $href) {
		$div = strpos($href, "?")? "&" : "?";
		$new = $href.$div.$name."=".$value;
	}
			
	return $new;
}
?>