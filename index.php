<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<style>
			body { background-color: black; color: white; font-style: verdana, sans-serif; }
			input[type=submit] { width: 25%; }
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
				if ($page - $jump <= 0)
					return 0;
				return $page - $jump;
			}
			function createButton($page, $disabled) {
				if ($disabled == true)
					$disabled = " disabled";
				else
					$disabled = "";
				return "<input name=\"page\" type=\"submit\" value=\"$page\"$disabled>";
			}

			$page = $_GET['page'];
			if (!isset($page))
				$page = 0;

			$prev = getPrev($page);
			$next = getNext($page);
			$prev5 = getPrev($page, 5);
			$next5 = getNext($page, 5);

			$page = intval($page);

			if (file_exists("$page.cxy")) {
				echo "<form action=\"/\">";
				echo createButton($prev5, !file_exists("$prev5.cxy"));
				echo createButton($prev, !file_exists("$prev.cxy"));
				echo createButton($next, !file_exists("$next.cxy"));
				echo createButton($next5, !file_exists("$next5.cxy"));
				echo "</form>";
				echo '<div class="vertical space"></div>';
				echo file_get_contents("$page.cxy");
			}
			else
				echo '<pre> This part of the tutorial is not present </pre>
					<form>
						<input type="submit" name="page" value="0">
					</form?';
		?>
	</body>
</html>
