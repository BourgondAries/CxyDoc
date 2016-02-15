<?php
	function getNext($page, $jump=1) {
		return $page + $jump;
	}
	function getPrev($page, $jump=1) {
		$prev = $page - $jump;
		return $prev;
	}
	function createButton($page, $disabled, $text) {
		if ($disabled == true)
			$disabled = " disabled";
		else
			$disabled = "";
		return "<button name=\"page\" type=\"submit\" value=\"$page\"$disabled>$text</button>";
	}
	function getFileCountInDirectory($dir) {
		$result = array();
		exec("ls pages/ | wc -l", $result);
		return $result[0];
	}
	function createDropDownMenu($page, $to) {
		return file_get_contents('autogen/navigation');
		$html = '<select name="page" onchange="this.form.submit();">';
		for ($i = 0; $i < $to; ++$i) {
			if ($i == $page)
				$selected = ' selected';
			else
				$selected = '';
			$html .= "<option$selected value=\"$i\">$i</option>";
		}
		return $html . '</select>';
	}
	function doesPageExist($page) {
		return file_exists("pages/$page");
	}
	function getPage($page) {
		return file_get_contents("pages/$page");
	}
	function getVerticalSpace() {
		return '<div class="vertical space"></div>';
	}
	function generateNavibar($page) {
		$prev = getPrev($page);
		$next = getNext($page);
		$prev5 = getPrev($page, 5);
		$next5 = getNext($page, 5);

		$page = intval($page);
		$html = '';
		$html .=  '<form>';
		$html .=  createButton($prev5, !doesPageExist("$prev5"), '<<');
		$html .=  createButton($prev, !doesPageExist("$prev"), '<');
		$html .=  "</form>";
		$html .=  '<form>';
		$html .=  createDropDownMenu($page, getFileCountInDirectory('pages/'));
		$html .=  "</form>";
		$html .=  '<form>';
		$html .=  createButton($next, !doesPageExist("$next"), '>');
		$html .=  createButton($next5, !doesPageExist("$next5"), '>>');
		$html .=  "</form>";
		return $html;
	}

?>
