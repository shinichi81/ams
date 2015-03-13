<?php

function paging($totalmessages, $pagenow, $messagesperpage, $showpage, $function, $param) {
 	$start = 1;
	$amountofpages = ceil($totalmessages / $messagesperpage);
	
	/*foreach ($param as $key => $val) {
		if ($key == "type")
			$type = $val;
		else if ($key == "url")
			$url = $val;
		else if ($key == "id")
			$id = $val;
	}
	
	if (empty($param)) {
		$templateFunc = $function."(pagenum);";
	} else {
		if (count($param) == 1)
			$templateFunc = $function."('".$url."', pagenum);";
		else if (count($param) == 2)
			$templateFunc = $function."(pagenum, '".$type."', '".$url."');";
	}*/	
		
	$tempParam = "'".implode("','", $param)."'";
	$templateFunc = $function."(".$tempParam.");";
	
	if($amountofpages > $showpage) {
		if($pagenow >= 1 and $pagenow < $showpage) $start = 1;
		if($pagenow >= $showpage and $pagenow < ($showpage * 2) - 2) $start = $showpage - 1;
		for($i = 1; $i <= floor($amountofpages/$showpage); $i++) {
			if($pagenow >= ($showpage * ($i + 1)) - ($i * 2) and $pagenow < ($showpage * ($i + 2)) - (($i * 2) + 2)) $start = ($showpage * ($i + 1)) - (($i * 2) + 1);	
		}
	}
	
	$page = "";
	if($amountofpages <= $showpage) {
		for($k = $start; $k <= $amountofpages; $k++) {
			if($k == $pagenow) $link = "<strong>$k</strong> | ";
			else $link = "<a href=\"javascript:void(0);\" onclick=\"". str_replace("pagenum", $k, $templateFunc) ."\">$k</a> | ";
			//else $link = "<a href=\"$url&page=$k\">$k</a> ";		

			$page .= $link;
		}
	}
	else if($amountofpages > $showpage) {
		for($k = $start; $k < $start + $showpage; $k++) {
			if($k <= $amountofpages) {
				if($k == $pagenow) $link = "<strong>$k</strong> | ";
				else $link = "<a href=\"javascript:void(0);\" onclick=\"". str_replace("pagenum", $k, $templateFunc) ."\">$k</a> | ";
				//else $link = "<a href=\"$url&page=$k\">$k</a> ";

				$page .= $link;
			}
		}
	}
	
	// untuk menghilangkan "|" di bagian paling belakang
	$page = substr($page, 0, -2);
	
	/*				
	if($pagenow == 1) {
		$hopforbefore = 0;	
	}
	else {
		$hopforbefore = 1;
	}
				
	if($pagenow == $amountofpages) {
		$hopforafter = 0;
	}
	else {
		$hopforafter = 1;
	}
					
	$result->starts = "<a href=\"$url&page=1\">&laquo; First</a> ";
	$result->before = "<a href=\"$url&page=". ($pagenow - $hopforbefore) ."\">&#8249; Prev</a> ";
	$result->after = "<a href=\"$url&page=". ($pagenow + $hopforafter) ."\">Next &#8250;</a> ";
	$result->ends = "<a href=\"$url&page=$amountofpages\">Last &raquo;</a> ";
	$result->thispage = "Halaman $pagenow dari $amountofpages";
	*/
	
	return $page;
}