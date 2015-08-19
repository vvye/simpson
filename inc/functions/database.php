<?php

	require_once 'inc/config/database.php';
	require_once 'inc/medoo.min.php';

	function getDatabase()
	{
		return new medoo([
			'database_type' => 'mysql',
			'database_name' => 'simpson',
			'server'        => DB_SERVER,
			'username'      => DB_USERNAME,
			'password'      => DB_PASSWORD,
			'charset'       => 'utf8'
		]);
	}
