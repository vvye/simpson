<?php

	require_once __DIR__ . '/../vendor/Medoo.php';

	require_once __DIR__ . '/../config/database.php';


	function getDatabase()
	{
		try
		{
			return new Medoo\Medoo([
				'server'        => DB_SERVER,
				'username'      => DB_USERNAME,
				'password'      => DB_PASSWORD,
				'database_name' => DB_DATABASE_NAME,
				'database_type' => DB_DATABASE_TYPE,
				'charset'       => DB_CHARSET
			]);
		}
		catch (Exception $e)
		{
			die('database error');
		}
	}
