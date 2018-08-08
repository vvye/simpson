<?php

	function getUser($userId)
	{
		global $database;

		$users = $database->select('users', [
			'id',
			'first_name',
			'last_name',
			'email',
			'email_public',
			'bio',
			'registration_time',
			'last_login_time',
			'admin',
			'banned'
		], [
			'id'    => $userId,
			'LIMIT' => 1
		]);

		if (count($users) !== 1)
		{
			return null;
		}

		return $users[0];
	}