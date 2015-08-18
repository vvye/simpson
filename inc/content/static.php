<?php

	require_once 'inc/functions/static_pages.php';
	require_once 'inc/Parsedown.php';

	if (isset($_GET['id']))
	{
		$id = preg_replace('/[^0-9]/', '', $_GET['id']);

		$parsedown = new Parsedown();
		echo $parsedown->text(getStaticPageContent($id));
	}
