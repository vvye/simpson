<?php

	/*
		simpson
		2015, by vvye
	*/

	require_once 'inc/functions/pages.php';
	require_once 'inc/functions/menu.php';

	session_start();

	$currentPageName = isset($_GET['p']) ? sanitize($_GET['p']) : 'home';

?>
<!doctype html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<title>simpson</title>

		<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
		<!--[if lte IE 8]>
		<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-old-ie-min.css">
		<![endif]-->
		<!--[if gt IE 8]><!-->
		<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-min.css">
		<!--<![endif]-->

		<link rel="stylesheet" type="text/css" href="css/main.css"/>
		<link rel="stylesheet" type="text/css" href="css/messages.css"/>
	</head>

	<body>

		<div class="pure-menu pure-menu-horizontal">
			<ul class="pure-menu-list">

				<?php

					renderMenu($currentPageName);

				?>

			</ul>
		</div>

		<div class="container">

			<?php

				if (file_exists($page = 'inc/content/' . $currentPageName . '.php'))
				{
					include $page;
				}
				else
				{
					echo 'that page doesn\'t exist.';
				}

			?>

		</div>

		<footer>
			<p>powered by <em>simpson</em>.</p>
		</footer>

	</body>

</html>
