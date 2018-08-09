<?php

	function renderMenu()
	{

		global $currentPage;

		$menuItems = array_filter(PAGES, function ($page) {
			return !isset($page['inMenu']) || $page['inMenu'];
		});

		renderTemplate('menu', [
			'menuItems'       => $menuItems,
			'currentPageName' => $currentPage['name']
		]);

	}
