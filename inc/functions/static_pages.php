<?php

	function getMenuItemsForStaticPages()
	{
		$filenames = glob('static/*.md');
		if (empty($filenames))
		{
			return [];
		}

		$menuItems = [];
		foreach ($filenames as $filename)
		{
			$filename = substr(basename($filename), 0, -3);

			list($order, $caption) = explode('_', $filename, 2);
			$caption = htmlentities($caption);

			$menuItems[$order] = $caption;
		}
		ksort($menuItems);

		return $menuItems;
	}


	function getStaticPageContent($id)
	{
		$filenames = glob('static/' . $id . '_*.md');

		if (count($filenames) !== 1)
		{
			return 'that page doesn\'t exist.';
		}

		return file_get_contents($filenames[0]);
	}
