<?php

	require_once __DIR__ . '/../../config/user.php';


	define('MSG_EMAIL_TAKEN',
		'That e-mail address is taken.');

	define('MSG_PASSWORD_TOO_SHORT',
		'That password is too short (must be at least ' . MIN_PASSWORD_LENGTH . ' characters).');

	define('MSG_INVALID_FIRST_NAME',
		'That first name is invalid (must be 3-30 characters and contain only letters, numbers, spaces, - and _).');

	define('MSG_INVALID_LAST_NAME',
		'That last name is invalid (must be 3-30 characters and contain only letters, numbers, spaces, - and _).');

	define('MSG_EMAIL_MISSING',
		'Enter an e-mail address.');

	define('MSG_FIRST_NAME_MISSING',
		'Enter a first name.');

	define('MSG_LAST_NAME_MISSING',
		'Enter a last name.');

	define('MSG_USER_DOESNT_EXIST',
		'That user doesn\'t exist.');
