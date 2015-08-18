<?php

	function getMenuItems()
	{
		$menuItems = [];

		$filenames = glob('pages/*.md');
		foreach ($filenames as $filename)
		{
			$filename = substr(basename($filename), 0, -3);

			$order = explode('_', $filename, 2)[0];
			$caption = htmlentities(explode('_', $filename, 2)[1]);

			$menuItems[$order] = $caption;
		}
		ksort($menuItems);

		return $menuItems;
	}


	function getPageContent($id)
	{
		$filename = glob('pages/' . $id . '_*.md')[0];

		return file_get_contents($filename);
	}