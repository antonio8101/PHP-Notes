<?php

/**
 * Print copyright statement in the form of: Copyright AAAA © MYCOMPANY s.r.l..
 * using the actual year as AAAA...
 *
 * @param string $company
 *
 * @return string
 */
function getCopyRight(string $company): string{
	$year = date('Y', time());
	return "Copyright " . $year . " © " . $company;
}

echo getCopyRight("MYCOMPANY s.r.l.");