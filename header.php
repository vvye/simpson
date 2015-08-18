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
				<li class="pure-menu-item"><a href="index.php" class="pure-menu-link">Home</a></li>
				<li class="pure-menu-item"><a href="profile.php" class="pure-menu-link">My profile</a></li>
				<?php
					$menuItems = getMenuItems();
					foreach ($menuItems as $id => $caption)
					{
						echo '<li class="pure-menu-item"><a href="static.php?id=' . $id . '" class="pure-menu-link">'
							. $caption . '</a></li>';
					}
				?>
			</ul>
		</div>

		<div class="container">