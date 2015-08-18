<?php

	/*
		simpson
		2015, by vvye
	*/

	require_once 'inc/functions/pages.php';
	require_once 'inc/functions/static_pages.php';

?>

<!DOCTYPE html>
<html lang="de">

	<head>
		<meta charset="UTF-8">
		<title>simpson</title>

		<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
		<!--[if lte IE 8]>
		<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-old-ie-min.css">
		<![endif]-->
		<!--[if gt IE 8]><!-->
		<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-min.css">
		<!--<![endif]-->

		<link rel="stylesheet" type="text/css" href="css/main.css" />

	</head>

	<body>

		<div class="pure-menu pure-menu-horizontal">
			<ul class="pure-menu-list">
				<li class="pure-menu-item"><a href="index.php" class="pure-menu-link">home</a></li>
				<li class="pure-menu-item"><a href="?p=profile" class="pure-menu-link">my profile</a></li>
				<?php
					$menuItems = getMenuItems();
					foreach ($menuItems as $id => $caption)
					{
						echo '<li class="pure-menu-item"><a href="?p=static&id=' . $id . '" class="pure-menu-link">'
							. $caption . '</a></li>';
					}
				?>
			</ul>
		</div>

		<div class="container">

			<?php

				$p = isset($_GET['p']) ? sanitize($_GET['p']) : 'home';

				if (file_exists($page = 'inc/content/' . $p . '.php'))
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
