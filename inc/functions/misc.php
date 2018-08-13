<?php

	require_once __DIR__ . '/../config/misc.php';


	function renderAlert($msg)
	{
		renderTemplate('alert', [
			'type'    => '',
			'message' => $msg
		]);
	}


	function renderSuccessAlert($msg)
	{
		renderTemplate('alert', [
			'type'    => 'success',
			'message' => $msg
		]);
	}


	function renderErrorAlert($msg)
	{
		renderTemplate('alert', [
			'type'    => 'error',
			'message' => $msg
		]);
	}


	function renderDate($time, $includingRelativeTime = false)
	{
		$date = date(DEFAULT_DATE_FORMAT, $time);

		if (!$includingRelativeTime)
		{
			return $date;
		}

		$relativeTime = getRelativeTime($time);
		return '<span class="relative-time" title="' . $date . '">' . $relativeTime . '</span>';
	}


	function getRelativeTime($time)
	{
		$now = time();
		$diff = abs($now - $time);

		if ($diff < 10)
		{
			return 'right now';
		}
		$diffUnits = [
			'year'   => $diffYears = (int)floor($diff / 31556926),
			'month'  => $diffMonths = floor($diff / 2629744) % 12,
			'week'   => $diffWeeks = floor($diff / 604800) % 4,
			'day'    => $diffDays = $diffYears === 0 ? floor($diff / 86400) % 7 : 0,
			'hour'   => $diffHours = $diffYears === 0 && $diffMonths === 0 ? floor($diff / 3600) % 24 : 0,
			'minute' => $diffMinutes = $diffYears === 0 && $diffMonths === 0 && $diffWeeks === 0 ? floor($diff / 60) % 60 : 0,
			'second' => $diffSeconds = $diffYears === 0 && $diffMonths === 0 && $diffWeeks === 0 && $diffDays === 0 && $diffHours === 0 ? $diff % 60 : 0
		];
		$diffUnits = array_filter($diffUnits, function ($val) {
			return (int)$val !== 0;
		});
		$diffUnits = array_map(function ($unit, $value) {
			return $value . ' ' . $unit . ($value !== 1 ? 's' : '');
		}, array_keys($diffUnits), $diffUnits);

		$result = count($diffUnits) === 1
			? $diffUnits[0]
			: join(', ', array_slice($diffUnits, 0, -1)) . ' and ' . $diffUnits[count($diffUnits) - 1];

		return $now - $time > 0 ? $result . ' ago' : 'in ' . $result;
	}


	function obfuscateEmail($email)
	{
		return str_replace(['@', '.'], [' <code>at</code> ', ' <code>dot</code> '], $email);
	}


	function renderPagination($link, $page, $numPages)
	{
		if ($numPages === 1)
		{
			return;
		}

		$range = 2;
		$elision = false;

		echo '<ul class="pagination">';
		for ($i = 1; $i <= $numPages; $i++)
		{
			if ($i <= $range + 1 || $i >= $numPages - $range || ($page - $range <= $i && $page + $range >= $i))
			{
				$selected = ($i === $page) ? ' class="selected"' : '';
				echo '<li' . $selected . '><a href="' . $link . '&page=' . $i . '">' . $i . '</a></li>';
				$elision = false;
			}
			else if (!$elision)
			{
				echo '<li class="elision">&hellip;</li>';
				$elision = true;
			}
		}
		echo '</ul>';
	}


	function constrain(&$var, $min, $max)
	{
		if ($max < $min)
		{
			$tmp = $max;
			$max = $min;
			$min = $tmp;
		}

		if ($var < $min)
		{
			$var = $min;
		}
		else if ($var > $max)
		{
			$var = $max;
		}
	}