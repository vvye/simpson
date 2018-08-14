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
			'last_activity_time',
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


	function setUserData($userId, $data)
	{
		global $database;

		$database->update('users', [
			'email'        => strtolower(htmlspecialchars($data['email'])),
			'email_public' => $data['emailPublic'],
			'first_name'   => htmlspecialchars($data['firstName']),
			'last_name'    => htmlspecialchars($data['lastName']),
			'bio'          => htmlspecialchars($data['bio']),
		], [
			'id' => $userId
		]);
	}


	function userExists($userId)
	{
		global $database;

		$numUsers = $database->count('users', [
			'id' => $userId
		]);

		return (is_int($numUsers) && $numUsers === 1);
	}


	function getNumUsersByName($name)
	{
		global $database;

		$users = $database->select('users', [
			'first_name',
			'last_name'
		]);

		$users = array_filter($users, function ($user) use ($name) {
			return $user['first_name'] . ' ' . $user['last_name'] === $name;
		});

		return count($users);
	}


	function getUserIdByName($name)
	{
		global $database;

		$users = $database->select('users', [
			'id',
			'first_name',
			'last_name'
		]);

		$users = array_values(array_filter($users, function ($user) use ($name) {
			return $user['first_name'] . ' ' . $user['last_name'] === $name;
		}));

		if (empty($users))
		{
			return null;
		}
		return $users[0]['id'];
	}