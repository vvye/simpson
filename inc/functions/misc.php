<?php

	function renderMessage($msg)
	{
		renderTemplate('message', [
			'type'    => '',
			'message' => $msg
		]);
	}


	function renderSuccessMessage($msg)
	{
		renderTemplate('message', [
			'type'    => 'success',
			'message' => $msg
		]);
	}


	function renderErrorMessage($msg)
	{
		renderTemplate('message', [
			'type'    => 'error',
			'message' => $msg
		]);
	}