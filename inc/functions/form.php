<?php

	function getFieldValue($fieldName)
	{
		return $_POST[$fieldName] ?? ($_GET[$fieldName] ?? '');
	}