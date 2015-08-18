<?php

	function sanitize($string)
	{
		return preg_replace('/[^A-Za-z0-9 ]/', '', $string);
	}