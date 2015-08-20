<?php

	$_SESSION = [];
	session_destroy();

	header('Location: index.php');
	die();
