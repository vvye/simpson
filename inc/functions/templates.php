<?php

	function renderTemplate($templateName, $vars = [])
	{
		$templateFilename = __DIR__ . '/../templates/' . $templateName . '.php';

		if (file_exists($templateFilename))
		{
			extract($vars);
			include $templateFilename;
		}
	}