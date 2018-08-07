<?php

	/*
		simpson
	*/

	session_start();

	require_once __DIR__ . '/inc/functions/database.php';
	require_once __DIR__ . '/inc/functions/session.php';
	require_once __DIR__ . '/inc/functions/pages.php';
	require_once __DIR__ . '/inc/functions/templates.php';
	require_once __DIR__ . '/inc/functions/menu.php';
	require_once __DIR__ . '/inc/strings.php';

	$currentPage = getCurrentPage();
	$database = getDatabase();

?><!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>simpson</title>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merriweather+Sans:300,300i,700" />
		<link rel="stylesheet" type="text/css" href="css/main.css" />
		<link rel="stylesheet" type="text/css" href="css/form.css" />
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

		<footer>
			<p>
				powered by <em>simpson</em>.
			</p>
		</footer>

	</body>
</html>