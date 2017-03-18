<?php

	require_once __DIR__ . '/../config/pages.php';


	function getCurrentPage()
	{
		$pages = PAGES;
		$currentPageName = $_GET['p'] ?? DEFAULT_PAGE_NAME;
		return $pages[$currentPageName] ?? ERROR_PAGE;
	}


	function renderCurrentPage()
	{
		global $currentPage;

		$pageName = $currentPage['name'];

		if (file_exists($filename = __DIR__ . '/../pages/' . $pageName . '.php'))
		{
			include $filename;
		}
		else
		{
			include __DIR__ . '/../pages/' . ERROR_PAGE['name'] . '.php';
		}
	}
