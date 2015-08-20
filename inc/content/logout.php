<?php

	$_SESSION = [];
	session_destroy();

	echo 'you logged out.';
	include 'inc/content/home.php';
