<?php

	require_once 'inc/functions/pages.php';
	require_once 'inc/functions/static_pages.php';


	function renderMenu($currentPageName)
	{
		renderDefaultMenuItems($currentPageName);
		renderMenuItemsForStaticPages($currentPageName);
	}


	function renderDefaultMenuItems($currentPageName)
	{
		$menuItems = getDefaultMenuItems();
		foreach ($menuItems as $menuItem)
		{
			if (isset($menuItem['condition']) && !$menuItem['condition'])
			{
				continue;
			}

			$selected = ($menuItem['pageName'] === $currentPageName)
				? ' pure-menu-selected'
				: '';
			echo '<li class="pure-menu-item' . $selected . '">'
				. '<a href="?p=' . $menuItem['pageName'] . '" class="pure-menu-link">'
				. $menuItem['caption']
				. '</a></li>';
		}
	}


	function renderMenuItemsForStaticPages($currentPageName)
	{
		$menuItems = getMenuItemsForStaticPages();
		foreach ($menuItems as $id => $caption)
		{
			$selected = ($currentPageName === 'static' && isset($_GET['id']) && $id == $_GET['id'])
				? ' pure-menu-selected'
				: '';
			echo '<li class="pure-menu-item' . $selected . '">'
				. '<a href="?p=static&id=' . $id . '" class="pure-menu-link">'
				. $caption
				. '</a></li>';
		}
	}
