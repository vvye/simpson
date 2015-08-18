<?php

	function sanitize($string)
	{
		return preg_replace('/[^A-Za-z0-9 ]/', '', $string);
	}


	function getDefaultMenuItems($currentPage)
	{
		return [
			'home'     => 'home',
			'messages' => 'messages',
			'profile'  => 'my profile',
			'admin'    => 'admin'
		];
	}
