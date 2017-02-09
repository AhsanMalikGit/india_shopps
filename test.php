<?php
function cleanString($string)
{
	$res = str_replace(array('(', ')', '-'), '', $string);
	$res = str_replace(array('  '), ' ', $res);
	// allow only letters
	//$res = preg_replace('/[^\da-z ]/i', '', $string);
	// make lowercase
	$res = strtolower($res);
	// return
	$res = explode(' ', $string);
	return $res;
}

function spell_check($string1, $string2)
{
	$i = 0;
	$sims = 0;
	foreach($string1 as $str)
	{
		$i++;
		if(in_array($str, $string2))
		{
			unset($string1[$i]);
			unset($string2[$i]);
			$sims++;
		}
	}
	if(count($string1))
	{
		spell_check($string1,$string2);
	}
	return $sims;
}
$string1 = cleanString($a);
$string2 = cleanString($b);

spell_check($string1,$string2);

print_r($string1);
print_r($string2);

//$jam = similar_text($string2, $string1, $sims);
//$sims = levenshtein($a, $b);
echo $sims;
?>