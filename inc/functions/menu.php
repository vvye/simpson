<?php

	function renderMenu()
	{
		global $currentPage;

		$menuItems = array_filter(PAGES, function ($page) {
			return isset($page['inMenu']) && $page['inMenu'];
		});

		foreach ($menuItems as $key => $menuItem)
		{
			$menuItems[$key]['active'] = $menuItem['name'] === $currentPage['name']
				|| (isset($menuItem['related']) && in_array($currentPage['name'], $menuItem['related']));
		}

		renderTemplate('menu', [
			'menuItems'       => $menuItems,
		]);
	}
