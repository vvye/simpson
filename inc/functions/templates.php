<?php

	function renderTemplate($templateName, $vars = [])
	{
		$templateFilename = __DIR__ . '/../lang/en/templates/' . $templateName . '.php';

		if (file_exists($templateFilename))
		{
			extract($vars);
			include $templateFilename;
		}
	}