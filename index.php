<?php

	/*
		simpson
	*/

	require_once __DIR__ . '/inc/functions/pages.php';
	require_once __DIR__ . '/inc/functions/templates.php';
	require_once __DIR__ . '/inc/functions/menu.php';


	getCurrentPage();

?><!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>simpson</title>
		<link rel="stylesheet" type="text/css" href="css/main.css">
	</head>
	<body>

		<header>
			<?php

				renderMenu();

			?>
		</header>

		<div class="main">
			<?php

				renderCurrentPage();

			?>
		</div>

	</body>
</html>