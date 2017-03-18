<?php

	require_once __DIR__ . '/../vendor/Medoo.php';

	require_once __DIR__ . '/../config/database.php';


	function setupDatabase()
	{
		global $database;

		try
		{
			$database = new Medoo\Medoo([
				'server'        => DB_SERVER,
				'username'      => DB_USERNAME,
				'password'      => DB_PASSWORD,
				'database_name' => DB_DATABASENAME,
				'database_type' => 'mysql',
				'charset'       => DB_CHARSET
			]);
		}
		catch (Exception $e)
		{
			die('database error');
		}
	}
