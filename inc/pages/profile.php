<?php

	global $currentSubpageName;

	do
	{

		if ($currentSubpageName === DEFAULT_SUBPAGE_NAME)
		{
			$userId = $_SESSION['userId'];
			$isOwnProfile = true;
		}
		else
		{
			$userId = (int)$currentSubpageName;
			$isOwnProfile = false;
		}


		renderTemplate('profile', [
			'userId' => $userId
		]);

	} while (false);