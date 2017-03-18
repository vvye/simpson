<?php

	function renderMenu() {

		global $currentPage;

		renderTemplate('menu', [
			'menuItems' => PAGES,
			'currentPageName' => $currentPage['name']
		]);

	}
