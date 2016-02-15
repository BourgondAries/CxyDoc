<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<style>
			body { background-color: black; color: white; font-style: verdana, sans-serif; }
			input[type=submit] { width: 20%; }
			select { width: 20%; }
			pre { background-color: rgba(235, 236, 228, 0.2); padding: 1vh 1vw 1vh 1vw; }
			.vertical.space { height: 1vh; }
		</style>
		<title>Cxy: The Fourth Evolution</title>
	</head>
	<body>
		<?php
			function getNext($page, $jump=1) {
				return $page + $jump;
			}
			function getPrev($page, $jump=1) {
				$prev = $page - $jump;
				if ($prev <= 0)
					return 0;
				return $prev;
			}
			function createButton($page, $disabled) {
				if ($disabled == true)
					$disabled = " disabled";
				else
					$disabled = "";
				return "<input name=\"page\" type=\"submit\" value=\"$page\"$disabled>";
			}
			function getFileCountInDirectory($dir) {
				return iterator_count(new FilesystemIterator($dir, FilesystemIterator::SKIP_DOTS)) - 1;
			}
			function createDropDownMenu($page, $to) {
				$html = '<select name="page" onchange="this.form.submit();">';
				for ($i = 0; $i < $to; ++$i) {
					if ($i == $page)
						$selected = ' selected';
					else
						$selected = '';
					$html .= "<option$selected value=$i>$i</option>";
				}
				return $html . '</select>';
			}
			function doesPageExist($page) {
				return file_exists("pages/$page");
			}
			function getPage($page) {
				return file_get_contents("pages/$page");
			}

			$page = $_GET['page'];
			if (!isset($page))
				$page = 0;

			$prev = getPrev($page);
			$next = getNext($page);
			$prev5 = getPrev($page, 5);
			$next5 = getNext($page, 5);

			$page = intval($page);

			if (doesPageExist($page)) {
				echo '<form>';
				echo createButton($prev5, !doesPageExist("$prev5"));
				echo createButton($prev, !doesPageExist("$prev"));
				echo createDropDownMenu($page, getFileCountInDirectory('pages/'));
				echo createButton($next, !doesPageExist("$next"));
				echo createButton($next5, !doesPageExist("$next5"));
				echo "</form>";
				echo '<div class="vertical space"></div>';
				echo getPage($page);
			}
			else
				echo '
					<form>
						<input type="submit" name="page" value="0">
					</form>
					<pre> This part of the tutorial is not present </pre>';
		?>
	</body>
</html>
